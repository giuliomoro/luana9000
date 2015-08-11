<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.inc.php');
$link = mysql_connect($dbhost, $dbuser, $dbpassword);
if (!$link) die('Could not connect: ' . mysql_error());
if (!mysql_select_db($dbname)) die('Could not connect: ' . mysql_error());
?>