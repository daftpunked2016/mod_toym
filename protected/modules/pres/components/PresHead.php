<?php
/* add variables or conditions if need */
class PresHead extends CWidget
{
	
	public function init()
	{
		
	}
	
	public function run()
	{	
		$this->render("head", []);
	}
}
?>