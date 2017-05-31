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
}
