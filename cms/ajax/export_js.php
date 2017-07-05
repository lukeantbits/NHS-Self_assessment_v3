<?php
$pg = 0;
$as_id = $_REQUEST['as_id'];
require_once("../includes/dbconnect.php");
require_once("../includes/accessibility.php");
require_once("../includes/session.php");
require_once("../includes/pclzip.lib.php");
openDb();



$url = 'http://localhost/git/NHS-Self_assessment_v3/cms/json_output.php?as_id='.$as_id; 
//$url = 'http://preview.antbits.com/preview/content/NHS-Self_assessment_v3/cms/json_output.php?as_id='.$as_id; 
//echo $url;
$header[] = "Content-type: application/json ";
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
	$sql = "SELECT title , dimensions_j, review_key FROM assessments WHERE id = ".$as_id;
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_assoc($result);
	
	if($row['dimensions_j'] == 'elastic'){
		$w = 364;
		$h= 466;
	}else{
		$tmp = explode("x",$row['dimensions_j']);
		$w= $tmp[0];
		$h= $tmp[1];
	}
	//$working_name = strtolower(str_replace(" ","_",$row['title']));
	$working_name = "as_".$as_id;
	if(is_dir("../packages_js/".$working_name)){
		
	}else{
		mkdir("../packages_js/".$working_name);
		//mkdir("../packages/".$working_name."/".$working_name);
	}
	//echo $working_name;
	$json_handle = fopen("../packages_js/".$working_name."/data.json","w");
	fwrite($json_handle,str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>","",$response));
	fclose($json_handle);
	array_push($files,"../packages_js/".$working_name."/data.json");
	
	$template_handle = fopen("../template_js.html","rw");
	$str = str_replace(array("{id}","{w}","{h}"),array($as_id,$w,$h),fread($template_handle,10000000));
	$target = fopen("../packages_js/".$working_name."/webpart.txt","w");
	fwrite($target,$str);
	array_push($files,"../packages_js/".$working_name."/webpart.txt");
	/*
	$template_handle = fopen("../template_js_dated.html","rw");
	$str = str_replace(array("{id}","{w}","{h}","{datekey}"),array($as_id,$w,$h,$row['review_key']),fread($template_handle,10000000));
	$target = fopen("../packages_js/".$working_name."/webpart_inline.txt","w");
	fwrite($target,$str);
	array_push($files,"../packages_js/".$working_name."/webpart_inline.txt");
	
	$template_handle = fopen("../template_syndicated.html","rw");
	$str = str_replace(array("{id}","{w}","{h}"),array($as_id,$w,$h),fread($template_handle,10000000));
	$target = fopen("../packages_js/".$working_name."/syndication_snippet.txt","w");
	fwrite($target,$str);
	array_push($files,"../packages_js/".$working_name."/syndication_snippet.txt");
	*/
	$template_handle = fopen("../accessibility.html","rw");
	$str = str_replace("{content}",renderAccessible($as_id),fread($template_handle,10000000));
	$target = fopen("../packages_js/".$working_name."/accessible.html","w");
	fwrite($target,$str);
	array_push($files,"../packages_js/".$working_name."/accessible.html");
	
	copy_directory("../archive/as_".$as_id,"../packages_js/".$working_name."/images/");
	$archive = new PclZip("../packages_js/".$working_name.".zip");
	$v_list = $archive->create(implode(",",$files),PCLZIP_OPT_REMOVE_PATH, "../packages_js/");
	echo "[{\"path\": \"packages_js/".$working_name.".zip\"}]";
	   
}


function copy_directory( $source, $destination ) {
	global $files;
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