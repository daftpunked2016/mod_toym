<?php

class PortfolioController extends Controller
{
	use BasicHelper;

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
		$response = ['type'=>true];

		if((!empty($_POST)) || (!empty($_FILES))) {
			$nominator_id = Yii::app()->getModule('nominator')->user->id;
			$nomination = ToymNomination::model()->find("nominator_id = {$nominator_id}");
			$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");
			$response['type'] = false;
			
			if($portfolio == null) {
				$portfolio = new ToymPortfolio();
				$portfolio->created_by = json_encode(['NR'=>$nominator_id]);
				$portfolio->nominee_id = $nomination->nominee_id;
				$portfolio->nomination_id = $nomination->id;
				$portfolio->nominator_id = $nominator_id;
			} else {
				$portfolio->updated_by = json_encode(['NR'=>$nominator_id]);
			}

			$portfolio->setScenario('page'.$_POST['page']);

			if(isset($_POST['ToymPortfolio']))
				$portfolio->attributes = $_POST['ToymPortfolio'];
			
			$transaction = Yii::app()->db->beginTransaction();

			if(isset($_FILES['supporting_photo_1'])) $portfolio->uploadEachFileToAttr($_FILES['supporting_photo_1'], 'supporting_photo_1', $nominator_id, null);
			if(isset($_FILES['supporting_photo_2'])) $portfolio->uploadEachFileToAttr($_FILES['supporting_photo_2'], 'supporting_photo_2', $nominator_id, null);
			if(isset($_FILES['supporting_photo_3'])) $portfolio->uploadEachFileToAttr($_FILES['supporting_photo_3'], 'supporting_photo_3', $nominator_id, null);
			if(isset($_FILES['supporting_photo_4'])) $portfolio->uploadEachFileToAttr($_FILES['supporting_photo_4'], 'supporting_photo_4', $nominator_id, null);
			if(isset($_FILES['id_birth_cert_upload_id'])) $portfolio->addFileToAttr($_FILES['id_birth_cert_upload_id'], 'id_birth_cert_upload_id', $nominator_id, null);
			if(isset($_FILES['photograph_upload_id'])) $portfolio->addFileToAttr($_FILES['photograph_upload_id'], 'photograph_upload_id', $nominator_id, null);
			if(isset($_FILES['nbi_clearance_upload_id'])) $portfolio->addFileToAttr($_FILES['nbi_clearance_upload_id'], 'nbi_clearance_upload_id', $nominator_id, null);

			if(isset($_POST['change_page']) && $portfolio->status_id != 1) {
				$validate = true;
			} else {
				$validate = $portfolio->validate();
			}

			if($validate) {
			
				try {
					if ($portfolio->save(false)) {	
						$transaction->commit();
						$response['type'] = true;
						$response['message'] = 'Changes have been successfully saved.';
					}
				} catch (Exception $e) {
					$transaction->rollback();
					echo "<pre>";
					print_r($e);
					$response['message'] = 'Saving Failed! Please try again later or contact the System Administrator if it happened repeatedly.';
				}
			} else {
				$transaction->rollback();
				$response['message'] = 'Validation Failed! Please double check the required fields and rules.';
				$response['field_error_messages'] = $portfolio->getErrors();
			}
		}

