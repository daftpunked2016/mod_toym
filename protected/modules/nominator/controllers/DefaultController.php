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
		if(Yii::app()->getModule('nominator')->user->id) {
			$this->redirect('index');
		}

		$this->layout = '/layouts/login';
		
		$model = new NominatorLoginForm;
		
		if(isset($_POST['NominatorLoginForm']))
		{
			$model->attributes = $_POST['NominatorLoginForm'];
			
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
			
		Yii::app()->getModule('nominator')->user->logout(false);
		Yii::app()->user->setFlash('success', 'Logout Successful');
		$this->redirect(Yii::app()->getModule('nominator')->user->loginUrl);
	}

	public function actionChangePassword()
	{
		if(Yii::app()->getModule('nominator')->user->getState('account_id')) {
			Yii::app()->user->setFlash('error', 'Account not allowed to change password.');
			$this->redirect(array('default/index'));
		}

		$nominator = ToymNominator::model()->findByPk(Yii::app()->getModule('nominator')->user->id);

		if(!empty($_POST) && isset($_POST['ToymNominator'])) {
			
			$nominator->new_password = $_POST['ToymNominator']['new_password'];
			$nominator->confirm_password = $_POST['ToymNominator']['confirm_password'];
			$nominator->current_password = $_POST['ToymNominator']['current_password'];
			$nominator->setScenario('changePassword');

			if($nominator->validate()) {
				$nominator->password = $nominator->hashPassword($nominator->new_password, $nominator->salt);

				if($nominator->save(false)) {
					$nominator->new_password = $nominator->confirm_password = $nominator->current_password = "";
					Yii::app()->user->setFlash('success','Account password has been successfully changed');
				} else {
					Yii::app()->user->setFlash('error','An error occurred while running function. Please try again or report this issue to the administrator.');
				}
			} else {
				Yii::app()->user->setFlash('error','Please fix the form errors.');
			}
		}

		$this->render('change_password', [
			'nominator'=>$nominator
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