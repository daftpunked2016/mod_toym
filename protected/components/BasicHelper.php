<?php

trait BasicHelper
{
	function validateFileInput($input_name, array $file_list)
	{
		return (isset($file_list[$input_name]) && $file_list[$input_name]['error'] == 0);
	}

	function mapFileInputArray($files)
	{
		$mapped_files = [];

		foreach($files as $property_name => $values) {
			foreach($values as $key=>$value) {
				$mapped_files[$key][$property_name]=$value;
			}  
		}

		return $mapped_files;
	}

	/**
	* Delete record and returns @var int $res
	*/
	public function deleteRec(CActiveRecord $acRec, $transaction = null)
	{
		try {
			if($acRec->delete()) {
				if($transaction) 
					$transaction->commit();	

				$res = 1; //success
			} else {
				$res = 2;
			}
		} catch (Exception $e) {
			$res = 4;
		}

		if($res != 1) {
			if($transaction)
				$transaction->rollback();
		}

		return $res;
	}

	public function mergePdfs($pdfs_filepath, $pdf_output_filepath)
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $pdftk_loc = '/usr/local/bin/pdftk'; /* for local server */
        } else {
            $pdftk_loc = '/usr/bin/pdftk'; /* for production server */
        }

        passthru("{$pdftk_loc} {$pdfs_filepath} cat output {$pdf_output_filepath}"); // merge PDF files
    }

    public function readViewPdf($pdf_filename, $pdf_path)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdf_filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($pdf_path));
        header('Accept-Ranges: bytes');

        @readfile($pdf_path);
    }

    public function downloadPdf($pdf_filename, $pdf_path)
    {
		header('Content-Type: application/pdf');
		header("Content-Transfer-Encoding: Binary");
		header('Content-disposition: attachment; filename="'.$pdf_filename.'"');
		readfile($pdf_path);
    }

    public function downloadFile($filename, $file_path)
    {
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($filename) . "\""); 
		readfile($file_path);
    }
}
