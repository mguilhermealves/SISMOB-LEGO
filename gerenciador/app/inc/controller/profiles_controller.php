<?php
class profiles_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new profiles_model();
		$boiler->set_field( array( $key , $field  ) ) ;
		$boiler->set_filter( $filters ) ;
		$boiler->set_order( array( $field . " asc " ) ) ;
		$boiler->load_data();
		$out = array();
		foreach( $boiler->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	private function filter( $info ){
		$done = array();
		$filter = array( " idx > 0 ",  "active = 'yes'" );
		if( isset( $info["get"]["filter_name"] ) && !empty( $info["get"]["filter_name"] ) ){
			$done["filter_name"] = $info["get"]["filter_name"] ;
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new profiles_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " name asc " ) ) ;
		list( $total , $data ) = $boiler->return_data();
		$page = "Perfil";
		$form = array(
			"title" => "Listagem de Perfis"
			, "titlenew" => "Novo Perfil"
			, "new" => $GLOBALS["newprofile_url"]
			, "search" => $GLOBALS["profiles_url"]
			, "action" => set_url( $GLOBALS["profile_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/profiles.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Perfil";
		$data = array();
		$form = array(
		"title" => "Cadastrar Perfil"
		, "url" => $GLOBALS["newprofile_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["profiles_url"] , $info["get"] );
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new profiles_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Perfil";
			$form["url"] = sprintf( $GLOBALS["profile_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/profile.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new profiles_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		else{
			$info["post"]["slug"] = generate_slug( $info["post"]["name"] ) . generate_key(5);
		}
		$boiler->populate( $info["post"] );
		$boiler->save();
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["profiles_url"] ) ;
		  }
		}
	  }
	  public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new profiles_model();
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		  $boiler->remove();			
		}	
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["profiles_url"] ) ;
		  }
		}
	  }
}
