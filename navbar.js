window.onload = loadNavbar;

function loadNavbar(){
	var ajaxRequest;
	ajaxRequest = new XMLHttpRequest();
	
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('navbar');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	ajaxRequest.open("GET","navbar.php",true);
	ajaxRequest.send(null);
}