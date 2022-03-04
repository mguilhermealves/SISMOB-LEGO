$('input[name="phone"]').inputmask("(99)9999-9999");
$('input[name="address_zip_code"]').inputmask("99999-999");
$('input[name="cpf"]').inputmask("999.999.999-99");

$("#btntk_pwd").bind("click", function(){
    copyToClipboard( $("#tk_pwd") );
});
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    $temp.remove();
	alert("Link Copiado")
}