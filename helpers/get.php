<?php
require_once(__DIR__.DIRECTORY_SEPARATOR.'dbconnect.php');
$table="requests";

$query='SELECT requests.id, scene_id, fadetime, class
FROM requests
LEFT JOIN classes ON requests.class_id = classes.id
ORDER BY requests.id DESC 
LIMIT 1';
$resource=mysql_query($query,$link);
$assoc=mysql_fetch_assoc($resource);
// echo "<pre>";var_dump($assoc);echo "</pre>"; //warning: this is gonna break update.php . Use only when debugging and loading directly get.php
$scene_id=$assoc['scene_id'];
$fadetime=$assoc['fadetime'];
$class=$assoc['class'];
mysql_close($link);
?>