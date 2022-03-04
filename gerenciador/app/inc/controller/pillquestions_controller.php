<?php
class pillquestions_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new pillquestions_model();
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
		$filter = array( " idx > 0 ",  "active = 'yes'" );
		if( isset( $info["get"]["filter_name"] ) && !empty( $info["get"]["filter_name"] ) ){
			$done["filter_name"] = $info["get"]["filter_name"] ;
			$filter["filter_name"] = " text like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new pillquestions_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " text asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Questões";
		$form = array(
			"title" => "Listagem de Questões"
			, "titlenew" => "Nova Questão"
			, "new" => $GLOBALS["newpillquestion_url"]
			, "search" => $GLOBALS["pillquestion_url"]
			, "action" => set_url( $GLOBALS["pillquestion_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/pillquestions.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Questão";
		$data = array();
		$form = array(
		"title" => "Cadastrar Alternativa"
		, "url" => $GLOBALS["newpillquestion_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["pills_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		$sidebar_color = "rgba(255, 147, 0, 0.82)";
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new pillquestions_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("pills"), true);				
			$pills_id = isset( $boiler->data[0]["pills_attach"] ) ? $boiler->data[0]["pills_attach"][0]["idx"] : 0;
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;

			$pills_id = isset( $data["pills_attach"][0] ) && (int)$data["pills_attach"][0]["idx"] > 0 ? $data["pills_attach"][0]["idx"] : 0;

			$info["get"]["done"] = sprintf( $GLOBALS["pill_url"] , $pills_id ) ;
			$form["title"] = "Editar Alternativa";
			$form["url"] = sprintf( $GLOBALS["pillquestion_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/pillquestion.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new pillquestions_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		else{
			$info["post"]["slug"] = generate_slug( $info["post"]["text"] );
		}
		$boiler->populate( $info["post"] );		
		$boiler->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach($info, array("pills"), true);

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){						
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			  if(isset($info["post"]["pills_id"])){
				basic_redir( sprintf( $GLOBALS["pill_url"] , $info["post"]["pills_id"])  ) ;
			  }
			  else{
				basic_redir( $GLOBALS["pills_url"] ) ;
			  }
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$boiler = new pillquestions_model();
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
			basic_redir( $GLOBALS["pillquestions_url"] ) ;
			}
		}
	}
	public static function display_in( ){			
		$boiler = new pillquestions_model();
		$boiler->set_order( array( " text asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		return $data;
	}

	public function formnew( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$pills_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;
		$page = "Alternativa";
		$data = array();
		$form = array(
			"title" => "Cadastrar Alternativa"
			, "url" => $GLOBALS["newpillquestionsave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["pills_url"] , $info["get"] );
		$sidebar_color = "rgba(255, 147, 0, 0.82)";

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/pillquestion.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}

}
