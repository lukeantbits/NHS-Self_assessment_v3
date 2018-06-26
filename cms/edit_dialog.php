
<?php 
if(isset($_GET['pg'])){
	$pg = $_GET['pg'];
}else{
	$pg = 3;
}
 ?>
<?php require_once("includes/dbconnect.php");?>
<?php require_once("includes/session.php");?>
<?php require_once("includes/shared.php");?>
<?php 
openDb();
$type = $_REQUEST['type'];
$type_arr = array();
$type_arr['link'] = array('table' => 'links','values' => array('link_copy','link_url'));
$type_arr['result'] = array('table' => 'results','values' => array('result_copy'));
$type_arr['set variable'] = array('table' => 'vars','values' => array('name','vals'));
$type_arr['video'] = array('table' => 'video','values' => array('name','vals'));
if(isset($_REQUEST['submit'])){
	if($_REQUEST['add_row'] == 1){
		$sql = "INSERT INTO ".$type_arr[$type]['table']." (as_id) VALUES (".$as_id.")";
		mysqli_query($connection,$sql);
	}
	foreach($_REQUEST as $key){
		if(strpos("_".key($_REQUEST),$type_arr[$type]['values'][0])>0){
			$tmp = key($_REQUEST);
			$tmp_arr = explode("_",$tmp);
			$id = array_pop($tmp_arr);
			if(isset($_REQUEST['delete_'.$id])){
				$sql = "DELETE FROM ".$type_arr[$type]['table']." WHERE id = ".$id;
				mysqli_query($connection,$sql);
			}else{
				$sql = "UPDATE ".$type_arr[$type]['table']." SET ";
				foreach($type_arr[$type]['values'] as $subkey){
					if($type == "set variable"){
						$val = sanitizeVar(mysqli_real_escape_string($connection,trim($_REQUEST[$subkey."_".$id])));
						if(varChanged($val,$id)){
							$sql.= " ".$subkey." = '".$val."' , ";
						}
						
					}else{
						$sql.= " ".$subkey." = '".mysqli_real_escape_string($connection,trim($_REQUEST[$subkey."_".$id]))."' , ";
					}
					
				}
				if($type_arr[$type]['table'] == "results"){
					if(isset($_REQUEST['priority_'.$id])){
						$sql.= " priority = 1 , ";
					}else{
						$sql.= " priority = 0 , ";
					}
				}
				if(isset($_REQUEST['shared_'.$id])){
					$sql.= " as_id = 0 ";
				}else{
					$sql.= " as_id = ".$as_id." ";
				}
				
				$sql.= " WHERE id = ".$id;
				mysqli_query($connection,$sql);
			}
			//echo $sql."<br>";
		}
		next($_REQUEST);
	}
}
?>
<?php require_once("includes/head.php");?>
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
<script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"> </script>
<body>
<br />

<div >
  <form id="main_form" method="POST" action="edit_dialog.php?submit=true&type=<?php echo $type;?>">
    <div class="dialog_nav_bar">
      <?php if($type != "video"){?>
      <h2> <?php echo ucfirst($type_arr[$type]['table']);?>&nbsp;editor</h2>
      <ul>
        <li><a href="#" id="add" >Add <?php echo substr($type_arr[$type]['table'],0,-1);?></a></li>
        <li><a href="#" id="save" >Save</a></li>
      </ul>
      <?php } ?>
    </div>
    <div id="page">
      <?php
