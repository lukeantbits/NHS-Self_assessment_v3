<?php
$pg = null;
require_once("../includes/dbconnect.php");
require_once("../includes/session.php");
openDb();
if(isset($_REQUEST['page'])){
	$page = $_REQUEST['page'];
	switch($page){
		case 1:
			$fields = array("title","colour_1","colour_2","colour_3","print_title","review_key");
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' , ";
			foreach($fields as $key){
				$sql.= $key." = '".$_REQUEST[$key]."' , ";
			}
			if($_REQUEST['quiz'] == 'true'){
				$sql.= " quiz = 1";
			}else{
				$sql.= " quiz = 0";
			}
			if($_REQUEST['reporting'] == 'true'){
				$sql.= " , reporting = 1";
			}else{
				$sql.= " , reporting = 0";
			}
			if($_REQUEST['syndication_footer'] == 'true'){
				$sql.= " , syndication_footer = 1";
			}else{
				$sql.= " , syndication_footer = 0";
			}
			$sql.= " , dimensions_f = '".$_REQUEST['width_f']."x".$_REQUEST['height_f']."' , dimensions_j = '".$_REQUEST['width_j']."x".$_REQUEST['height_j']."' WHERE id = ".$_REQUEST['id'];
			mysql_query($sql);
			//echo $sql;
		break;
		case 2:
			$fields = array("intro_title","intro_copy","intro_copy_alt","intro_foot","intro_graphic","intro_graphic_alt","intro_graphic_position","intro_graphic_position_m","hr_intro_graphic_alt","img_alt","js_body_w","js_body_left","js_body_top");
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' , ";
			foreach($fields as $key){
				$sql.= $key." = '".mysql_real_escape_string($_REQUEST[$key])."' , ";
			}
			$sql = substr($sql,0,-2);
			$sql.= " WHERE id = ".$_REQUEST['as_id'];
			mysql_query($sql);
			//echo $sql;
		break;
		case 3:	
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysql_query($sql);
			$question = $_REQUEST['q'];
			$answers = explode(",",$_REQUEST['answers']);
			$sql = "UPDATE questions SET question_body = '".mysql_real_escape_string($_REQUEST['question_body'])."' , question_type = '".$_REQUEST['question_type']."' , info_box = ".$_REQUEST['info_box']." , q_select_1 = '".$_REQUEST['q_select_1']."' , q_select_2 = '".$_REQUEST['q_select_2']."', q_select_3 = '".$_REQUEST['q_select_3']."', q_select_4 = '".$_REQUEST['q_select_4']."', q_select_5 = '".$_REQUEST['q_select_5']."' , info_box_position = '".$_REQUEST['info_box_position']."' , quiz_summary = '".mysql_real_escape_string($_REQUEST['quiz_summary'])."' , quiz_answer = '".mysql_real_escape_string($_REQUEST['quiz_answer'])."', quiz_check = '".mysql_real_escape_string($_REQUEST['quiz_check'])."' WHERE id = ".$_REQUEST['q_id'];
			//echo $sql;
			mysql_query($sql);
			$i = 0;
			foreach($answers as $key){
				$sql= "UPDATE answers SET answer = '".mysql_real_escape_string($_REQUEST['t_'.$i])."' WHERE id = ".$key;
				mysql_query($sql);
				$sql = "SELECT id FROM actions WHERE answer_id = ".$key;
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result)){
					$subsql = "UPDATE actions SET";
					if(isset($_REQUEST[$row['id']."_select_1"])){
						$subsql.= " type = '".$_REQUEST[$row['id']."_select_1"]."' ,";
						$subsql.= " sub_type = '".$_REQUEST[$row['id']."_select_2"]."' ,";
						$subsql.= " operator = '".$_REQUEST[$row['id']."_select_3"]."' ,";
						if($_REQUEST[$row['id']."_value_1"] != ""){
							$subsql.= " value = '".$_REQUEST[$row['id']."_value_1"]."' ";
						}else{
							$subsql.= " value = '".$_REQUEST[$row['id']."_select_4"]."' ";
							
						}
					}
					
					$subsql.= " WHERE id = ".$row['id'];
					mysql_query($subsql)or die($subsql);
				}
				$i++;
			}			
		break;
		case 4:
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysql_query($sql);
			$sql = "SELECT id FROM result_page_items WHERE as_id = ".$_REQUEST['as_id'];
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)){
				$subsql = "UPDATE result_page_items SET ";
				if(isset($_REQUEST['rt_'.$row['id']])){
					$body = "";
					if(isset($_REQUEST['t_'.$row['id']])){
						$body = $_REQUEST['t_'.$row['id']];
					}
					$subsql.=" type = '".$_REQUEST['rt_'.$row['id']]."' , body = '".mysql_real_escape_string($body)."'  ";
				}
				if(isset($_REQUEST['p1_'.$row['id']])){
					$subsql.=" , p1 = '".$_REQUEST['p1_'.$row['id']]."' ";
				}
				if(isset($_REQUEST['p2_'.$row['id']])){
					$subsql.=" , p2 = '".$_REQUEST['p2_'.$row['id']]."' ";
				}
				if(isset($_REQUEST['p3_'.$row['id']])){
					$subsql.=" , p3 = '".$_REQUEST['p3_'.$row['id']]."' ";
				}
				$subsql.=" WHERE id =  ".$row['id'];
				mysql_query($subsql)or die($subsql);
			}
		break;
		case 5:
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysql_query($sql);
			$sql = "SELECT id FROM link_page_items WHERE as_id = ".$_REQUEST['as_id'];
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)){
				$subsql = "UPDATE link_page_items SET ";
				if(isset($_REQUEST['rt_'.$row['id']])){
					$body = "";
					if(isset($_REQUEST['t_'.$row['id']])){
						$body = $_REQUEST['t_'.$row['id']];
					}
					$subsql.=" type = '".$_REQUEST['rt_'.$row['id']]."' , body = '".mysql_real_escape_string($body)."'  ";
				}
				if(isset($_REQUEST['p1_'.$row['id']])){
					$subsql.=" , p1 = '".$_REQUEST['p1_'.$row['id']]."' ";
				}
				if(isset($_REQUEST['p2_'.$row['id']])){
					$subsql.=" , p2 = '".$_REQUEST['p2_'.$row['id']]."' ";
				}
				$subsql.=" WHERE id =  ".$row['id'];
				mysql_query($subsql)or die($subsql);
			}
		break;
	}
}
?>