<?php
require_once('dbconnect.php');

$where='1';

if(isset($_GET['id']))
  $id=(int)$_GET['id'];
else if (isset($get_scenes_id))
  $id=$get_scenes_id;
else
  $id=-1;
if($id>=0) //if no id is passed, get all of them 
  $where='id='.$id;

//id gets ignored if firstId is defined
if(isset($_GET['firstId']))
  $firstId=(int)$_GET['firstId'];
else if (isset($get_scenes_firstId))
  $firstId=$get_scenes_firstId;
else
  $firstId=-1;
if($firstId>=0)
  $where='id>='.$firstId;

if(isset($_GET['lastId']))
  $lastId=(int)$_GET['lastId'];
else if (isset($get_scenes_lastId))
  $lastId=$get_scenes_lastId;
else
  $lastId=-1;
if($lastId>=0) 
  $where.=' AND id<='.$lastId;


   
$temporaryAttribute='data-use-once';
require_once('parser.php');
$query='SELECT id,content,temporary FROM scenes WHERE '.$where; 
$resource=mysql_query($query,$link);

while ($assoc=mysql_fetch_assoc($resource)){
	echo '
	<div id="div'.$assoc['id'].'" ';
	if($assoc['temporary']==true)
		echo $temporaryAttribute;
	echo '><span style="font-size: 0"></span>	
		'.tagparse($assoc['content']).'
	</div>';
}
?>