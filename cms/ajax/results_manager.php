<?php
require_once("../includes/dbconnect.php");
session_start();
switch($_REQUEST['cmd']){
	case "list":
		listResults();
	break;
	case "shift":
		indexResults();
		
		$sql = "SELECT id,ind FROM result_page_items WHERE as_id = ".$_REQUEST['as_id']." AND ind = ".$_REQUEST['r_ind'];
		$result = mysqli_query($connection,$sql);
		$r1 = mysqli_fetch_assoc($result);
		//
		$sql = "SELECT id,ind FROM result_page_items WHERE as_id = ".$_REQUEST['as_id']." AND ind = ".(intval($_REQUEST['r_ind'])+intval($_REQUEST['d']));
		$result = mysqli_query($connection,$sql);
		$r2 = mysqli_fetch_assoc($result);
		//
		$sql = "UPDATE result_page_items SET ind = ".$r2['ind']."  WHERE id = ".$r1['id'];
		$result = mysqli_query($connection,$sql);
		$sql = "UPDATE result_page_items SET ind = ".$r1['ind']."  WHERE id = ".$r2['id'];
		$result = mysqli_query($connection,$sql);
		listResults();
		//
	break;
	case "add":
			$sql = "SELECT * FROM result_page_items WHERE as_id = ".$_REQUEST['as_id']." ORDER BY ind,id";
			$result = mysqli_query($connection,$sql);
			$i = 0;
			$lock = false;
			while($row = mysqli_fetch_assoc($result)){
				if($_REQUEST['ind'] == $i-1 && $lock == false){
					mysqli_query($connection,"INSERT INTO result_page_items (body,ind,as_id,type) VALUES ('',".$i.",".$_REQUEST['as_id'].",'text')");
					$i++;
					$lock = true;
				}
				$subsql = "UPDATE result_page_items SET ind = ".$i." WHERE id = ".$row['id'];
				mysqli_query($connection,$subsql);
				$i++;
			}
			if($lock == false){
				mysqli_query($connection,"INSERT INTO result_page_items (body,ind,as_id,type) VALUES ('',".$i.",".$_REQUEST['as_id'].",'text')");
			}
			indexResults();
			listResults();
	break;
	case "delete":
		  if(isset($_REQUEST['id'])){
			  $status = "success";
			  mysqli_query($connection,"DELETE FROM result_page_items WHERE id = ".$_REQUEST['id'])or die($status = "fail");
			  echo $status;
		  }
		  indexResults();
		  listResults();
	break;
}
function listResults(){
	global $connection;
	$sql = "SELECT * FROM result_page_items WHERE as_id = ".$_REQUEST['as_id']." ORDER BY ind,id";
	//echo $sql;
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result) == 0){
		mysqli_query($connection,"INSERT INTO result_page_items (as_id,type,body) VALUES (".$_REQUEST['as_id'].",'text','Opening paragraph')");
		$sql = "SELECT * FROM result_page_items WHERE as_id = ".$_REQUEST['as_id'];
		$result = mysqli_query($connection,$sql);
	}
	
	$results = array();
	while($row = mysqli_fetch_assoc($result)){
		
		/*for($i=0;$i<sizeof($row);$i++){
			if(key($row) == "body"){
				//$row[key($row)]= urlencode($row[key($row)]);
				$row[key($row)]= $row[key($row)];
			}
			next($row);
		}*/
		array_push($results,$row);
		//print_r($row);
	}
	echo "{\"results\":".json_encode($results).",\"params\": [{\"maxpoints\": \"".getMaxPoints("points")."\",\"vars\": \"".getVars()."\"}]}";
}
function getVars(){
	global $connection;
	$sql = "SELECT name FROM vars WHERE name LIKE '%:number' AND (as_id = ".$_REQUEST['as_id']." OR as_id = 0)";
	$result = mysqli_query($connection,$sql);
	$results = array();
	while($row = mysqli_fetch_assoc($result)){
		array_push($results,$row['name']);
	}
	return implode(",",$results);
}
function getMaxPoints($type){
	global $connection;
	$total = 0;
	$last = 0;
	$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['as_id'];
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		if($type == "points"){
			$subsql = "SELECT value FROM answers INNER JOIN actions ON answers.id=actions.answer_id WHERE question = ".$row['id']." AND  type = 'points' AND value > 0  ORDER BY value+0 DESC";
		}else{
			$subsql = "SELECT value FROM answers INNER JOIN actions ON answers.id=actions.answer_id WHERE question = ".$row['id']." AND  type = 'points' AND value > 0  ORDER BY value+0 DESC";
		
		}
		$subresult = mysqli_query($connection,$subsql);
		if(mysqli_num_rows($subresult)>0){
			$subrow = mysqli_fetch_assoc($subresult);
			$total+= $subrow['value'];
			
		}
	}
	return $total;
}
function indexResults(){
	global $connection;
	$sql = "SELECT * FROM result_page_items WHERE as_id = ".$_REQUEST['as_id']." ORDER BY ind,id";
	$result = mysqli_query($connection,$sql);
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		$subsql = "UPDATE result_page_items SET ind = ".$i." WHERE id = ".$row['id'];
		mysqli_query($connection,$subsql);
		$i++;
	}
}
?>