<?php
$pg = $_REQUEST['pg'];
require_once("../includes/session.php");
require_once("../includes/dbconnect.php");
if(isset($_REQUEST['mode'])){
	switch($_REQUEST['mode']){
		case "new":
			$_SESSION['a'] = 0;
			$_SESSION['q'] = 0;
			$sql = "INSERT INTO assessments (title) VALUES ('New assessment')";
			$result = mysql_query($sql);
			$_SESSION['as_id'] = mysql_insert_id();
			$result = mysql_query("INSERT INTO questions (ref,question_title) VALUES (".$_SESSION['as_id'].",'New question')");
			$q = mysql_insert_id();
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_SESSION['as_id'].",".mysql_insert_id().",0,' ')";
			mysql_query($sql);
			$sql = "INSERT INTO actions (answer_id,type) VALUES (".mysql_insert_id().",'points')";
			mysql_query($sql);
			$sql = "INSERT INTO links (as_id) VALUES (".$_SESSION['as_id'].")";
			mysql_query($sql);
			$sql = "INSERT INTO results (as_id) VALUES (".$_SESSION['as_id'].")";
			mysql_query($sql);
			mkdir("../archive/as_".$_SESSION['as_id']);
			copy("../img/spacer.png","../archive/as_".$_SESSION['as_id']."/spacer.png");
			echo "as_id=".mysql_insert_id();
			
		break;
		case "delete":
			$_SESSION['a'] = 0;
			$_SESSION['q'] = 0;
			$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['ref'];
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)){
				$subsql = "SELECT id FROM answers WHERE question = ".$row['id'];
				$subresult = mysql_query($subsql);
				while($subrow = mysql_fetch_assoc($subresult)){
					$sql = "DELETE FROM actions WHERE answer_id = ".$subrow['id'];
					mysql_query($sql);
				}
				$sql = "DELETE FROM answers WHERE ref = ".$row['id'];
				mysql_query($sql);
			}
			$sql = "DELETE FROM assessments WHERE id = ".$_REQUEST['ref'];
			mysql_query($sql);
			$sql = "DELETE FROM questions WHERE ref = ".$_REQUEST['ref'];
			mysql_query($sql);
			$sql = "SELECT id FROM assessments";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);
			$_SESSION['as_id'] = $row['id'];
			echo "success=true&as_id=".$row['id'];
			
		break;
		case "switch":
			$_SESSION['a'] = 0;
			$_SESSION['q'] = 0;
			$_SESSION['as_id'] = $_REQUEST['as_id'];
			echo "self.as_id=".$_SESSION['as_id'];
		break;
	
	}
}
?>
