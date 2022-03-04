$(document).ready(function () {

    var status = ($('#object_propertie').val());
    var type_propertie = ($('#type_propertie').val());
    var financial_propertie = ($('select[name="financial_propertie"]').val());
    var isswap = ($('#isswap').val());

    if (isswap == 'yes') {
        $('div[name="text_exchange"]').show();
    } else {
        $('div[name="text_exchange"]').hide();
    }

    if (type_propertie == 'apartmant') {
        $('div[name="is_apartmant"]').show();
    } else {
        $('div[name="is_apartmant"]').hide();
    }

    if (financial_propertie == 'yes') {
        $('div[name="is_financer"]').show();
    } else {
        $('div[name="is_financer"]').hide();
    }

    if (status == 'sale') {
        $('#configs').show();
        $('div[name="sale"]').show();
        $('div[name="location"]').hide();
    } else if (status == 'location') {
        $('#configs').show();
        $('div[name="sale"]').hide();
        $('div[name="location"]').show();
    } else {
        $('#configs').hide();
        $('div[name="sale"]').hide();
        $('div[name="location"]').hide();
    }
});

$('#isswap').change(function () {
    var isswap = ($(this).val());

    if (isswap == 'yes') {
        $('div[name="text_exchange"]').show();
    } else {
        $('div[name="text_exchange"]').hide();
    }
});

$('#type_propertie').change(function () {
    var type_propertie = ($(this).val());

    if (type_propertie == 'apartmant') {
        $('div[name="is_apartmant"]').show();
    } else {
        $('div[name="is_apartmant"]').hide();
    }
});

$('select[name="financial_propertie"]').change(function () {
    var financial_propertie = ($(this).val());

    if (financial_propertie == 'yes') {
        $('div[name="is_financer"]').show();
    } else {
        $('div[name="is_financer"]').hide();
    }
});

$('#object_propertie').change(function () {
    var status = ($(this).val());

    if (status == 'sale') {
        $('#configs').show();
        $('div[name="sale"]').show();
        $('div[name="location"]').hide();
    } else if (status == 'location') {
        $('#configs').show();
        $('div[name="sale"]').hide();
        $('div[name="location"]').show();
    } else {
        $('#configs').hide();
        $('div[name="sale"]').hide();
        $('div[name="location"]').hide();
    }
});

/* CONSULTA CEP */
$("#code_postal").change(function () {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#address").val("...");
            $("#district").val("...");
            $("#city").val("...");
            $("#uf").val("...");
            $("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#address").val(dados.logradouro);
                    $("#district").val(dados.bairro);
                    $("#city").val(dados.localidade);
                    $("#uf").val(dados.uf);
                    $("#ibge").val(dados.ibge);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
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
});