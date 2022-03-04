
pj_users_template = '<div id="row_#IDX#" class="large-12 columns">';
pj_users_template += '    <input type="hidden" name="users_id[]" value="#IDX#" />';
pj_users_template += '    <hr style="margin:0px;margin-bottom:1rem;"/>';
pj_users_template += '    <div class="large-3 columns">';
pj_users_template += '        #NAME#';
pj_users_template += '    </div>';
pj_users_template += '    <div class="large-3 columns">';
pj_users_template += '        #EMAIL#';
pj_users_template += '    </div>';
pj_users_template += '    <div class="large-3 columns">';
pj_users_template += '        #CPF#';
pj_users_template += '    </div>';
pj_users_template += '    <div class="large-3 columns">';
pj_users_template += '        <button id="btn_remove_user_#IDX#" type="button" class="btn round hollow button secondary">Remover</button>';
pj_users_template += '    </div> ';
pj_users_template += '</div>';



$("input[id='name_user']").autocomplete({
    serviceUrl: users_autocomplete + '?autcomplete_field=name' ,
    minChars: 5,
    deferRequestBy: 5,
    noCache: true,
    onSelect: function(sugestion) {
        $("#idx_user").val( sugestion.data.idx )
        $("#name_user").val(sugestion.data.name)
        $("#mail_user").val(sugestion.data.mail)
        $("#cpf_user").val(sugestion.data.cpf)        
    }
});

$("input[id='mail_user']").autocomplete({
    serviceUrl: users_autocomplete + '?autcomplete_field=mail' ,
    minChars: 5,
    deferRequestBy: 5,
    noCache: true,
    onSelect: function(sugestion) {
        $("#idx_user").val( sugestion.data.idx )
        $("#name_user").val(sugestion.data.name)
        $("#mail_user").val(sugestion.data.mail)
        $("#cpf_user").val(sugestion.data.cpf)
    }
});

$("input[id='cpf_user']").autocomplete({
    serviceUrl: users_autocomplete + '?autcomplete_field=cpf' ,
    minChars: 5,
    deferRequestBy: 5,
    noCache: true,
    onSelect: function(sugestion) {
        $("#idx_user").val( sugestion.data.idx )
        $("#name_user").val(sugestion.data.name)
        $("#mail_user").val(sugestion.data.mail)
        $("#cpf_user").val(sugestion.data.cpf)
    }
});




$('input[id="cpf_user"]').inputmask("999.999.999-99");
$("button[id^='btn_remove_user_']").bind("click", function(){
    if( confirm( 'confirma remover esse registro' ) ){
        var idx = String( $(this).prop("id") ).replace('btn_remove_user_','')
        pj_users.remove( idx );
    }
})
$("#btn_add_user").bind("click", function(){
    if( $("#idx_user").val() > 0 ){
        pj_users.remove(  $("#idx_user").val() )
        var data = {
            "#IDX#":  $("#idx_user").val()
            , "#NAME#": $("#name_user").val()
            , "#EMAIL#": $("#mail_user").val()
            , "#CPF#": $("#cpf_user").val()
        }
        pj_users.add( data );

        $("#idx_user").val('0')
        $("#name_user").val('')
        $("#mail_user").val('')
        $("#cpf_user").val('')
    }
    else{
        alert("Necessário informar um usuario cadastrado")
    }
})
pj_users = {
    add: function( data ){
        template = pj_users_template ;
        $.each(data, function(r, p) {
            var t = new RegExp(r, "g")
            template = String(template).replace(t, p);
        })
        $("#row_add").after(template);

        $("#btn_remove_user_" + data["#IDX#"] ).bind("click", function(){
            if( confirm( 'confirma remover esse registro' ) ){
                pj_users.remove( data["#IDX#"] );
            }
        })

    }
    , remove: function( idx ){
        $("#row_" + idx ).remove()
    }
}

