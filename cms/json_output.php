<?php
header('Content-Type: application/json');
ini_set('display_errors',1);
$pg = 0;
$info_boxes = array();
$results= array();
$links= array();
$qvars= array();
$videos= array();
//
require_once("includes/dbconnect.php");
require_once("includes/shared.php");
require_once("includes/session_lite.php");
function is_quiz_active($id){
	global $connection;
	$output = 0;
	$sql = "SELECT answer,id FROM answers WHERE question = ".$id." ORDER BY ind";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$subsql = "SELECT id FROM actions WHERE answer_id = ".$row['id']." AND type = 'quiz'";
		$subresult = mysqli_query($connection,$subsql);
		if(mysqli_num_rows($subresult)>0){
			$output = 1;
		}
	}
	return $output;
}
function alt_tint($val){
	global $colours;
	$output = "000000";
	foreach($colours as $key){
		if($val == $key[0]){
			$output = $key[1];
		}
	}
	return $output;
}
function list_answers($id){
	global $connection;
	$sql = "SELECT answer,id FROM answers WHERE question = ".$id." ORDER BY ind";
	$result = mysqli_query($connection,$sql);
	$output = array();
	while($row = mysqli_fetch_assoc($result)){
		$a = array();
		$a['body'] = trim(stripChars($row['answer']));
		$a['actions'] = list_answer_actions($row['id']);
		array_push($output,$a);
	}
	return $output;
}
function list_answer_actions($id){
	global $connection;
	global $results,$links,$qvars;
	$sql = "SELECT type,sub_type,operator,value FROM actions WHERE answer_id = ".$id;
	$result = mysqli_query($connection,$sql);
	$output = array();
	while($row = mysqli_fetch_assoc($result)){
		$ac = array();
		$i = 0;
		switch($row['type']){
			case "result":
				array_push($results,$row['value']);
			break;
			case "link":
				array_push($links,$row['value']);
			break;
			case "set variable":
				array_push($qvars,$row['sub_type']);
			break;
		}
		foreach($row as $key){
			if($key != ""){
				$ac[key($row)] = $key;
			}
			next($row);
			$i++;
			
		}
		array_push($output,$ac);
	}
	return $output;
}
function format_question_action($arr){
	$output = array();
	$p = 0;
	if($arr['q_select_1'] != "null"){
		$i = 0;
		foreach($arr as $key){
			if($i >= 8 && $key != ""){
				switch($i){
					case 8:
						$output['condition'] = $key.' if';
					break;
					case 9:
						$output['property'] = $key;
						if($key == "points"){
							$p = 1;
						}
					break;
					case 10:
						$output['operator'] = stripChars($key);
					break;
					case 11:
						if($p == 0){
							$output['value'] = $key;
						}
					break;
					case 12:
						if($p == 1){
							$output['value'] = $key;
						}
					break;
				}
			}
			$i++;
		}
	}
	return $output;
}
if($as_id > 1){
	$output = array();
	// CONFIG
	openDb();
	$sql = "SELECT id,title,replace(colour_1,'#','')as colour_1,replace(colour_2,'#','')as colour_2,colour_3,intro_title,intro_copy,intro_foot,intro_foot_title,intro_graphic,h_max,h_min,print_title,reporting,syndication_footer,progress_bar,quiz FROM assessments WHERE id = ".$as_id;
	$result = mysqli_query($connection,$sql);
	$as_row = mysqli_fetch_assoc($result);
	for($i =0;$i < sizeof($as_row);$i++){
		if(strpos(key($as_row),"colour")=== false){
			if(strpos(key($as_row),"_copy")>=0){
				$as_row[key($as_row)] = tweakHTML($as_row[key($as_row)]);	
			}
		}else{
			$as_row[key($as_row)] = array($as_row[key($as_row)],alt_tint($as_row[key($as_row)]));
		}
		next($as_row);
	}
	$output['config'] = $as_row;
	// QUESTIONS
	$output['questions'] = array();
	$sql = "SELECT * FROM questions WHERE ref = ".$as_id." ORDER BY ind";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		array_push($info_boxes,$row['info_box']);
		$q = array();
		$q['type'] = $row['question_type'];
		$q['info_box'] = $row['info_box'];
		$q['info_box_position'] = $row['info_box_position'];
		$q['title'] = $row['question_title'];
		$q['body'] = $row['question_body'];
		$q['quiz_summary'] = $row['quiz_summary'];
		$q['quiz_answer'] = trim($row['quiz_answer']);
		$q['quiz_check'] = $row['quiz_check'];
		$q['quiz_active'] = is_quiz_active($row['id']);
		$q['answers'] = list_answers($row['id']);
		if($row['q_select_1'] != 'null'){
			$q['action'] = format_question_action($row);
		}
		array_push($output['questions'],$q);
	}
	// RESULTS
	$output['results'] = array();
	$sql = "SELECT type,p1,p2,p3,body as text FROM result_page_items WHERE as_id = ".$as_id." ORDER BY ind";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		array_push($output['results'],$row);
	}
	// LINKS
	$output['links'] = array();
	$sql = "SELECT type,p1,p2,body as text FROM link_page_items WHERE as_id = ".$as_id." ORDER BY ind";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		array_push($output['links'],$row);
		if($row['type'] == "obligatory link"){
			array_push($links,$row['text']);
		}
		if($row['type'] == "obligatory video"){
			array_push($videos,$row['text']);
		}
	}
	// RESULT ITEMS
	$output['result_items'] = array();
	$results = array_unique($results);
	foreach($results as $subkey){
		$subsql = "SELECT id,result_copy as text,priority FROM results WHERE id = ".$subkey;
		$subresult = mysqli_query($connection,$subsql);
		$subrow = mysqli_fetch_assoc($subresult);
		array_push($output['result_items'],$subrow);
	}
	// LINK ITEMS
	$output['link_items'] = array();
	$links = array_unique($links);
	if(sizeof($links) > 1){
		foreach($links as $subkey){
			$subsql = "SELECT id,link_copy as text,link_url FROM links WHERE id = ".$subkey;
			$subresult = mysqli_query($connection,$subsql);
			$subrow = mysqli_fetch_assoc($subresult);
			array_push($output['link_items'],$subrow);
		}
	}
	// QVARS
	$output['qvars'] = array();
	$qvars = array_unique($qvars);
	foreach($qvars as $subkey){
		$subsql = "SELECT vals FROM vars WHERE name = '".$subkey."'";
		$subresult = mysqli_query($connection,$subsql);
		$subrow = mysqli_fetch_assoc($subresult);
		$output['qvars'][$subkey] = array();
		
		if($subrow['vals'] != "" && !strpos($subkey,":number")){
			$tmp = explode("|",$subrow['vals']);
			foreach($tmp as $v){
				array_push($output['qvars'][$subkey],$v);
			}
		}else{
			array_push($output['qvars'][$subkey],0);
		}
		
	}
	
	// INFO BOXES
	$output['info_boxes'] = array();
	$info_boxes = array_unique($info_boxes);
	foreach($info_boxes as $subkey){
		$subsql = "SELECT id,sub_title_text as title,body_text as body,title_text as name FROM infoboxes WHERE id = ".$subkey;
		$subresult = mysqli_query($connection,$subsql);
		if($subresult->num_rows > 0){
			$subrow = mysqli_fetch_assoc($subresult);
			array_push($output['info_boxes'],$subrow);
		}
	}
	// VIDEOS
	$output['videos'] = array();
	$sql = "SELECT distinct(value)FROM self_assessments_v3.actions INNER JOIN self_assessments_v3.answers ON self_assessments_v3.answers.id = self_assessments_v3.actions.answer_id WHERE type = 'video' AND self_assessments_v3.answers.ref = ".$as_id;
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		array_push($output['videos'],$row['value']);
	}
	$sql = "SELECT body FROM link_page_items  WHERE type = 'obligatory video' AND as_id = ".$as_id;
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_assoc($result)){
		array_push($output['videos'],$row['body']);
		
	}
	echo json_encode($output);
}
?>
