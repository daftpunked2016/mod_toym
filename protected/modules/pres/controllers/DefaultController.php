<?php

class DefaultController extends Controller
{
	public $layout = '/layouts/main';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionLogin()
	{
		$this->layout = '/layouts/login';
		
		$model = new PresLoginForm;
		
		if(isset($_POST['PresLoginForm']))
		{
			$model->attributes = $_POST['PresLoginForm'];
			
			if ($model->validate() && $model->login())
			{
				// $transaction = new Transaction;
				// $transaction->generateLog(Yii::app()->getModule("admin")->user->id, Transaction::TYPE_LOGIN);
				$this->redirect(array('default/index'));
			}
		}

		$this->render('login',array('model'=>$model));
	}
}