<?php
/* add variables or conditions if need */
class LeftsideNav extends CWidget
{
	
	public function init()
	{
		
	}
	
	public function run()
	{	
		$nomination_setting = ToymSettings::model()->find("code = 'nomination_status'");
		$this->render("leftside_nav", ['nomination_setting'=>$nomination_setting]);
	}
}
?>