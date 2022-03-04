<?php
class users_controller{

	public function meu_cadastro( $info ){
		$page = 'meu_cadastro';       
		if( site_controller::check_login() ){
	
			$user = new users_model();
			$user->set_filter( array( " active = 'yes' ", " idx = '".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]."' " ) ) ;			
			$user->load_data();
            $user->attach(array("profiles"));
            

			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");
			include( constant("cRootServer") . "ui/page/meu_cadastro.php");		
			include( constant("cRootServer") . "ui/common/foot.php");
			include( constant("cRootServer") . "ui/common/footer.php");
		
		}
		
	}

    public function meu_cadastro_salvar($info){
        if( site_controller::check_login() ){

            $user = new users_model();
			$user->set_filter( array( " active = 'yes' ", " idx = '".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]."' " ) ) ;
            

            if( isset( $_FILES[ "image" ] ) && is_file( $_FILES[ "image" ]["tmp_name"] ) ){
                $d = preg_split("/\./", $_FILES[ "image" ]["name"] ) ;
                $extension = $d[ count( $d ) - 1 ];
                $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "image" ]["name"]  ) )  ;
                $extension = date("YmdHis") . "." . $extension;
                $file = "furniture/upload/images/" . $name . $extension ;
                
                if( file_exists( constant("cRootServer") . $file ) ){
                    unlink( constant("cRootServer") . $file );
                }
                move_uploaded_file( $_FILES[ "image" ]["tmp_name"] , constant("cRootServer") . $file );
                $info["post"]["image"] = $file ;	
                $_SESSION[ constant("cAppKey") ]["credential"]["image"] =  $file ;	  			
            }	

            $user->populate($info["post"]);
            $user->save();

            basic_redir( $GLOBALS["meu_cadastro_url"] ) ;
        }
    }

}
?>