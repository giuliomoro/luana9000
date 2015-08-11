<html>
<head>
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
  // $get_scenes_firstId=1000;
  // $get_scenes_lastId=1006;
  require_once('helpers/get-scenes.php');
?>
</div>
<div id="refreshData"></div>
<div id="debug"></div>
<script language="JavaScript">
$.support.cors = true;
var temporaryAttribute='data-use-once';
var activeDiv=0;
var previousDiv;
var previousDivObj=$("#the-non-existing-object");
var activeDivObj;
var fadeTime=0;
var intervalHandle;
var updateMyContentInterval=200; //milliseconds
var ajaxLongPollingTimeout=20000; //milliseconds
var previousDivClass="";
var timestamp=0;
function updateMyContent(){
		// $('#refreshData').load("helpers/update.php?timestamp="+timestamp,function(){
			$.ajax({
				url: "helpers/update.php?timestamp="+timestamp,
				dataType: "text",
				timeout: ajaxLongPollingTimeout
			})
			.fail(function( jqxhr, settings, exception ){ //requires jQuery>=1.5
				//if it fails, just keep going. 
				setTimeout("updateMyContent();", updateMyContentInterval);
			})
			.done(function(str) {
				$.globalEval(str); //this will set the timestamp, activeDiv, fadeTime, activeDivClass variables
				if (previousDiv==activeDiv) { //this should never happen when long polling is being used
					// document.getElementById("debug").innerHTML+=("return "+activeDiv+" "+previousDiv+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"); 
					intervalHandle=setTimeout("updateMyContent();", updateMyContentInterval ); //but if it happens, do nothing and just reset the timeout
					return;
				}
				if(previousDivObj.is("["+temporaryAttribute+"]")){ //if the div is to be used only once, remove it after use
					previousDivObj.remove();
				}
				activeDivObj=$('#div'+activeDiv);
        if(activeDivObj.length===0){ //either the div does not exist, or it has already been removed or it has not been loaded yet
          $.get("helpers/get-scenes.php?id="+activeDiv,function(data){  //either way, try to load it again
            activeDivObj=$('#div'+activeDiv); //check again, so to make sure you do not add two elements with the same id
            if(activeDivObj.length===0){
              $("#cycler").append(data);
              activeDivObj=$('#div'+activeDiv); 
              showActiveDiv(); //leaving showActiveDiv() unconditional means that in case the element was not loaded (e.g.: server busy or id does not exist in the db),
                              //the browser will fade out the currently displayed div and go back to display an empty screen.
              return;
            }
            //if you get here, probably something strange happened. Anyhow, retrigger the update!
            intervalHandle=setTimeout(updateMyContent, updateMyContentInterval);
            return;
          });
        }
        showActiveDiv();
			});
		// });
	}
setTimeout(updateMyContent, 200);

function showActiveDiv(){
  activeDivObj.addClass(activeDivClass);
  activeDivObj.css({'z-index':2, "display":"block"});
  // verticalCenter(activeDivObj);
  //Should multiple updates happen in the server, only the latest will be considered.
  if(previousDivObj.length!=0)
    previousDivObj.fadeOut(fadeTime, fadeOutCallback);
  else
    fadeOutCallback();
}
function fadeOutCallback(){
	previousDivObj.css({"z-index":1, "display":"none"});
	previousDivObj.removeClass(previousDivClass);
	activeDivObj.css({'z-index':3, "display":"block"});
	previousDivObj=activeDivObj;
	previousDivClass=activeDivClass;
	previousDiv=activeDiv;
	intervalHandle=setTimeout(updateMyContent, updateMyContentInterval+fadeTime );//start the timeout after the fade ends.
}
</script>


</body>
</html>