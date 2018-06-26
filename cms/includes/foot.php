<script>
<?php

echo "quiz = ".$page_row['quiz'].";
";
?>
var app 
 $(document).ready(function(){
	app = new CMSroot(pg,as_id,q,a,quiz);
	$("#export_all").click(function(event){
		$.getJSON("ajax/swf_batch.php", function(data) { 
			window.location = data[0].path;
		}); 
		return false;
	});
 });
if(navigator.vendor.indexOf("Apple")>-1){
	$(".nav_1_right").css("top","55px");
}

</script>
<?php 

if($page_row['touch'] != ""){
	$tmp = explode("|",$page_row['touch']);
	if(time()<($tmp[1]+300) && $_SESSION['ac_email'] != $tmp[0]){
		echo "<div class=\"session_warning\">Edited by ".$tmp[0]." ".round((time()-$tmp[1])/60)." minutes ago";
	}else{
		echo "<div class=\"session\">Last edited by ".$tmp[0]." on ".date("Y-m-d H:i:s",$tmp[1]);
	}
}
//print_r($_SESSION);
?>
</div>
<?php //require_once("../../../includes/nav.php");?>