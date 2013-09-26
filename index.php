<html>
<head>
<?php require_once(__DIR__.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'dbconnect.php');?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/default.css" type="text/css" />
<link rel="stylesheet" href="css/cycler.css" type="text/css" />
<link rel="stylesheet" href="css/retrieveClasses.css.php" type="text/css" />
<body>
<div id="cycler"><?php
require_once(__DIR__.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'parser.php');
$query="SELECT id,content FROM scenes WHERE 1";
$resource=mysql_query($query,$link);
while ($assoc=mysql_fetch_assoc($resource)){
	echo '
	<div id="div'.$assoc['id'].'">
		'.tagparse($assoc['content']).'
	</div>';
}
?>
</div>
<div id="refreshData"></div>
<div id="debug"></div>
<script language="JavaScript">
var activeDiv=0;
var previousDiv;
var previousDivObj;
var activeDivObj;
var fadeTime=0;
var interval=150;
var intervalHandle;
var previousDivClass="";
function updateMyContent(){
		$('#refreshData').load("helpers/update.php",function(){
			// alert("loaded update.php");
			$.getScript("js/update.js.php",function(){
				// alert("gotscriptupdate.js.php");
				if (previousDiv==activeDiv) {
					// document.getElementById("debug").innerHTML+=("return "+activeDiv+" "+previousDiv+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); 
					intervalHandle=setTimeout("updateMyContent();", interval );
					return;
				}
				activeDivObj=$('#div'+activeDiv);
				activeDivObj.addClass(activeDivClass);
				activeDivObj.css({'z-index':2, "display":"block"});
				if (previousDivObj!=undefined){
					// alert ("changing");
					//Should multiple updates happen in the database while stopped, only the latest one will be considered.
					previousDivObj.fadeOut(fadeTime,function(){
						previousDivObj.css({"z-index":1, "display":"none"});
						// alert(" "+previousDivClass);
						previousDivObj.removeClass(previousDivClass);
						activeDivObj.css({'z-index':3, "display":"block"});
						previousDivObj=activeDivObj;
						previousDivClass=activeDivClass;
						previousDiv=activeDiv;
						intervalHandle=setTimeout("updateMyContent();", interval );
					});
				}
				else{
					previousDiv=activeDiv;
					previousDivObj=activeDivObj;
					previousDivClass=activeDivClass;
					activeDivObj.css({'z-index':3, "display":"block"});
					intervalHandle=setTimeout("updateMyContent();", interval );
				}
			}
			)
		});
	}
setTimeout("updateMyContent();", 0);
</script>


</body>
</html>