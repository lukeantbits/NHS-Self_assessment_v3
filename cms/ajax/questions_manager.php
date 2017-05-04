<?php
require_once("../includes/dbconnect.php");
session_start();

switch($_REQUEST['cmd']){
	case "list":
		listQuestions();
	break;
	case "switch_question":
		$_SESSION['q'] = $_REQUEST['q'];
	break;
	case "shift_question":
		indexQuestions();
		
		$sql = "SELECT id,ind FROM questions WHERE ref = ".$_REQUEST['ref']." AND ind = ".$_REQUEST['q'];
		$result = mysql_query($sql);
		$r1 = mysql_fetch_assoc($result);
		//
		$sql = "SELECT id,ind FROM questions WHERE ref = ".$_REQUEST['ref']." AND ind = ".(intval($_REQUEST['q'])+intval($_REQUEST['d']));
		$result = mysql_query($sql);
		$r2 = mysql_fetch_assoc($result);
		//
		$sql = "UPDATE questions SET ind = ".$r2['ind']."  WHERE id = ".$r1['id'];
		$result = mysql_query($sql);
		$sql = "UPDATE questions SET ind = ".$r1['ind']."  WHERE id = ".$r2['id'];
		$result = mysql_query($sql);
		$_SESSION['q'] = intval($_REQUEST['q'])+intval($_REQUEST['d']);
		//
	break;
	case "add_question":
			$result = mysql_query("INSERT INTO questions (ref,question_title,ind) VALUES (".$_REQUEST['ref'].",'New question',9999)");
			$q = mysql_insert_id();
			$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['ref'];
			$result = mysql_query($sql);
			$_SESSION['q'] =mysql_num_rows($result)-1;
			$_SESSION['a'] =0;
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$q.",0,' ')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysql_insert_id().",'points','+','0')";
			mysql_query($sql);
			indexQuestions();
			listQuestions();
	break;
	case "list_questions":
			listQuestions();
	break;
	case "set_question":
		$sql = "SELECT quiz FROM assessments WHERE id = ".$_REQUEST['ref'];
		$result = mysql_query($sql);
		$as_row = mysql_fetch_assoc($result);
		if($_REQUEST['q_type']=="gender"){
			$sql = "UPDATE questions SET question_type = 'gender',question_body='Are you?' WHERE id = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)){
				$sql = "DELETE FROM actions WHERE answer_id = ".$row['id'];
				mysql_query($sql);
			}
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'male')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,sub_type,value) VALUES (".mysql_insert_id().",'set variable','=','gender','male')";
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'female')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,sub_type,value) VALUES (".mysql_insert_id().",'set variable','=','gender','female')";
			mysql_query($sql);
			listQuestions();
		}
		if($_REQUEST['q_type']=="yes/no"){
			$sql = "UPDATE questions SET question_type = 'yes/no' WHERE id = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysql_query($sql);
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'yes')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysql_insert_id().",'points','+','0')";
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'no')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysql_insert_id().",'points','+','0')";
			mysql_query($sql);
			listQuestions();
		}
		if($_REQUEST['q_type']=="true/false"){
			$sql = "UPDATE questions SET question_type = 'true/false' WHERE id = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysql_query($sql);
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'True')";
			mysql_query($sql);
			if($as_row['quiz'] == 1){
				$sql = "INSERT INTO actions (answer_id,type,value) VALUES (".mysql_insert_id().",'quiz','1')";
			}else{
				$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysql_insert_id().",'points','+','0')";
			}
			mysql_query($sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'False')";
			mysql_query($sql);
			if($as_row['quiz'] == 1){
				$sql = "INSERT INTO actions (answer_id,type,value) VALUES (".mysql_insert_id().",'quiz','0')";
			}else{
				$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysql_insert_id().",'points','+','0')";
			}
			mysql_query($sql);
			listQuestions();
		}
	break;
	case "delete_question":
			if(isset($_REQUEST['ref'])){
				$status = "success";
				mysql_query("DELETE FROM questions WHERE id = ".$_REQUEST['ref'])or die($status = "fail");
				echo $status;
			}
			$_SESSION['q'] = $_REQUEST['q'];
	break;
}
function listQuestions(){
	$sql = "SELECT quiz FROM assessments WHERE id = ".$_REQUEST['ref'];
	$result = mysql_query($sql);
	$as_row = mysql_fetch_assoc($result);
	$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref']." ORDER BY ind,id";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 0){
		mysql_query("INSERT INTO questions (ref,question_title) VALUES (".$_REQUEST['ref'].",'New question')");
		$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref'];
		$_SESSION['q'] =0;
		$_SESSION['a'] =0;
		$result = mysql_query($sql);
	}
	$answer_str = "";
	$variables_str = "{},";
	
	$links_str = "{},";
	while($row = mysql_fetch_assoc($result)){
		$subsql = "SELECT * FROM answers WHERE question = ".$row['id']." ORDER BY ind";
		$subresult = mysql_query($subsql);
		$answers = array();
		if(mysql_num_rows($subresult) == 0){
			mysql_query("INSERT INTO answers (question,ref) VALUES (".$row['id'].",".$_REQUEST['ref'].") ORDER BY ind ASC");
			$subsql = "SELECT * FROM answers WHERE question = ".$row['id']." ORDER BY ind ASC";
			$subresult = mysql_query($subsql);
		}
		while($subrow = mysql_fetch_assoc($subresult)){
			//
			if($as_row['quiz'] == 1){
				$subsubsql = "SELECT * FROM actions WHERE answer_id = ".$subrow['id']." ORDER BY id ASC";
			}else{
				$subsubsql = "SELECT * FROM actions WHERE answer_id = ".$subrow['id']." AND type <> 'quiz' ORDER BY id ASC";
			}
			$subsubresult = mysql_query($subsubsql);
			$actions = array();
			if(mysql_num_rows($subsubresult)>0){
				while($subsubrow = mysql_fetch_assoc($subsubresult)){
					array_push($actions,$subsubrow);
				}
				$subrow['actions'] = $actions;
			}else{
				$subrow['actions'] = "";
			}
			
			//
			array_push($answers,$subrow);
		}
		$row['answers'] = $answers;
		$answer_str.=json_encode($row).",";
	}
	// results 
	$results_str = "";
	$sql = "SELECT id,result_copy FROM results WHERE as_id = ".$_REQUEST['ref']." ORDER BY id DESC";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		if(strlen($row['result_copy'])>40){
			$row['title'] = substr(strip_tags($row['result_copy']),0,40)."...";
		}else{
			$row['title'] = strip_tags($row['result_copy']);
		}
		
		$results_str.=json_encode($row).",";
	}
	// links
	$links_str = "";
	$sql = "SELECT link_copy,link_url,id FROM links WHERE as_id = ".$_REQUEST['ref']." OR as_id = 0 ORDER BY id DESC";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$links_str.=json_encode($row).",";
	}
	// variables
	$variables_str = "";
	$sql = "SELECT * FROM vars WHERE as_id = ".$_REQUEST['ref']." OR as_id = 0 ORDER BY id DESC";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$variables_str.=json_encode($row).",";
	}
	// info boxes
	$info_str = "";
	$sql = "SELECT id,title_text FROM infoboxes WHERE as_id = ".$_REQUEST['ref']." OR as_id = 0 ORDER BY id DESC";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$info_str.=json_encode($row).",";
	}
	
	echo "{\"questions\":[".substr($answer_str,0,-1)."],\"variables\":[".substr($variables_str,0,-1)."],\"links\":[".substr($links_str,0,-1)."],\"results\":[".substr($results_str,0,-1)."],\"infoboxes\":[{\"id\":\"0\",\"title_text\":\"N/A\"},".substr($info_str,0,-1)."]}";
}
function indexQuestions(){
	$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref']." ORDER BY ind,id";
	$result = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($result)){
		$subsql = "UPDATE questions SET ind = ".$i." WHERE id = ".$row['id'];
		mysql_query($subsql);
		$i++;
	}
}
?>