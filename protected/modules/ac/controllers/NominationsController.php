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

		if($status == 1 || $status == 2 || $status == 3 || $status == 4) {
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
			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = 2; //Approved to AC, Pending to NC/Admin

			if($nominee->save()) {	
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
			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = 3; //PENDING

			if($nominee->save()) {	
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
			$connection = Yii::app()->db;
			$transaction = $connection->beginTransaction();

			$nominee->status = 4; //REJECTED

			$email_notification = new EmailWrapper;
			$email_notification->setSubject('TOYM - JCIPH | REJECTION OF NOMINATION');
			$email_notification->setReceivers(array(
				$nominee->nominator->email => $nominee->nominator->getFullName(),
			));
			$email_notification->setMessage($this->renderPartial('application.views.email_templates.nominee_reject_notif', ['nominee'=>$nominee], true));
			$send_email = $email_notification->sendMessage();

			if($nominee->save() && $send_email) {	
				$transaction->commit();
				Yii::app()->user->setFlash('success','Nomination successfully Rejected');
			} else {
				$transaction->rollback();
				Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
			}

			$this->redirect(["nominees?status={$status}"]);
		}
	}
}