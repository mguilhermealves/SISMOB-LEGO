$(document).ready(function () {

    $('body').keypress(function(event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

    $('.cnpj').mask("99.999.999/9999-99");
});