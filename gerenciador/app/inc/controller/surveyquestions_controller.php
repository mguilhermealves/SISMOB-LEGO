<?php
class surveyquestions_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new surveyquestions_model();
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
		$boiler = new surveyquestions_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Questões";
		$form = array(
			"title" => "Listagem de Questões"
			, "titlenew" => "Nova Questão"
			, "new" => $GLOBALS["newsurveyquestion_url"]
			, "search" => $GLOBALS["surveyquestion_url"]
			, "action" => set_url( $GLOBALS["surveyquestion_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyquestions.php");
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
		"title" => "Cadastrar Questão"
		, "url" => $GLOBALS["newsurveyquestion_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["surveyquestions_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new surveyquestions_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("surveys"), true);
			$boiler->attach(array("surveyalternatives"), false);				
			$surveys_id = isset( $boiler->data[0]["surveys_attach"] ) ? $boiler->data[0]["surveys_attach"][0]["idx"] : 0;
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Questão";
			$form["url"] = sprintf( $GLOBALS["surveyquestion_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyquestion.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new surveyquestions_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["title"] );
		$boiler->populate( $info["post"] );		
		$boiler->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;
		}
		$boiler->save_attach($info, array("surveys"), true);

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){						
			basic_redir( $info["post"]["done"] ) ;
			//basic_redir( sprintf($GLOBALS["survey_url"] , $info["post"]["surveys_id"])  ) ;
			
		  }
		  else{
			basic_redir( $GLOBALS["surveys_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$boiler = new surveyquestions_model();
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
			basic_redir( $GLOBALS["surveyquestions_url"] ) ;
			}
		}
	}
	public static function display_in( ){			
		$boiler = new surveyquestions_model();
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		return $data;
	}

	public function formnew( $info ){			
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$surveys_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;
		$page = "Questão";
		$data = array();
		$form = array(
		"title" => "Cadastrar Questão"
		, "url" => $GLOBALS["newsurveyquestionsave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["surveys_url"] , $info["get"] );

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveyquestion.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public static function display_in_surveys_tab($info){					
		$survey = new surveys_model();
		$survey->set_filter( array( " idx = '" .$info["survey_id"]. "'" ) ) ;
		$survey->load_data();
		$survey->attach(array("surveyquestions"));
		$surveyquestions_survey = $survey->data;		
		return $surveyquestions_survey;
	}
	public static function form_modal( $key ){
		$boiler = new surveyquestions_model();
		$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
		$boiler->load_data();
		$boiler->set_paginate( array(1) ) ;
		$data = current( $boiler->data ) ;
		return $data;
	}

}
