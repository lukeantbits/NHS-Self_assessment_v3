<?php 
function renderQAction($row){
	//print_r($row);
	$output = '';
	$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	if($row['q_select_1'] == 'show'){
		$output = 'Only answer this question if you answered ';
	}else{
		$output = 'Ignore this question if you answered ';
	}
	$q=0;
	$q_sql = 'SELECT id,ind FROM questions WHERE ref = '.$row['ref'].' AND ind < '.$row['ind'].' ORDER BY ind ASC';
	$q_result = mysql_query($q_sql);
	while($q_row = mysql_fetch_assoc($q_result)){
		$q++;
		$a_sql = 'SELECT id,ind FROM answers WHERE question = '.$q_row['id'].' ORDER BY ind ASC';
		$a_result = mysql_query($a_sql);
		$a =0;
		$snippets = array();
		while($a_row = mysql_fetch_assoc($a_result)){
			$a++;
			//$ac_sql = 'SELECT id FROM actions WHERE type = "set variable" AND answer_id = '.$a_row['id'].' AND sub_type = "'.$row['q_select_2'].'"';
			$ac_sql = 'SELECT id FROM actions WHERE type = "set variable" AND answer_id = '.$a_row['id'].' AND sub_type = "'.$row['q_select_2'].'" AND value = "'.$row['q_select_4'].'"';
			$ac_result = mysql_query($ac_sql);
			while($ac_row = mysql_fetch_assoc($ac_result)){
				array_push($snippets,$letter[$a_row['ind']].' to question '.($q_row['ind']+1));
			}
		}
		$output.= implode(' or ',$snippets);
	}
	return $output;
}
function renderAccessible($id){
	$sql = 'SELECT * FROM assessments WHERE id = '.$id;
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$output = '<h1>'.$row['title'].'</h1>';
	$output.= '<h2>'.$row['intro_title'].'</h2>';
	$output.= '<p>'.$row['intro_copy'].'</p>';
	$output.= '<h2>Questions</h2><ol>';
	
	$q_sql = 'SELECT * FROM questions WHERE ref = '.$id.' ORDER BY ind ASC';
	$q_result = mysql_query($q_sql);
	while($q_row = mysql_fetch_assoc($q_result)){
		
		$output.= '<li><span>'.$q_row['question_body'].'</span>';
		if($q_row['q_select_1']!='null'){
			$output.= ' <span class="action">(';
			$output.= renderQAction($q_row);
			$output.= ')</span>';
		}
		$output.= '<ol type="A">';
		$a_sql = 'SELECT id,answer FROM answers WHERE question = '.$q_row['id'].' ORDER BY ind ASC';
		$a_result = mysql_query($a_sql);
		while($a_row = mysql_fetch_assoc($a_result)){
			$output.= '<li><span>'.$a_row['answer'];
			$ac_sql = 'SELECT * FROM actions WHERE answer_id = '.$a_row['id'];
			$ac_result = mysql_query($ac_sql);
			if(mysql_num_rows($ac_result)>0){	
				$results = array();	
				while($ac_row = mysql_fetch_assoc($ac_result)){
					switch($ac_row['type']){
						case 'points':
							if($ac_row['value'] != 0){
								$output.=' <span class="action">(';
								
									if($ac_row['operator'] == '+'){
										$output.= 'Add '.$ac_row['value'].' points';
									}else{
										$output.= 'Subtract '.$ac_row['value'].' points';
									}
								$output.=')</span>';
							}
						break;
						case 'result':
							array_push($results,$ac_row['value']);
						break;
					}
				}
				if(sizeof($results)>0){
					$output.="<ul>";
					foreach($results as $key){
						$ad_sql = 'SELECT * FROM results WHERE id = '.$key;
						$ad_result = mysql_query($ad_sql); 
						$ad_row = mysql_fetch_assoc($ad_result);
						$output.='<li class = "advice">'.$ad_row['result_copy'].'</li>';
					}
					$output.="</ul>";
				}
				
			}
			$output.='</span></li>';
			
		}
		$output.='</ol></li>';
		
	}
	$output.='</ol>';
	$r_sql= 'SELECT * FROM result_page_items WHERE type = "points triggered result" AND as_id = '.$id.' ORDER BY p1 ASC';
	$r_result = mysql_query($r_sql);
	if(mysql_num_rows($r_result)>0){
		$output.= '<h2>Results</h2><div style = "results"><ul>';
		$r = 0;
		while($r_row = mysql_fetch_assoc($r_result)){
			$r++;
			if($r<mysql_num_rows($r_result)){
				$output.='<li><b>'.$r_row['p1'].' - '.($r_row['p2']-1).' points:</b>'.$r_row['body'].'</li>';
			}else{
				$output.='<li><b>'.$r_row['p1'].' + points:</b>'.$r_row['body'].'</li>';
			}
		}
		$output.= '</ul></div>';
	}
	//$output = str_replace('â€™','\'',$output);
	return $output;
}?>