<?php
class tokens_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$tokens = new tokens_model();
		$tokens->set_field( array( $key , $field  ) ) ;
        $tokens->set_filter( $filters ) ;
        $tokens->load_data();
        $out = array();
		foreach( $tokens->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function display( $info ){
        $boiler = new tokens_model();
        $boiler->set_filter( array(  " name = '" . $boiler->con->real_escape_string( $info["key"] ) . "'" ) ) ;
        $boiler->load_data();
		if( isset( $boiler->data[0] ) ){
			include( constant("cRootServer") . "ui/common/header.inc.php");
			include( constant("cRootServer") . "ui/common/head.inc.php");
            include( constant("cRootServer") . "ui/page/newpwd.php");
			include( constant("cRootServer") . "ui/common/footer.inc.php");
			print("<script>");
			include( constant("cRootServer") . "furniture/js/newpwd.js");
			print("</script>");
			include( constant("cRootServer") . "ui/common/foot.inc.php");
		}
		else{
			site_controller::error( 
				array( 
					"title" => "Error"
					, "msg" => "O link não foi encontrado, solicite novo link para definir a senha" 
					, "done" => $GLOBALS["home_url"]
				) 
			);
		}
	}
	public function renew( $info ){
        $boiler = new tokens_model();
        $boiler->set_filter( array(  " name = '" . $boiler->con->real_escape_string( $info["key"] ) . "' " ) ) ;
        $boiler->load_data();
		if( isset( $boiler->data[0] ) ){
			$boiler->attach( array("users") , true , null , array( " idx " ) );
			if( isset( $boiler->data[0]["users_attach"][0] ) ){
				$boiler->con->update(" password = md5('" . $boiler->con->real_escape_string( $info["post"]["password"] ) . "') , modified_at = now() , modified_by = idx " , " users " , " where idx = '" . $boiler->data[0]["users_attach"][0]["idx"] . "' limit 1" ) ;
				$boiler->con->update(" active = 'no', removed_at = now() , removed_by = " . $boiler->data[0]["users_attach"][0]["idx"] . " " , " tokens " , " where idx = '" . $boiler->data[0]["idx"] . "' limit 1" ) ;
				site_controller::error( 
					array( 
						"title" => "Senha Alterada"
						, "msg" => "A senha foi definida" 
						, "done" => $GLOBALS["home_url"]
					) 
				);
				exit();
			}
			else{
				site_controller::error( 
					array( 
						"title" => "Error"
						, "msg" => "Problemas ao tentar salvar a nova senha, solicite novo link para definir a senha" 
						, "done" => $GLOBALS["home_url"]
					) 
				);
			}
		}
	}
}
