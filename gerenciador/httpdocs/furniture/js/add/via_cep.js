function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
    $("#ibge").val("");
}

$('.cep-mask').inputmask("99999-999");

/* CONSULTA CEP */


function get_cep(field){

    //Pegando o nome do formulário que está sendo usando pelo usuário no momento
    var form = '#'+ $(field).closest('form').attr('id')
    //Nova variável "cep" somente com dígitos.
    var cep = $(field).val().replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
    
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            var courseAddress = form+" #courseAddress";
            var courseDistrict = form +" #courseDistrict";
            var courseCity = form +" #courseCity";
            var courseState = form +" #courseState";

            //Preenche os campos com "..." enquanto consulta webservice.
            $(courseAddress).val("...");
            $(courseDistrict).val("...");
            $(courseCity).val("...");
            $(courseState).val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                console.log()
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $(courseAddress).val(dados.logradouro);
                    $(courseDistrict).val(dados.bairro);
                    $(courseCity).val(dados.localidade);
                    $(courseState).val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    $('#modal_cep').modal({ backdrop: 'static', keyboard: false });
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}


$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra").find( "#courseCEP") ).bind("blur",function(){
    return get_cep( $(this) ); 
});