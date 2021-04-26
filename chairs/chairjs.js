window.onload = resetRate;
var emp = "emptystar.png";
var full = "fullstar.png";
var i;
var j;
var set = 0;

function resetRate(){
	if (set == 0){
		for (i=1;i<=10;i++){
			document.getElementById(i).src = emp;
		}
		document.getElementById("rating").innerHTML = "?";
		document.getElementById("ratingform").value = "0";
	}
}

function resetStar(j){
	document.getElementById(j).src = emp;
}

function changeRate(j){
	if (set == 0){
		for (i=1;i<=10;i++){
			if (i<=j){document.getElementById(i).src = full;}
			if (i>j){document.getElementById(i).src = emp;}
		}
		document.getElementById("rating").innerHTML = j;
		document.getElementById("ratingform").value = j;
	}
}

function setRate(){
	set = 1-set;
}

function editReview(){
	document.getElementById("edit").style.display = "block";
	document.getElementById("yreview").style.display = "none";
}