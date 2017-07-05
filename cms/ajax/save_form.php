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
			if($_REQUEST['progress_bar'] == 'true'){
				$sql.= " , progress_bar = 1";
			}else{
				$sql.= " , progress_bar = 0";
			}
			if($_REQUEST['syndication_footer'] == 'true'){
				$sql.= " , syndication_footer = 1";
			}else{
				$sql.= " , syndication_footer = 0";
			}
			$sql.= " , h_max = ".intval($_REQUEST['h_max'])." , h_min = ".intval($_REQUEST['h_min'])." WHERE id = ".$_REQUEST['id'];
			mysqli_query($connection,$sql);
			//echo $sql;
		break;
		case 2:
			$fields = array("intro_title","intro_copy","intro_foot","intro_graphic","img_alt");
			
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' , ";
			foreach($fields as $key){
				if($_REQUEST[$key] == '<br>'){
					$_REQUEST[$key] = '';
				}
				$sql.= $key." = '".mysqli_real_escape_string($connection,$_REQUEST[$key])."' , ";
			}
			$sql = substr($sql,0,-2);
			$sql.= " WHERE id = ".$_REQUEST['as_id'];
			mysqli_query($connection,$sql);
			//echo $sql;
		break;
		case 3:	
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysqli_query($connection,$sql);
			$question = $_REQUEST['q'];
			$answers = explode(",",$_REQUEST['answers']);
			$sql = "UPDATE questions SET question_body = '".mysqli_real_escape_string($connection,$_REQUEST['question_body'])."' , question_type = '".$_REQUEST['question_type']."' , info_box = ".$_REQUEST['info_box']." , q_select_1 = '".$_REQUEST['q_select_1']."' , q_select_2 = '".$_REQUEST['q_select_2']."', q_select_3 = '".$_REQUEST['q_select_3']."', q_select_4 = '".$_REQUEST['q_select_4']."', q_select_5 = '".$_REQUEST['q_select_5']."' , info_box_position = '".$_REQUEST['info_box_position']."' , quiz_summary = '".mysqli_real_escape_string($connection,$_REQUEST['quiz_summary'])."' , quiz_answer = '".mysqli_real_escape_string($connection,$_REQUEST['quiz_answer'])."', quiz_check = '".mysqli_real_escape_string($connection,$_REQUEST['quiz_check'])."' WHERE id = ".$_REQUEST['q_id'];
			//echo $sql;
			mysqli_query($connection,$sql);
			$i = 0;
			foreach($answers as $key){
				$sql= "UPDATE answers SET answer = '".mysqli_real_escape_string($connection,$_REQUEST['t_'.$i])."' WHERE id = ".$key;
				mysqli_query($connection,$sql);
				$sql = "SELECT id FROM actions WHERE answer_id = ".$key;
				$result = mysqli_query($connection,$sql);
				while($row = mysqli_fetch_assoc($result)){
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
					mysqli_query($connection,$subsql)or die($subsql);
				}
				$i++;
			}			
		break;
		case 4:
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM result_page_items WHERE as_id = ".$_REQUEST['as_id'];
			$result = mysqli_query($connection,$sql);
			while($row = mysqli_fetch_assoc($result)){
				$subsql = "UPDATE result_page_items SET ";
				if(isset($_REQUEST['rt_'.$row['id']])){
					$body = "";
					if(isset($_REQUEST['t_'.$row['id']])){
						$body = $_REQUEST['t_'.$row['id']];
					}
					$subsql.=" type = '".$_REQUEST['rt_'.$row['id']]."' , body = '".mysqli_real_escape_string($connection,$body)."'  ";
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
				mysqli_query($connection,$subsql)or die($subsql);
			}
		break;
		case 5:
			$sql = "UPDATE assessments SET touch = '".$_SESSION['ac_email']."|".time()."' WHERE id = ".$_REQUEST['as_id'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM link_page_items WHERE as_id = ".$_REQUEST['as_id'];
			$result = mysqli_query($connection,$sql);
			while($row = mysqli_fetch_assoc($result)){
				$subsql = "UPDATE link_page_items SET ";
				if(isset($_REQUEST['rt_'.$row['id']])){
					$body = "";
					if(isset($_REQUEST['t_'.$row['id']])){
						$body = $_REQUEST['t_'.$row['id']];
					}
					$subsql.=" type = '".$_REQUEST['rt_'.$row['id']]."' , body = '".mysqli_real_escape_string($connection,$body)."'  ";
				}
				if(isset($_REQUEST['p1_'.$row['id']])){
					$subsql.=" , p1 = '".$_REQUEST['p1_'.$row['id']]."' ";
				}
				if(isset($_REQUEST['p2_'.$row['id']])){
					$subsql.=" , p2 = '".$_REQUEST['p2_'.$row['id']]."' ";
				}
				$subsql.=" WHERE id =  ".$row['id'];
				mysqli_query($connection,$subsql)or die($subsql);
			}
		break;
	}
}
?>