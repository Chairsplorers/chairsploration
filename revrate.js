var setr = {};

function fid(cid,rev){
	return "r"+cid+":"+rev;
}

function revAddSet(cid,rev,k){
	setr[fid(cid,rev)]=k;
}

function revToggleSet(cid,rev){
	var ajaxRequest;
	ajaxRequest = new XMLHttpRequest();

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			setr[fid(cid,rev)] = 1-setr[fid(cid,rev)];
			
			if(setr[fid(cid,rev)]==0){
				document.getElementById(fid(cid,rev)).innerHTML = "Mark as helpful";
			}
			else{
				document.getElementById(fid(cid,rev)).innerHTML = "Unmark as helpful";
			}			
		}
	}
	
	var remove = setr[fid(cid,rev)];
	
	var queryString = "?cid=" + cid + "&rev=" + rev + "&remove="+remove+"&unhelpful="+setr[fid(cid,rev)];
	ajaxRequest.open("GET", "revrate.php" + queryString, true);
	ajaxRequest.send(null);
}