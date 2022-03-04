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
			$_SESSION["messages_app"]["info"] = array("Informe sua nova senha");
			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/page/senha.php");
		}
		else{
			$_SESSION["messages_app"]["warning"] = array("URL não encontrado ou desabilitado");
			basic_redir( $GLOBALS["home_url"] );
			exit();
		}
	}
	public function renew( $info ){
        $boiler = new tokens_model();
        $boiler->set_filter( array(  " name = '" . $boiler->con->real_escape_string( $info["key"] ) . "' " ) ) ;
        $boiler->load_data();
		if( isset( $boiler->data[0] ) && !empty( $info["post"]["password"] ) ){
			$boiler->attach( array("users") , true , null , array( " idx " ) );
			if( isset( $boiler->data[0]["users_attach"][0] ) ){
				$boiler->con->update(" password = md5('" . $boiler->con->real_escape_string( $info["post"]["password"] ) . "') , modified_at = now() , modified_by = idx " , " users " , " where idx = '" . $boiler->data[0]["users_attach"][0]["idx"] . "' limit 1" ) ;
				$boiler->con->update(" active = 'no', removed_at = now() , removed_by = " . $boiler->data[0]["users_attach"][0]["idx"] . " " , " tokens " , " where idx = '" . $boiler->data[0]["idx"] . "' limit 1" ) ;
				$_SESSION["messages_app"]["info"] = array("Senha Alterada com sucesso");
			}
			else{
				$_SESSION["messages_app"]["danger"] = array("Problemas ao tentar salvar a nova senha, solicite novo link para definir a senha");
			}
			basic_redir( $GLOBALS["home_url"] );
			exit();
		}
		$_SESSION["messages_app"]["warning"] = array("Não conseguimos processar a informação tente novamente");
		basic_redir( sprintf( $GLOBALS["tkpwd_url"] , $info["key"] ) );
		exit();
	}
}
