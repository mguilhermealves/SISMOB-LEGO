<?php
class transparencias_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$transparencias = new transparencias_model();
		$transparencias->set_field( array( $key , $field  ) ) ;
		$transparencias->set_filter( $filters ) ;
		$transparencias->load_data();
		$out = array();
		foreach( $transparencias->data as $value ){
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
		$transparencias = new transparencias_model();		
		$transparencias->set_filter( array( " idx > 0 ", "active = 'yes'" ) ) ;
		$transparencias->set_paginate( array( $info["sr"] , $paginate ) ) ;
		list($total, $data) = $transparencias->return_data();	
		
		switch ($info["format"]) {
			case ".json":
				$t = array_count_values(array_column($transparencias->con->results($transparencias->con->select(" idx ", " transparencias ","")),  "idx"));
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
				$page = 'transparencias';
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["transparencias_url"], $done) : $GLOBALS["transparencias_url"]), "pattern" => array(
						"new" => $GLOBALS["newtransparencia_url"], "action" => $GLOBALS["transparencia_url"], "search" => !empty($info["get"]) ? set_url($GLOBALS["transparencias_url"], $info["get"]) : $GLOBALS["transparencias_url"]
					)
				);
				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/transparencias.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				print('<script>' . "\n");
				print('    data_transparencias_json = {' . "\n");
				print('        url: "' . $GLOBALS["transparencias_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/transparencias.js");
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
			$transparencias = new transparencias_model();
			$transparencias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$transparencias->load_data();
			$data = current( $transparencias->data );
			
			$form = array(
				"url" => sprintf( $GLOBALS["transparencia_url"] , $info["idx"] )
			) ;
		}
		else{
			$data = array( "transparencias" => array() );
			$form = array(
				"url" => $GLOBALS["newtransparencia_url"]
			) ;
		}
		$page = 'transparencia';
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/transparencia.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$transparencias = new transparencias_model();
		if( isset( $info["idx"] ) ){
			$transparencias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		

		if( isset( $_FILES[ "arquivo" ] ) && is_file( $_FILES[ "arquivo" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "arquivo" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "arquivo" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "arquivo" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["arquivo"] = $file ;		  			
		}			

	
		$transparencias->populate( $info["post"] );
		$transparencias->save();
		basic_redir( $GLOBALS["transparencias_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$transparencias = new transparencias_model();
			$transparencias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$transparencias->remove();			
		}	
		
		basic_redir( $GLOBALS["transparencias_url"] ) ;
	}
}
