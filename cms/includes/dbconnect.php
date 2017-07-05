<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
function openDb(){
	$host = "localhost"; 
	$user = "root"; 
	$pass = "member"; 
	$db = "self_assessments_v3"; 
	// open connection 
	global $connection;
	$connection = mysqli_connect($host, $user, $pass) or die ("Unable to connect!");
	mysqli_select_db($connection,$db) or die ("Unable to select database!"); 
	//echo "<h1>OPEN DB()</h1>";
	mysqli_query($connection,'SET CHARACTER SET utf8');
}/*
function openDb(){
	$host = "109.228.1.16"; 	
	$user = "root"; 
	$pass = "Dinosaur202";
	$db = "self_assessments_v3"; 
	// open connection 
	global $connection;
	$connection = mysqli_connect($host, $user, $pass) or die ("Unable to connect!");
	mysqli_select_db($connection,$db) or die ("Unable to select database!"); 
	//echo "<h1>OPEN DB()</h1>";
	mysqli_query($connection,'SET CHARACTER SET utf8');
}*/
$key = "millionaire";
function encrypt($string,$key){
    $returnString = array();
    for ($a = 0; $a < strlen($string); $a++){
        $returnString[] = ord(substr($string,$a,1)) + ord(substr($key,$a % strlen($key),1));
    }
    return join(",",$returnString);
};
function decrypt($string,$key){
    $returnString = "";
    $string = explode(",",$string);
    for ($a = 0; $a < count($string); $a++){
        $returnString .= chr($string[$a] - ord(substr($key,$a % strlen($key),1)));
    }
    return $returnString;
};
openDb();
?>