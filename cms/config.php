<?php $pg = 1;?>
<?php require_once("includes/dbconnect.php");?>
<?php require_once("includes/session.php");?>
<?php require_once("includes/shared.php");?>
<?php require_once("includes/head.php");?>
<body>
<div id="main">
  <?php require_once("includes/nav_1.php");
  ?>
  <div id="page">
    <form enctype="application/x-www-form-urlencoded" name="main_form" id="main_form">
      <table class="form_table" >
        <tr>
          <td align="right" style="width:150px;"><strong>Title</strong></td>
          <td><input name="title" style="width:400px;" type="text" id="title" value="<?php echo $page_row['title'];?>" /></td>
        </tr>
        <tr>
          <td align="right" style="width:100px;"><strong>Print title</strong></td>
          <td><input name="print_title" style="width:400px;" type="text" id="print_title" value="<?php echo $page_row['print_title'];?>" /></td>
        </tr>
        <tr>
          <td align="right" style="width:100px;"><strong>Review date key</strong></td>
          <td><input name="review_key" style="width:400px;" type="text" id="review_key" value="<?php echo $page_row['review_key'];?>" /></td>
        </tr>
        <tr>
          <td align="right"><strong>Colour 1</strong></td>
          <td><select name="colour_1" id = "colour_1" style="color:#FFFFFF;background-color:#<?php echo $page_row['colour_1'];?>">
              <?php
	if(strstr($page_row['dimensions_f'],"x")){
		$dimensions_j = explode("x",$page_row['dimensions_j']);
		
	}else{
		$dimensions_j = array(364,466);
		
	}
    foreach($colours as $key){
		if($key[0] == $page_row['colour_1']){
			echo "<option selected style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}else{
			echo "<option style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}	
	}
	?>
            </select></td>
        </tr>
        <tr>
          <td align="right"><strong>Colour 2</strong></td>
          <td><select name="colour_2" id = "colour_2" style="color:#FFFFFF;background-color:#<?php echo $page_row['colour_2'];?>">
              <?php
    foreach($colours as $key){
		if($key[0] == $page_row['colour_2']){
			echo "<option selected style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}else{
			echo "<option style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}	
	}
	?>
            </select>
            &nbsp;(start &amp; finish buttons)</td>
        </tr>
        <tr>
          <td align="right"><strong>Colour 3</strong></td>
          <td><select name="colour_3" id = "colour_3" style="color:#FFFFFF;background-color:#<?php echo $page_row['colour_3'];?>">
              <?php
    foreach($colours as $key){
		if($key[0] == $page_row['colour_3']){
			echo "<option selected style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}else{
			echo "<option style = \"background-color:#".$key[0].";color:#FFFFFF;\" value=\"".$key[0]."\">".$key[0]."</option>";
		}	
	}
	?>
            </select>
            &nbsp;(links button)</td>
        </tr>
        <tr>
          <td align="right"><strong>Min height</strong></td>
          <td><input name="h_min" style="width:50px;" type="text" id="h_min" value="<?php echo $page_row['h_min'];?>" />
            (set to zero for no min height) </td>
        </tr>
        <tr>
          <td align="right"><strong>Max height</strong></td>
          <td><input name="h_max" style="width:50px;" type="text" id="h_max" value="<?php echo $page_row['h_max'];?>" />
            (set to zero for no max height) </td>
        </tr>
        <tr>
          <td align="right"><strong>Quiz mode</strong></td>
          <td><input name="quiz" type="checkbox" id="quiz" value="1" <?php if($page_row['quiz'] == 1){?>checked="checked"<?php }?> /></td>
        </tr>
        <tr>
          <td align="right"><strong>Report stats</strong></td>
          <td><input name="reporting" type="checkbox" id="reporting" value="1" <?php if($page_row['reporting'] == 1){?>checked="checked"<?php }?> /></td>
        </tr>
        <tr>
          <td align="right"><strong>Syndicate</strong></td>
          <td><input name="syndication_footer" type="checkbox" id="syndication_footer" value="1" <?php if($page_row['syndication_footer'] == 1){?>checked="checked"<?php }?> /></td>
        </tr>
        <tr>
          <td align="right"><strong>Progess bar?</strong></td>
          <td><input name="progress_bar" type="checkbox" id="progress_bar" value="1" <?php if($page_row['progress_bar'] == 1){?>checked="checked"<?php }?> /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="button" class="black_button" id="export_js" value="Export" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="hidden" name="id" id="id"  value="<?php echo $as_id;?>"/></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php require_once("includes/foot.php");?>
</body>
</html>