<?php
class lessons_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$boiler = new lessons_model();
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
			$filter["filter_name"] = " lessons_title like '%" . $info["get"]["filter_name"] . "%' " ;
		}
		return array( $done , $filter ) ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

		list( $done , $filter ) = $this->filter( $info );
		$boiler = new lessons_model();
		$boiler->set_filter( $filter ) ;
		$boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
		$boiler->set_order( array( " lessons_title asc " ) ) ;
		list( $recordset , $data ) = $boiler->return_data();
		$page = "Aulas";
		$form = array(
			"title" => "Listagem de Aulas"
			, "titlenew" => "Nova Aula"
			, "new" => $GLOBALS["newlesson_url"]
			, "search" => $GLOBALS["lessons_url"]
			, "action" => set_url( $GLOBALS["lesson_url"] , $done )
		) ;
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/lessons.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/list_actions.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){	
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = "Aula";
		$data = array();
		$form = array(
		"title" => "Cadastrar Aula"
		, "url" => $GLOBALS["newlesson_url"] 
		);
		$info["get"]["done"] =  set_url( $GLOBALS["lessons_url"] , $info["get"] );
		$users_lists =  users_controller::data4select("idx", array(" idx > 0 "), "first_name");
		
		if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
			$boiler = new lessons_model();
			$boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
			$boiler->load_data();
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;
			$form["title"] = "Editar Aula";
			$form["url"] = sprintf( $GLOBALS["lesson_url"] , $info["idx"] ) ;
		}
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/lesson.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function save( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new lessons_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		else{
			$info["post"]["slug"] = generate_slug( $info["post"]["lessons_title"] ) . generate_key(4) . date("ymd");
		}
		if (isset($_FILES["lessons_content_file"]) && is_file($_FILES["lessons_content_file"]["tmp_name"])) {
            $d = preg_split("/\./", $_FILES[ "lessons_content_file" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
            $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "lessons_content_file" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;

			switch( $info["post"]["lessons_type"] ){
				case "pdf":
					$file = "furniture/upload/pdf/" . $name . $extension ;
					if (!file_exists(dirname(constant("cRootServer") . "furniture/upload/pdf/" ))) {
						mkdir(dirname(constant("cRootServer") . "furniture/upload/pdf/" ), true);
						chmod( dirname( constant("cRootServer") . "furniture/upload/pdf/"  )  , 0775 ) ;
					}
				break;
				case "imagem":
					$file = "furniture/upload/images/" . $name . $extension ;
					if (!file_exists(dirname(constant("cRootServer") . "furniture/upload/images/" ))) {
						mkdir(dirname(constant("cRootServer") . "furniture/upload/images/" ), true);
						chmod( dirname( constant("cRootServer") . "furniture/upload/images/"  )  , 0775 ) ;
					}
				break;
				case "planilhaexcel":
					$file = "furniture/upload/xls/" . $name . $extension ;
					if (!file_exists(dirname(constant("cRootServer") . "furniture/upload/xls/" ))) {
						mkdir(dirname(constant("cRootServer") . "furniture/upload/xls/" ), true);
						chmod( dirname( constant("cRootServer") . "furniture/upload/xls/"  )  , 0775 ) ;
					}
				break;
				case "powerpoint":
					$file = "furniture/upload/ppt/" . $name . $extension ;
					if (!file_exists(dirname(constant("cRootServer") . "furniture/upload/ppt/" ))) {
						mkdir(dirname(constant("cRootServer") . "furniture/upload/ppt/" ), true);
						chmod( dirname( constant("cRootServer") . "furniture/upload/ppt/"  )  , 0775 ) ;
					}
				break;
				case "tincan":
					$file = "furniture/upload/tincan/" . $name . $extension ;
					if (!file_exists(dirname(constant("cRootServer") . "furniture/upload/tincan/" ))) {
						mkdir(dirname(constant("cRootServer") . "furniture/upload/tincan/" ), true);
						chmod( dirname( constant("cRootServer") . "furniture/upload/tincan/"  )  , 0775 ) ;
					}
				break;
			}
            if (!file_exists(dirname(constant("cRootServer") . $file))) {
                mkdir(dirname(constant("cRootServer") . $file), true);
				chmod( dirname( constant("cRootServer") . $file )  , 0775 ) ;
            }
            if (file_exists(constant("cRootServer") . $file)) {
                unlink(constant("cRootServer") . $file);
            }
            move_uploaded_file($_FILES["lessons_content_file"]["tmp_name"], constant("cRootServer") . $file);
			$info["post"]["lessons_content_url"] = $file ;
            if ($info["post"]["lessons_type"] == "tincan") {
				$zip = new ZipArchive;
				$zip_path = constant("cRootServer") . $file ;
				$res = $zip->open( $zip_path );
				if ($res === TRUE) {
					$zip_path = preg_replace("/" . $name . $extension . "$/" , "" ,  $zip_path ) . generate_key(50);
					$zip->extractTo($zip_path);
					$zip->close();
				}
				unlink( constant("cRootServer") . $file );
				$it = new RecursiveDirectoryIterator( $zip_path );
				foreach(new RecursiveIteratorIterator($it) as $file_in){
					if ( strtolower( preg_replace('/(.+)(res\/index.html)$/',"$2",$file_in) ) == 'res/index.html'  ){
						$info["post"]["lessons_content_url"] = str_replace(constant("cRootServer") ,'', $file_in ) ;
					}
				}
			}
        }
		$boiler->populate( $info["post"] );
		$boiler->save();
		if( !isset( $info["idx"] ) ){
			$info["idx"] = $boiler->con->insert_id;
		}	
		$boiler->save_attach($info, array("sections"), true);

		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["lessons_url"] ) ;
		  }
		}
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
		  $boiler = new lessons_model();
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
			basic_redir( $GLOBALS["lessons_url"] ) ;
		  }
		}
	}
	public static function display_in_section($info){			

		$section = new sections_model();
		$section->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
		$section->load_data();
		$section->attach(array("lessons"));
		$section_lessons = $section->data;
		
		return $section_lessons;
	}
	public static function save_in_section( $info ){	
		
		if( ! site_controller::check_login() ){
		  basic_redir( $GLOBALS["home_url"] ) ;
		}
		$boiler = new lessons_model();
		if( isset( $info["idx"] ) ){
		  $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		$info["post"]["slug"] = generate_slug( $info["post"]["lessons_title"] );
		$boiler->populate( $info["post"] );
		$boiler->save();
		if( isset( $info["post"]["no-redirect"] ) ){
		  print("ok");
		}
		else{
		  if( isset( $info["post"]["done"] ) ){
			basic_redir( $info["post"]["done"] ) ;
		  }
		  else{
			basic_redir( $GLOBALS["lessons_url"] ) ;
		  }
		}
	}
	public static function form_modal( $key ){
		$boiler = new lessons_model();
		$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
		$boiler->load_data();
		$boiler->set_paginate( array(1) ) ;
		$data = current( $boiler->data ) ;
		return $data;
	}
}
