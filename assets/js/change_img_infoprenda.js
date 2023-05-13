/* Cambio de imagenes del info prenda */
function img(anything) {
  document.querySelector('.slide').src = anything;
}

function change(change) {
  const line = document.querySelector('.home');
  line.style.background = change;
}