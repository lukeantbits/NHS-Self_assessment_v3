<?php
require_once("../includes/dbconnect.php");
//require_once("../includes/session.php");
require_once("../includes/pclzip.lib.php");
openDb();




$files = array();
$sql = "SELECT title FROM assessments";
$result = mysqli_query($connection,$sql);
while($row = mysqli_fetch_assoc($result)){
	$working_name = strtolower(str_replace(" ","_",$row['title']));
	$flashMaster = fopen("../swf/sa.swf","r");
	$binaryData = fread($flashMaster,10000000);
	$binaryData = str_replace("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~",str_pad($working_name,64,"~"),$binaryData);
	fclose($flashMaster);
	$flashFile = fopen("../packages/assessment_swfs/".$working_name.".swf","w");
	fwrite($flashFile,$binaryData);
	array_push($files,"../packages/assessment_swfs/".$working_name.".swf");
	fclose($flashFile);
}
$archive = new PclZip("../packages/assessment_swfs.zip");
$v_list = $archive->create(implode(",",$files),PCLZIP_OPT_REMOVE_PATH, "../packages/");
echo "[{\"path\": \"packages/assessment_swfs.zip\"}]";
	   



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