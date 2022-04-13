$(document).ready(function () {

    $('body').keypress(function(event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

    $(".categories_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["account_pay_categories_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 3,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            $("#cod_category").val(sugestion.data.idx);
            $("#categorie_name").html(sugestion.data.name);
        }
    });
});