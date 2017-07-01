<?php

class NominationsController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex()
	{
		$this->redirect('nominees');
	}

	public function actionNominees($status = null)
	{
		$criteria = [];
		$condition = '';

		if($status == 1 || $status == 2 || $status == 3 || $status == 4 || $status == 5) {
			$condition = "status = {$status}";
		}

		if(isset($_GET['credentials']) && $_GET['credentials'] != "") {
			if($condition != "") $condition .= " AND ";
			$condition .= "(CONCAT(t.firstName,' ', t.lastname) LIKE :credentials OR 
				CONCAT(nominator.firstName,' ', nominator.lastname) LIKE :credentials OR 
				t.email LIKE :credentials
			)";
			$criteria['params'] = [':credentials'=>'%'.$_GET['credentials'].'%'];
		}

		$criteria['condition'] = $condition;
		$criteria['order'] = 't.date_created DESC'; 

		$nominees = ToymNominee::model()
			->with([
				'nominator'=>[
					'select'=> false,
					'condition'=> "chapter.area_no = ".Yii::app()->getModule('ac')->user->getState('area_no'),
            		'join' => "INNER JOIN jci_chapter AS chapter ON nominator.endorsing_chapter = chapter.id",
				]   
			])
			->findAll($criteria);

		$nomineesDP=new CArrayDataProvider($nominees, array(
			'pagination' => array(
				'pageSize' => 15
			)
		));

		$this->render('nominees', [
			'nomineesDP' => $nomineesDP,
			'status'=>$status,
		]);
	}

	public function actionApprove($id, $status = null)
	{
		$nominee = ToymNominee::model()->findByPk($id);
		
		if($nominee)
		{
			$nominator = ToymNominator::model()->findByPk($nominee->nominator_id);

			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = $nominator->status_id = 2; //Approved to AC, Pending to NC/Admin

			if($nominee->save() && $nominator->save()) {	
				$transaction->commit();
				Yii::app()->user->setFlash('success','Nomination successfully Approved');
			} else {
				$transaction->rollback();
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
			}

			$this->redirect(["nominees?status={$status}"]);
		}
	}


	public function actionReturnToPending($id, $status = null)
	{
		$nominee = ToymNominee::model()->findByPk($id);

		if($nominee)
		{
			$nominator = ToymNominator::model()->findByPk($nominee->nominator_id);

			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = $nominator->status_id = 3; //PENDING

			if($nominee->save() && $nominator->save()) {	
				$transaction->commit();
				Yii::app()->user->setFlash('success','Nomination successfully reverted to Pending status.');
			} else {
				$transaction->rollback();
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
			}

			$this->redirect(["nominees?status={$status}"]);
		}
	}

	public function actionReject($id, $status = null)
	{
		$nominee = ToymNominee::model()->findByPk($id);

		if($nominee)
		{
			$nominator = ToymNominator::model()->findByPk($nominee->nominator_id);

			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = $nominator->status_id = 5; //REJECTED BY AC

			$email_notification = new EmailWrapper;
			$email_notification->setSubject('TOYM - JCIPH | Nomination Status: Pending - Lack of Requirements');
			$email_notification->setReceivers(array(
				$nominee->nominator->email => $nominee->nominator->getFullName(),
			));
			$email_notification->setMessage($this->renderPartial('application.views.email_templates.nominee_reject_notif', ['nominee'=>$nominee], true));
			$send_email = $email_notification->sendMessage();

			if($nominee->save() && $nominator->save() && $send_email) {	
				$transaction->commit();
				Yii::app()->user->setFlash('success','Nomination successfully Rejected');
			} else {
				$transaction->rollback();
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
			}

			$this->redirect(["nominees?status={$status}"]);
		}
	}

	public function actionViewDetails()
	{
		if(isset($_POST['id'])) {
			$nominee_id = $_POST['id'];
			$nominee =  ToymNominee::model()->findByPk($nominee_id);
			$nominator = ToymNominator::model()->findByPk($nominee->nominator_id);
	    	$nominee_essays = ToymNomineeEssays::model()->find("nominee_id = {$nominee->id}");
	    	$nominee_info = ToymNomineeInfo::model()->find("nominee_id = {$nominee->id}");

	    	if($nominee_info == null) $nominee_info = new ToymNomineeInfo();
	    	
	    	echo $this->renderPartial('_view_details', [
	    		'nominee'=>$nominee,
	    		'nominator'=>$nominator,
	    		'nominee_essays'=>$nominee_essays,
	    		'nominee_info'=>$nominee_info,
	    		'categories'=>ToymCategory::model()->findAll(['order'=>'catname ASC']),
				'subcategories'=>ToymSubcategory::model()->findAll(['order'=>'catdesc ASC']),
				'chapters'=>Chapter::model()->findAll(['order'=>'chapter ASC','condition'=>'id != 334 AND id != 338 AND id != 339 AND id != 340 AND id != 341']),
				'countries'=>Countries::model()->findAll(['order'=>'country_name ASC'])
	    	]);
		}
	}


}