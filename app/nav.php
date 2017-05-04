<style type="text/css">
#ac_nav {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
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
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<div id="ac_nav"> <form name="form" id="form"><select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
 <?php openDb();
 $sql = "SELECT id,title FROM assessments";
 $result = mysql_query($sql);
 while($row = mysql_fetch_assoc($result)){
	 if($row['id'] == $asid){
		 echo "<option selected value = '".$page."?asid=".strtolower(str_replace(" ","_",$row['title']))."|".$row['id']."'>".$row['title']."</option>
";
	 }else{
		 echo "<option value = '".$page."?asid=".strtolower(str_replace(" ","_",$row['title']))."|".$row['id']."'>".$row['title']."</option>
";
	}

  }?></select>
&nbsp;|&nbsp;<a href="<?php echo $root."index.php";?>">Index</a>&nbsp;|&nbsp;<a href="<?php echo $root."logout.php";?>">Logout</a></form></div>