function openLeftNav() {
	document.getElementById("osLeftBar").style.width = "250px";
	document.getElementById("page").style.marginLeft = "250px";
	// document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function openRightNav() {
	document.getElementById("osRightBar").style.width = "250px";
	document.getElementById("page").style.marginRight = "250px";
	// document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeLeftNav() {
	document.getElementById("osLeftBar").style.width = "0";
	document.getElementById("page").style.marginLeft= "0";
	// document.body.style.backgroundColor = "white";
}

function closeRightNav() {
	document.getElementById("osRightBar").style.width = "0";
	document.getElementById("page").style.marginRight= "0";
	// document.body.style.backgroundColor = "white";
}