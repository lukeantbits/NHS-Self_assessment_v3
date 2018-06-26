<?php
$colours = array(
	array("669900","336d24"),
	array("006699","0799C6"),
	array("990000","DD645F"),
	array("FF6600","c85408"),
	array("048E8C","52B7BA"),
	array("2859A1","5EA3D6"),
	array("990066","6D0F57"),
	array("025F3B","089330"),
	array("E42A1D","FB745D"),
	array("5D2F91","330072"),
	array("D5C899","D5C899"),
	array("F2EFE0","F2EFE0"),
	array("107DA2","107DA2"),
	array("06639E","06639E"),
	array("3900AC","744CC5"),
	array("6b2180","9f7eb2"),
	array("024583","168EFE"),
	array("A90000","FB3103"),
	array("005eb8","003087"),
	array("1A2D5C","8c96ad"),
	array("D41E3D","e98e9e"),
	array("007F40","006747")
);
$preview_path = '../app/';
$preview_path = '/tools_distribution/self-assessments/';
function lookup_field($table,$field,$id){
	global $connection;
	 if(is_numeric($id) && $field <> "" && $table <> ""){
		openDb();
		$sql = "SELECT ".$field." FROM ".$table." WHERE ref = ".$id;
		$result = mysqli_query($connection,$sql);
		$row = mysqli_fetch_assoc($result);
		echo $row[$field];
	} 
}

function sanitizeVar($str){
	return str_replace(array("<",">"," ","+","-","*","&","="),array("less_than","more_than","_","_","_","_","and"," "),$str);
}
function stripChars($str){
	return str_replace(array("`","â€™","Â","’","’"),array("'","'","","'","'"),$str);
}
function tweakHTML($str){
	$find = array("<div>","</div>","</ul>");
	$replace = array("","","</ul><br>");
	$output = str_replace($find,$replace,$str);
	return $output;

}
function varChanged($val,$id){
	global $connection;
	$sql = "SELECT id FROM vars WHERE name = '".$id."' AND vals = '".$val."'";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)>0){
		return false;
	}else{
		return true;
	}
}
?>