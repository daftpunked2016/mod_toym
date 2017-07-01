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
		$nominator_condition = ['select' => false];

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

		if(isset($_GET['area_no']) && $_GET['area_no'] != "") {
			$nominator_condition['condition'] = "chapter.area_no = :area_no";
			$nominator_condition['join'] = "INNER JOIN jci_chapter AS chapter ON nominator.endorsing_chapter = chapter.id";
			$nominator_condition['params'] = [':area_no'=>$_GET['area_no']];
		}

		if(isset($_GET['chapter_id']) && $_GET['chapter_id'] != "") {
			$nominator_condition['condition'] = "nominator.endorsing_chapter = :chapter_id";
			$nominator_condition['params'] = [':chapter_id' => $_GET['chapter_id']];
		}

		$criteria['condition'] = $condition;
		$criteria['order'] = 't.date_created DESC'; 

		$nominees = ToymNominee::model()->with(['nominator'=>$nominator_condition])->findAll($criteria);

		$nomineesDP=new CArrayDataProvider($nominees, array(
			'pagination' => array(
				'pageSize' => 15
			)
		));

		$this->render('nominees', [
			'nomineesDP' => $nomineesDP,
			'status'=>$status,
			'chapters'=>Chapter::model()->findAll(['order'=>'chapter ASC','condition'=>'id != 334 AND id != 338 AND id != 339 AND id != 340 AND id != 341']),
		]);
	}

	public function actionApprove($id, $status = null)
	{
		$nominee = ToymNominee::model()->findByPk($id);

		if($nominee->approveNomination())
		{
			$nominator = ToymNominator::model()->findByPk($nominee->nominator_id);
			$nominator->status_id = 1;

			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();
			
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

			$nominee->status = $nominator->status_id = 2; //PENDING


			if($nominee->save() && $nominator->save()) {	
				$transaction->commit();
				Yii::app()->user->setFlash('success','Nomination successfully reverted to Pending status.');
			} else {
				$transaction->rollback();
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again.');
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

			$nominee->status = $nominator->status_id = 4; //REJECTED BY NC

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
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again.');
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