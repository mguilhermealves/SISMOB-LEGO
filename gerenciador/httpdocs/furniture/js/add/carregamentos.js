function submitData(){
   
    var membersDetails = new Array();
    var tipo = $("#tipoplanilha").val();
  
    $(".datagrid").each(function () {
        var row = $(this);
        var memberDetails = {};

        if(row.find(".selectload").is(":checked")){
                    
            memberDetails.nome = row.find(".nome").eq(0).val();
            memberDetails.email = row.find(".email").eq(0).val();
            memberDetails.cpf = row.find(".cpf").eq(0).val();
            memberDetails.regional =  row.find(".regional").eq(0).val();
            memberDetails.data =  row.find(".data").eq(0).val();
            memberDetails.vendas =  row.find(".vendas").eq(0).val();
            memberDetails.positivacao =  row.find(".positivacao").eq(0).val();
            memberDetails.exposicao_pdv =  row.find(".exposicao_pdv").eq(0).val();
            membersDetails.push(memberDetails);
        }
    });

    if(membersDetails.length > 0){
        $.ajax({
            type: "POST",
            url: $("#frm_carregamento").data('action'),
            data: { users:JSON.stringify(membersDetails),tipo:tipo},
            dataType: 'JSON',
            success: function( data ){    
		                    alert( data.mensagem ) ;
                document.location = "https://gerenciador.incentivosbiolab.com.br/carregamentos";



            },
            error:function( data ){    
                swal({
                    title: "Houve um erro no processamento",
                    type: "error",                            
                });
            }
        })
      
    }
    else{
        swal({
            title: "Selecione ao menos um registro!",
            type: "error",               
        });
    }
        

}

