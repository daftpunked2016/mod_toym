<?php

class PortfoliosController extends Controller
{
	use BasicHelper;
	
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
			'nominee'=> ['select' => false, 'condition'=>'status = 1'],
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

	public function actionView($id)
	{ 
		$portfolio = ToymPortfolio::model()->findByPk($id);
		$pdf_filename = $portfolio->generatePdf();
		$pdf_filepath = 'page_assets/pdfs/'.$pdf_filename;

		$this->readViewPdf($pdf_filename, $pdf_filepath);
		unlink($pdf_filepath);
	}

	public function actionDownload($id)
	{ 
		$portfolio = ToymPortfolio::model()->findByPk($id);
		$pdf_filename = $portfolio->generatePdf();
		$pdf_filepath = 'page_assets/pdfs/'.$pdf_filename;

		$this->downloadPdf($pdf_filename, $pdf_filepath);
		unlink($pdf_filepath);
	}

	public function actionDownloadDocument($id)
	{ 
		$file = ToymFileUploads::model()->findByPk($id);
		$filepath = ToymFileUploads::getFilePath($id, true);

		if(strtolower($file->file_extension) != "pdf") {
			$this->downloadFile($id.'_'.time().'.'.$file->file_extension, $filepath);
		} else {
			$this->downloadPdf($id.'_'.time().'.pdf', $filepath);
		}

		unlink($pdf_filepath);
	}

	public function actionDownloadPhotos($id)
	{
		$files = ToymPortfolio::getImageFilesArray($id);

		if(empty($files)) {
			echo "<pre>";
			echo "Error! No Supporting Photos uploaded yet for this portfolio";
			echo "</pre>";
			exit;
		}

	    # create new zip opbject
	    $zip = new ZipArchive();

	    # create a temp file & open it
	    $tmp_file = tempnam('.','');
	    $zip->open($tmp_file, ZipArchive::CREATE);

	    # loop through each file
	    foreach($files as $file){

	        # download file
	        $download_file = file_get_contents($file);

	        #add it to the zip
	        $zip->addFromString(basename($file),$download_file);

	    }

	    # close zip
	    $zip->close();

	    # send the file to the browser as a download
	    header('Content-disposition: attachment; filename=Portfolio_SupportPhotos_'.$id.'.zip');
	    header('Content-type: application/zip');
	    readfile($tmp_file);
	    unlink($tmp_file);
	    unlink($download_file);
	}
}