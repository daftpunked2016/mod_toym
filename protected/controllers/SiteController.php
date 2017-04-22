<?php

class SiteController extends Controller
{
	use BasicHelper;

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset(Yii::app()->session['member'])) { $this->redirect(['site/nominate']); }

		$this->redirect(['site/checklogin']);
	}

	public function actionCheckLogin()
	{
		if(isset(Yii::app()->session['member'])) { $this->redirect(['site/nominate']); }

		$this->render('check_login', []);
	}

	public function actionProceedNominate()
	{
		if(isset($_POST['Account']) && !empty($_POST['Account'])) {
			$credentials = $_POST['Account'];
			$account_auth = Account::authenticate($credentials['username'], $credentials['password']);
			
			if($account_auth !== false) {
				Yii::app()->session['member'] = true;
				Yii::app()->session['account'] = $account_auth;
				$this->redirect(['site/nominate']);
			} else {
				Yii::app()->user->setFlash('error', '<li> Username / Password is incorrect. </li>');
				$this->redirect(['site/checklogin']);
			}
		} else {
			Yii::app()->session['member'] = false;
			$this->redirect(['site/nominate']);
		}
	}

	public function actionCancelNominate()
	{
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->redirect(['site/checklogin']);
	}

	public function actionNominate()
	{
		$session = Yii::app()->session;

		if(!isset($session['member'])) { $this->redirect(['site/checklogin']); }

		$nominator = new ToymNominator();
		$nominee = new ToymNominee();
		$nominee_info = new ToymNomineeInfo();
		$nominee_essays = new ToymNomineeEssays();
		
		if (isset($_POST['ToymNominator']) && isset($_POST['ToymNominee'])) {
			$nominator->attributes = $_POST['ToymNominator'];
			$nominee->attributes = $_POST['ToymNominee'];
			$nominee_info->attributes = $_POST['ToymNomineeInfo'];
			$nominee_essays->attributes = $_POST['ToymNomineeEssays'];
			$valid_files_loaded = false;
			
			if($this->validateFileInput('photograph_upload_id',$_FILES)) {
				$valid_files_loaded = true; $nominee_info->photograph_upload_id = 1;
			}

			if($this->validateFileInput('id_birth_cert_upload_id',$_FILES)) {
				$valid_files_loaded = true; $nominee_info->id_birth_cert_upload_id = 1;
			}

			$valid = $nominator->validate();
			$valid = $nominee->validate() && $valid;
			$valid = $nominee_info->validate() && $valid;
			$valid = $nominee_essays->validate() && $valid;

			if ($valid && $valid_files_loaded) {
				$transaction = Yii::app()->db->beginTransaction();

				try {
					if ($nominator->save()) {
						$nominee->nominator_id = $nominator->id;
						$nominee_info->addFileToAttr($_FILES['id_birth_cert_upload_id'], 'id_birth_cert_upload_id', $nominator->id);
						$nominee_info->addFileToAttr($_FILES['photograph_upload_id'], 'photograph_upload_id', $nominator->id);

						if ($nominee->save()) {	
							$nominee_info->nominee_id = $nominee->id;
							$nominee_essays->nominee_id = $nominee->id;
							$nomination = new ToymNomination();
							$nomination->nominator_id =  $nominator->id;
							$nomination->nominee_id = $nominee->id;
							
							if($nomination->save() && $nominee_info->save() && $nominee_essays->save()) {
								$transaction->commit();
								Yii::app()->session->clear();
								Yii::app()->session->destroy();
								Yii::app()->session->open();
								Yii::app()->user->setFlash('success', 'Nomination Complete! Please wait for the e-mail notification regarding your nomination. Thank you!');
								$this->redirect(['site/checklogin']);
							}
						}
					}
				} catch (Exception $e) {
					echo "<pre>";
					print_r($e);
					echo "</pre>";
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'Nomination Failed! Please try again later or contact the System Administrator if it happened repeatedly.');
				}
			} else {
				// echo "<pre>";
				// print_r($nominator->getErrors());
				// echo "<hr />";
				// print_r($nominee->getErrors());
				// echo "<hr />";
				// print_r($nominee_info->getErrors());
				// echo "</pre>";
				Yii::app()->user->setFlash('error', '<li> Validation Failed! Please double check the required fields and rules. </li>');
			}
		}

		$this->render('nominate', [
			'nominator'=>$nominator,
			'nominee'=>$nominee,
			'nominee_info'=>$nominee_info,
			'nominee_essays'=>$nominee_essays,
			'account'=> (isset($session['account'])) ? $session['account'] : null,
			'categories'=>ToymCategory::model()->findAll(['order'=>'catname ASC']),
			'subcategories'=>ToymSubcategory::model()->findAll(['order'=>'catdesc ASC']),
			'chapters'=>Chapter::model()->findAll(['order'=>'chapter ASC','condition'=>'id != 334 AND id != 338 AND id != 339 AND id != 340 AND id != 341']),
			'countries'=>Countries::model()->findAll(['order'=>'country_name ASC'])

		]);
	}

	public function actionListSubcategoryOptions()
	{
		$options = "<option value='' disabled selected>Select Subcategory..</option>";

		if(isset($_POST['category_id'])) {
			$subcategories = ToymSubcategory::model()->findAll([
				'condition'=>'catid = :category',
				'order'=>'catdesc ASC',
				'params'=>[':category'=>$_POST['category_id']]
			]);

			foreach ($subcategories as $subs) {
				$options .= "<option value=".$subs->id.">".$subs->catdesc."</option>";
			}	
		}

		echo $options;
		exit;
	}

	/**
	 * This is the action to handle external exceptions.
	 */
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

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}