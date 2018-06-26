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
		$result = mysqli_query($connection,$sql);
		$r1 = mysqli_fetch_assoc($result);
		//
		$sql = "SELECT id,ind FROM questions WHERE ref = ".$_REQUEST['ref']." AND ind = ".(intval($_REQUEST['q'])+intval($_REQUEST['d']));
		$result = mysqli_query($connection,$sql);
		$r2 = mysqli_fetch_assoc($result);
		//
		$sql = "UPDATE questions SET ind = ".$r2['ind']."  WHERE id = ".$r1['id'];
		$result = mysqli_query($connection,$sql);
		$sql = "UPDATE questions SET ind = ".$r1['ind']."  WHERE id = ".$r2['id'];
		$result = mysqli_query($connection,$sql);
		$_SESSION['q'] = intval($_REQUEST['q'])+intval($_REQUEST['d']);
		//
	break;
	case "add_question":
			$result = mysqli_query($connection,"INSERT INTO questions (ref,question_title,ind) VALUES (".$_REQUEST['ref'].",'New question',9999)");
			$q = mysqli_insert_id($connection);
			$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['ref'];
			$result = mysqli_query($connection,$sql);
			$_SESSION['q'] =mysqli_num_rows($result)-1;
			$_SESSION['a'] =0;
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$q.",0,' ')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysqli_insert_id($connection).",'points','+','0')";
			mysqli_query($connection,$sql);
			indexQuestions();
			listQuestions();
	break;
	case "list_questions":
			listQuestions();
	break;
	case "set_question":
		$sql = "SELECT quiz FROM assessments WHERE id = ".$_REQUEST['ref'];
		$result = mysqli_query($connection,$sql);
		$as_row = mysqli_fetch_assoc($result);
		if($_REQUEST['q_type']=="gender"){
			$sql = "UPDATE questions SET question_type = 'gender',question_body='Are you?' WHERE id = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysqli_query($connection,$sql);
			while($row = mysqli_fetch_assoc($result)){
				$sql = "DELETE FROM actions WHERE answer_id = ".$row['id'];
				mysqli_query($connection,$sql);
			}
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'male')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,sub_type,value) VALUES (".mysqli_insert_id($connection).",'set variable','=','gender','male')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'female')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,sub_type,value) VALUES (".mysqli_insert_id($connection).",'set variable','=','gender','female')";
			mysqli_query($connection,$sql);
			listQuestions();
		}
		if($_REQUEST['q_type']=="yes/no"){
			$sql = "UPDATE questions SET question_type = 'yes/no' WHERE id = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysqli_query($connection,$sql);
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'yes')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysqli_insert_id($connection).",'points','+','0')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'no')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysqli_insert_id($connection).",'points','+','0')";
			mysqli_query($connection,$sql);
			listQuestions();
		}
		if($_REQUEST['q_type']=="true/false"){
			$sql = "UPDATE questions SET question_type = 'true/false' WHERE id = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM answers WHERE question = ".$_REQUEST['q'];
			$result = mysqli_query($connection,$sql);
			$sql = "DELETE FROM answers WHERE question = ".$_REQUEST['q'];
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",0,'True')";
			mysqli_query($connection,$sql);
			if($as_row['quiz'] == 1){
				$sql = "INSERT INTO actions (answer_id,type,value) VALUES (".mysqli_insert_id($connection).",'quiz','1')";
			}else{
				$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysqli_insert_id($connection).",'points','+','0')";
			}
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_REQUEST['ref'].",".$_REQUEST['q'].",1,'False')";
			mysqli_query($connection,$sql);
			if($as_row['quiz'] == 1){
				$sql = "INSERT INTO actions (answer_id,type,value) VALUES (".mysqli_insert_id($connection).",'quiz','0')";
			}else{
				$sql = "INSERT INTO actions (answer_id,type,operator,value) VALUES (".mysqli_insert_id($connection).",'points','+','0')";
			}
			mysqli_query($connection,$sql);
			listQuestions();
		}
	break;
	case "delete_question":
			if(isset($_REQUEST['ref'])){
				$status = "success";
				mysqli_query($connection,"DELETE FROM questions WHERE id = ".$_REQUEST['ref'])or die($status = "fail");
				echo $status;
			}
			$_SESSION['q'] = $_REQUEST['q'];
	break;
}
function listQuestions(){
	global $connection;
	$sql = "SELECT quiz FROM assessments WHERE id = ".$_REQUEST['ref'];
	$result = mysqli_query($connection,$sql);
	$as_row = mysqli_fetch_assoc($result);
	$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref']." ORDER BY ind,id";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result) == 0){
		mysqli_query($connection,"INSERT INTO questions (ref,question_title) VALUES (".$_REQUEST['ref'].",'New question')");
		$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref'];
		$_SESSION['q'] =0;
		$_SESSION['a'] =0;
		$result = mysqli_query($connection,$sql);
	}
	$answer_str = "";
	$variables_str = "{},";
	
	$links_str = "{},";
	while($row = mysqli_fetch_assoc($result)){
		$subsql = "SELECT * FROM answers WHERE question = ".$row['id']." ORDER BY ind";
		$subresult = mysqli_query($connection,$subsql);
		$answers = array();
		if(mysqli_num_rows($subresult) == 0){
			mysqli_query($connection,"INSERT INTO answers (question,ref) VALUES (".$row['id'].",".$_REQUEST['ref'].") ORDER BY ind ASC");
			$subsql = "SELECT * FROM answers WHERE question = ".$row['id']." ORDER BY ind ASC";
			$subresult = mysqli_query($connection,$subsql);
		}
		while($subrow = mysqli_fetch_assoc($subresult)){
			//
			if($as_row['quiz'] == 1){
				$subsubsql = "SELECT * FROM actions WHERE answer_id = ".$subrow['id']." ORDER BY id ASC";
			}else{
				$subsubsql = "SELECT * FROM actions WHERE answer_id = ".$subrow['id']." AND type <> 'quiz' ORDER BY id ASC";
			}
			$subsubresult = mysqli_query($connection,$subsubsql);
			$actions = array();
			if(mysqli_num_rows($subsubresult)>0){
				while($subsubrow = mysqli_fetch_assoc($subsubresult)){
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
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
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
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$links_str.=json_encode($row).",";
	}
	// variables
	$variables_str = "";
	$sql = "SELECT * FROM vars WHERE as_id = ".$_REQUEST['ref']." OR as_id = 0 ORDER BY id DESC";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$variables_str.=json_encode($row).",";
	}
	// info boxes
	$info_str = "";
	$sql = "SELECT id,title_text FROM infoboxes WHERE as_id = ".$_REQUEST['ref']." OR as_id = 0 ORDER BY id DESC";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$info_str.=json_encode($row).",";
	}
	
	echo "{\"questions\":[".substr($answer_str,0,-1)."],\"variables\":[".substr($variables_str,0,-1)."],\"links\":[".substr($links_str,0,-1)."],\"results\":[".substr($results_str,0,-1)."],\"infoboxes\":[{\"id\":\"0\",\"title_text\":\"N/A\"},".substr($info_str,0,-1)."]}";
}
function indexQuestions(){
	global $connection;
	$sql = "SELECT * FROM questions WHERE ref = ".$_REQUEST['ref']." ORDER BY ind,id";
	$result = mysqli_query($connection,$sql);
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		$subsql = "UPDATE questions SET ind = ".$i." WHERE id = ".$row['id'];
		mysqli_query($connection,$subsql);
		$i++;
	}
}
?>