$(document).ready(function () {

    $('body').keypress(function (event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

    $('.money').mask("#.##0,00", {
        reverse: true
    });

    $('.percent').mask('#.##0,00', {
        reverse: true
    });

    $('.document').mask("999.999.999-99");
    $('.phone').mask("(99) 9999-9999");
    $('.celphone').mask("(99) 99999-9999");
    $('.postalcode').mask("99999-999");

    $(".properties_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["properties_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 3,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            $("#properties_id").val(sugestion.data.idx);
            $("#clients_id").val(sugestion.data.users_attach[0].idx);
            $("#client_first_name").val(sugestion.data.users_attach[0].first_name);
            $("#client_last_name").val(sugestion.data.users_attach[0].last_name);
            $("#client_document").val(sugestion.data.users_attach[0].document);
            $("#client_address").val(sugestion.data.address);
            $("#client_number_address").val(sugestion.data.number_address);
            $("#client_complement").val(sugestion.data.complement);
            $("#client_code_postal").val(sugestion.data.code_postal);
            $("#client_district").val(sugestion.data.district);
            $("#client_city").val(sugestion.data.city);
            $("#client_uf").val(sugestion.data.uf);

            $("#porcent_propertie").val(sugestion.data.porcent_propertie);
            $(".price_condominium").val(sugestion.data.price_condominium);
            $(".price_iptu").val(sugestion.data.price_iptu);
            $(".percentual_iptu").val(sugestion.data.percentual_iptu);
            $("#administrative_fees").val(sugestion.data.administrative_fees);
            $("#classification").val(sugestion.data.classification);

            $("#price_location").val(sugestion.data.price_location);
            $("#price_sale").val(sugestion.data.price_sale);
            $(".type_propertie").val(sugestion.data.type_propertie);
            $(".deadline_contract").val(sugestion.data.deadline_contract);
            $(".object_propertie").val(sugestion.data.object_propertie);

            var type = sugestion.data.object_propertie;

            if (type == 'location') {
                $("#location").show();
                $("#day_due_location").prop("disabled", false);
                $("#payment_method_location").prop("disabled", false);
                $("#sale").hide();
                $("#day_due_sale").prop("disabled", true);
                $("#payment_method_sale").prop("disabled", true);
            } else if (type == 'sale') {
                $("#sale").show();
                $("#day_due_sale").prop("disabled", false);
                $("#payment_method_sale").prop("disabled", false);
                $("#location").hide();
                $("#day_due_location").prop("disabled", true);
                $("#payment_method_location").prop("disabled", true);
            } else {
                $("#sale").hide();
                $("#day_due_sale").prop( "disabled", false );
                $("#payment_method_sale").prop( "disabled", false );
                $("#location").hide();
                $("#day_due_location").prop( "disabled", true );
                $("#payment_method_location").prop( "disabled", true );
            }
        }
    });

    $(".tenants_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["tenants_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 3,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            console.log(sugestion);
            $("#users_id").val(sugestion.data.idx);
            $("#tenant_first_name").val(sugestion.data.first_name);
            $("#tenant_last_name").val(sugestion.data.last_name);
            $("#tenant_cpf").val(sugestion.data.cpf);
        }
    });

    var type = ($('.object_propertie').val());

    if (type == 'location') {
        $("#location").show();
        $("#day_due_location").prop("disabled", false);
        $("#payment_method_location").prop("disabled", false);
        $("#sale").hide();
        $("#day_due_sale").prop("disabled", true);
        $("#payment_method_sale").prop("disabled", true);
    } else if (type == 'sale') {
        $("#sale").show();
        $("#day_due_sale").prop("disabled", false);
        $("#payment_method_sale").prop("disabled", false);
        $("#location").hide();
        $("#day_due_location").prop("disabled", true);
        $("#payment_method_location").prop("disabled", true);
    } else {
        $("#sale").hide();
        $("#day_due_sale").prop("disabled", false);
        $("#payment_method_sale").prop("disabled", false);
        $("#location").hide();
        $("#day_due_location").prop("disabled", true);
        $("#payment_method_location").prop("disabled", true);
    }

    var is_aproved = ($('#is_aproved').val());

    if (is_aproved == 'pending') {
        $('#number_contract_aproved').hide();
        $('#text_reproved').hide();
    } else if (is_aproved == 'approved') {
        $('#number_contract_aproved').show();
        $('#n_contract').attr('disabled', 'disabled');
        $('#is_aproved').attr('disabled', 'disabled');
        $('#text_reproved').hide();
    } else if (is_aproved == 'reproved') {
        $('#text_reproved').show();
        $('#number_contract_aproved').hide();
    } else {
        $('#text_reproved').hide();
        $('#number_contract_aproved').hide();
    }

    var object_propertie = ($('.type_propertie').val());

    if (object_propertie == 'apartmant') {
        $('.is_apartmant').show();
    } else {
        $('.is_apartmant').hide();
    }
});

$('#marital_status').change(function () {
    var status = ($(this).val());

    if (status == 'married') {
        $("#conjuge").show();
    } else {
        $("#conjuge").hide();
    }
});

$('#is_pet').change(function () {
    var status = ($(this).val());

    if (status == 'yes') {
        $("#type_pet").show();
    } else {
        $('#type_pet').hide();
        $('#type_pet').val('');
    }
});

$('#type_work').change(function () {
    var status = ($(this).val());

    if (status == 'clt') {
        $('#clt').show();
        $('#pj').hide();
        $('#show_address_info_financeiras').show();
    } else if (status == 'pj') {
        $('#pj').show();
        $('#clt').hide();
        $('#show_address_info_financeiras').show();
    } else {
        $('#pj').hide();
        $('#clt').hide();
        $('#show_address_info_financeiras').hide();
    }
});

$('#type_work_guarantor').change(function () {
    var status = ($(this).val());

    if (status == 'clt_guarantor') {
        $('#clt_guarantor').show();
        $('#pj_guarantor').hide();
        $('#fiance_guarantor').hide();
    } else if (status == 'pj_guarantor') {
        $('#pj_guarantor').show();
        $('#clt_guarantor').hide();
        $('#fiance_guarantor').hide();
    } else if (status == 'fiance_guarantor') {
        $('#fiance_guarantor').show();
        $('#pj_guarantor').hide();
        $('#clt_guarantor').hide();
    } else {
        $('#pj_guarantor').hide();
        $('#clt_guarantor').hide();
        $('#fiance_guarantor').hide();
    }
});

$('#type_guarantor').change(function () {
    var status = ($(this).val());

    if (status == 'guarantor') {
        $('#guarantor').show();
        $('#type_work_guarantor_div').show();
        $('#surety_bond').hide();
    } else if (status == 'surety_bond') {
        $('#surety_bond').show();
        $('#type_work_guarantor_div').hide();
        $('#guarantor').hide();
    } else {
        $('#surety_bond').hide();
        $('#guarantor').hide();
        $('#type_work_guarantor_div').hide();
    }
});

$('#is_aproved').change(function () {
    var status = ($(this).val());

    if (status == 'pending') {
        $('#number_contract_aproved').hide();
        $('#text_reproved').hide();
    } else if (status == 'approved') {
        $('#number_contract_aproved').hide();
        $('#text_reproved').hide();
    } else if (status == 'reproved') {
        $('#text_reproved').show();
        $('#number_contract_aproved').hide();
    }
});

/* CONSULTA CEP */
$("#postalcode").change(function () {

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