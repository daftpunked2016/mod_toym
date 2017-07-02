<?php

class DefaultController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex()
	{
		$area_regions = AreaRegion::model()->findAll();
		$area_regions_arr = [];

		foreach($area_regions as $region) {
			if(!isset($area_regions_arr[$region->area_no])) {
				$area_regions_arr[$region->area_no] = [$region];
			} else {
				$area_regions_arr[$region->area_no][] = $region;
			}
		}

		$this->render('index', ['area_regions'=>$area_regions_arr]);
	}

	public function actionListChapters($rid)
	{
		$region = AreaRegion::model()->findByPk($rid);
		$chapters = Chapter::model()->findAll(array('condition'=>'region_id = :rid', 'params'=>array(':rid'=>$rid)));
		
		$chaptersDP=new CArrayDataProvider($chapters, array(
			'pagination' => array(
		        'pageSize'=>50,
		    ),
		));

		$this->render('chapters', array(
			'chaptersDP'=>$chaptersDP,
			'region'=>$region,
		));
	}

	public function actionLogin()
	{
		if(Yii::app()->getModule('admin')->user->id) {
			$this->redirect('index');
		}

		$this->layout = '/layouts/login';
		
		$model = new AdminLoginForm;
		
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes = $_POST['AdminLoginForm'];
			
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
			
		Yii::app()->getModule('admin')->user->logout(false);
		Yii::app()->user->setFlash('success', 'Logout Successful');
		$this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
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