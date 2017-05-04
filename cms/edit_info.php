<?php $pg = 3; ?>
<?php require_once("includes/dbconnect.php");?>
<?php require_once("includes/session.php");?>
<?php require_once("includes/shared.php");?>
<?php 
openDb();
if(isset($_REQUEST['info_id'])){
	$info_id = $_REQUEST['info_id'];
}else{
	$info_id = 0;
}
if(isset($_REQUEST['submit'])){
	if($_REQUEST['delete_box'] == 1){
		$sql = "DELETE FROM infoboxes WHERE id = ".$info_id;
		mysql_query($sql);
		$info_id = 0;
	}else{
		$sql = "UPDATE infoboxes SET title_text = '".mysql_real_escape_string($_REQUEST['title_text'])."' , sub_title_text = '".mysql_real_escape_string($_REQUEST['sub_title_text'])."' , body_text = '".mysql_real_escape_string($_REQUEST['body_text'])."' , ";
		
		
		if(isset($_REQUEST['shared'])){
			$sql.= " as_id = 0 ";
		}else{
			$sql.= " as_id = ".$as_id;
		}
		
		$sql.= " WHERE id = ".$info_id;
		//echo $sql;
		mysql_query($sql);
	}
	if($_REQUEST['switch_id']>0){
		$info_id = $_REQUEST['switch_id'];
	}
	if($_REQUEST['add_box'] == 1){
		$sql = "INSERT INTO infoboxes (title_text,as_id) VALUES ('new info box',".$as_id.")";
		mysql_query($sql);
		//echo $sql;
		$info_id = mysql_insert_id();
	}
}

?>
<?php require_once("includes/head.php");?>
<body>
<pre><?php 
//print_r($_REQUEST);
?>
</pre>
<div >
<form id="main_form" method="POST" action="edit_info.php?submit=true">
  <div class="dialog_nav_bar">
    <h2> Info box editor</h2>
    <ul>
      <li><a href="#" id="add" >Add</a></li>
      
      <li><a href="#" id="save" >Save</a></li>
      <li><a href="#" id="delete" >Delete</a></li>
    </ul>
  </div>
  <div id="page">
    <div class="answer_content"><strong>Info box: </strong>
      <select id="info_box_switch">
        <?php
    $sql = "SELECT * FROM infoboxes WHERE as_id = ".$as_id." OR as_id = 0 ORDER BY as_id DESC,id DESC";
	$result = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_assoc($result)){
		if($row['id'] == $info_id || ($i == 0 && $info_id == 0 )){
			echo "<option selected = \"selected\" value=\"".$row['id']."\">".$row['title_text']."</option>";
			$info_row = $row;
		}else{
			echo "<option value=\"".$row['id']."\">".$row['title_text']."</option>";
		}
		$i++;
		
	}
    ?>
      </select>
    </div>
    <br>
    <div class="answer_content">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right"><strong>Shared ?</strong></td>
          <td><input type="checkbox" <?php if($info_row['as_id'] == 0){?>checked="checked"<?php }?> name="shared" id="shared" />&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Name:</strong></td>
          <td><label for="textfield"></label>
            <input type="text" style="width:640px;" name="title_text" id="title_text" value="<?php echo $info_row['title_text']; ?>" /></td>
        </tr>
        <tr>
          <td align="right"><strong>Title:</strong></td>
          <td><label for="textfield"></label>
            <input type="text" style="width:640px;" name="sub_title_text" id="sub_title_text" value="<?php echo $info_row['sub_title_text']; ?>" /></td>
        </tr>
        <tr>
          <td valign="top"><strong>Body text:</strong></td>
          <td><div class="nic_bg" >
              <textarea name="body_text" id="body_text" style="width:640px;height:300px;" ><?php echo $info_row['body_text']; ?></textarea>
            </div></td>
        </tr>
      </table>
    </div>
  </div>
  <input name="info_id" id="info_id" type="hidden" value="<?php echo $info_row['id']; ?>" />
  <input name="switch_id" id="switch_id" type="hidden" value="0" />
  <input name="add_box" id="add_box" type="hidden" value="0" />
  <input name="delete_box" id="delete_box" type="hidden" value="0" />
</form>
<script language="javascript">
 $(document).ready(function(){
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','removeformat','xhtml']}).panelInstance('body_text');
	$('#save').click(function(){
		$('#body_text').val((nicEditors.findEditor('body_text').getContent()));
		$('#main_form').submit();
	});
	$('#add').click(function(){
		$('#body_text').val((nicEditors.findEditor('body_text').getContent()));
		$('#add_box').val(1);
		$('#main_form').submit();
	});
	$('#delete').click(function(){
		$('#delete_box').val(1);
		$('#main_form').submit();
		
	});
	$('#info_box_switch').change(function(){
		$('#body_text').val((nicEditors.findEditor('body_text').getContent()));
		$('#switch_id').val($('#info_box_switch').val());
		$('#main_form').submit();
		
	});

 });

</script>
</body>
</html>