<?php
$pg = 0;
$as_id = $_REQUEST['as_id'];
require_once("../includes/dbconnect.php");
require_once("../includes/session.php");
require_once("../includes/pclzip.lib.php");
require_once("../includes/accessibility.php");
openDb();



//url = 'http://localhost/nhs/self_assessment/xml_output.php?as_id='.$as_id; 
$url = 'http://preview.antbits.com/preview/self_assessments/xml_output.php?as_id='.$as_id; 

$header[] = "Content-type: text/xml ";
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);


$response = curl_exec($ch);     

if (curl_errno($ch)) {
   // echo curl_error($ch);
} else {
    curl_close($ch);
	$files = array();
	$sql = "SELECT title , dimensions_f FROM assessments WHERE id = ".$as_id;
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_assoc($result);
	if($row['dimensions_f'] == 'elastic'){
		$w = 364;
		$h= 466;
	}else{
		$tmp = explode("x",$row['dimensions_f']);
		$w= $tmp[0];
		$h= $tmp[1];
	}
	$working_name = strtolower(str_replace(" ","_",$row['title']));
	if(is_dir("../packages/".$working_name)){
		
	}else{
		mkdir("../packages/".$working_name);
		//mkdir("../packages/".$working_name."/".$working_name);
	}
	//echo $working_name;
	$xml_handle = fopen("../packages/".$working_name."/".$working_name.".xml","w");
	fwrite($xml_handle,str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>","",$response));
	fclose($xml_handle);
	array_push($files,"../packages/".$working_name."/".$working_name.".xml");
	
	$flashMaster = fopen("../swf/sa.swf","r");
	$binaryData = fread($flashMaster,10000000);
	$binaryData = str_replace("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~",str_pad($working_name,64,"~"),$binaryData);
	fclose($flashMaster);
	$flashFile = fopen("../packages/".$working_name."/".$working_name.".swf","w");
	fwrite($flashFile,$binaryData);
	array_push($files,"../packages/".$working_name."/".$working_name.".swf");
	fclose($flashFile);
	$template_handle = fopen("../template.html","rw");
	$str = str_replace(array("{filename}","{id}","{w}","{h}"),array($working_name,$as_id,$w,$h),fread($template_handle,10000000));
	$target = fopen("../packages/".$working_name."/index.html","w");
	fwrite($target,$str);
	array_push($files,"../packages/".$working_name."/index.html");
	
	$template_handle = fopen("../accessibility.html","rw");
	$str = str_replace("{content}",renderAccessible($as_id),fread($template_handle,10000000));
	$target = fopen("../packages/".$working_name."/accessible.html","w");
	fwrite($target,$str);
	array_push($files,"../packages/".$working_name."/accessible.html");
	
	copy("../swfobject/swfobject.js","../packages/".$working_name."/swfobject.js");
	array_push($files,"../packages/".$working_name."/swfobject.js");
	copy_directory("../archive/as_".$as_id,"../packages/".$working_name."/".$working_name);
	
	$archive = new PclZip("../packages/".$working_name.".zip");
	$v_list = $archive->create(implode(",",$files),PCLZIP_OPT_REMOVE_PATH, "../packages/");
	//echo "path=packages/".$working_name.".zip";
	echo "[{\"path\": \"packages/".$working_name.".zip\"}]";
	   
}


function copy_directory( $source, $destination ) {
	global $files,$connection;
	if ( is_dir( $source ) ) {
		@mkdir( $destination );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
			if ( $readdirectory == '.' || $readdirectory == '..' ) {
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) {
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $PathDir, $destination . '/' . $readdirectory );
			array_push($files,$destination . '/' . $readdirectory);
		}
 
		$directory->close();
	}else {
		copy( $source, $destination );
	}
}
?>