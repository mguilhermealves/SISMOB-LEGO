$("#frm_pwd").submit( function(){
    if( String( $('input[type="password"][name="password"]').val() ).replace(/[^a-z0-9]+?/gim,"") == "" ){
        alert("Necessário informar o campo senha");
        return false;
    }
    if( String( $('input[type="password"][name="confirm-password"]').val() ).replace(/[^a-z0-9]+?/gim,"")  == "" ){
        alert("Necessário informar o campo confirmação de senha");
        return false;
    }
    if( $('input[type="password"][name="password"]').val() != $('input[type="password"][name="confirm-password"]').val() ){
        alert("O campo senha e confirmação de senha precisa ser iguais");
        return false;
    }
})