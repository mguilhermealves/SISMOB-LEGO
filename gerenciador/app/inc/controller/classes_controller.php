<?php
class classes_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new classes_model();
		$boiler->set_field( array( $key , $field  ) ) ;
		$boiler->set_filter( $filters ) ;
		$boiler->load_data();
		$out = array();
		foreach( $boiler->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	private function filter( $info ){
		$done = array();
		$filter = array( "active = 'yes'" );
		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
		  $done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
		  $done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}
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
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'name asc';
	
		list( $done , $filter ) = $this->filter( $info );
		$boiler = new classes_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " name asc " ) ) ;
		list( $total , $data ) = $boiler->return_data();
        $sidebar_color = "rgba(255, 147, 0, 0.82)";
		$page = "turmas";
		$form = array(
			"title" => "Listagem de Turma"
			, "titlenew" => "Nova Turma"
			, "new" => $GLOBALS["newclasse_url"]
			, "search" => $GLOBALS["classes_url"]
			, "action" => set_url( $GLOBALS["classe_url"] , $done )
		) ;
        $ordenation_name = 'name-asc';
        $ordenation_name_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
			case 'name asc':
				$ordenation_name = 'name-desc';
				$ordenation_name_ordenation = 'fas fa-angle-up';
				break;
			case 'name desc':
				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fas fa-angle-down';
				break;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/classes.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
        $sidebar_color = "rgba(255, 147, 0, 0.82)";
		$page = "Turma";
		$data = array();
		$form = array(
			"title" => "Cadastrar Turma"
			, "url" => $GLOBALS["newclasse_url"] 
		);
		//$info["get"]["done"] =  set_url( $GLOBALS["classes_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new classes_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->set_paginate( array(1) ) ;
			$boiler->load_data();
			//$boiler->attach(array("profiles"));

			$data = current( $boiler->data ) ;

			$form["title"] = "Editar Turma";
			$form["url"] = sprintf( $GLOBALS["classe_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/classe.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new classes_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["name"] );
		$boiler->populate( $info["post"] );
		$boiler->save();
		
		if( !isset( $info["idx"] ) ){
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach( $info , array( "profiles" ) );

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["classes_url"] ) ;
		  }
		}
	  }
	  public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new classes_model();
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
			basic_redir( $GLOBALS["classes_url"] ) ;
		  }
		}
	  }
}
