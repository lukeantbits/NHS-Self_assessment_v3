<?php
session_start();
//

$root = "http://localhost/nhs/preview/";
session_cache_expire(30);



$_SESSION['pg'] = $pg;
$vars = array("as_id","q","a","ex_mode");
$vals = array(1,0,0,0);
$i = 0;

foreach($vars as $key){
	if(isset($_REQUEST[$key])){
		$_SESSION[$key] = $_REQUEST[$key];
	}
	if(isset($_SESSION[$key])){
		$$key = $_SESSION[$key];
	}else{
		$$key = $vals[$i];
		$_SESSION[$key] = $vals[$i];
	}
	$i++;
}

?>