
function Rabbits(id_channel) {
	copy(id_channel);
}

function copy(str) {
	let tmp = document.createElement('INPUT'),
	focus = document.activeElement;

	tmp.value = str;

	document.body.appendChild(tmp);
	tmp.select();
	document.execCommand('copy');
	document.body.removeChild(tmp);
	focus.focus();
}
