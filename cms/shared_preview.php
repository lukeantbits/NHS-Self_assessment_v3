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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" debug="true">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Self Assessment CMS</title>
<meta name="viewport" id="mvp" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<script src="js/bcNav.js"></script>
<script src="js/CMSroot.js"></script>
<script src="js/configPage.js"></script>
<script src="js/fileuploader.js"></script>
<script src="<?php echo $preview_path;?>vendor/jquery-3.2.1.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/linksPage.js"></script>
<script src="js/navController.js"></script>
<script src="js/nicEdit.js"></script>
<script src="js/questionsPage.js"></script>
<script src="js/resultsPage.js"></script>
<script src="js/splashPage.js"></script>
<script src="js/tinycolor-min.js"></script>
<link href="css/layout.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="fancyapps/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script language="javascript">
<?php
echo $head_str;
?>
</script>
</head>
<style type="text/css">
#new_window {
	font-weight:bold;
	background-color:#000;
	color:#FFF;
	padding:5px;
	border:none;
	border-radius:5px;
}
h2{
	color:#231f20;
}
#ac_nav {
	color: #FFF;
	background-color: #0759a5;
	padding:15px;
	padding-top:8px;
	padding-bottom:12px;
	position:absolute;
	right:10px;
	top:0px;
	margin-top:-30px;
	padding-top:35px;
	text-align:center;
	border:5px solid #FFF;
	-moz-border-radius: 20px;
	border-radius: 20px;
	-moz-box-shadow: 0px 5px 6px #ccc;
	-webkit-box-shadow: 0px 5px 6px #ccc;
	box-shadow: 0px 5px 6px #ccc;
}
#ac_nav a{
	color: #FFF;
}
#ac_nav a:hover{
	color: #FFF;
	text-decoration:none;
}
body{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	background-color:#fff;
	margin-top:100px;
}
</style>
<body style="background-color:#FFFFFF;">
<div id="ac_nav"><a href="../../../index.php">Index</a>&nbsp;|&nbsp;<a href="../../../logout.php">Logout</a></div>
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
<br />
<br />

</div>

        
    
<div id="assessment_webpart_wrapper">		
<div id = "tool_self-assessments_<?php echo $as_id;?>" class = "tool_self-assessments"></div>
<script id = "tool-script_self-assessments_<?php echo $as_id;?>" src="<?php echo $preview_path;?>js/inline_launcher.js"></script>
</div>		
		</div>
        <script>
 $(document).ready(function(){
	$("#platform").change(function(event){
		window.location.href = "shared_preview.php?as_id=<?php echo $as_id;?>&pg=<?php echo $pg;?>&q=<?php echo $q;?>";
	})
	$("#new_window").click(function(){
		window.open("shared_preview.php?as_id=<?php echo $as_id;?>&pg=0&q=0",'_blank');
	})
	$("#preview_mode").change(function(event){
		switch(event.target.value){
			case "splash":
				window.location.href = "shared_preview.php?as_id=<?php echo $as_id;?>&pg=0&q=0";
			break;
			case "results":
				window.location.href = "shared_preview.php?as_id=<?php echo $as_id;?>&pg=4&q=0";
			break;
			case "links":
				window.location.href = "shared_preview.php?as_id=<?php echo $as_id;?>&pg=5&q=0";
			break;
			default:
				//alert((event.target.value).slice(1,1))
				window.location.href = "shared_preview.php?as_id=<?php echo $as_id;?>&pg=3&q="+event.target.value.slice(1)
			break
		}
		//window.location.href = "shared_preview.php?as_id=&pg=&q=";
	})
 });
</script>
</body>
</html>