<?php
class pills_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new pills_model();
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
			$filter["filter_name"] = " pill_title like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'pill_title asc';

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new pills_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( $ordenation ) ) ;
		list( $total , $data ) = $boiler->return_data();
		$page = "Pílulas";
		$form = array(
			
			"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["pills_url"], $done) : $GLOBALS["pills_url"])
			, "title" => "Listagem de Pílulas"
			, "titlenew" => "Nova Pílula"
			, "new" => $GLOBALS["newpill_url"]
			, "search" => $GLOBALS["pills_url"]
			, "action" => set_url( $GLOBALS["pill_url"] , $done )
		) ;
        $ordenation_pill_title = 'pill_title-asc';
        $ordenation_pill_title_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
          case 'pill_title asc':
            $ordenation_pill_title = 'pill_title-desc';
            $ordenation_pill_title_ordenation = 'fas fa-angle-up';
            break;
          case 'pill_title desc':
            $ordenation_pill_title = 'pill_title-asc';
            $ordenation_pill_title_ordenation = 'fas fa-angle-down';
            break;
		}
		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/pills.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Pílula";
		$data = array();
		$form = array(
		"title" => "Cadastrar Pílula"
		, "url" => $GLOBALS["newpill_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["pills_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		$total = 0 ;
		$paginate = 5000;
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new pills_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("pillquestions","profiles"));
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;

			$total = count( $data["pillquestions_attach"] );

			$form["title"] = "Editar Pílula";
			$form["url"] = sprintf( $GLOBALS["pill_url"] , $info["idx"] ) ;
		}
		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/pill.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new pills_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		else{
			$info["post"]["slug"] = generate_slug( $info["post"]["pill_title"] ) . generate_key(15) ;
		}

		if( isset( $info["post"]["pill_start_date"] ) && isset( $info["post"]["pill_start_hour"] ) ){
			$info["post"]["pill_start_date"] = $info["post"]["pill_start_date"] . " " . $info["post"]["pill_start_hour"] ;
		} 
		if( isset( $info["post"]["pill_end_date"] ) && isset( $info["post"]["pill_end_hour"] ) ){
			$info["post"]["pill_end_date"] = $info["post"]["pill_end_date"] . " " . $info["post"]["pill_end_hour"] ;
		}

		$boiler->populate( $info["post"] );
		$boiler->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach($info, array("profiles") );

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			//basic_redir( $info["post"]["done"] ) ;
			basic_redir( $GLOBALS["pills_url"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["pills_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new pills_model();
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
			basic_redir( $GLOBALS["pills_url"] ) ;
		  }
		}
	  }
}
