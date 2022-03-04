<?php
class questions_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new questions_model();
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
		$boiler = new questions_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Questões";
		$form = array(
			"title" => "Listagem de Questões"
			, "titlenew" => "Nova Questão"
			, "new" => $GLOBALS["newquestion_url"]
			, "search" => $GLOBALS["question_url"]
			, "action" => set_url( $GLOBALS["question_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/questions.php");
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
		, "url" => $GLOBALS["newquestion_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["questions_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new questions_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("tests"), true);
			$boiler->attach(array("alternatives"), false);				
			$tests_id = isset( $boiler->data[0]["tests_attach"] ) ? $boiler->data[0]["tests_attach"][0]["idx"] : 0;
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Questão";
			$form["url"] = sprintf( $GLOBALS["question_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/question.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new questions_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["title"] );
		$boiler->populate( $info["post"] );		
		$boiler->save();
		$dicotomia = false ;
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $boiler->con->insert_id;	
			if( $info["post"]["type"] == "dicotomia" ){
				$dicotomia = true ;
			}
		}

		$boiler->save_attach($info, array("tests"), true);

		if( isset( $info["post"]["action_js"] ) ){
			foreach( $info["post"]["action_js"] as $v ){
				$_SESSION["action_js"][] = base64_decode( $v );
			}
		}
		
		if( $dicotomia ){
			$alternatives = new alternatives_controller();
			ob_start();
			$ret_sim = $alternatives->save( 
				array( 
					"post" => array(
						"no-redirect" => "true"
						, "sections_id" => $info["post"]["sections_id"]
						, "tests_id" => $info["post"]["tests_id"]
						, "questions_id" => $info["idx"]
						, "display_position" => "1"
						, "is_correct" => "yes"
						, "title" => "Sim"
					) 
				) 
			);
			$ret_nao = $alternatives->save( 
				array( 
					"post" => array(
						"no-redirect" => "true"
						, "sections_id" => $info["post"]["sections_id"]
						, "tests_id" => $info["post"]["tests_id"]
						, "questions_id" => $info["idx"]
						, "display_position" => "2"
						, "title" => "Não"
					) 
				) 
			);
			ob_clean();
		}
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
			if( isset( $info["post"]["done"] ) ){
				basic_redir( $info["post"]["done"] ) ;
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
			$boiler = new questions_model();
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
			basic_redir( $GLOBALS["questions_url"] ) ;
			}
		}
	}
	public static function display_in( ){			
		$boiler = new questions_model();
		$boiler->set_order( array( " title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		return $data;
	}

	public function formnew( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}

		$tests_id = isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $info["idx"] : 0;
		$page = "Questão";
		$data = array();
		$form = array(
		"title" => "Cadastrar Questão"
		, "url" => $GLOBALS["newquestionsave_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["tests_url"] , $info["get"] );

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/question.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public static function display_in_tests_tab($info){			
		
		$test = new tests_model();
		$test->set_filter( array( " idx = '" .$info["test_id"]. "'" ) ) ;
		$test->load_data();
		$test->attach(array("questions"));
		$questions_test = $test->data;		
		return $questions_test;
	}
	public static function form_modal( $key ){
		$boiler = new questions_model();
		$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
		$boiler->load_data();
		$boiler->set_paginate( array(1) ) ;
		$data = current( $boiler->data ) ;
		return $data;
	}

}
