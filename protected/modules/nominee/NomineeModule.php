<?php

class NomineeModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'nominee.models.*',
			'nominee.components.*',
		));

		$this->setComponents(array(
            'errorHandler'=>array(
                'errorAction'=>'/nominee/default/error',
			),
            'user'=>array(
                'class'=>'WebNominee',  
				'allowAutoLogin'=>true,				
                'loginUrl'=>Yii::app()->createUrl('/nominee/default/login'),
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
			Yii::app()->errorHandler->errorAction='nominee/default/error';

			$route = $controller->id . '/' . $action->id;
			
			$publicPages = array(
				'default/login',
				'default/error',
				'default/forgotpassword',
				'default/rstpwd',
			);
			
			// if(Yii::app()->getModule('nominee')->user->isGuest && !in_array($route,$publicPages))
			if(Yii::app()->getModule('nominee')->user->isGuest && !in_array($route,$publicPages)) {            
				Yii::app()->getModule('nominee')->user->loginRequired();                
			}


			else
				return true;
		}
		else
			return false;
	}
}
