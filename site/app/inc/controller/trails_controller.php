<?php
class trails_controller{
	public function treinamentos( $info ){
		$page = 'treinamentos';
			
		if( !site_controller::check_login() ){
            basic_redir($GLOBALS["home_url"]);
		}
			
        $trilhas = new trails_model();			
        $trilhas->set_filter( array( " active = 'yes' ", " trail_status = 'Publicado' " ) ) ;	
        $trilhas->set_order( array( " display_position asc " ) ) ;			
        $trilhas->load_data();
		if( !isset( $trilhas->data[0] ) ){
            basic_redir($GLOBALS["home_url"]);
		}
        else{
            $trails = $trilhas->data;
        }

        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/page/treinamentos.php");             
        include( constant("cRootServer") . "ui/common/foot.php");
        include( constant("cRootServer") . "ui/common/footer.php");
		
	}	
	public function treinamento( $info ){
		$page = 'treinamentos';
			
		if( !site_controller::check_login() ){
            basic_redir($GLOBALS["home_url"]);
		}
			
        $trilha = new trails_model();			
        $trilha->set_filter( array( " active = 'yes' ", " trail_status = 'Publicado' ", " slug = '".$info["slug"]."' " ) ) ;				
        $trilha->load_data();
        $trilha->attach(array("courses"),false," and course_status = 'Publicado' ");
		if( !isset( $trilha->data[0] ) ){
            basic_redir($GLOBALS["home_url"]);
		}
        else{
            $data = current( $trilha->data );	
        }
        
        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        
        include( constant("cRootServer") . "ui/page/treinamento.php");
                        
        include( constant("cRootServer") . "ui/common/foot.php");
        include( constant("cRootServer") . "ui/common/footer.php");
		
		
	}
}
?>