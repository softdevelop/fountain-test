<?php
function __autoload($classname) {
	if(strpos($classname, 'controller'))
		$filename = "controllers/". $classname .".php";
	else if(strpos($classname, 'model'))
		$filename = "models/". $classname .".php";
	else if(strpos($classname, 'helpers')) 
		$filename = "views/helpers/". $classname .".php";
	else if(strpos($classname, '_Component')) {
		$comFolder = str_split($classname, strrpos($classname, '_'))[0];
		$filename = "components/".$comFolder.'/'. $classname .".php";
	}
	else if($classname == "ConnectDb")	$filename = "config/". $classname .".php";
	else $filename = $defaultfile = "controllers/staticpages_controller.php";
	
	if (is_file($filename)) include_once($filename);
	else  					include_once($defaultfile);
}
