$(document).ready(function () {

    $('.money').mask("#.##0,00", {
        reverse: true
    });
    $('#document').mask("999.999.999-99");

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

/* CONSULTA CLIENTE */
$(document).on('click', '.pesquisarCliente', function () {
    var cod_client = $("#cod_client").val();
    var name_client = $("#name_client").val();
    var cpf_client = $("#cpf_client").val();

    //AUTOCOMPLETE PROPERTIES
    var path = "/search_client";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: path,
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            cod_client: cod_client,
            name_client: name_client,
            cpf_client: cpf_client
        },
        beforeSend: function () {

        },
        success: function (data) {
            html = "";
            html += '<table class="table table-striped table-inverse">';
            html += '<thead class="thead-inverse">';
            html += '<tr>';
            html += '<th>Código</th>';
            html += '<th>Nome</th>';
            html += '<th>CPF</th>';
            html += '<th>Ação</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(data, function (index, value) {
                html += '<tr>';

                html += '<td scope="row"><p>' + value.idx +
                    '</p></td>';

                html += '<td><p>' + value.first_name + '</p></td>';

                html += '<td><p class="cpf">' + value.document +
                    '</p></td>';

                html +=
                    '<td><a data-id="' + value.idx +
                    '" class="btn btn-info btn-sm btn_selecionar_cliente"><i class="bi bi-pencil-square"></i> Selecionar</a></td>';

                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $('#table_find_clients').empty('').append(html);
        },
    });
});

/* SELECIONA CLIENTE */
$(document).on('click', '.btn_selecionar_cliente', function () {

    var client_id = $(this).data('id');

    //AUTOCOMPLETE PROPERTIES
    var path = "/select_client";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: path,
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            client_id: client_id
        },
        beforeSend: function () {

        },
        success: function (resp) {
            
            jQuery("#clients_id").val(resp.idx);
            jQuery("#first_name").val(resp.first_name);
            jQuery("#last_name").val(resp.last_name);
            jQuery("#mail").val(resp.mail);
            jQuery("#document").val(resp.document);
            jQuery("#rg").val(resp.rg);
            jQuery("#cnh").val(resp.cnh);
            jQuery("#phone").val(resp.phone);
            jQuery("#celphone").val(resp.celphone);
            jQuery("#id").val(resp.id);
        },
    });
});