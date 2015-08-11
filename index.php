<html>
<head>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'dbconnect.php');?>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/align.js"></script>
<link rel="stylesheet" href="css/default.css?md5=<?php echo md5('css/default.css')?>" type="text/css" />
<link rel="stylesheet" href="css/cycler.css" type="text/css" />
<link rel="stylesheet" href="css/retrieveClasses.css.php?md5=<?php echo md5('css/retrieveClasses.css.php');?>" type="text/css" />
<link rel="stylesheet" href="css/otg.css?md5=<?php echo md5('css/otg.css');?>" type="text/css" />
<body>
<div id="cycler">
<noscript>
<div style="color: black; background: white; font-size: 40px">Devi attivare Javascript per visualizzare correttamente questa pagina.</div>
</noscript>
<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'parser.php');
$query="SELECT id,content FROM scenes WHERE 1";
$resource=mysql_query($query,$link);
while ($assoc=mysql_fetch_assoc($resource)){
	echo '
	<div id="div'.$assoc['id'].'"><span style="font-size: 0"></span>	
		'.tagparse($assoc['content']).'
	</div>';
}
?>
</div>
<div id="refreshData"></div>
<div id="debug"></div>
<script language="JavaScript">
$.support.cors = true;
var activeDiv=0;
var previousDiv;
var previousDivObj;
var activeDivObj;
var fadeTime=0;
var intervalHandle;
var updateMyContentInterval=200; //milliseconds
var ajaxLongPollingTimeout=20000; //milliseconds
var previousDivClass="";
var timestamp=0;
function updateMyContent(){
		// alert("firs here "+timestamp)
		// $('#refreshData').load("helpers/update.php?timestamp="+timestamp,function(){
			$.ajax({
				url: "helpers/update.php?timestamp="+timestamp,
				dataType: "text",
				timeout: ajaxLongPollingTimeout
			})
			.fail(function( jqxhr, settings, exception ){ //requires jQuery>=1.5
				//if it fails, just keep going. Prudentially set timestamp to 0, so to force reload activeDiv
				timestamp=0;
				setTimeout("updateMyContent();", updateMyContentInterval);
			})
			.done(function(str) {
				$.globalEval(str);
				// alert("gotscriptupdate.js.php"+
						// "\ntimestamp: "+timestamp+
						// "\nactiveDiv: "+activeDiv+
						// "\nfadeTime: "+fadeTime+
						// "\nactiveDivClass: "+activeDivClass);
				//TODO: destroy previousDiv
				if (previousDiv==activeDiv) { //we barely care about this case, when 
					// document.getElementById("debug").innerHTML+=("return "+activeDiv+" "+previousDiv+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); 
					intervalHandle=setTimeout("updateMyContent();", updateMyContentInterval );
					return;
				}
				activeDivObj=$('#div'+activeDiv);
				activeDivObj.addClass(activeDivClass);
				activeDivObj.css({'z-index':2, "display":"block"});
				// verticalCenter(activeDivObj);
				if (previousDivObj!==undefined){ 
					// alert ("changing");
					//Should multiple updates happen in the server, only the latest will be considered.
					previousDivObj.fadeOut(fadeTime,function(){
						previousDivObj.css({"z-index":1, "display":"none"});
						// alert(" "+previousDivClass);
						previousDivObj.removeClass(previousDivClass);
						activeDivObj.css({'z-index':3, "display":"block"});
						previousDivObj=activeDivObj;
						previousDivClass=activeDivClass;
						previousDiv=activeDiv;
						intervalHandle=setTimeout("updateMyContent();", updateMyContentInterval );
					});
				}
				else{ //first call ! 
					previousDiv=activeDiv;
					previousDivObj=activeDivObj;
					previousDivClass=activeDivClass;
					activeDivObj.css({'z-index':3, "display":"block"});
					intervalHandle=setTimeout("updateMyContent();", updateMyContentInterval );
				}
			})
		// });
	}
setTimeout("updateMyContent();", 200);
</script>


</body>
</html>