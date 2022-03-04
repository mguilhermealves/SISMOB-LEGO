
$("select[id='type']").bind("change", function(){
    $("#text_container").hide();
    $("#zip_container").hide();
    $("#link_container").hide();
    $("#" + $("option:selected",this).val() + "_container").show();
})
$("select[id='type']").change();

