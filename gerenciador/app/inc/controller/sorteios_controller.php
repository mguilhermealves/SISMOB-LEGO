<?php
class sorteios_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$sorteios = new sorteios_model();
		$sorteios->set_field( array( $key , $field  ) ) ;
		$sorteios->set_filter( $filters ) ;
		$sorteios->load_data();
		$out = array();
		foreach( $sorteios->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}

	public function display( $info ){
		if( ! site_controller::check_login() ){
		basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = 10 ;
		$done = array();
		$sorteios = new sorteios_model();		
		$sorteios->set_filter( array( " idx > 0 ", "active = 'yes'" ) ) ;
		$sorteios->set_paginate( array( $info["sr"] , $paginate ) ) ;
		list($total, $data) = $sorteios->return_data();	
		
		switch ($info["format"]) {
			case ".json":
				$t = array_count_values(array_column($sorteios->con->results($sorteios->con->select(" idx ", " sorteios ","")),  "idx"));
				foreach (array_keys($GLOBALS["yes_no_lists"]) as $k) {
					if (!isset($t[$k])) {
						$t[$k] = 0;
					}
				}
				header('Content-type: application/json');			
				echo json_encode(
					array(
						"total" => array_merge(array("total" => array_sum($t)), $t), "row" => $data
					)
				);
				break;
			default:
				$page = 'sorteios';
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["sorteios_url"], $done) : $GLOBALS["sorteios_url"]), "pattern" => array(
						"new" => $GLOBALS["newsorteio_url"], "action" => $GLOBALS["sorteio_url"], "search" => !empty($info["get"]) ? set_url($GLOBALS["sorteios_url"], $info["get"]) : $GLOBALS["sorteios_url"]
					)
				);
				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/sorteios.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				print('<script>' . "\n");
				print('    data_sorteios_json = {' . "\n");
				print('        url: "' . $GLOBALS["sorteios_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/sorteios.js");
				print('</script>' . "\n");
				include(constant("cRootServer") . "ui/common/foot.inc.php");
				break;
		}
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$sorteios = new sorteios_model();
			$sorteios->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$sorteios->load_data();
			$data = current( $sorteios->data );
			
			$form = array(
				"url" => sprintf( $GLOBALS["sorteio_url"] , $info["idx"] )
			) ;
		}
		else{
			$data = array( "sorteios" => array() );
			$form = array(
				"url" => $GLOBALS["newsorteio_url"]
			) ;
		}
		$page = 'sorteio';
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/sorteio.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$sorteios = new sorteios_model();
		if( isset( $info["idx"] ) ){
			$sorteios->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		

		if( isset( $_FILES[ "arquivo_regulamento" ] ) && is_file( $_FILES[ "arquivo_regulamento" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "arquivo_regulamento" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "arquivo_regulamento" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "arquivo_regulamento" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["arquivo_regulamento"] = $file ;		  			
		}			

		if( isset( $_FILES[ "arquivo_permissionarios" ] ) && is_file( $_FILES[ "arquivo_permissionarios" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "arquivo_permissionarios" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "arquivo_permissionarios" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "arquivo_permissionarios" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["arquivo_permissionarios"] = $file ;		  			
		}			

		if( isset( $_FILES[ "arquivo_naopermissionarios" ] ) && is_file( $_FILES[ "arquivo_naopermissionarios" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "arquivo_naopermissionarios" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "arquivo_naopermissionarios" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "arquivo_naopermissionarios" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["arquivo_naopermissionarios"] = $file ;		  			
		}			
		
		$sorteios->populate( $info["post"] );
		$sorteios->save();
		basic_redir( $GLOBALS["sorteios_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$sorteios = new sorteios_model();
			$sorteios->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$sorteios->remove();			
		}	
		
		basic_redir( $GLOBALS["sorteios_url"] ) ;
	}
}
