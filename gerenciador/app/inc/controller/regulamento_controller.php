<?php
class regulamento_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$regulamento = new regulamento_model();
		$regulamento->set_field( array( $key , $field  ) ) ;
		$regulamento->set_filter( $filters ) ;
		$regulamento->load_data();
		$out = array();
		foreach( $regulamento->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$regulamento = new regulamento_model();
			$regulamento->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$regulamento->load_data();
			$data = current( $regulamento->data );
			
			$form = array(
				"url" => $GLOBALS["management_rules_url"] 
			) ;
		}
		
		$page = 'Regulamento';
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/regulamento.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$regulamento = new regulamento_model();
		if( isset( $info["idx"] ) ){
			$regulamento->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		
		$regulamento->populate( $info["post"] );
		$regulamento->save();
		basic_redir( $GLOBALS["management_rules_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$regulamento = new regulamento_model();
			$regulamento->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$regulamento->remove();			
		}	
		
		basic_redir( $GLOBALS["management_rules_url"] ) ;
	}
}
