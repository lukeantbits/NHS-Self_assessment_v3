<?php $pg = 2;?>
<?php require_once("includes/dbconnect.php");?>
<?php require_once("includes/session.php");?>
<?php require_once("includes/shared.php");?>
<?php require_once("includes/head.php");?>
<body>
<div id="main">
  <?php require_once("includes/nav_1.php");?>
  <form enctype="multipart/form-data" id="main_form">
    <div id="page">
      <table border="0" class="form_table">
        <tr>
          <td align="right" style="width:200px;" valign="top"><strong>Title</strong></td>
          <td><input type="text" style="width:300px;" name="intro_title" id="intro_title" value="<?php echo $page_row['intro_title'];?>" /></td>
          <td rowspan="9" valign="top" style="padding:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Splash image (flash)</strong><br />
            <br />
            <img <?php if(strlen($page_row['intro_graphic'])<3 || strpos($page_row['intro_graphic'],".swf")){?>style="visibility:hidden;"<?php }?> src = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['intro_graphic'];?>" name="splash_img" id = "splash_img">
            <div id = "splash_flash" <?php if(strpos($page_row['intro_graphic'],".swf") == false){?>style="visibility:hidden;"<?php }?>> </div>
            <input name="intro_graphic" type="hidden" id="intro_graphic" value="<?php echo $page_row['intro_graphic'];?>" />
            <div id="file-uploader"> </div></td>
                <td><strong>Splash image (JS)</strong><br />
            <br />
            <img <?php if(strlen($page_row['intro_graphic_alt'])<3 || strpos($page_row['intro_graphic_alt'],".swf")){?>style="visibility:hidden;"<?php }?> src = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['intro_graphic_alt'];?>" name="splash_alt_img" id = "splash_alt_img">
            <div id = "splash_alt_flash" <?php if(strpos($page_row['intro_graphic_alt'],".swf") == false){?>style="visibility:hidden;"<?php }?>> </div>
            <input name="intro_graphic_alt" type="hidden" id="intro_graphic_alt" value="<?php echo $page_row['intro_graphic_alt'];?>" />
            <div id="file-uploader_alt"> </div></td>
              </tr>
            </table>
            
            
            <strong>Splash image (JS mobile)</strong><br />
            <br />
            <img <?php if(strlen($page_row['hr_intro_graphic_alt'])<3 || strpos($page_row['hr_intro_graphic_alt'],".swf")){?>style="visibility:hidden;"<?php }?> src = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['hr_intro_graphic_alt'];?>" name="hr_splash_alt_img" id = "hr_splash_alt_img">
            <div id = "hr_splash_alt_flash" <?php if(strpos($page_row['hr_intro_graphic_alt'],".swf") == false){?>style="visibility:hidden;"<?php }?>> </div>
            <input name="hr_intro_graphic_alt" type="hidden" id="hr_intro_graphic_alt" value="<?php echo $page_row['hr_intro_graphic_alt'];?>" />
            <div id="hr_file-uploader_alt"> </div></td>
        </tr>
        <tr>
          <td align="right" style="width:200px;" valign="top"><strong>Image alt tag&nbsp;</strong></td>
          <td><input type="text" style="width:300px;" name="img_alt" id="img_alt" value="<?php echo $page_row['img_alt'];?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Image placement</strong></td>
          <td valign="top"><select name="intro_graphic_position" id="intro_graphic_position">
              <option value="1" <?php if($page_row['intro_graphic_position'] == 1){?>selected = "selected"<?php }?>>top left</option>
              <option value="2" <?php if($page_row['intro_graphic_position'] == 2){?>selected = "selected"<?php }?>>top center</option>
              <option value="3" <?php if($page_row['intro_graphic_position'] == 3){?>selected = "selected"<?php }?>>top right</option>
              <option value="4" <?php if($page_row['intro_graphic_position'] == 4){?>selected = "selected"<?php }?>>bottom left</option>
              <option value="5" <?php if($page_row['intro_graphic_position'] == 5){?>selected = "selected"<?php }?>>bottom center</option>
              <option value="6" <?php if($page_row['intro_graphic_position'] == 6){?>selected = "selected"<?php }?>>bottom right</option>
               <option value="7" <?php if($page_row['intro_graphic_position'] == 7){?>selected = "selected"<?php }?>>do not display</option>
            </select></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Image placement mobile</strong></td>
          <td valign="top"><select name="intro_graphic_position_m" id="intro_graphic_position_m">
              <option value="1" <?php if($page_row['intro_graphic_position_m'] == 1){?>selected = "selected"<?php }?>>top left</option>
              <option value="2" <?php if($page_row['intro_graphic_position_m'] == 2){?>selected = "selected"<?php }?>>top center</option>
              <option value="3" <?php if($page_row['intro_graphic_position_m'] == 3){?>selected = "selected"<?php }?>>top right</option>
              <option value="4" <?php if($page_row['intro_graphic_position_m'] == 4){?>selected = "selected"<?php }?>>bottom left</option>
              <option value="5" <?php if($page_row['intro_graphic_position_m'] == 5){?>selected = "selected"<?php }?>>bottom center</option>
              <option value="6" <?php if($page_row['intro_graphic_position_m'] == 6){?>selected = "selected"<?php }?>>bottom right</option>
              <option value="7" <?php if($page_row['intro_graphic_position_m'] == 7){?>selected = "selected"<?php }?>>do not display</option>
            </select></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Flash Body</strong></td>
          <td valign="top" style="width:300px;"><div class="nic_bg" style="width:300px;">
              <textarea name="intro_copy" id="intro_copy" style = "width:300px;height:300px;"><?php echo $page_row['intro_copy'];?></textarea>
            </div></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>JS Body</strong></td>
          <td valign="top" style="width:300px;"><div class="nic_bg" style="width:300px;">
              <textarea name="intro_copy_alt" id="intro_copy_alt" style = "width:300px;height:300px;"><?php echo $page_row['intro_copy_alt'];?></textarea>
            </div></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>JS Body width</strong></td>
          <td valign="top" style="width:300px;"><input type="text" style="width:300px;" name="js_body_w" id="js_body_w" value="<?php echo $page_row['js_body_w'];?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>JS top offset</strong></td>
          <td valign="top" style="width:300px;"><input type="text" style="width:300px;" name="js_body_top" id="js_body_top" value="<?php echo $page_row['js_body_top'];?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>JS left offset</strong></td>
          <td valign="top" style="width:300px;"><input type="text" style="width:300px;" name="js_body_left" id="js_body_left" value="<?php echo $page_row['js_body_left'];?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Footnote</strong></td>
          <td style="width:300px;"><div class="nic_bg" style="width:300px;">
              <textarea name="intro_foot" id="intro_foot" style = "width:300px;height:50px;"><?php echo $page_row['intro_foot'];?></textarea>
            </div></td>
        </tr>
      </table>
    </div>
  </form>
</div>
<?php require_once("includes/foot.php");?>
<script language="javascript">
<?php if(strpos($page_row['intro_graphic'],".swf") != false){?>
	var swf_path = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['intro_graphic'];?>"
<?php }else{
	echo "var swf_path = null;";
}?>
</script>
</body>
</html>