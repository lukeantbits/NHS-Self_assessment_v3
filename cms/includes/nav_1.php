<?php 
$sql = "SELECT * FROM assessments";
$result = mysqli_query($connection,$sql);
$page_row = "";
?>
<div id="nav1" class="nav_bar"><div class="nav_1_right">
  <ul>
  <li ><a href="#"  id="delete_assessment">Delete</a></li>
    <li class="green_btn"><a href="#"  class="green_btn" id="save_all">Save</a></li>
    <li><a href="#"  id="new_assessment">Create new</a></li>
    <li ><a href="#"  id="preview">Preview</a></li>
    <li><select id="assessment_switcher">
  	<?php 
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		if($row['id'] == $as_id || $i == 0){
			echo "<option selected=\"selected\" value=\"".$row['id']."\">".$row['title']."</option>";
			$page_row = $row;
		}else{
			echo "<option value=\"".$row['id']."\">".$row['title']."</option>";
		}
		$i++;
	}
	$as_id = $page_row['id'];
	$_SESSION['as_id'] = $page_row['id'];
	?>
    
  </select></li>
  </ul>
  </div>
  <ul>
    <li><a href="#" <?php if($pg == 1){?>class="current"<?php }?> id="nav_1">Config</a></li>
    <li><a href="#" <?php if($pg == 2){?>class="current"<?php }?> id="nav_2">Splash</a></li>
    <li><a href="#" <?php if($pg == 3){?>class="current"<?php }?> id="nav_3">Questions</a></li>
    <li><a href="#" <?php if($pg == 4){?>class="current"<?php }?> id="nav_4">Results area</a></li>
    <li><a href="#" <?php if($pg == 5){?>class="current"<?php }?> id="nav_5">Links</a></li>
    
  </ul>
  
</div>
