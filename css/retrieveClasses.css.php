/*beginning of classes retrieved from themes table in database*/
<?php $query="SELECT * FROM classes WHERE 1";
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'dbconnect.php');
$resource=mysql_query($query,$link);
while($row=mysql_fetch_assoc($resource)){
	$keys=array_keys($row);
	echo '
	.'.$row['class'].'{
		';

	for($i=2;$i<count($row);$i++){
		if ($row[$keys[$i]]){
			echo $keys[$i].' : '.$row[$keys[$i]].' !important;
		';
		}
	}
	echo '}';
}
?>

/*ending of classes retrieved from themes table in database*/