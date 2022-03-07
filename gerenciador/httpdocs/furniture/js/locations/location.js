$(document).ready(function () {

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
        $('#show_address_info_financeiras').show();
    } else if (work == 'pj') {
        $('#pj').show();
        $('#clt').hide();
        $('#show_address_info_financeiras').show();
    } else {
        $('#pj').hide();
        $('#clt').hide();
        $('#show_address_info_financeiras').hide();
    }

    var guarantor = ($('#type_guarantor').val());

    if (guarantor == 'guarantor') {
        $('#guarantor').show();
        $('#type_work_guarantor_div').show();
        $('#surety_bond').hide();
    } else if (guarantor == 'surety_bond') {
        $('#surety_bond').show();
        $('#type_work_guarantor_div').hide();
        $('#guarantor').hide();
    } else {
        $('#surety_bond').hide();
        $('#guarantor').hide();
        $('#type_work_guarantor_div').hide();
    }

    var type_work_guarantor = ($('#type_work_guarantor').val());

    if (type_work_guarantor == 'clt_guarantor') {
        $('#clt_guarantor').show();
        $('#pj_guarantor').hide();
        $('#fiance_guarantor').hide();
    } else if (type_work_guarantor == 'pj_guarantor') {
        $('#pj_guarantor').show();
        $('#clt_guarantor').hide();
        $('#fiance_guarantor').hide();
    } else if (type_work_guarantor == 'fiance_guarantor') {
        $('#fiance_guarantor').show();
        $('#pj_guarantor').hide();
        $('#clt_guarantor').hide();
    } else {
        $('#pj_guarantor').hide();
        $('#clt_guarantor').hide();
        $('#fiance_guarantor').hide();
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

    var object_propertie = ($('#object_propertie_searh').val());

    if (object_propertie == 'apartmant') {
        $('#is_apartmant').show();
    } else {
        $('#is_apartmant').hide();
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
$("#cep").change(function () {

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
$(document).on('click', '.pesquisarImovel', function () {
    var cod_propertie = $("#cod_propertie").val();
    var name_client = $("#name_client").val();
    var cpf_client = $("#cpf_client").val();
    // var address_propertie = $("#address_propertie").val();

    //AUTOCOMPLETE PROPERTIES
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/search_propertie",
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            cod_propertie: cod_propertie,
            name_client: name_client,
            cpf_client: cpf_client
        },
        beforeSend: function () {

        },
        success: function (data) {
            if (data.length > 0) {
                html = "";
                html += '<table class="table table-striped table-inverse">';
                html += '<thead class="thead-inverse">';
                html += '<tr>';
                html += '<th>Código</th>';
                // html += '<th>Nome</th>';
                html += '<th>Endereço</th>';
                html += '<th>Bairro</th>';
                html += '<th>Cidade</th>';
                html += '<th>UF</th>';
                // html += '<th>CPF</th>';
                html += '<th>Escolher</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                $.each(data, function (index, value) {
                    html += '<tr>';

                    html += '<td scope="row"><p>' + value.idx +
                        '</p></td>';

                    // html += '<td><p>' + value.client_properties.first_name +
                    //     '</p></td>';

                    html += '<td><p>' + value.address + ", N° " + value.number_address +
                        '</p></td>';

                    html += '<td><p>' + value.district +
                        '</p></td>';

                    html += '<td><p>' + value.city +
                        '</p></td>';

                    html += '<td><p>' + value.uf +
                        '</p></td>';

                    // html += '<td><p class="cpf">' + value.client_properties
                    //     .cpf_cnpj +
                    //     '</p></td>';

                    html +=
                        '<td><a data-id="' + value.idx +
                        '" class="btn btn-info btn-sm btn_selecionar_cliente"><i class="bi bi-pencil-square"></i> Selecionar</a></td>';

                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';
                $('#table_find_clients').empty('').append(html);
            } else {
                html = "";
                html += '<table class="table table-striped table-inverse">';
                html += '<thead class="thead-inverse">';
                html += '<tr>';
                html += '<th>Código</th>';
                html += '<th>Nome</th>';
                html += '<th>CPF</th>';
                html += '<th>Escolher</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
                html += '<tr>';
                html +=
                    '<th colspan="4" style="text-align: center"><p class="alert alert-warning text-center">Nenhum imóvel disponivel para locação até o momento...</p></th>';
                html += '</tr>';
                html += '</tbody>';
                html += '</table>';
                $('#table_find_clients').empty('').append(html);
            }
        }
    });
});

/* SELECIONA CLIENTE */
$(document).on('click', '.btn_selecionar_cliente', function () {

    var cod_propertie = $(this).data('id');

    //AUTOCOMPLETE PROPERTIES
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/select_propertie",
        type: 'POST',
        dataType: "json",
        data: {
            _token: CSRF_TOKEN,
            cod_propertie: cod_propertie
        },
        beforeSend: function () {

        },
        success: function (resp) {
            jQuery("#first_name_search").val(resp.clients_attach[0].first_name);
            jQuery("#last_name_search").val(resp.clients_attach[0].last_name);
            jQuery("#document_search").val(resp.clients_attach[0].document);
            jQuery("#address_search").val(resp.address);
            jQuery("#number_address_search").val(resp.number_address);
            jQuery("#complement_search").val(resp.complement);
            jQuery("#cep_search").val(resp.code_postal);
            jQuery("#district_search").val(resp.district);
            jQuery("#city_search").val(resp.city);
            jQuery("#uf_search").val(resp.uf);
            jQuery("#type_propertie_search").val(resp.type_propertie);

            jQuery("#object_propertie_search").val(resp.object_propertie);
            jQuery("#price_location_search").val(resp.price_location);
            jQuery("#price_iptu_search").val(resp.price_iptu);
            jQuery("#deadline_contract_search").val(resp.deadline_contract);
            jQuery("#clients_id").val(resp.clients_attach[0].idx);
            jQuery("#properties_id").val(resp.idx);
        },
    });
});