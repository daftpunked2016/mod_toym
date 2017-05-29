<?php

class AreaChairsController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex()
	{
		$criteria['order'] = 'area_no ASC'; 
		$acs = AreaChair::model()->findAll($criteria);

		$acsDP=new CArrayDataProvider($acs, array(
			'pagination' => array(
				'pageSize' => 15
			)
		));

		$this->render('index', [
			'acsDP' => $acsDP
		]);
	}

	public function actionAssign()
	{
		if(!empty($_POST) && isset($_POST['AreaChair'])) {
			$ac = new AreaChair();
			$ac->attributes = $_POST['AreaChair'];	
			$result = $ac->assign();

			echo json_encode($result);
			exit;
		} 
	}

	public function actionDelete($id = null)
	{
		$ac = AreaChair::model()->findByPk($id);

		if($ac->delete()) {
			Yii::app()->user->setFlash('success','Area Chair successfully deleted!');
		} else {
			Yii::app()->user->setFlash('error','An error occurred while running the function. Please try again or contact the JCI Quadrant Team for this issue.');
		}

		$this->redirect(['areachairs/index']);	
	}
}