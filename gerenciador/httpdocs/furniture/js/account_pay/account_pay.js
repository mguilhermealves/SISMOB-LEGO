$(document).ready(function () {

    $('body').keypress(function(event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

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
            $("#account_pay_cost_center_id").val(sugestion.data.idx);
            $("#center_count_name").html(sugestion.data.name);
        }
    });

    $(".company_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["companies_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 3,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            console.log(sugestion.data);
            $("#companies_id").val(sugestion.data.idx);
            $("#company_name").html(sugestion.data.name);
        }
    });

});