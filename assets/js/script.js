var typed = new Typed('.typed', {
  strings: ["simple","rapide", " sécurisée"],
  typeSpeed: 50,
});
function updateDateTime() {
  var now = new Date();
  var date = now.toLocaleDateString();
  var time = now.toLocaleTimeString();
  document.getElementById("dateTime").innerHTML = date + ' ' + time;
}

setInterval(updateDateTime, 1000);
