$(document).ready(function () {

    $('body').keypress(function (event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

    $('.money').mask("#.##0,00", {
        reverse: true
    });

    $('.document').mask("999.999.999-99");
    $('.phone').mask("(99) 9999-9999");
    $('.celphone').mask("(99) 99999-9999");
    $('.postalcode').mask("99999-999");

    var status = ($('#marital_status').val());

    if (status == 'married') {
        $("#conjuge").show();
    } else {
        $("#conjuge").hide();
    }

    var is_pet = ($('#is_pet').val());

    if (is_pet == 'yes') {
        $("#type_pet").show();
    } else {
        $("#type_pet").hide();
    }

    var work = ($('#type_work').val());

    if (work == 'clt') {
        $('#clt').show();
        $('#pj').hide();
    } else if (work == 'pj') {
        $('#pj').show();
        $('#clt').hide();
    } else {
        $('#pj').hide();
        $('#clt').hide();
        $('#show_address_info_financeiras').hide();
    }

    var fiance = ($('#type_fiance').val());

    if (fiance == 'guarantor') {
        $('#fiance').show();
        $('#type_work_fiance_div').show();
        $('#surety_bond').hide();
    } else if (fiance == 'surety_bond') {
        $('#surety_bond').show();
        $('#type_work_fiance_div').hide();
        $('#fiance').hide();
    } else {
        $('#surety_bond').hide();
        $('#fiance').hide();
        $('#type_work_fiance_div').hide();
    }

    var type_work_fiance = ($('#type_work_fiance').val());

    if (type_work_fiance == 'clt') {
        $('#clt_fiance').show();
        $('#pj_fiance').hide();
        $('#fiance_guarantor').hide();
    } else if (type_work_fiance == 'pj') {
        $('#pj_fiance').show();
        $('#clt_fiance').hide();
        $('#fiance_guarantor').hide();
    } else if (type_work_fiance == 'fiance_guarantor') {
        $('#fiance_guarantor').show();
        $('#pj_fiance').hide();
        $('#clt_fiance').hide();
    } else {
        $('#pj_fiance').hide();
        $('#clt_fiance').hide();
        $('#fiance_guarantor').hide();
    }

    $("#btn_save").addClass("d-none");
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
    } else if (status == 'pj') {
        $('#pj').show();
        $('#clt').hide();
    } else {
        $('#pj').hide();
        $('#clt').hide();
        $('#show_address_info_financeiras').hide();
    }
});

$('#type_work_fiance').change(function () {
    var status = ($(this).val());

    if (status == 'clt') {
        $('#clt_fiance').show();
        $('#pj_fiance').hide();
    } else if (status == 'pj') {
        $('#pj_fiance').show();
        $('#clt_fiance').hide();
    } else {
        $('#pj_fiance').hide();
        $('#clt_fiance').hide();
        $('#fiance_guarantor').hide();
    }
});

$('#type_fiance').change(function () {
    var status = ($(this).val());

    if (status == 'guarantor') {
        $('#fiance').show();
        $('#type_work_fiance_div').show();
        $('#surety_bond').hide();
    } else if (status == 'surety_bond') {
        $('#surety_bond').show();
        $('#type_work_fiance_div').hide();
        $('#fiance').hide();
    } else {
        $('#surety_bond').hide();
        $('#fiance').hide();
        $('#type_work_fiance_div').hide();
    }
});

/* CONSULTA CPF */
$("#cpf").change(function () {
    var cpf = $(this).val().replace(/\D/g, '');

    $.ajax({
        method: "POST",
        url: '/consultar_cpf_tenant',
        data: {
            cpf: cpf
        },
        beforeSend: function () {
            $(".spinner-border").show();
        },
        success: function (data) {
            var jsonData = JSON.parse(data);
            if (jsonData.error == true) {
                $("#error_cpf").removeClass("d-none").html('<span>' + jsonData.message + '</span>').css("color", "red");
            } else {
                $("#error_cpf").addClass("d-none");
                $("#btn_save").removeClass("d-none");
            }
        },
        complete: function () {
            $('.spinner-border').hide();
        }
    });
});

/* CONSULTA CEP */
$("#postalcode").change(function () {

    //Nova vari??vel "cep" somente com d??gitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Express??o regular para validar o CEP.
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
                    //CEP pesquisado n??o foi encontrado.
                    limpa_formul??rio_cep();
                    alert("CEP n??o encontrado.");
                }
            });
        } //end if.
        else {
            //cep ?? inv??lido.
            limpa_formul??rio_cep();
            alert("Formato de CEP inv??lido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formul??rio.
        limpa_formul??rio_cep();
    }
});

function limpa_formul??rio_cep() {
    //Limpa valores do formul??rio de cep.
    document.getElementById('address').value=("");
    document.getElementById('district').value=("");
    document.getElementById('city').value=("");
    document.getElementById('uf').value=("");
}

/* CONSULTA CEP FIADOR PJ */
$("#fiance_postalcode").change(function () {

    //Nova vari??vel "cep" somente com d??gitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Express??o regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#fiance_address").val("...");
            $("#fiance_district").val("...");
            $("#fiance_city").val("...");
            $("#fiance_uf").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#fiance_address").val(dados.logradouro);
                    $("#fiance_district").val(dados.bairro);
                    $("#fiance_city").val(dados.localidade);
                    $("#fiance_uf").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado n??o foi encontrado.
                    limpa_formul??rio_fiance_cep();
                    alert("CEP n??o encontrado.");
                }
            });
        } //end if.
        else {
            //cep ?? inv??lido.
            limpa_formul??rio_fiance_cep();
            alert("Formato de CEP inv??lido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formul??rio.
        limpa_formul??rio_fiance_cep();
    }
});

function limpa_formul??rio_fiance_cep() {
    //Limpa valores do formul??rio de cep.
    document.getElementById('fiance_address').value=("");
    document.getElementById('fiance_district').value=("");
    document.getElementById('fiance_city').value=("");
    document.getElementById('fiance_uf').value=("");
}