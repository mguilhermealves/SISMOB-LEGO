$(document).ready(function () {

    $('.money').mask("#.##0,00", {
        reverse: true
    });

    $("#cancel_billet").on("click", function () {
        var idPayment = $(this).data("payment");

        $.ajax({
            method: "POST",
            url: '/cancel_billet',
            data: {
                idPayment: idPayment
            },
            beforeSend: function () {

            },
            success: function (data) {
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            }
        });
    });

    $("#send_billet").on("click", function () {
        var idPayment = $(this).data("payment");

        $.ajax({
            method: "POST",
            url: '/send_billet',
            data: {
                idPayment: idPayment
            },
            beforeSend: function () {
                
            },
            success: function (data) {
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            }
        });
    });
});
