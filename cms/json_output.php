<?xml version="1.0" encoding="utf-8"?>
<?php
$pg = 0;
$info_boxes = array();
$results= array();
$links= array();
$qvars= array();
$videos= array();

require_once("includes/dbconnect.php");
require_once("includes/shared.php");
require_once("includes/session_lite.php");
function is_quiz_active($id){
	$output = 0;
	$sql = "SELECT answer,id FROM answers WHERE question = ".$id." ORDER BY ind";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		$subsql = "SELECT id FROM actions WHERE answer_id = ".$row['id']." AND type = 'quiz'";
		$subresult = mysql_query($subsql);
		if(mysql_num_rows($subresult)>0){
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
	$sql = "SELECT answer,id FROM answers WHERE question = ".$id." ORDER BY ind";
	$result = mysql_query($sql);
	$output= "
";
	while($row = mysql_fetch_assoc($result)){
		$output.= "				<a>
";
		$output.= "					<body><![CDATA[".stripChars($row['answer'])."]]></body>
";		
		$output.= "					<actions>".list_answer_actions($row['id'])."					</actions>
";
		$output.= "				</a>
";
	
	}
	return $output;
}
function list_answer_actions($id){
	global $results,$links,$qvars;
	$sql = "SELECT type,sub_type,operator,value FROM actions WHERE answer_id = ".$id;
	$result = mysql_query($sql);
	$output= "
";
	while($row = mysql_fetch_assoc($result)){
		$output.= "						<ac>
";
		;
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
			if($i == 0){
				prev($row);
			}else{
				next($row);
			}
			
			if($key != ""){
				$output.= "							<".key($row)."><![CDATA[".$key."]]></".key($row).">
";
			}
			
			$i++;
			
		}
		$output.= "						</ac>
";
	}
	return $output;
}
function format_question_action($arr){
	$output = "";
	$p = 0;
	if($arr['q_select_1'] != "null"){
		$i = 0;
		foreach($arr as $key){
			if($i >= 8 && $key != ""){
				switch($i){
					case 8:
						$output .= "				<condition>".$key." if</condition>
";
					break;
					case 9:
						$output .= "				<property>".$key."</property>
";
						if($key == "points"){
							$p = 1;
						}
					break;
					case 10:
						$output .= "				<operator><![CDATA[".stripChars($key)."]]></operator>
";
					break;
					case 11:
						if($p == 0){
							$output .= "				<value>".$key."</value>
";
						}
					break;
					case 12:
						if($p == 1){
							$output .= "				<value>".$key."</value>
";
						}
					break;
				}
			}
			$i++;
		}
	}
	return $output;
}
if($ex_mode == "normal"){
	header ("content-type: text/xml");
}
if($as_id > 1){
	openDb();
	$sql = "SELECT id,title,replace(colour_1,'#','')as colour_1,replace(colour_2,'#','')as colour_2,colour_3,intro_title,intro_copy,intro_copy_alt,intro_foot,intro_graphic,intro_graphic_alt,hr_intro_graphic_alt,intro_graphic_position,intro_graphic_position_m,dimensions_f,dimensions_j,print_title,reporting,syndication_footer,img_alt,js_body_w,js_body_top,js_body_left,quiz FROM assessments WHERE id = ".$as_id;
	$result = mysql_query($sql);
	$as_row = mysql_fetch_assoc($result);
	echo "<root>
";
	echo "	<config>
";
	for($i =0;$i < sizeof($as_row);$i++){
		if(strpos(key($as_row),"colour")=== false){
			if(strpos(key($as_row),"intro")=== false){
				echo "		<".key($as_row).">".$as_row[key($as_row)]."</".key($as_row).">		
";			
			}else{
				echo "		<".key($as_row)."><![CDATA[".tweakHTML($as_row[key($as_row)])."]]></".key($as_row).">		
";			
			}
		}else{
			echo "		<".key($as_row).">".$as_row[key($as_row)]."|".alt_tint($as_row[key($as_row)])."</".key($as_row).">
";	
		}
		next($as_row);
	}
	echo "	</config>
";
	echo "	<questions>
";
	$sql = "SELECT * FROM questions WHERE ref = ".$as_id." ORDER BY ind";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		array_push($info_boxes,$row['info_box']);
		echo "		<q type = \"".$row['question_type']."\" info_box = \"".$row['info_box']."\" info_box_position = \"".$row['info_box_position']."\">
";
		echo "			<title><![CDATA[".$row['question_title']."]]></title>
";
		echo "			<body><![CDATA[".$row['question_body']."]]></body>
";
		if($row['q_select_1'] != 'null'){echo "			<action>
".format_question_action($row)."			</action>
";
		}
		echo "			<quiz_summary><![CDATA[".$row['quiz_summary']."]]></quiz_summary>
";
		echo "			<quiz_answer><![CDATA[".$row['quiz_answer']."]]></quiz_answer>
";
		echo "			<quiz_check><![CDATA[".$row['quiz_check']."]]></quiz_check>
";
		echo "			<quiz_active>".is_quiz_active($row['id'])."</quiz_active>
";	
		echo "			<answers>".list_answers($row['id'])."			</answers>
";
		echo "		</q>
";
	}
	echo "	</questions>
