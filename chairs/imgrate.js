var emph = "empheart.png";
var fullh = "fullheart.png";
var seth = {};

function HdispHeart(cid,imgid){
	document.getElementById(fid(cid,imgid)).style.visibility = "visible";
}

function HhideHeart(cid,imgid){
	if (seth[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).style.visibility = "hidden";
	}
}

function fid(cid,imgid){
	return "c"+cid+"i"+imgid;
}

function HaddSet(cid,imgid,k){
	seth[fid(cid,imgid)]=k;
}

function HresetRate(cid,imgid){
	if (seth[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).src = emph;
	}
}

function HchangeRate(cid,imgid){
	if (seth[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).src = fullh;
	}
}

function HtoggleSet(cid,imgid){
	var ajaxRequest;
	ajaxRequest = new XMLHttpRequest();

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responsethext;
		}
	}
	
	var remove = seth[fid(cid,imgid)];
	
	var queryString = "?cid=" + cid + "&imgid=" + imgid + "&remove="+remove;
	ajaxRequest.open("GET", "imgrate.php" + queryString, true);
	ajaxRequest.send(null);
	
	seth[fid(cid,imgid)] = 1-seth[fid(cid,imgid)];
}

function Htest(){
	alert("Mouse over.");
}