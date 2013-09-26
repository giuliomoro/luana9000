<?php
function tagparse($text){
	$subs=array('title','cit','author','autdesc','source');
	foreach($subs as $sub){
		$text=str_ireplace('['.$sub.']','<span class="'.$sub.'">',$text);
		$text=str_ireplace('[/'.$sub.']','</span>',$text);
	}
	return($text);
}
?>