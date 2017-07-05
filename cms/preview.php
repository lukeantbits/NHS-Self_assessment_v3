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
<div id = "antbits-SA_<?php echo $as_id;?>" class = "antbits-SA"></div> 
<script type="text/javascript">
	var antbits_sa_container = {};
	(function(){
		var antbits_sa = document.createElement('script');
		antbits_sa.id = 'antbits-SA_<?php echo $as_id;?>'; 
		antbits_sa.async = true; 
		antbits_sa.src = '../app/js/sa_launcher.js'; 
		var antbits_sa_obj = document.getElementsByTagName('script')[document.getElementsByTagName('script').length - 1]; 
		antbits_sa_obj.parentNode.insertBefore(antbits_sa, antbits_sa_obj);
	})();
</script>
</div>		
		</div>
        <script>
 $(document).ready(function(){
	$("#platform").change(function(event){
		window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=<?php echo $pg;?>&q=<?php echo $q;?>";
	})
	$("#new_window").click(function(){
		window.open("preview.php?as_id=<?php echo $as_id;?>&pg=0&q=0",'_blank');
	})
	$("#preview_mode").change(function(event){
		switch(event.target.value){
			case "splash":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=0&q=0";
			break;
			case "results":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=4&q=0";
			break;
			case "links":
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=5&q=0";
			break;
			default:
				//alert((event.target.value).slice(1,1))
				window.location.href = "preview.php?as_id=<?php echo $as_id;?>&pg=3&q="+event.target.value.slice(1)
			break
		}
		//window.location.href = "preview.php?as_id=&pg=&q=";
	})
 });
</script>
</body>
</html>