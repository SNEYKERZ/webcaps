// Obtener los elementos del DOM
const tabLogin = document.getElementById('tab-login');
const tabRegister = document.getElementById('tab-register');
const loginForm = document.getElementById('pills-login');
const registerForm = document.getElementById('pills-register');

// JQuery
$(document).ready(function () {
    $('#tab-login').click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#tab-register').removeClass('active');
        $('#pills-login').addClass('show active');
        $('#pills-register').removeClass('show active');

        // Remover la clase form-control-valid en el formulario de registro
        $('#pills-register .form-control').removeClass('form-control-valid').val('');;
    });

    $('#tab-register').click(function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#tab-login').removeClass('active');
        $('#pills-register').addClass('show active');
        $('#pills-login').removeClass('show active');

        // Remover la clase form-control-valid en el formulario de login
        $('#pills-login .form-control').removeClass('form-control-valid').val('');;
    });

    // Agregar clase form-control-valid cuando los inputs sean válidos
    $('#pills-login .form-control').on('input', function () {
        if (this.checkValidity()) {
            $(this).addClass('form-control-valid');
        } else {
            $(this).removeClass('form-control-valid');
        }
    });

    $('#pills-register .form-control').on('input', function () {
        if (this.checkValidity()) {
            $(this).addClass('form-control-valid');
        } else {
            $(this).removeClass('form-control-valid');
        }
    });
});