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
                $(".spinner-border").show();
            },
            success: function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            },
            complete: function () {
                $('.spinner-border').hide();
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
                $(".spinner-border").show();
            },
            success: function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            },
            complete: function () {
                $('.spinner-border').hide();
            }
        });
    });
});
