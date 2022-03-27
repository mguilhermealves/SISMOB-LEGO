$(document).ready(function () {

    $('.money').mask("#.##0,00", {
        reverse: true
    });

    $(".center_count_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["account_pay_cost_centers_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 1,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            $("#cod_center_count").val(sugestion.data.idx);
            $("#center_count_name").html(sugestion.data.name);
        }
    });

});