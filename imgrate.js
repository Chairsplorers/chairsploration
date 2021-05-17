var emp = "empheart.png";
var full = "fullheart.png";
var i;
var j;
var set = {};

function dispHeart(cid,imgid){
	document.getElementById(fid(cid,imgid)).style.visibility = "visible";
}

function hideHeart(cid,imgid){
	if (set[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).style.visibility = "hidden";
	}
}

function fid(cid,imgid){
	return "c"+cid+"i"+imgid;
}

function addSet(cid,imgid,k){
	set[fid(cid,imgid)]=k;
}

function resetRate(cid,imgid){
	if (set[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).src = emp;
	}
}

function changeRate(cid,imgid){
	if (set[fid(cid,imgid)] == 0){
		document.getElementById(fid(cid,imgid)).src = full;
	}
}

function toggleSet(cid,imgid){
	var ajaxRequest;
	ajaxRequest = new XMLHttpRequest();

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	var remove = set[fid(cid,imgid)];
	
	var queryString = "?cid=" + cid + "&imgid=" + imgid + "&remove="+remove;
	ajaxRequest.open("GET", "imgrate.php" + queryString, true);
	ajaxRequest.send(null);
	
	set[fid(cid,imgid)] = 1-set[fid(cid,imgid)];
}

function test(){
	alert("Mouse over.");
}