<?php

class NominatorModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'nominator.models.*',
			'nominator.components.*',
		));

		$this->setComponents(array(
            'errorHandler'=>array(
                'errorAction'=>'/nominator/default/error',
			),
            'user'=>array(
                'class'=>'WebNominator',  
				'allowAutoLogin'=>true,				
                'loginUrl'=>Yii::app()->createUrl('/nominator/default/login'),
            ),
        ));
		
		Yii::app()->user->setStateKeyPrefix('_parent');
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			Yii::app()->errorHandler->errorAction='nominator/default/error';

			$route = $controller->id . '/' . $action->id;
			
			$publicPages = array(
				'default/login',
				'default/error',
				'default/forgotpassword',
				'default/rstpwd',
			);
			
			// if(Yii::app()->getModule('nominator')->user->isGuest && !in_array($route,$publicPages))
			if(Yii::app()->getModule('nominator')->user->isGuest && !in_array($route,$publicPages)) {            
				Yii::app()->getModule('nominator')->user->loginRequired();                
			}


			else
				return true;
		}
		else
			return false;
	}
}
