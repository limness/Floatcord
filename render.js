const remote = require('electron').remote;
const main = remote.require('./index.js');

var button = document.getElementById('buttonchik');
button.textContent = 'OpenWindow';

button,addEventListener("click", () => {
  var window = remote.getCurrentWindow();
  main.openWindow('indexGet');
  window.close();
}, false)
