
var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('code'), {
			lineNumbers: true,
			matchBrackets: true,
			mode: 'javascript',
			theme: 'material',
			indentUnit: 4
		});
myCodeMirror.setSize("1100", "500");
