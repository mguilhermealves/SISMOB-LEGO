<?php
class banners_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
        $boiler = new banners_model();
        $boiler->set_field( array( $key , $field  ) ) ;
        $boiler->set_filter( $filters ) ;
        $boiler->set_order( array( $filed_name ) );
        $boiler->load_data();
        $out = array_column( $boiler->data , $filed_name , $key );
		return $out ;
	}

	private function filter( $info ){
	  $done = array();
	  $filter = array( " active = 'yes' "  );
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

    	list($done, $filter) = $this->filter($info);
		$banners = new banners_model();	
		if ($info["format"] != ".json") {
			$banners->set_paginate(array($info["sr"], $paginate));
		} else {
			$banners->set_paginate(array(0, 900000));
		}
		$banners->set_filter($filter);
		$banners->set_order( array( $ordenation ) ) ;
		list($total, $data) = $banners->return_data();	
		$banners->attach( array( "profiles" ) ) ;
		$data = $banners->data ; 
		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array("total" => $total), "row" => $data
					)
				);
			break;
			default:
				$page = 'Banner';
		
				$sidebar_color = "rgba(255, 235, 0, 0.92)";
				
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["banners_url"], $done) : $GLOBALS["banners_url"])
					, "pattern" => array(
						"new" => $GLOBALS["newbanner_url"], 
						"action" => $GLOBALS["banner_url"], 
						"search" => !empty($info["get"]) ? set_url( $GLOBALS["banners_url"], $info["get"] ) : $GLOBALS["trails_url"]
					)
				);

				$ordenation_name = 'name_title-asc';
				$ordenation_name_ordenation = 'fas fa-border-none';
				$ordenation_position = 'display_position-asc';
				$ordenation_position_ordenation = 'fas fa-border-none';

				switch ($ordenation) {
					case 'name asc':
						$ordenation_name = 'name-desc';
						$ordenation_name_ordenation = 'fas fa-angle-up';
					break;
					case 'name desc':
						$ordenation_name = 'name-asc';
						$ordenation_name_ordenation = 'fas fa-angle-down';
					break;
					case 'display_position asc':
						$ordenation_display_position = 'display_position-desc';
						$ordenation_display_position_ordenation = 'fas fa-angle-up';
					break;
					case 'display_position desc':
						$ordenation_display_position = 'display_position-asc';
						$ordenation_display_position_ordenation = 'fas fa-angle-down';
					break;
				}
				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/banners.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include( constant("cRootServer") . "ui/common/list_actions.php");
				include(constant("cRootServer") . "ui/common/foot.inc.php");
			break;
		}
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["slug"] ) ){
			$info["idx"] = (int)current( banners_controller::data4select("name", array("slug = '" . $info["slug"] . "' " ) , "idx" ) );
		}
		if( isset( $info["idx"] ) ){
			$banners = new banners_model();
			$banners->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$banners->load_data();
			$banners->attach(array("profiles"));
			$data = current( $banners->data );
			
			$form = array(
				"title" => "Editar Banner"
				, "url" => sprintf( $GLOBALS["banner_url"] , $info["slug"] )
			) ;
		}
		else{
			$form = array(
				"title" => "Cadastrar Banner"
				, "url" => $GLOBALS["newbanner_url"]
			) ;
		}
		$page = 'banner';
		
		$sidebar_color = "rgba(255, 235, 0, 0.92)";
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/banner.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$banners = new banners_model();
		if( isset( $info["slug"] ) ){
			$info["idx"] = (int)current( banners_controller::data4select("name", array("slug = '" . $info["slug"] . "' " ) , "idx" ) );
		}
		if( isset( $info["idx"] ) ){
			$banners->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		else{
			$info["post"]["slug"] = generate_key(10) . date("ymd");
		}

		if( isset( $_FILES[ "image" ] ) && is_file( $_FILES[ "image" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "image" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "image" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/topbanner/" . $name . $extension ;
			
            if (!file_exists(dirname(constant("cRootServer") . $file))) {
                mkdir(dirname(constant("cRootServer") . $file), true);
				chmod( dirname( constant("cRootServer") . $file )  , 0775 ) ;
            }
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "image" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["img"] = $file ;		  			
		}			
		$banners->populate( $info["post"] );
		$banners->save();

		if( !isset( $info["idx"] ) ){
			$info["idx"] = $banners->con->insert_id;
		}
		$banners->save_attach($info, array("profiles"));
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["banners_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$banners = new banners_model();
			$banners->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$banners->remove();			
		}	
		
		basic_redir( $GLOBALS["banners_url"] ) ;
	}
}
