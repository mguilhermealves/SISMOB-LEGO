<?php
class surveyalternatives_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new surveyalternatives_model();
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
		$boiler = new surveyalternatives_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Alternativas";
		$form = array(
			"title" => "Listagem de Alternativas"
			, "titlenew" => "Nova Alternativa"
			, "new" => $GLOBALS["newsurveyalternative_url"]
			, "search" => $GLOBALS["surveyalternative_url"]
			, "action" => set_url( $GLOBALS["surveyalternative_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyalternatives.php");
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
		, "url" => $GLOBALS["newsurveyalternative_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["surveyalternatives_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new surveyalternatives_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("surveyquestions"), true);				
			$surveyquestions_id = isset( $boiler->data[0]["surveyquestions_attach"] ) ? $boiler->data[0]["surveyquestions_attach"][0]["idx"] : 0;
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Alternativa";
			$form["url"] = sprintf( $GLOBALS["surveyalternative_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyalternative.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new surveyalternatives_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["title"] );
		$boiler->populate( $info["post"] );		
		$boiler->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach($info, array("surveyquestions"), true);

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){						
			basic_redir( $info["post"]["done"] ) ;
			// basic_redir( sprintf($GLOBALS["surveyquestion_url"] , $info["post"]["surveyquestions_id"])  ) ;
			
		  }
		  else{
			basic_redir( $GLOBALS["surveyquestions_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$boiler = new surveyalternatives_model();
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
			basic_redir( $GLOBALS["surveyalternatives_url"] ) ;
			}
		}
	}
	public static function display_in( ){			
		$boiler = new surveyalternatives_model();
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		return $data;
	}

	public function formnew( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$surveyquestions_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;
		$page = "Alternativa";
		$data = array();
		$form = array(
		"title" => "Cadastrar Alternativa"
		, "url" => $GLOBALS["newsurveyalternativesave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["surveyquestions_url"] , $info["get"] );

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyalternative.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public static function display_in_surveyquestions_tab($info){			
		
		$surveyquestion = new surveyquestions_model();
		$surveyquestion->set_filter( array( " idx = '" .$info["surveyquestion_id"]. "'" ) ) ;
		$surveyquestion->load_data();
		$surveyquestion->attach(array("surveyalternatives"));
		$surveyalternatives_surveyquestions = $surveyquestion->data;			
		return $surveyalternatives_surveyquestions;
	}
	public static function form_modal( $key ){
		$boiler = new surveyalternatives_model();
		$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
		$boiler->load_data();
		$boiler->set_paginate( array(1) ) ;
		$data = current( $boiler->data ) ;
		return $data;
	}

}
