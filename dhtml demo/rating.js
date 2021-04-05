window.onload = resetRate;
var emp = "emptystar.png";
var full = "fullstar.png";
var i;
var j;

function resetRate(){
	for (i=1;i<=10;i++){
		document.getElementById(i).src = emp;
	}
}

function changeRate(j){
	for (i=1;i<=j;i++){
		document.getElementById(i).src = full;
	}
}