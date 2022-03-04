<?php
class surveys_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new surveys_model();
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
		$boiler = new surveys_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Pesquisas";
		$form = array(
			"title" => "Listagem de Pesquisas"
			, "titlenew" => "Nova Pesquisa"
			, "new" => $GLOBALS["newsurvey_url"]
			, "search" => $GLOBALS["surveys_url"]
			, "action" => set_url( $GLOBALS["survey_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/surveys.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Pesquisa";
		$data = array();
		$form = array(
		"title" => "Cadastrar Pesquisa"
		, "url" => $GLOBALS["newsurvey_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["surveys_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new surveys_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("surveyquestions"));
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Pesquisa";
			$form["url"] = sprintf( $GLOBALS["survey_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/survey.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){			
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new surveys_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["title"] );
		$boiler->populate( $info["post"] );
		$boiler->save();
		if( !isset( $info["idx"] ) ){
			$info["idx"] = $boiler->con->insert_id;
		}	
		$boiler->save_attach($info, array("sections"));

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
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
		  $boiler = new surveys_model();
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
			basic_redir( $GLOBALS["surveys_url"] ) ;
		  }
		}
	  }
	  public static function display_in_section($info){			

		$section = new sections_model();
		$section->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
		$section->load_data();
		$section->attach(array("surveys"),true);
		$section_surveys = $section->data;
		
		return $section_surveys;
	}
	public static function form_modal( $key ){
			$boiler = new surveys_model();
			$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
			$boiler->load_data();
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			return $data;
	}
}