//echo $_GET['type'];
switch($type){
	case "link":
		$sql = "SELECT * FROM links WHERE as_id = ".$as_id." OR as_id = 0 ORDER BY as_id DESC,id DESC";
		$result = mysqli_query($connection,$sql);
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$i++;
			?>
      <div class="answer_content">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:10px;"><input class="mini_btn_red" value="-" type="submit" name = "delete_<?php echo $row['id'];?>" id = "delete_<?php echo $row['id'];?>" /></td>
            <td align="right" style="width:30px;"><strong>Title</strong></td>
            <td nowrap="nowrap"><input style="width:400px;" name="link_copy_<?php echo $row['id'];?>" id="link_copy_<?php echo $row['id'];?>" type="text" value="<?php echo $row['link_copy'];?>"/>
              &nbsp;&nbsp;<strong>
              <input type="checkbox" <?php if($row['as_id'] == 0){?>checked="checked"<?php }?> name="shared_<?php echo $row['id'];?>" id="shared_<?php echo $row['id'];?>" />
              Shared?</strong>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" ></td>
            <td align="right"><strong>Url</strong></td>
            <td><input style="width:100%;" name="link_url_<?php echo $row['id'];?>" id="link_url_<?php echo $row['id'];?>" type="text" value="<?php echo $row['link_url'];?>"/></td>
          </tr>
        </table>
      </div>
      <br />
      <?php
		}
		
	break; 
	case "result":
		$sql = "SELECT * FROM results WHERE as_id = ".$as_id." OR as_id = 0 ORDER BY as_id DESC,id DESC";
		$result = mysqli_query($connection,$sql);
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$i++;
			?>
      <div class="answer_content">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" nowrap="nowrap" style="width:80px;"><input class="mini_btn_red" value="-" type="submit" name = "delete_<?php echo $row['id'];?>" id = "delete_<?php echo $row['id'];?>" />
              <br />
              <strong>
              <input type="checkbox" <?php if($row['as_id'] == 0){?>checked="checked"<?php }?> name="shared_<?php echo $row['id'];?>" id="shared_<?php echo $row['id'];?>" />
              Shared?</strong>&nbsp;<strong>
              <input type="checkbox" <?php if($row['priority'] == 1){?>checked="checked"<?php }?> name="priority_<?php echo $row['id'];?>" id="priority_<?php echo $row['id'];?>" />
              Priority?</strong>&nbsp;</td>
            <td nowrap="nowrap"><textarea style="width:100%;" name="result_copy_<?php echo $row['id'];?>" id="result_copy_<?php echo $row['id'];?>" /><?php echo stripChars(trim(strip_tags($row['result_copy'])));?></textarea></td>
          </tr>
        </table>
      </div>
      <br />
      <?php
		}
		
	break; 
	case "set variable":
	?>
      <div class="info">You may create new system variables here, you need to create a "|" seperated list of preset values.<br><br>You may also create a numeric variable which defaults to a value of 0, to do this name your variable with the suffix ":number" and leave the value blank.<br><br> Also be careful what you alter/delete as results may be unpredictable!</div>
      <?php
		$sql = "SELECT * FROM vars WHERE as_id = ".$as_id." OR as_id = 0 ORDER BY as_id DESC,id DESC";
		$result = mysqli_query($connection,$sql);
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$i++;
			?>
      <div class="answer_content">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:10px;"><?php if($row['id']>4){ ?>
              <input class="mini_btn_red" value="-" type="submit" name = "delete_<?php echo $row['id'];?>" id = "delete_<?php echo $row['id'];?>" />
              <?php }?>
              &nbsp;&nbsp;&nbsp;<strong>Variable&nbsp;name :</strong>
              <input style="width:200px;" name="name_<?php echo $row['id'];?>" id="name_<?php echo $row['id'];?>" type="text" value="<?php echo $row['name'];?>"/>
              <strong>Values :</strong>
              <input style="width:250px;" name="vals_<?php echo $row['id'];?>" id="vals_<?php echo $row['id'];?>" type="text" value="<?php echo $row['vals'];?>"/>
              &nbsp;&nbsp;<strong>
              <input type="checkbox" <?php if($row['as_id'] == 0){?>checked="checked"<?php }?> name="shared_<?php echo $row['id'];?>" id="shared_<?php echo $row['id'];?>" />
              Shared?</strong></td>
          </tr>
        </table>
      </div>
      <br />
      <?php
		}
		
	break; 
	case "video":
	?>
      
      <?php
	break; 
}
  ?>
    </div>
    <input name="add_row" id="add_row" type="hidden" value="0" />
  </form>
</div>
<script language="javascript">
var bc_obj
 $(document).ready(function(){
	$('#save').click(function(){
		$('#main_form').submit();
	});
	$('#add').click(function(){
		$('#add_row').val(1);
		$('#main_form').submit();
	});
	<?php if($type == "video"){
	$tmp = explode("_",$_REQUEST['callback']);
	$bc_id = 0;
	if(sizeof($tmp)>2){
		$sql = "SELECT value FROM actions WHERE id =  ".$tmp[2];
		$result = mysqli_query($connection,$sql);
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			$bc_id = $row['value'];
		}
	}
	
	?>
	bc_obj = new bcNav($('#page'),'<?php echo $tmp[2];?>','<?php echo $bc_id;?>');
	<?php }?>

 });
</script>
</body>
</html>