<?php
class courses_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new courses_model();
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
		$filter = array(  "active = 'yes'" );


		if( !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) && !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
			//$done["filter_profiles"] = $info["get"]["filter_profiles"];
			$profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
			$filter["filter_profiles"] = " idx in ( select courses_profiles.courses_id from courses_profiles where courses_profiles.active = 'yes' and courses_profiles.profiles_id in ( '" . implode("','",$profiles_id) . "') ) ";
		}
		else{
			if (isset($info["get"]["filter_profiles"]) && !empty($info["get"]["filter_profiles"])) {
				$done["filter_profiles"] = $info["get"]["filter_profiles"];
				$filter["filter_profiles"] = " idx in ( select courses_profiles.courses_id from courses_profiles where courses_profiles.active = 'yes' and courses_profiles.profiles_id = '" . $info["get"]["filter_profiles"] . "' ) ";
			}
		}


		  
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
			$filter["filter_name"] = " course_title like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		if (isset($info["get"]["filter_course_status"]) && !empty($info["get"]["filter_course_status"])) {
		  $done["filter_course_status"] = $info["get"]["filter_course_status"];
		  $filter["filter_course_status"] = " course_status = '" . $info["get"]["filter_course_status"] . "' ";
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'display_position asc';
	
		list( $done , $filter ) = $this->filter( $info );
		$boiler = new courses_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( $ordenation ) ) ;
		list( $total , $data ) = $boiler->return_data();
		$done_url = rawurlencode( set_url( $GLOBALS["courses_url"] , $done ) ) ;
        $sidebar_color = "rgba(255, 147, 0, 0.82)";
		$page = "cursos";
		$form = array(
			"title" => "Listagem de Cursos"
			, "titlenew" => "Novo Curso"
			, "new" => $GLOBALS["newcourse_url"]
			, "search" => $GLOBALS["courses_url"]
			, "action" => $GLOBALS["course_url"] 
			, "section" => $GLOBALS["sections_by_course_url"] 
		) ;
		
        $ordenation_positions = 'display_position-asc';
        $ordenation_positions_ordenation = 'fas fa-border-none';
        $ordenation_course = 'course_title-asc';
        $ordenation_course_ordenation = 'fas fa-border-none';
        $ordenation_createdat = 'created_at-asc';
        $ordenation_createdat_ordenation = 'fas fa-border-none';
        $ordenation_modifiedat = 'modified_at-asc';
        $ordenation_modifiedat_ordenation = 'fas fa-border-none';
        $ordenation_course_status = 'course_status-asc';
        $ordenation_course_status_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
			case 'display_position asc':
				$ordenation_positions = 'display_position-desc';
				$ordenation_positions_ordenation = 'fas fa-angle-up';
				break;
			case 'display_position desc':
				$ordenation_positions = 'display_position-asc';
				$ordenation_positions_ordenation = 'fas fa-angle-down';
				break;
			case 'course_title asc':
				$ordenation_course = 'course_title-desc';
				$ordenation_course_ordenation = 'fas fa-angle-up';
				break;
			case 'course_title desc':
				$ordenation_course = 'course_title-asc';
				$ordenation_course_ordenation = 'fas fa-angle-down';
				break;
			case 'created_at asc':
				$ordenation_createdat = 'created_at-desc';
				$ordenation_createdat_ordenation = 'fas fa-angle-up';
				break;
			case 'created_at desc':
				$ordenation_createdat = 'created_at-asc';
				$ordenation_createdat_ordenation = 'fas fa-angle-down';
				break;
			case 'modified_at asc':
				$ordenation_modifiedat = 'modified_at-desc';
				$ordenation_modifiedat_ordenation = 'fas fa-angle-up';
				break;
			case 'modified_at desc':
				$ordenation_modifiedat = 'modified_at-asc';
				$ordenation_modifiedat_ordenation = 'fas fa-angle-down';
				break;
			case 'course_status asc':
				$ordenation_course_status = 'course_status-desc';
				$ordenation_course_status_ordenation = 'fas fa-angle-up';
				break;
			case 'course_status desc':
				$ordenation_course_status = 'course_status-asc';
				$ordenation_course_status_ordenation = 'fas fa-angle-down';
				break;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/courses.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
        $sidebar_color = "rgba(255, 147, 0, 0.82)";
		$page = "Curso";
		$data = array();
		$form = array(
			"title" => "Cadastrar Curso"
			, "url" => $GLOBALS["newcourse_url"] 
			, "done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["courses_url"] 
		);	
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");		
		$trilhas = trails_controller::data4select("idx", array(" idx > 0 "), "trail_title");
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new courses_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->attach(array("trails"),true);
			$boiler->attach(array("sections","profiles"));
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;				
			$form["title"] = "Editar Curso";
			$form["url"] = sprintf( $GLOBALS["course_url"] , $info["idx"] ) ;
		}		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/course.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
        include( constant("cRootServer") . "ui/common/list_actions.php");
		print("<script src='".constant("cFurniture")."js/courses-adm.js'></script>");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new courses_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;

		  if( empty( $info["post"]["course_duration"] ) ){
			  $info["post"]["course_duration"] = " ";
		  }
		  if( empty( $info["post"]["credits_value"] ) ){
			  $info["post"]["credits_value"] = " ";
		  }
		  if( empty( $info["post"]["credits_text"] ) ){
			  $info["post"]["credits_text"] = " ";
		  }
		}
		else{
			$info["post"]["slug"] = generate_slug( $info["post"]["course_title"] . "-" . date("Y-m-d H:i:s") );
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}


		if (isset($_FILES["thumbnail"]) && is_file($_FILES["thumbnail"]["tmp_name"])) {
            $d = preg_split("/\./", $_FILES[ "thumbnail" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
            $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "thumbnail" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;

            if (!file_exists(dirname(constant("cRootServer") . $file))) {
                mkdir(dirname(constant("cRootServer") . $file), true);
				chmod( dirname( constant("cRootServer") . $file )  , 0775 ) ;
            }
            if (file_exists(constant("cRootServer") . $file)) {
                unlink(constant("cRootServer") . $file);
            }
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"], constant("cRootServer") . $file);
            $info["post"]["course_img_url"] = $file;
        }
	
		$boiler->populate( $info["post"] );
		$boiler->save();

		if( !isset( $info["idx"] ) ){
			$info["idx"] = $boiler->con->insert_id;
		}
		
		$boiler->save_attach($info, array("trails") ,true);
		$boiler->save_attach( $info , array( "profiles" ) );

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["courses_url"] ) ;
		  }
		}
	  }
	  public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new courses_model();
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
			basic_redir( $GLOBALS["courses_url"] ) ;
		  }
		}
	  }
	  public function section_course( $info ){		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		$boiler = new courses_model();
		if( isset( $info["post"]["courses_id"] ) ){
			$info["idx"] = $info["post"]["courses_id"];
		    $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
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
			  basic_redir( $GLOBALS["courses_url"] ) ;
			}
		  }

	  }



}
