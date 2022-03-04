
// Esconde ou mostra os campos data e hora no descritivo de atividade de acordo com a seleção do checkbox
// Checkbox: Não aplicar data e hora
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#not_apply_date") ).bind("change",function(){
    var form = '#'+ $(this).closest('form').attr('id');
    var div_with_father = form + ' #curso_presencial_data';
    var field_with_father = form + ' #not_apply_date';
    ($(field_with_father).is(":checked")) ? $(div_with_father).addClass("d-none") : $(div_with_father).removeClass("d-none");
});



// Libera a navegação entre as seções
function display_labels(submit_name){
    $('#error-descript').empty()
    $('#error-address').empty()
    $('#error-link').empty()
    $(submit_name).removeClass("d-none"); 
}


// Valida se os termos foram aceitos
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#save_accept_terms") ).bind("click",function(){

    var form = '#'+ $(this).closest('form').attr('id');
    var check_term = ($(form +' #check_term').is(':checked'));

    if (check_term == false) {
        $(form+' #save_accept_terms').attr('type', 'button');
        $(form +' #myModal').modal({ backdrop: 'static', keyboard: false });
    } else {
        $(form+' #save_accept_terms').attr('type', 'submit');
        $(form+' #save_accept_terms').click();
    }
});



// Dados do professor / Palestrante
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#save_information_panelist") ).bind("click",function(){
    var form = '#'+ $(this).closest('form').attr('id');

    if (!$(form + ' #paneListName').val() || !$(form + ' #paneListCpf').val() || !$(form + ' #paneListLinkedin').val() || !$(form + ' #paneCurriculoLattes').val() || !$(form + ' #paneListFormacao').val() || !$(form + ' #paneListActing').val() || !$(form + ' #paneListSpecialty').val()) {
        $(form + ' #msn_error').removeClass("d-none")
        $(form + ' #coffe_brake').addClass("d-none")
        $(form + ' #accept_terms').addClass("d-none")
    } else {
        $(form + ' #msn_error').addClass("d-none")
        $(form + ' #coffe_brake').removeClass("d-none")
    }
});



// Valiida os campos da seção de endereços do curso
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#save_courses_address") ).bind("click",function(){
    
    var form = '#'+ $(this).closest('form').attr('id');
    // VERIFICA SE OS CAMPOS ESTAO VAZIOS
    if (!$(form + ' #courseLocal').val() || !$(form + ' #courseCEP').val() || !$(form + ' #courseAddress').val() || !$(form + ' #courseAddressNumber').val() || !$(form + ' #courseDistrict').val() || !$(form + ' #courseCity').val() || !$(form + ' #courseState').val()) {
        $(form + ' #msn_error').removeClass("d-none")
        $(form + ' #information_activitie').addClass("d-none")
    } else {
        $(form + ' #msn_error').addClass("d-none")
        $(form + ' #information_activitie').removeClass("d-none")
    }


    $(form + ' #msn_error').addClass("d-none")
    $(form + ' #information_activitie').removeClass("d-none")
});


// Início TODO LIST 
//Pega o enter no add da TODO LIST ----- NAO FUNCIONAAAAAA
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#ListItem") ).bind("click",function(){
    var form = '#'+ $(this).closest('form').attr('id');
    $(form +" #ListItem").keyup(function (event) {
        if (event.keyCode == 13) {
            $(form +" #add_list").click();
        }
    });
});


// TODO - Adiciona item na lista
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#add_list") ).bind("click",function(){
    var form = '#'+ $(this).closest('form').attr('id');
    var toAdd = $(form + ' #ListItem').val();
    $('ol').append('<li><div class="row"><div class="col-sm-10">' + toAdd + '</div><div class="col-sm-2"><button type="button" class="btn btn-danger btn-sm ml-5 pull-right todo-item-delete">X</button><textArea style="display: none;" name="post[ActivityInformation][preRequisite][]">' + toAdd + '</textArea></div></div></li><hr style="margin: 0; padding: 0; ">');
    $(form + ' #ListItem').val('');
});

// TODO - Remove item da lista
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( ".todo-item-delete") ).bind("click",function(e){
    var form = '#'+ $(this).closest('form').attr('id');
    e.preventDefault();
    $(form+' '+this).parent().fadeOut('slow', function () {
        $(this).parent('li').remove();
    });

});

$(document).on('dblclick', 'li', function () {
    $(this).toggleClass('strike').fadeOut('slow');
});


$('ol').sortable();
// Final da TODO LIST

