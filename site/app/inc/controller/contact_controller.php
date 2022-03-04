<?php
class contact_controller{
	public function contatos( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}
		$page = 'contatos';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
								
		
		include( constant("cRootServer") . "ui/page/contatos.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
		
	}
	public function save( $info ){
        $obj = array();
        $translate = array(
            "nome" => "name"
            , "celular" => "telephone"
            , "mensagem" => "message"
        ) ;
		foreach($info["post"]["body"] as $body){
			$obj[ strtr( $body["name"] , $translate ) ] = $body["value"];
		}		
        $contacts = new contacts_model();		
        $contacts->populate( $obj ) ;
        $contacts->save();

        echo json_encode([
            "alert" => "alert-success",
            "message" => "Contato enviado com sucesso!"
        ]);

            
        // if(site_controller::validateRecaptcha($obj)){
        //     $contacts = new contacts_model();		
        //     $contacts->populate( $obj ) ;
        //     $contacts->save();

        //     echo json_encode([
        //         "alert" => "alert-success",
        //         "message" => "Contato enviado com sucesso!"
        //     ]);

        // }else{

        //     echo json_encode([
        //         "alert" => "alert-danger",
        //         "message" => "Houve um erro ao enviar, tente novamente!"
        //     ]);

        // }
		
    }
}
?>