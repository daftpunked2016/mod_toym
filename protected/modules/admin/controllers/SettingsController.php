<?php

class SettingsController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex()
	{
		$settings = ToymSettings::model()->findAll();
		$settings_arr = [];

		foreach($settings as $s) {
			$settings_arr[$s->code] = $s;
		}

		$this->render('index', [
			'settings'=>$settings_arr,
		]);
	}

	public function actionSave()
	{
		$response = ['type' => false];

		if(!empty($_POST)) {
			$setting = ToymSettings::model()->find('code = :code',[':code'=> $_POST['name'] ]);
			$setting->status = $_POST['value'];

			if($setting->save()) {
				$response['type'] = true;
				$response['message'] = "Setting changes has been saved!";
			} else {
				$response['message'] = 'Saving Failed! Please try again later or contact the System Administrator if it happened repeatedly.';
			}
		}

		echo json_encode($response);
    	exit;
	}
}