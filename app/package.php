<?php
header( 'Content-Type: application/javascript' );
require_once("jsmin.php");
$output = '';
if ($handle = opendir('js/')) {
    while (false !== ($entry = readdir($handle))) {
		
        
		if(strlen($entry)>3 && !strstr($entry,"min") && strstr($entry,".js") && !strstr($entry,"assessment.js") && !strstr($entry,"webtrends") && !strstr($entry,"wt_init")){
			//echo "<br>js/$entry\n";
			$h = fopen("js/$entry", "rb");
			$output.= stream_get_contents($h)."
";
			fclose($h);
		}
		
	}
    closedir($handle);
}
//echo JSMin::minify($output);
echo $output;
?>