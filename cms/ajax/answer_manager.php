<?php
require_once("../includes/dbconnect.php");
session_start();
$ref = $_REQUEST['ref'];
$q = $_REQUEST['q'];

//indexAnswers($ref,$q,false);
switch($_REQUEST['cmd']){
	case "list":
		listAnswers($ref,$q);
	break;
	case "add_answer":
		$sql = "SELECT quiz FROM assessments WHERE id = ".$_REQUEST['ref'];
		$result = mysql_query($sql);
		$as_row = mysql_fetch_assoc($result);
		$a = $_REQUEST['a'];
		$sql = "SELECT ind,id FROM answers WHERE ref = ".$ref." AND question = ".$q." ORDER BY ind ASC";
		$result = mysql_query($sql);
		
		$i = 0;
		$tmp = 0;
		while($row = mysql_fetch_assoc($result)){
			if($row['id'] == $a){
				$i++;
				$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$ref.",".$q.",".$i.",' ')";
				mysql_query($sql);
				if($as_row['quiz'] == 0){
					$sql = "INSERT INTO actions (answer_id,type) VALUES (".mysql_insert_id().",'points')";
					mysql_query($sql);
				}else{
					$sql = "INSERT INTO actions (answer_id,type) VALUES (".mysql_insert_id().",'correct')";
					mysql_query($sql);
				}
				
				$tmp++;
			}
			if($tmp>=0){
				$sql = "UPDATE answers SET ind = ".$i." WHERE id = ".$row['id'];
				mysql_query($sql);
			}
			
			$i++;
		}
		indexAnswers($ref,$q,true);
		listAnswers($ref,$q);
	break;
	case "delete_answer":
		mysql_query("DELETE FROM answers WHERE question = ".$q." AND id = ".$_REQUEST['a']);
		indexAnswers($ref,$q,true);	
		listAnswers($ref,$q);
	break;
	case "shift_answer":
			$tmp = explode("_",$_REQUEST['d']);
			$direction = $tmp[1];
			$a = $tmp[2];
			$sql = "SELECT ind,id FROM answers WHERE ref = ".$ref." AND question = ".$q." ORDER BY ind ASC";
			$result = mysql_query($sql);
			$prev = "";
			$i = 0;
			$halt = false;
			while($row = mysql_fetch_assoc($result)){
				if($halt){
					$row_b = $row;
					break;
				}
				if($i == $a){
					$row_a = $row;
					if($direction == "dn"){
						$halt = true;
					}else{
						$row_b = $prev;
						break;
					}
				}
				$i++;
				$prev = $row;
			}
			//echo $row_a['id']."/".$row_b['id'];
			$sql_1 = "UPDATE answers SET ind = ".$row_a['ind']." WHERE id = ".$row_b['id'];
			mysql_query($sql_1);
			$sql_2 = "UPDATE answers SET ind = ".$row_b['ind']." WHERE id = ".$row_a['id'];
			mysql_query($sql_2);
			//echo $sql_1." / ".$sql_2;
			indexAnswers($ref,$q,true);
			listAnswers($ref,$q);		
	break;
	case "add_action":
		$tmp = explode("_",$_REQUEST['a']);
		$sql = "INSERT INTO actions (answer_id,type) VALUES (".$tmp[1].",'points')";
		mysql_query($sql);
		listAnswers($ref,$q);
	break;
	case "delete_action":
		$tmp = explode("_",$_REQUEST['a']);
		$sql = "DELETE FROM actions WHERE id = ".$tmp[2];
		mysql_query($sql);
		listAnswers($ref,$q);
	break;
}
function indexAnswers($ref,$q,$flush){
	$sql = "SELECT ind,id FROM answers WHERE ref = ".$ref." AND question = ".$q." ORDER BY ind,id ASC";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)>0 || $flush){
		$i = 0;
		while($row = mysql_fetch_assoc($result)){
			$sql = "UPDATE answers SET ind = ".$i." WHERE id = ".$row['id'];
			mysql_query($sql);
			$i++;
		}
	}
}
function listAnswers($ref,$q){
	$json = "";
	$sql = "SELECT * FROM answers WHERE question = ".$q." ORDER BY ind ASC";
	$result = mysql_query($sql);
	$answers = array();
	while($row = mysql_fetch_assoc($result)){
		$subsql = "SELECT * FROM actions WHERE answer_id = ".$row['id']." ORDER BY id ASC";
		$subresult = mysql_query($subsql);
		$actions = array();
		if(mysql_num_rows($subresult)>0){
			while($subrow = mysql_fetch_assoc($subresult)){
				array_push($actions,$subrow);
			}
			$row['actions'] = $actions;
		}else{
			$row['actions'] = "";
		}
		array_push($answers,$row);
	}
	
	$json.=json_encode($answers).",";
	echo substr($json,0,-1);
}
?>