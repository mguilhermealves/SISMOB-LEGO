<?php
class feira_madrugada_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$feira_madrugada = new feira_madrugada_model();
		$feira_madrugada->set_field( array( $key , $field  ) ) ;
		$feira_madrugada->set_filter( $filters ) ;
		$feira_madrugada->load_data();
		$out = array();
		foreach( $feira_madrugada->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$feira_madrugada = new feira_madrugada_model();
			$feira_madrugada->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$feira_madrugada->load_data();
			$data = current( $feira_madrugada->data );
			
			$form = array(
				"url" => sprintf( $GLOBALS["feira_madrugada_url"] , $info["idx"] )
			) ;
		}
		
		$page = 'feira_madrugada';
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/feira_madrugada.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$feira_madrugada = new feira_madrugada_model();
		if( isset( $info["idx"] ) ){
			$feira_madrugada->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		
		if( isset( $_FILES[ "imagem" ] ) && is_file( $_FILES[ "imagem" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem"] = $file ;
		  	
		
		}	
		#print("aguarde...");
		#print( count( $info["post"]["categories"]  ) );
		#exit();			
		$feira_madrugada->populate( $info["post"] );
		$feira_madrugada->save();
		basic_redir( $GLOBALS["feira_madrugada_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$feira_madrugada = new feira_madrugada_model();
			$feira_madrugada->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$feira_madrugada->remove();			
		}	
		
		basic_redir( $GLOBALS["feira_madrugada_url"] ) ;
	}
}
