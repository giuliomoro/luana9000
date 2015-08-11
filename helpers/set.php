<?php
$table="scenes";

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'dbconnect.php');
if ($value=$_GET['value'])
	$query="UPDATE $table SET value='$value' WHERE id=1";
elseif ($active=$_GET['active'])
	$query="UPDATE $table SET active='$active' WHERE id=1";

if (!mysql_query($query, $link))
	die("<br>errore nell'esecuzione della query".mysql_error());
elseif (!mysql_affected_rows())
	echo("<br>nessuna riga &egrave; stata modificata");
else echo "<br>operazione eseguita correttamente";

$query="SELECT * FROM $table WHERE id=1";
$resource=mysql_query($query,$link);
echo "<pre>";
var_dump(mysql_fetch_row($resource));
echo "</pre>";
mysql_close($link);
?>