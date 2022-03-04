$(document).ready(function () {
   
    function deleteTodoItem(e, item) {
        e.preventDefault();
        $(item).parent().fadeOut('slow', function () {
            $(item).parent('li').remove();
        });
    }

    $('#add_list').click(
        function () {
            var toAdd = $('#ListItem').val();
            $('ol').append('<li>' + toAdd + '<button type="button" class="btn btn-danger btn-sm ml-5 todo-item-delete">X</button><textArea style="display: none;" name="post[ActivityInformation][preRequisite][]">' + toAdd + '</textArea></li>');
        });

    $("#ListItem").keyup(function (event) {
        if (event.keyCode == 13) {
            $("#add_list").click();
        }
    });

    $(document).on('dblclick', 'li', function () {
        $(this).toggleClass('strike').fadeOut('slow');
    });

    $(document).on('click', '.todo-item-delete', function (e) {
        var item = this;
        deleteTodoItem(e, item)
    })

    $('input').focus(function () {
        $(this).val('');
    });

    $('ol').sortable();

    var check_term = ($('#check_term').is(':checked'));

    if (check_term == false) {
        $('#save_accept_terms').attr('type', 'button')
    } else {
        $('#save_accept_terms').attr('type', 'submit')
    }

    var not_apply_date = ($('#not_apply_date').is(':checked'));
    if (not_apply_date == false) {
        $('#curso_presencial_data').removeClass("d-none")
    } else {
        $('#curso_presencial_data').addClass("d-none")
    }

    var toggle_atividade_aplicada = ($('#toggle_atividade_aplicada').is(':checked'));
    if (toggle_atividade_aplicada == false) {
        $('#toggle_atividade_aplicada').val('In Company');
    } else {
        $('#toggle_atividade_aplicada').val('Aberto ao público');
    }

    var toggle_periodicidade = ($('#toggle_periodicidade').is(':checked'));
    if (toggle_periodicidade == false) {
        $('#toggle_periodicidade').val('Curso recorrente');
    } else {
        $('#toggle_periodicidade').val('Curso único');
    }

    var curso_a_distancia_click = false;
    var curso_presencial_click = false;
});

/* CURSO A DISTANCIA */

$('a[data-toggle="tab"]').on('hide.bs.tab', function (event) {
    event.target // newly activated tab
    event.relatedTarget // previous active tab

    $('#disponibilizar-dentro-da-plataforma').addClass("d-none");
    $('#disponibilizado-na-plataforma-parceiro-integracao').addClass("d-none")
    $('#disponibilizado-na-plataforma-parceiro-voucher').addClass("d-none")
});

$("#disponibilizar-dentro-da-plataforma-tab").click(function () {
    $('#disponibilizar-dentro-da-plataforma').removeClass("d-none");
});
$("#disponibilizado-na-plataforma-parceiro-integracao-tab").click(function () {
    $('#disponibilizado-na-plataforma-parceiro-integracao').removeClass("d-none")
});

$("#disponibilizado-na-plataforma-parceiro-voucher-tab").click(function () {
    $('#disponibilizado-na-plataforma-parceiro-voucher').removeClass("d-none")
});

/* FIM CURSO A DISTANCIA */