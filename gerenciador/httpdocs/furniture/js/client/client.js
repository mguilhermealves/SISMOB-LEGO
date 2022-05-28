$(document).ready(function () {

    $('body').keypress(function (event) {
        if (event.keyCode == '13') {
            return false;
        }
    });

    $('#phone').mask("(99) 9999-9999");
    $('#celphone').mask("(99) 99999-9999");
    $('#postalcode').mask("99999-999");
    $('.document').mask("999.999.999-99");

    var status = ($('#marital_status').val());

    if (status == 'married') {
        $("#conjuge").show();
    } else {
        $("#conjuge").hide();
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

/* CONSULTA CPF */
$("#cpf").change(function () {
    var cpf = $(this).val().replace(/\D/g, '');

    $.ajax({
        method: "POST",
        url: '/consultar_cpf',
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
                $("#btn_save").addClass("d-none");
            } else {
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