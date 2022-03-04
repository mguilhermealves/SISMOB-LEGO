$("button[id^='btnrmv_']").bind("click", function(){
    if( confirm("Deseja remover esse Participante ?") ){
        var id = String( $(this).prop("id") ).replace(/^btnrmv_/,"")
        console.log( $(this).prop("id") )
        $.ajax({
            type: "POST",
            url: 'participante/' + id
            , data: { "btn_remove": "yes" }
            ,success: function( data ){
                $("#tr_participante_" + id).remove();
            }
        })
    }
});