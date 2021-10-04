
function mouseenter(event) {
	var button = document.getElementById("about_developer");
	button.style.backgroundColor = "#181c25";

	document.getElementById("developerLim").style.visibility = "visible";
	document.getElementById("developerEternal").style.visibility = "visible";
}
function mouseleave(event) {
	var button = document.getElementById("about_developer");
	button.style.backgroundColor = "";

	document.getElementById("developerLim").style.visibility = "hidden";
	document.getElementById("developerEternal").style.visibility = "hidden";
}
function langmouseenter(event) {
	var button = document.getElementById("change_language");
	button.style.backgroundColor = "#181c25";

	document.getElementById("languageEnglish").style.visibility = "visible";
	document.getElementById("languageRussia").style.visibility = "visible";
}
function langmouseleave(event) {
	var button = document.getElementById("change_language");
	button.style.backgroundColor = "";

	document.getElementById("languageEnglish").style.visibility = "hidden";
	document.getElementById("languageRussia").style.visibility = "hidden";
}

function vipmouseenter(event) {
	var button = document.getElementById("vip");
	document.getElementById("soonVIP").style.visibility = "visible";
}
function vipmouseleave(event) {
	var button = document.getElementById("vip");
	document.getElementById("soonVIP").style.visibility = "hidden";
}
function laterenter(event) {
	var button = document.createElement("div");
	document.getElementById("soonVIP").style.visibility = "visible";
}
function laterleave(event) {
	var button = document.getElementById("vip");
	document.getElementById("soonVIP").style.visibility = "hidden";
}
