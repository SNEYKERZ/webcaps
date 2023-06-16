/* Cambio de imagenes del info prenda */
function img(anything) {
  document.querySelector('.slide').src = anything;
}

function change(change) {
  const homeElement = document.querySelector('.home');
  homeElement.style.background = change;
}
