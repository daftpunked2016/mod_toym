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

	public function actionForgotPassword()
	{
		$this->layout = '/layouts/login';
		
		if(isset($_POST['reset']))
		{
			$email = $_POST['email'];

			if($email !== '')
			{
				$nominee = ToymNominee::model()->find('email = "'.$email.'"');
				
				if($nominee != null)
				{
					$vlCode = $nominee->id.$nominee->salt.$nominee->nominator_id;
					$hashedVlCode = sha1($vlCode);

					//EMAIL NOTIFICATION
					$email_notification = new EmailWrapper;
					$email_notification->setSubject('TOYM - JCIPH | RESET PASSWORD REQUEST');
					$email_notification->setReceivers(array(
						$email => $nominee->getFullName(),
					));
					$email_notification->setMessage(Yii::app()->controller->renderPartial('application.views.email_templates.nominee_forgot_password', ['nominee'=>$nominee, 'hashedVlCode'=>$hashedVlCode], true));
					$send_email = $email_notification->sendMessage();

					if($send_email) {	
						Yii::app()->user->setFlash('success','An email with the link for your Password Reset request, was sent to your Email Address.');
					} else {
						Yii::app()->user->setFlash('error','There\'s an error in sending the email. Please try again later.');
					}
				}
				else
					Yii::app()->user->setFlash('error','Nominee Account doesn\'t exist! The Username/Email Address you inputted was invalid. Please try again.');
			}	
			else
				Yii::app()->user->setFlash('error','Please input your Username/Email Address first!');

		}

		$this->render('forgotpass');
	}

	public function actionRstPwd($vc, $ai)
	{
		$this->layout = '/layouts/login';
		$nominee = ToymNominee::model()->findByPk($ai);

		if($nominee != null)
		{
			$vlCode = $nominee->id.$nominee->salt.$nominee->nominator_id;
			$hashedVlCode = sha1($vlCode);

			if($hashedVlCode === $vc)
			{
				if(isset($_POST['newpassword']))
				{
					if($_POST['newpassword'] === $_POST['confirmpassword'])
					{
						$nominee->setScenario('resetPwd');
						$nominee->new_password = $_POST['newpassword'];
						$nominee->confirm_password = $_POST['confirmpassword'];
						$valid = $nominee->validate();

						if($valid)
						{
							$nominee->password = $nominee->hashPassword($nominee->new_password, $nominee->salt);

							if($nominee->save(false))
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
							{print_r($nominee->getErrors());exit;}
					}
					else
						Yii::app()->user->setFlash('error','Passwords doesn\'t match!');


					$this->redirect(array('rstpwd', 'vc'=>$vc, 'ai'=>$ai));
				}

				$this->render('reset_password',array('nominee'=>$nominee));
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