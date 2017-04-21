<?php

trait BasicHelper
{
	function validateFileInput($input_name, array $file_list)
	{
		return (isset($file_list[$input_name]) && $file_list[$input_name]['error'] == 0);
	}
}
