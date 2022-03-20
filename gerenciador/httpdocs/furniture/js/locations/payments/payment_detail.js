$(document).ready(function () {

    $('.money').mask("#.##0,00", {
        reverse: true
    });
});

$("#cancel_billet").on("click", function() {
    var idPayment = $(this).data("payment");
    var idDetail = $(this).data("detail");

    $.ajax({
        method: "POST",
        url: '/cancel_billet',
        data: {
            idPayment: idPayment,
            idDetail: idDetail
        },
        beforeSend: function() {

        },
        success: function(data) {
            setTimeout(function() {
                window.location.reload();
            }, 1500);
        }
    });
});
