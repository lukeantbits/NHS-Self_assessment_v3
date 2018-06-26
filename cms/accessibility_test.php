<?php
$pg = 0;
$as_id = 79;
require_once("includes/dbconnect.php");
require_once("includes/accessibility.php");
require_once("includes/session.php");
require_once("includes/pclzip.lib.php");
openDb();
echo renderAccessible($as_id);
	