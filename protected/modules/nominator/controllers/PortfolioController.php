<?php

class PortfolioController extends Controller
{
	public $layout = '/layouts/main';

	public function actionIndex()
	{
		$this->redirect('build');
	}

	public function actionBuild($page = 1)
	{
		$nominator_id = Yii::app()->getModule('nominator')->user->id;
		$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");

		if($portfolio == null) {
			$portfolio = new ToymPortfolio();
		}

		if($page != 1 && $page != 2 && $page != 3) {
			$page = 1;
		}

		$this->render("build", [
			'portfolio'=>$portfolio, 
			'page'=>$page
		]);
	}

	public function actionSave()
	{	
		if((!empty($_POST) && isset($_POST['ToymPortfolio'])) || (!empty($_FILES))) {
			$response = ['type'=>false];
			$nominator_id = Yii::app()->getModule('nominator')->user->id;
			$nomination = ToymNomination::model()->find("nominator_id = {$nominator_id}");
			$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");

			if($portfolio == null) {
				$portfolio = new ToymPortfolio();
				$portfolio->created_by = json_encode(['NR'=>$nominator_id]);
			} else {
				$portfolio->updated_by = json_encode(['NR'=>$nominator_id]);
			}

			$portfolio->attributes = $_POST['ToymPortfolio'];
			$portfolio->nominator_id = $nominator_id;
			$portfolio->nomination_id = $nomination->id;
			$portfolio->nominee_id = $nomination->nominee_id;
		
			if($portfolio->validate()) {
				$transaction = Yii::app()->db->beginTransaction();

				try {
					if(isset($_FILES['supporting_photo_1'])) $portfolio->addFileToAttr($_FILES['supporting_photo_1'], 'supporting_photo_1', $nominator_id);
					if(isset($_FILES['supporting_photo_2'])) $portfolio->addFileToAttr($_FILES['supporting_photo_2'], 'supporting_photo_2', $nominator_id);
					if(isset($_FILES['supporting_photo_3'])) $portfolio->addFileToAttr($_FILES['supporting_photo_3'], 'supporting_photo_3', $nominator_id);
					if(isset($_FILES['supporting_photo_4'])) $portfolio->addFileToAttr($_FILES['supporting_photo_4'], 'supporting_photo_4', $nominator_id);
					if(isset($_FILES['id_birth_cert_upload_id'])) $portfolio->addFileToAttr($_FILES['id_birth_cert_upload_id'], 'id_birth_cert_upload_id', $nominator_id);
					if(isset($_FILES['photograph_upload_id'])) $portfolio->addFileToAttr($_FILES['photograph_upload_id'], 'photograph_upload_id', $nominator_id);
					if(isset($_FILES['nbi_clearance_id'])) $portfolio->addFileToAttr($_FILES['nbi_clearance_id'], 'nbi_clearance_id', $nominator_id);

					if ($portfolio->save()) {	
						$transaction->commit();
						$response['type'] = true;
						$response['message'] = 'Changes have been successfully saved.';
					}
				} catch (Exception $e) {
					$response['message'] = 'Saving Failed! Please try again later or contact the System Administrator if it happened repeatedly.';
				}
			} else {
				 $response['message'] = 'Validation Failed! Please double check the required fields and rules.';
				 $response['field_error_messages'] = $portfolio->getErrors();
			}
		}

		echo json_encode($response);
		exit;
	}

	public function actionSubmit()
	{

	}

	public function actionWaiver()
	{
		$this->renderPartial('waiver');
	}
}