		echo json_encode($response);
		exit;
	}

	public function actionDeleteSupportingImage()
	{
		if(isset($_POST['fid'])) {
			$response['type'] = false;
			$response['message'] = 'Error in deleting image file!';

			$transaction = Yii::app()->db->beginTransaction();
			$file_upload = ToymFileUploads::model()->findByPk($_POST['fid']);
			$nominator_id = Yii::app()->getModule('nominator')->user->id;
			$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");
			$attribute = $_POST['attribute'];

			if(rename($file_upload->getServerPath(), "fileuploads/tmp/{$file_upload->filename}")) {
				if($this->deleteRec($file_upload)) {
					$file_ids = json_decode($portfolio->$attribute);
					$file_key = array_search($_POST['fid'], $file_ids);
					unset($file_ids[$file_key]);

					$portfolio->$attribute = (empty($file_ids)) ? "" : json_encode(array_values($file_ids));
					$portfolio->updated_by = json_encode(['NR'=>$nominator_id]);

					if($portfolio->save()) {
						$transaction->commit();
						$response['type'] = true;
						$response['message'] = "Image file has been deleted successfully";
					}
					
				} else {
					$transaction->rollback();
				}
			}

			echo json_encode($response);
			exit;
		}
	}

	public function actionDeleteFile()
	{
		if(isset($_POST['fid'])) {
			$response['type'] = false;
			$response['message'] = 'Error in deleting file!';

			$transaction = Yii::app()->db->beginTransaction();
			$file_upload = ToymFileUploads::model()->findByPk($_POST['fid']);
			$nominator_id = Yii::app()->getModule('nominator')->user->id;
			$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");
			$attribute = $_POST['attribute'];

			if(rename($file_upload->getServerPath(), "fileuploads/tmp/{$file_upload->filename}")) {
				if($this->deleteRec($file_upload)) {
					$portfolio->$attribute = "";
					$portfolio->updated_by = json_encode(['NR'=>$nominator_id]);

					if($portfolio->save()) {
						$transaction->commit();
						$response['type'] = true;
						$response['message'] = "Image file has been deleted successfully";
					}
					
				} else {
					$transaction->rollback();
				}
			}

			echo json_encode($response);
			exit;
		}
	}

	public function actionSubmit()
	{
		$response = ['type' => false];
		$nominator_id = Yii::app()->getModule('nominator')->user->id;

		$portfolio = ToymPortfolio::model()->find("nominator_id = {$nominator_id}");
		if(!$portfolio) $portfolio = new ToymPortfolio();
		$portfolio->setScenario('submit');

		if(isset($_FILES['id_birth_cert_upload_id'])) $portfolio->addFileToAttr($_FILES['id_birth_cert_upload_id'], 'id_birth_cert_upload_id', $nominator_id, null);
		if(isset($_FILES['photograph_upload_id'])) $portfolio->addFileToAttr($_FILES['photograph_upload_id'], 'photograph_upload_id', $nominator_id, null);
		if(isset($_FILES['nbi_clearance_upload_id'])) $portfolio->addFileToAttr($_FILES['nbi_clearance_upload_id'], 'nbi_clearance_upload_id', $nominator_id, null);
		
		$nominator = ToymNominator::model()->findByPk($nominator_id);
    	$nominee =  ToymNominee::model()->find("nominator_id = {$nominator_id}");
    	$nominee_essays = ToymNomineeEssays::model()->find("nominee_id = {$nominee->id}");
    	$nominee_info = ToymNomineeInfo::model()->find("nominee_id = {$nominee->id}");
    	if(!$nominee_info) $nominee_info = new ToymNomineeInfo();

    	$nomination_info_validate = $nominee->validate() && $nominee_essays->validate() && $nominee_info->validate() && $nominator->validate();
    	$portfolio_validate = $portfolio->validate();

    	$transaction = Yii::app()->db->beginTransaction();

    	if($nomination_info_validate && $portfolio_validate) {
    		$portfolio->date_submitted = date('Y-m-d H:i:s');
    		$portfolio->status_id = 1; //COMPLETED
    		$portfolio->updated_by = json_encode(['NR'=>$nominator_id]);

    		if($portfolio->save()) {
    			$transaction->commit();
				$response['type'] = true;
				$response['message'] = "Portfolio has been completed and submitted successfully!";
				Yii::app()->user->setFlash('success','Portfolio completed and submitted successfully');
			} else {
				$transaction->rollback();
				$response['message'] = 'Submission Failed! Please try again later or contact the System Administrator if it happened repeatedly.';
			}
    	} else {
    		$transaction->rollback();
    		$message = "Please double check the following: <br /><br />";

    		if($nomination_info_validate == false) {
    			$message .= "- Nomination Information Sheet is still incomplete or some fields may have some validation errors. <br />";
    		}

    		if($portfolio_validate == false) {
    			$message .= "- Portfolio is still incomplete or some fields may have some validation errors. Try saving each page to see errors.";
    		}

    		$response['message'] = $message;
    	}

    	echo json_encode($response);
    	exit;
	}

	public function actionWaiver()
	{
		$this->renderPartial('waiver');
	}

	
}