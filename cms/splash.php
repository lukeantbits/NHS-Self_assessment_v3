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
          <td><input type="text" style="width:500px;" name="intro_title" id="intro_title" value="<?php echo $page_row['intro_title'];?>" /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><span style="padding:10px;"><strong>Splash image</strong></span></td>
          <td valign="top"><img <?php if(strlen($page_row['intro_graphic'])<3 || strpos($page_row['intro_graphic'],".swf")){?>style="visibility:hidden;"<?php }?> src = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['intro_graphic'];?>" name="splash_img" id = "splash_img" />
            <div id = "splash_flash" <?php if(strpos($page_row['intro_graphic'],".swf") == false){?>style="visibility:hidden;"<?php }?>> </div>
            <input name="intro_graphic" type="hidden" id="intro_graphic" value="<?php echo $page_row['intro_graphic'];?>" />
            <div id="file-uploader"> </div></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Body</strong></td>
          <td valign="top" ><div class="nic_bg" style="width:500px;">
              <textarea name="intro_copy" id="intro_copy" style = "width:500px;height:300px;"><?php echo $page_row['intro_copy'];?></textarea>
            </div></td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Info title</strong></td>
          <td >
              <input type="text"  name="intro_foot_title" id="intro_foot_title" style = "width:500px;" value = "<?php echo $page_row['intro_foot_title'];?>">
            </td>
        </tr>
        <tr>
          <td align="right" valign="top"><strong>Info</strong></td>
          <td ><div class="nic_bg" style="width:500px;">
              <textarea name="intro_foot" id="intro_foot" style = "width:500px;height:300px;"><?php echo $page_row['intro_foot'];?></textarea>
            </div></td>
        </tr>
      </table>
    </div>
  </form>
</div>
<?php require_once("includes/foot.php");?>
<script language="javascript" type="text/javascript">
<?php if(strpos($page_row['intro_graphic'],".swf") != false){?>
	var swf_path = "archive/as_<?php echo $as_id;?>/<?php echo $page_row['intro_graphic'];?>"
<?php }else{
	echo "var swf_path = null;";
}?>
</script>
</body>
</html>