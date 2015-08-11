window.onresize=function(){verticalCenter(activeDivObj)};
function verticalCenter(aDivObject){
	var height=aDivObject.css("height");
	var paddingTop=aDivObject.css("padding-top");
	var paddingBottom=aDivObject.css("padding-bottom");
	height=height.replace("px","");
	paddingBottom=paddingBottom.replace("px","");
	paddingTop=paddingTop.replace("px","");
	var clientHeight=document.documentElement.clientHeight;
	var newPaddingTop=(0.90*clientHeight-height-paddingBottom-paddingTop)/2+"px";
	aDivObject[0].style.setProperty("padding-top",newPaddingTop );
	// alert(paddingTop+" "+paddingBottom+" "+newPaddingTop);
	return 1;
}