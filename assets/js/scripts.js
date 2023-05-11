/* Script Promociones */
document.querySelectorAll('.clonar-span').forEach(function (e) {
  var selector = e.querySelector('span');
  for (i = 1; i <= 7; ++i) {
    var clon = selector.cloneNode(true);
    selector.after(clon);
  }
})

/* Cambio de imagenes del info prenda */
function img(anything) {
  document.querySelector('.slide').src = anything;
}

function change(change) {
  const line = document.querySelector('.home');
  line.style.background = change;
}