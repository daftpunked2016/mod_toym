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

	public function actionForgotPassword()
	{
		$this->layout = '/layouts/login';
		
		if(isset($_POST['reset']))
		{
			$email = $_POST['email'];

			if($email !== '')
			{
				$nominator = ToymNominator::model()->find('email = "'.$email.'"');
				
				if($nominator != null && $nominator->is_jci_member != 1)
				{
					$vlCode = $nominator->id.$nominator->salt;
					$hashedVlCode = sha1($vlCode);

					//EMAIL NOTIFICATION
					$email_notification = new EmailWrapper;
					$email_notification->setSubject('TOYM - JCIPH | RESET PASSWORD REQUEST');
					$email_notification->setReceivers(array(
						$email => $nominator->getFullName(),
					));
					$email_notification->setMessage(Yii::app()->controller->renderPartial('application.views.email_templates.nominator_forgot_password', ['nominator'=>$nominator, 'hashedVlCode'=>$hashedVlCode], true));
					$send_email = $email_notification->sendMessage();

					if($send_email) {	
						Yii::app()->user->setFlash('success','An email with the link for your Password Reset request, was sent to your Email Address.');
					} else {
						Yii::app()->user->setFlash('error','There\'s an error in sending the email. Please try again later.');
					}
				} else {
					if($nominator == null) {
						Yii::app()->user->setFlash('error','Nominator Account doesn\'t exist! The Username/Email Address you inputted was invalid. Please try again.');
					} else {
						if($nominator->is_jci_member == 1) {
							Yii::app()->user->setFlash('error','Your TOYM Nominator account is connected to your MyJCIP Account. Please request a reset password in this link: <a href="http://jci.org.ph/mod02/index.php/site/forgotpassword" target="_blank">MyJCIP Forgot Password</a>');
						}
					}
				}	
			}	
			else
				Yii::app()->user->setFlash('error','Please input your Username/Email Address first!');

		}

		$this->render('forgotpass');
	}

	public function actionRstPwd($vc, $ai)
	{
		$this->layout = '/layouts/login';
		$nominator = ToymNominator::model()->findByPk($ai);

		if($nominator != null)
		{
			$vlCode = $nominator->id.$nominator->salt;
			$hashedVlCode = sha1($vlCode);

			if($hashedVlCode === $vc)
			{
				if(isset($_POST['newpassword']))
				{
					if($_POST['newpassword'] === $_POST['confirmpassword'])
					{
						$nominator->setScenario('resetPwd');
						$nominator->new_password = $_POST['newpassword'];
						$nominator->confirm_password = $_POST['confirmpassword'];
						$valid = $nominator->validate();

						if($valid)
						{
							$nominator->password = $nominator->hashPassword($nominator->new_password, $nominator->salt);

							if($nominator->save(false))
							{
								Yii::app()->user->setFlash('success','You have successfully changed your password!');
								$this->redirect(array('login'));
							}
							else
							{
								 Yii::app()->user->setFlash('error','An error has occurred while trying to change your password. Please try again later.');
							}
						}
						else
							{print_r($nominator->getErrors());exit;}
					}
					else
						Yii::app()->user->setFlash('error','Passwords doesn\'t match!');


					$this->redirect(array('rstpwd', 'vc'=>$vc, 'ai'=>$ai));
				}

				$this->render('reset_password',array('nominator'=>$nominator));
			}
			else
			{
				Yii::app()->user->setFlash('error','INVALID LINK!');
				$this->redirect(array('login'));
			}
		}
		else
		{
			Yii::app()->user->setFlash('error','INVALID LINK!');
			$this->redirect(array('login'));
		}
	}
}