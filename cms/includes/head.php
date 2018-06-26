<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" debug="true">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Self Assessment CMS</title>

<?php
$handle = openDir("js");
while($fname = readdir($handle)) {
	if(substr($fname, 0, 1) != "."){
		echo "<script src=\"js/".$fname."\"></script>
";
	}
}
?>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="fancyapps/source/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="fancyapps/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="fancyapps/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script language="javascript">
<?php
echo $head_str;
?>
</script>
</head>