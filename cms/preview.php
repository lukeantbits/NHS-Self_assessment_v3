<?php 
$vars = array("as_id","q","pg","platform");
foreach($vars as $key){
	if(isset($_REQUEST[$key])){
		$$key = $_REQUEST[$key];
		
	}
}

?>
<?php require_once("includes/dbconnect.php");?>
<?php require_once("includes/shared.php");?>
<?php require_once("includes/session.php");?>
<?php 



openDb();
?>
<?php require_once("includes/head.php");?>

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
<script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"> </script>
<style type="text/css">
#new_window {
	font-weight:bold;
	background-color:#000;
	color:#FFF;
	padding:5px;
	border:none;
	border-radius:5px;
}
</style>
<body style="background-color:#FFFFFF;">

<?php 
$sql = "SELECT * FROM assessments WHERE id = ".$as_id;
$result = mysqli_query($connection,$sql);
$page_row = mysqli_fetch_assoc($result);

if($page_row['dimensions_f'] == 'elastic'){
	$w_f = 364;
	$h_f= 466;
}else{
	$tmp = explode("x",$page_row['dimensions_f']);
	$w_f= $tmp[0];
	$h_f= $tmp[1];
}
if($page_row['dimensions_j'] == 'elastic'){
	$w_j = 364;
	$h_j= 466;
}else{
	$tmp = explode("x",$page_row['dimensions_j']);
	$w_j= $tmp[0];
	$h_j= $tmp[1];
}


switch($pg){
	case 3:
		$p = $q;
	break;
	case 4:
		$p = "results";
	break;
	case 5:
		$p = "links";
	break;
	default:
		$p = "splash";
	break;
}
?>
<div id="flashContent">
<div>
<b>Switch preview mode:</b>
<select id="preview_mode">
<?php 
$sql = "SELECT id,ind FROM questions WHERE ref = ".$as_id." ORDER BY ind";
$result = mysqli_query($connection,$sql);
if($pg <3){
	echo "	<option selected=\"selected\" value = \"splash\">Splash</option>
	";
}else{
	echo "	<option value = \"splash\">Splash</option>
	";
}
while($row = mysqli_fetch_assoc($result)){
	if($pg == 3 && $q == $row['ind']){
	echo "	<option selected=\"selected\" value = \"Q".$row['ind']."\">Q".($row['ind']+1)."</option>
";
	}else{
	echo "	<option value = \"Q".$row['ind']."\">Q".($row['ind']+1)."</option>
";
	}
}
if($pg == 4){
	echo "	<option selected=\"selected\" value = \"results\">Results</option>
	";
}else{
	echo "	<option value = \"results\">Results</option>
	";
}
if($pg == 5){
	echo "	<option selected=\"selected\" value = \"links\">Links</option>
	";
}else{
	echo "	<option value = \"links\">Links</option>
	";
}

?>
</select>

<input name="" id = "new_window" type="button" value="  Open in new tab ►  " />

<br />
<br />

</div>

<div id="assessment_webpart_wrapper">		
<script type="text/javascript">
$(document).ready(function() {
	var __assessment = document.createElement('script'); 
	var __assessment_obj = document.getElementsByTagName('script')[document.getElementsByTagName('script').length - 1]; 
	__assessment.id = 'assessment_webpart';
	__assessment.preview= '<?php echo $p;?>';  
	__assessment.ASid = '<?php echo $as_id;?>'; 
	__assessment.APPpath = '../app/';
	__assessment.dimensions = Array(<?php echo $w_j;?>,<?php echo $h_j;?>);
	__assessment.XMLpath = 'data/';
	__assessment.type = 'text/javascript';
	__assessment.async = true;
	__assessment.src = __assessment.APPpath+'js/assessment.js';
	__assessment_obj.parentNode.insertBefore(__assessment, __assessment_obj); 
	
	$("#new_window").click(function(){
		//window.open('../self_assessment_js/assessment.html?preview=&XMLpath=data/&ASid=<?php echo $as_id;?>','_blank');
		window.open('../app/assessment.html?preview=&XMLpath=data/&ASid=<?php echo $as_id;?>','_blank');
	})
	
})
</script>
</div>		
		</div>
        <script>
 $(document).ready(function(){
	$("#platform").change(function(event){
		window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=<?php echo $pg;?>&q=<?php echo $q;?>&platform="+$("#platform").val();
	})
	$("#preview_mode").change(function(event){
		switch(event.target.value){
			case "splash":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=0&q=0&platform="+$("#platform").val();
			break;
			case "results":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=4&q=0&platform="+$("#platform").val();
			break;
			case "links":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=5&q=0&platform="+$("#platform").val();
			break;
			default:
				//alert((event.target.value).slice(1,1))
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=3&q="+event.target.value.slice(1)+"&platform="+$("#platform").val()
			break
		}
		//window.location.href = "preview.php?as_id=&pg=&q=";
	})
 });
</script>
</body>
</html>