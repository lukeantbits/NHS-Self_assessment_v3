<?php
$colours = array(
	array("669900","9BC363"),
	array("006699","0799C6"),
	array("990000","DD645F"),
	array("FF6600","FF9800"),
	array("048E8C","52B7BA"),
	array("2859A1","5EA3D6"),
	array("990066","BE618B"),
	array("025F3B","089330"),
	array("E42A1D","FB745D"),
	array("333399","6061CA"),
	array("D5C899","D5C899"),
	array("F2EFE0","F2EFE0"),
	array("107DA2","107DA2"),
	array("06639E","06639E"),
	array("3900AC","744CC5"),
	array("6b2180","9f7eb2"),
	array("024583","168EFE"),
	array("A90000","FB3103"),
	array("0064B7","0684EB")
);
function lookup_field($table,$field,$id){
	 if(is_numeric($id) && $field <> "" && $table <> ""){
		openDb();
		$sql = "SELECT ".$field." FROM ".$table." WHERE ref = ".$id;
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
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
	$sql = "SELECT id FROM vars WHERE name = '".$id."' AND vals = '".$val."'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)>0){
		return false;
	}else{
		return true;
	}
}
?>