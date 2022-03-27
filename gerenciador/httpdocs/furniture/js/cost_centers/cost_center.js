$(document).ready(function () {

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