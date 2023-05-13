/* Carrusel */
$(document).ready(function () {
    // Inicializar el carrusel
    $('#carouselExample').carousel({
        interval: 6000
    });

    // Manejar el evento click de los indicadores
    $('.carousel-indicators li').click(function () {
        var slideTo = $(this).attr('data-slide-to');
        $('#carouselExample').carousel(parseInt(slideTo));
    });
});

// Manejar el evento de inicio de transición
$('#carouselExample').on('slide.bs.carousel', function (event) {
    var $currentSlide = $(event.relatedTarget);
    $currentSlide.css('opacity', 0);
    $currentSlide.addClass('animate__animated animate__fadeIn');
});

// Manejar el evento de fin de transición
$('#carouselExample').on('slid.bs.carousel', function (event) {
    var $currentSlide = $(event.relatedTarget);
    $currentSlide.removeClass('animate__animated animate__fadeIn');
    $currentSlide.css('opacity', 1);
});

// Manejar el evento click del botón de "Anterior"
$('.carousel-control-prev').click(function () {
    $('#carouselExample').carousel('prev');
});

// Manejar el evento click del botón de "Siguiente"
$('.carousel-control-next').click(function () {
    $('#carouselExample').carousel('next');
});