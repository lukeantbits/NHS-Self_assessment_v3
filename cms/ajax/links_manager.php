<?php
require_once("../includes/dbconnect.php");
session_start();
switch($_REQUEST['cmd']){
	case "list":
		listResults();
	break;
	case "shift":
		indexResults();
		
		$sql = "SELECT id,ind FROM link_page_items WHERE as_id = ".$_REQUEST['as_id']." AND ind = ".$_REQUEST['r_ind'];
		$result = mysql_query($sql);
		$r1 = mysql_fetch_assoc($result);
		//
		$sql = "SELECT id,ind FROM link_page_items WHERE as_id = ".$_REQUEST['as_id']." AND ind = ".(intval($_REQUEST['r_ind'])+intval($_REQUEST['d']));
		$result = mysql_query($sql);
		$r2 = mysql_fetch_assoc($result);
		//
		$sql = "UPDATE link_page_items SET ind = ".$r2['ind']."  WHERE id = ".$r1['id'];
		$result = mysql_query($sql);
		$sql = "UPDATE link_page_items SET ind = ".$r1['ind']."  WHERE id = ".$r2['id'];
		$result = mysql_query($sql);
		listResults();
		//
	break;
	case "add":
			$result = mysql_query("INSERT INTO link_page_items (body,ind,as_id,type) VALUES ('',9999,".$_REQUEST['as_id'].",'text')");
			indexResults();
			listResults();
	break;
	case "delete":
		  if(isset($_REQUEST['id'])){
			  $status = "success";
			  mysql_query("DELETE FROM link_page_items WHERE id = ".$_REQUEST['id'])or die($status = "fail");
			  echo $status;
		  }
		  indexResults();
		  listResults();
	break;
}
function listResults(){
	$sql = "SELECT * FROM link_page_items WHERE as_id = ".$_REQUEST['as_id']." ORDER BY ind,id";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0){
		mysql_query("INSERT INTO link_page_items (as_id,type,body) VALUES (".$_REQUEST['as_id'].",'text','Opening paragraph')");
		$sql = "SELECT * FROM link_page_items WHERE as_id = ".$_REQUEST['as_id'];
		$result = mysql_query($sql);
	}
	
	$results = array();
	while($row = mysql_fetch_assoc($result)){
		array_push($results,$row);
	}
	
	$sql = "SELECT id,link_copy FROM links WHERE as_id = ".$_REQUEST['as_id']." OR as_id = 0 ORDER BY as_id DESC,id DESC";
	$result = mysql_query($sql);
	$link_results = array();
	while($row = mysql_fetch_assoc($result)){
		array_push($link_results,$row);
	}
	echo "{\"links\":".json_encode($results).",\"link_list\":".json_encode($link_results).",\"bc_list\":".json_encode($link_results).",\"params\": [{\"maxpoints\": \"".getMaxpoints()."\"}]}";
}
function getMaxPoints(){
	$total = 0;
	$last = 0;
	$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['as_id'];
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$subsql = "SELECT value FROM answers INNER JOIN actions ON answers.id=actions.answer_id WHERE question = ".$row['id']." AND  type = 'points' AND value > 0  ORDER BY value+0 DESC";
		$subresult = mysql_query($subsql);
		if(mysql_num_rows($subresult)>0){
			$subrow = mysql_fetch_assoc($subresult);
			$total+= $subrow['value'];
			
		}
	}
	return $total;
}
function indexResults(){
	$sql = "SELECT * FROM link_page_items WHERE as_id = ".$_REQUEST['as_id']." ORDER BY ind,id";
	$result = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($result)){
		$subsql = "UPDATE link_page_items SET ind = ".$i." WHERE id = ".$row['id'];
		mysql_query($subsql);
		$i++;
	}
}
?>