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
			$result = mysqli_query($connection,$sql);
			$_SESSION['as_id'] = mysqli_insert_id($connection);
			$result = mysqli_query($connection,"INSERT INTO questions (ref,question_title) VALUES (".$_SESSION['as_id'].",'New question')");
			$q = mysqli_insert_id($connection);
			$sql = "INSERT INTO answers (ref,question,ind,answer) VALUES (".$_SESSION['as_id'].",".mysqli_insert_id().",0,' ')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO actions (answer_id,type) VALUES (".mysqli_insert_id().",'points')";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO links (as_id) VALUES (".$_SESSION['as_id'].")";
			mysqli_query($connection,$sql);
			$sql = "INSERT INTO results (as_id) VALUES (".$_SESSION['as_id'].")";
			mysqli_query($connection,$sql);
			mkdir("../archive/as_".$_SESSION['as_id']);
			copy("../img/spacer.png","../archive/as_".$_SESSION['as_id']."/spacer.png");
			copy("../img/spyglass_padded.png","../archive/as_".$_SESSION['as_id']."/spyglass_padded.png");
			echo "as_id=".mysqli_insert_id($connection);
			
		break;
		case "delete":
			$_SESSION['a'] = 0;
			$_SESSION['q'] = 0;
			$sql = "SELECT id FROM questions WHERE ref = ".$_REQUEST['ref'];
			$result = mysqli_query($connection,$sql);
			while($row = mysqli_fetch_assoc($result)){
				$subsql = "SELECT id FROM answers WHERE question = ".$row['id'];
				$subresult = mysqli_query($connection,$subsql);
				while($subrow = mysqli_fetch_assoc($subresult)){
					$sql = "DELETE FROM actions WHERE answer_id = ".$subrow['id'];
					mysqli_query($connection,$sql);
				}
				$sql = "DELETE FROM answers WHERE ref = ".$row['id'];
				mysqli_query($connection,$sql);
			}
			$sql = "DELETE FROM assessments WHERE id = ".$_REQUEST['ref'];
			mysqli_query($connection,$sql);
			$sql = "DELETE FROM questions WHERE ref = ".$_REQUEST['ref'];
			mysqli_query($connection,$sql);
			$sql = "SELECT id FROM assessments";
			$result = mysqli_query($connection,$sql);
			$row = mysqli_fetch_assoc($result);
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
