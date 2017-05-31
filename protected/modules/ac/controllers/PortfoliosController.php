<?php

class PortfoliosController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex($status = null)
	{
		$criteria = [];
		$condition = '';

		if($status == 1 || $status == 2) {
			$condition = "t.status_id = {$status}";
		}

		if(isset($_GET['credentials']) && $_GET['credentials'] != "") {
			if($condition != "") $condition .= " AND ";
			$condition .= "(CONCAT(nominee.firstname,' ', nominee.lastname) LIKE :credentials OR 
				CONCAT(nominator.firstname,' ', nominator.lastname) LIKE :credentials OR 
				nominee.email LIKE :credentials
			)";
			$criteria['params'] = [':credentials'=>'%'.$_GET['credentials'].'%'];
		}

		$criteria['condition'] = $condition;
		$criteria['order'] = 'nominator.date_created DESC'; 

		$portfolios = ToymPortfolio::model()->with([
			'nominee',
			'nominator'=>[
				'select'=> false,
				'condition'=> "chapter.area_no = ".Yii::app()->getModule('ac')->user->getState('area_no'),
        		'join' => "INNER JOIN jci_chapter AS chapter ON nominator.endorsing_chapter = chapter.id",
	   ]])->findAll($criteria);

		$portfoliosDP=new CArrayDataProvider($portfolios, array(
			'pagination' => array(
				'pageSize' => 15
			)
		));

		$this->render('portfolios', [
			'portfoliosDP' => $portfoliosDP,
			'status'=>$status,
		]);
	}
}