$(document).ready(function () {

    
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


//Valida se o link foi informado na seção
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#save_link") ).bind("click",function(){
    var form = '#'+ $(this).closest('form').attr('id');

    // VERIFICA SE OS CAMPOS ESTAO VAZIOS
    if (!$(form + ' #courseLink').val()) {
        $(form + ' #msn_error_link').removeClass("d-none")
        $(form + ' #information_activitie').addClass("d-none")
    } else {
        $(form + ' #msn_error_link').addClass("d-none")
        $(form + ' #information_activitie').removeClass("d-none")
    }
});



/*
function display_labels(submit_name) {

    //validate_address(submit_name)
    if (submit_name == '#save_course_address') {

    } else if (submit_name == '#course_link') {
        console.log(submit_name)
        $('#course_link').removeClass("d-none")
        $('#information_activitie').removeClass("d-none")
    } else if (submit_name == '#coffe_brake') {
        console.log(submit_name)
        $('#coffee_brake').removeClass("d-none")
    }{
            
        console.log(submit_name)
        $(submit_name).removeClass("d-none"); 
    }
}

*/

$('#curso-a-distancia-tab').click(function () {
    var curso_a_distancia_click = true;

    if (curso_a_distancia_click == true) {
        $('#curso-a-distancia').removeClass("d-none")
        $('#course_descript').addClass("d-none")
        $('#information_activitie').addClass("d-none")
        $('#course_address').addClass("d-none")
        $('#information_teacher').addClass("d-none")
        $('#accept_terms').addClass("d-none")
    }
});

$('#curso-presencial-tab').click(function () {
    var curso_presencial_click = true;

    if (curso_presencial_click == true) {
        $('#course_descript').removeClass("d-none")
        $('#curso-a-distancia').addClass("d-none")
    }
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













function curator_message_form(element_form){

  
    var form = '#'+ $(element_form).closest('form').attr('id');
    var field = $(element_form).attr('id');

    var course_descript = {
        'div_main' : 'course_descript',
        'div_error_report' : 'message_error_course_descript',
        'checkbox_correct_information' : 'ativity_details_correct',
    }

    var course_address = {
        'div_main' : 'course_address',
        'div_error_report' : 'message_error_course_address',
        'checkbox_correct_information' : 'address_correct'
    }

    var coffee_brake = {
        'div_main' : 'coffee_brake',
        'div_error_report' : 'message_error_coffee_brake',
        'checkbox_correct_information' : 'coffee_brake_correct'
    }

    var information_activitie = {
        'div_main' : 'information_activitie',
        'div_error_report' : 'message_error_information_activie',
        'checkbox_correct_information' : 'coffee_brake_correct'
    }

    var information_panelist = {
        'div_main' : 'information_panelist',
        'div_error_report' : 'message_error_information_panelist',
        'checkbox_correct_information' : 'professor_correct'            
    }

    var infrastructure = {
        'div_main' : 'infrastructure',
        'div_error_report' : 'message_error_infrastructure',
        'checkbox_correct_information' : 'infrastructure_correct'   
    }

    var link = {
        'div_main' : 'course_link',
        'div_error_report' : 'message_error_couse_link',
        'checkbox_correct_information' : 'course_link_correct'   
    }
 


    /*NÃO ALTERE DIRETAMENTE POR AQUI, UTILIZE AS VARIAVEIS ACIMA*/


    var elements = {
        'check_error_activity_description' : course_descript,
        'ativity_details_correct_yes': course_descript,
        'ativity_details_correct_no': course_descript,

        'check_error_course_address': course_address,
        'address_correct_yes': course_address,
        'address_correct_no': course_address,

        'check_error_course_coffee_brake': coffee_brake,
        'coffee_brake_correct_yes': coffee_brake,
        'coffee_brake_correct_no': coffee_brake,

        'check_error_activity_information_resume': information_activitie,
        'ativity_information_correct_yes': information_activitie,
        'ativity_information_correct_no': information_activitie,
                
        'check_error_activity_information_activity_goal': {
            'div_main' : 'information_activitie',
            'div_error_report' : 'ativity_information_correct'
        },

        'check_error_information_panelist': information_panelist,
        'professor_correct_yes': information_panelist,
        'professor_correct_no': information_panelist,

        'check_error_infrastructure': infrastructure,
        'infrastructure_correct_yes': infrastructure,
        'infrastructure_correct_no': infrastructure,

        'check_error_link': link,
        'course_link_correct_yes': link,
        'course_link_correct_no': link
    }

    name_field_invert = field.split("_");


    if(name_field_invert.at(-1) === 'yes'){
        field = field.replace('_yes', '_no')
    }
    var nextSection = next_section(form, elements[field]['div_main'])

    
    if($(form + ' #'+field).is(":checked")){
        
        $(form + ' #'+elements[field]['div_main']).addClass('with-border')

        var name = elements[field]['div_error_report']
        name_string = name.split("_");
        
        var name = '';
        for(var i = 0; i < name_string.length; i++){
            name = name.concat('['+name_string[i]+']')
        }

        if(!document.getElementsByName(name).length){
            $("#"+elements[field]['checkbox_correct_information']+'_no').prop("checked", true);
            $(form + ' #'+elements[field]['div_error_report']).append(form_message_error(name))
        }

        $(form + ' #'+nextSection['next']).addClass('d-none')


        if (nextSection['div_correct'] !== null && nextSection['div_correct'] !== undefined) {
            $(form + ' #'+nextSection['div_correct']).addClass('d-none')
        }else{
            alert('ultima div')
        }
        
    }else{

        $("#"+elements[field]['checkbox_correct_information']+'_yes').prop("checked", true);
        $(form + ' #'+elements[field]['div_main']).removeClass('with-border')
        $(form + ' #'+elements[field]['div_error_report']).empty()

        $(form + ' #'+nextSection['next']).removeClass('d-none')

        

        if (nextSection['div_correct'] !== null && nextSection['div_correct'] !== undefined) {
            $(form + ' #'+nextSection['div_correct']).removeClass('d-none')
        }else{
            alert('ultima div')
        }



    
   

        
    }

}

$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#check_error_activity_description, #check_error_course_address, #check_error_course_coffee_brake, #check_error_activity_information_resume, #check_error_activity_information_activity_goal, #check_error_information_panelist, #check_error_infrastructure, #check_error_link") ).bind("click",function(e){
    curator_message_form(this)
 });


 function form_message_error(name){    
    var html = '<div class="card mt-5">';
    html = html.concat('<div class="card-header label_div_orange">Caixa de Mensagens</div>')
    html = html.concat('<div class="card-body">')
    html = html.concat('<div class="row">')
    html = html.concat('<div class="col-sm-12">')
    html = html.concat('<label for="">Curador</label>')
    html = html.concat('<textarea class="form-control" name="'+name+'" id="'+name+'" rows="5" placeholder="Escreva aqui as suas considerações" style="resize: none;"></textarea>')
    html = html.concat('</div>')
    html = html.concat('</div>')
    html = html.concat('</div>')
    html = html.concat('</div>')
    return html;
 }

 
