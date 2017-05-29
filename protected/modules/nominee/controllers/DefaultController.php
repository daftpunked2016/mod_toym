<?php

class DefaultController extends Controller
{
	public $layout = '/layouts/main';
	
	public function actionIndex()
	{
		$this->redirect(['nomination/info']);
	}

	public function actionLogin()
	{
		$this->layout = '/layouts/login';
		
		$model = new NomineeLoginForm;
		
		if(isset($_POST['NomineeLoginForm']))
		{
			$model->attributes = $_POST['NomineeLoginForm'];
			
			if ($model->validate() && $model->login())
			{
				// $transaction = new Transaction;
				// $transaction->generateLog(Yii::app()->getModule("admin")->user->id, Transaction::TYPE_LOGIN);
				$this->redirect(array('default/index'));
			}
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		if(isset($_SESSION['token']))
			unset($_SESSION['token']);
			
		Yii::app()->getModule('nominee')->user->logout(false);
		Yii::app()->user->setFlash('success', 'Logout Successful');
		$this->redirect(Yii::app()->getModule('nominee')->user->loginUrl);
	}

	public function actionChangePassword()
	{
		$nominee = ToymNominee::model()->findByPk(Yii::app()->getModule('nominee')->user->id);

		if(!empty($_POST) && isset($_POST['ToymNominee'])) {
			
			$nominee->new_password = $_POST['ToymNominee']['new_password'];
			$nominee->confirm_password = $_POST['ToymNominee']['confirm_password'];
			$nominee->current_password = $_POST['ToymNominee']['current_password'];
			$nominee->setScenario('changePassword');

			if($nominee->validate()) {
				$nominee->temp_password = "";
				$nominee->password = $nominee->hashPassword($nominee->new_password, $nominee->salt);

				if($nominee->save(false)) {
					$nominee->new_password = $nominee->confirm_password = $nominee->current_password = "";
					Yii::app()->user->setFlash('success','Account password has been successfully changed');
				} else {
					//echo "<pre>";
					//print_r($nominee->getErrors());
					//echo "</pre>";
					Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
				}
			} else {
				Yii::app()->user->setFlash('error','Please fix the form errors.');
			}
		}

		$this->render('change_password', [
			'nominee'=>$nominee
		]);
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}