";
	echo "	<results>
";
	$sql = "SELECT * FROM result_page_items WHERE as_id = ".$as_id." ORDER BY ind";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		echo "		<ri type = \"".$row['type']."\" p1 = \"".$row['p1']."\" p2 = \"".$row['p2']."\" p3 = \"".$row['p3']."\"><![CDATA[".$row['body']."]]></ri>
";
	}
	echo "	</results>
";
	echo "	<links>
";
	$sql = "SELECT * FROM link_page_items WHERE as_id = ".$as_id." ORDER BY ind";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)){
		echo "		<li type = \"".$row['type']."\" p1 = \"".$row['p1']."\" p2 = \"".$row['p2']."\"><![CDATA[".$row['body']."]]></li>
";
		if($row['type'] == "obligatory link"){
			array_push($links,$row['body']);
		}
		if($row['type'] == "obligatory video"){
			array_push($videos,$row['body']);
		}
	}
	echo "	</links>
";
	echo "	<result_items>
";
	$results = array_unique($results);
	foreach($results as $subkey){
		
		$subsql = "SELECT id,result_copy,priority FROM results WHERE id = ".$subkey;
		$subresult = mysql_query($subsql);
		$subrow = mysql_fetch_assoc($subresult);
		echo "		<ri id = \"".$subkey."\" priority = \"".$subrow['priority']."\">";
		echo "<![CDATA[".stripChars($subrow['result_copy'])."]]>";
		echo "</ri>
";
	}
	echo "	</result_items>
";
	echo "	<link_items>
";
	$links = array_unique($links);
	foreach($links as $subkey){
		
		$subsql = "SELECT id,link_copy,link_url FROM links WHERE id = ".$subkey;
		$subresult = mysql_query($subsql);
		$subrow = mysql_fetch_assoc($subresult);
		echo "		<ri id = \"".$subkey."\" url = \"".$subrow['link_url']."\">";
		echo "<![CDATA[".$subrow['link_copy'];
		echo "]]></ri>";
	}
	echo "	</link_items>
";
	echo "	<qvars>
";
	$qvars = array_unique($qvars);
	foreach($qvars as $subkey){
		
		$subsql = "SELECT vals FROM vars WHERE name = '".$subkey."'";
		$subresult = mysql_query($subsql);
		$subrow = mysql_fetch_assoc($subresult);
		echo "		<v  name = \"".$subkey."\">
";
		//echo "".$subrow['vals'];
		if($subrow['vals'] != "" && !strpos($subkey,":number")){
			$tmp = explode("|",$subrow['vals']);
			foreach($tmp as $v){
				echo "<val>".$v."</val>";
			}
		}else{
			echo "<val>0</val>";
		}
		echo "		</v>
";
	}
	echo "	</qvars>
";
	echo "	<info_boxes>
";
	$info_boxes = array_unique($info_boxes);
	foreach($info_boxes as $subkey){
		$subsql = "SELECT sub_title_text,body_text,title_text FROM infoboxes WHERE id = ".$subkey;
		$subresult = mysql_query($subsql);
		$subrow = mysql_fetch_assoc($subresult);
		echo "		<ib  id = \"".$subkey."\">
";
		echo "			<title><![CDATA[".stripChars($subrow['sub_title_text'])."]]></title>
";
		echo "			<body><![CDATA[".stripChars($subrow['body_text'])."]]></body>
";
		echo "			<name><![CDATA[".stripChars($subrow['title_text'])."]]></name>
";		
		echo "		</ib>
";
	}
	echo "	</info_boxes>
";
	echo "	<videos>
";
	$sql = "SELECT distinct(value)FROM self_assessments.actions INNER JOIN self_assessments.answers ON self_assessments.answers.id = self_assessments.actions.answer_id WHERE type = 'video' AND self_assessments.answers.ref = ".$as_id;
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_assoc($result)){
		echo "			<v>".$row['value']."</v>";
	}
	$sql = "SELECT body FROM link_page_items  WHERE type = 'obligatory video' AND as_id = ".$as_id;
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_assoc($result)){
		echo "			<v>".$row['body']."</v>";
	}
	echo "	</videos>
";
	echo "</root>
";
}
?>