$($("#form_curso_presencial, #form_curso_hibrido, #form_curso_palestra, #form_videos_live, #form_curso_a_distancia_disponibilizar_dentro_da_plataforma, #form_curso_a_distancia_disponibilizado_na_plataforma_parceiro_integracao").find( "#ativity_details_correct_yes, #ativity_details_correct_no, #address_correct_yes, #address_correct_no, #coffee_brake_correct_yes, #coffee_brake_correct_yes, #ativity_information_correct_no, #ativity_information_correct_yes, #professor_correct_yes, #professor_correct_yes") ).bind("change",function(e){
    curator_message_form(this)
});




function next_section(current_form, section){

    current_form = current_form.replace('#', '')

    var itens = {
        'form_curso_presencial' : {
            'course_descript' : {
                'next' : 'course_address',
                'div_correct' : 'course_address_correct'
            },
            'course_address' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct' 
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }
        },
        'form_curso_a_distancia_disponibilizar-dentro-da-plataforma' : {
            'course_descript' : {
                'next' : 'course_link',
                'div_correct' : 'course_link_correct'
            },
            'course_link' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct'
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }  
        },
        'form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao' : {
            'course_descript' : {
                'next' : 'course_link',
                'div_correct' : 'course_link_correct'
            },
            'course_link' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct'
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }  
        },
        'form_curso_hibrido' : {
            'course_descript' : {
                'next' : 'course_address',
                'div_correct' : 'course_address_correct'
            },
            'course_address' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct' 
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'coffee_brake',
                'div_correct' : 'coffee_brake_correct'
            },
            'coffee_brake' : {
                'next' : 'times_and_moviments',
                'div_correct' : 'times_and_moviments_correct'
            },
            'times_and_moviments' : {
                'next' : 'infrastructure',
                'div_correct' : 'infrastructure_correct'
            },
            'infrastructure' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }
        },
        'form_videos_live' : {

            'course_descript' : {
                'next' : 'course_link',
                'div_correct' : 'course_link_correct'
            },

            'course_link' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct'
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }
        },
        'form_curso_palestra' : {
            'course_descript' : {
                'next' : 'course_address',
                'div_correct' : 'course_address_correct'
            },
            'course_address' : {
                'next' : 'information_activitie',
                'div_correct' : 'information_activitie_correct' 
            },
            'information_activitie' : {
                'next' : 'information_panelist',
                'div_correct' : 'information_panelist_correct'
            },
            'information_panelist' : {
                'next' : 'accept_terms',
                'div_correct' : null
            }
        }
    }

    return itens[current_form][section]
}




