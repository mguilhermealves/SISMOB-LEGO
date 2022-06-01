jQuery(function () {

    lightbox.init();

    $('body').on(function (event) {
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
    $('#document').mask("999.999.999-99");
    $('.document').mask("999.999.999-99");

    $(".clients_search").autocomplete({
        serviceUrl: '<?php print($GLOBALS["proprietaries_url"]) ?>.autocomplete',
        autoFocus: true,
        minChars: 3,
        deferRequestBy: 5,
        noCache: true,
        onSelect: function (sugestion) {
            $("#users_id").val(sugestion.data.idx);
            $("#clients_first_name").html(sugestion.data.first_name);
            $("#clients_last_name").html(sugestion.data.last_name);
            $("#clients_mail").html(sugestion.data.mail);
            $("#clients_document").html(sugestion.data.document);
            $("#clients_phone").html(sugestion.data.phone);
            $("#clients_celphone").html(sugestion.data.celphone);
        }
    });

    var status = ($('#object_propertie').val());
    var type_propertie = ($('#type_propertie').val());
    var financial_propertie = ($('select[name="financial_propertie"]').val());
    var isswap = ($('#is_swap').val());

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
        $('div[id="sale"]').show();
        $('div[id="location"]').hide();
    } else if (status == 'location') {
        $('#configs').show();
        $('div[id="sale"]').hide();
        $('div[id="location"]').show();
    } else {
        $('#configs').hide();
        $('div[id="sale"]').hide();
        $('div[id="location"]').hide();
    }

    // $("#delete_img").on("click", function () {
    //     var propertie_id = $(this).data("propertieid");
    //     var img_id = $(this).data("imgid");

    //     $.ajax({
    //         method: "POST",
    //         url: '/delete_img_propertie',
    //         data: {
    //             propertie_id: propertie_id,
    //             img_id: img_id
    //         },
    //         beforeSend: function () {
    //             $(".spinner-border").show();
    //         },
    //         success: function () {
    //             // setTimeout(function () {
    //             //     window.location.reload();
    //             // }, 1500);
    //         },
    //         complete: function () {
    //             $('.spinner-border').hide();
    //         }
    //     });
    // });
});

$('#price_iptu').change(function () {
    var price_iptu = ($(this).val());

    var price_location = document.getElementById("price_location").value

    var percentual = (price_iptu.replace(".", "").replace(",", "") * 100) / price_location.replace(".", "").replace(",", "");

    $(".percentual_iptu").val(percentual);
});

$('#is_swap').change(function () {
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
        $('div[id="sale"]').show();
        $('div[id="location"]').hide();
    } else if (status == 'location') {
        $('#configs').show();
        $('div[id="sale"]').hide();
        $('div[id="location"]').show();
    } else {
        $('#configs').hide();
        $('div[id="sale"]').hide();
        $('div[id="location"]').hide();
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