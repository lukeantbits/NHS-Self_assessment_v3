<?php
session_start();
//
//$_SESSION['ac_projects'] = "";
//$_SESSION['ac_email'] = "";
if(!isset($_SESSION['ac_projects'])){
	$_SESSION['ac_projects'] = '';
}
if(!isset($_SESSION['ac_email'])){
	$_SESSION['ac_email'] = 'guest';
}
//$root = "http://downloads.antbits.com/preview/";
$root = "http://localhost/git/NHS-Self_assessment_v3/";
//session_cache_expire(30);
if(isset($_SESSION['ac_loggedin'])){
	if($_SESSION['ac_loggedin'] == "true"){
	}else{
		$_SESSION['ac_loggedin'] = "false";
		//header("location: ".$root."login.php");
	}
}else{
	$_SESSION['ac_loggedin'] = "false";
	//header("location: ".$root."login.php");
}


$ac_projects = explode("|",$_SESSION['ac_projects']);

if(isset($ac_project)){
	//echo in_array($ac_project,$ac_projects);
	if(!in_array($ac_project,$ac_projects) && $ac_projects[0] != "ALL"){
		//header("location: ".$root."index.php");
	}
}else{
	//echo "no project id found!<br>";
}
//

$_SESSION['pg'] = $pg;
$head_str = "var pg = ".$pg."
";

$vars = array("as_id","q","a","ex_mode","quiz");
$vals = array(78,0,0,0,0);
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
	$head_str.= "var ".$key." = ".$_SESSION[$key].";
";
	$i++;
}
?>