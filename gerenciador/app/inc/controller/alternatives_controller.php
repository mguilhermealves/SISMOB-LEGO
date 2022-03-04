<?php
class alternatives_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new alternatives_model();
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
			$filter["filter_name"] = " title like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new alternatives_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Alternativas";
		$form = array(
			"title" => "Listagem de Alternativas"
			, "titlenew" => "Nova Alternativa"
			, "new" => $GLOBALS["newalternative_url"]
			, "search" => $GLOBALS["alternative_url"]
			, "action" => set_url( $GLOBALS["alternative_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/alternatives.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Alternativa";
		$data = array();
		$form = array(
		"title" => "Cadastrar Alternativa"
		, "url" => $GLOBALS["newalternative_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["alternatives_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new alternatives_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("questions"), true);				
			$questions_id = isset( $boiler->data[0]["questions_attach"] ) ? $boiler->data[0]["questions_attach"][0]["idx"] : 0;
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Alternativa";
			$form["url"] = sprintf( $GLOBALS["alternative_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/alternative.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new alternatives_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["title"] );
		$boiler->populate( $info["post"] );		
		$boiler->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach($info, array("questions"), true);

		if( isset( $info["post"]["action_js"] ) ){
			foreach( $info["post"]["action_js"] as $v ){
				$_SESSION["action_js"][] = base64_decode( $v );
			}
		}
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){						
			basic_redir( $info["post"]["done"] ) ;
			
			//basic_redir( sprintf($GLOBALS["question_url"] , $info["post"]["questions_id"])  ) ;
			
		  }
		  else{
			basic_redir( $GLOBALS["questions_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$boiler = new alternatives_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$boiler->remove();			
		}	
		if( isset( $info["post"]["action_js"] ) ){
			foreach( $info["post"]["action_js"] as $v ){
				$_SESSION["action_js"][] = base64_decode( $v );
			}
		}
		if( isset( $info["post"]["no-redirect"] ) ){
			print("ok");
		}
		else{
			if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
			}
			else{
			basic_redir( $GLOBALS["alternatives_url"] ) ;
			}
		}
	}
	public static function display_in( ){			
		$boiler = new alternatives_model();
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		return $data;
	}

	public function formnew( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$questions_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;
		$page = "Alternativa";
		$data = array();
		$form = array(
		"title" => "Cadastrar Alternativa"
		, "url" => $GLOBALS["newalternativesave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["questions_url"] , $info["get"] );

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/alternative.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public static function display_in_questions_tab($info){			
		
		$question = new questions_model();
		$question->set_filter( array( " idx = '" .$info["question_id"]. "'" ) ) ;
		$question->load_data();
		$question->attach(array("alternatives"));
		$alternatives_questions = $question->data;		
		return $alternatives_questions;
	}
	public static function form_modal( $key ){
		$boiler = new alternatives_model();
		$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
		$boiler->load_data();
		$boiler->set_paginate( array(1) ) ;
		$data = current( $boiler->data ) ;
		return $data;
	}

}
