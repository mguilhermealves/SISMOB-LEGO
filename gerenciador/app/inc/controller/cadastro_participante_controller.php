<?php
class cadastro_participante_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$cadastro_participante = new cadastro_participante_model();
		$cadastro_participante->set_field( array( $key , $field  ) ) ;
		$cadastro_participante->set_filter( $filters ) ;
		$cadastro_participante->load_data();
		$out = array();
		foreach( $cadastro_participante->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function display( $info ){		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$paginate = 20 ;
		$done = array();
		$cadastro_participante = new cadastro_participante_model();		
		$filter = array( "active = 'yes'" , "aprovado in ('" . $info["slug"] . "' )" );
		
		if( $info["slug"] == "aguradando" ){
			$filter[] = " not replace(replace( documento ,'.',''),'-','') in ( select distinct(cpf) from users ) " ;
		}
		$cadastro_participante->set_filter( $filter ) ;
		$cadastro_participante->set_field( array( " idx", "nome", "aprovado" ) ) ;
		
		if ($info["format"] != ".json") {
			$cadastro_participante->set_paginate( array($info["sr"], $paginate));
		} else {
			$cadastro_participante->set_paginate(array(0, 900000));
		}
		list($total, $data) = $cadastro_participante->return_data();
		
		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');			
				echo json_encode(
					array(
						"total" => array( "total" => $total)
						, "row" => $data
					)
				);
				break;
			default:
				$page = 'Cadastro Participantes';
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["pre-registers-" . $info["slug"] . "_url"], $done) : $GLOBALS["pre-registers-" . $info["slug"] . "_url"])
					, "pattern" => array(
						"new" => $GLOBALS["pre-registers-" . $info["slug"] . "_url"]
						, "action" => $GLOBALS["pre-register_url"]
						, "search" => !empty($info["get"]) ? set_url($GLOBALS["pre-register_url"], $info["get"]) : $GLOBALS["pre-register_url"]
					)
				);
				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/cadastro_participantes.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				print('<script>' . "\n");
				print('    data_cadastro_participante_json = {' . "\n");
				print('        url: "' . $GLOBALS["pre-registers-" . $info["slug"] . "_url"] .'.json"' . "\n");
				print('        , action: "' . set_url( $GLOBALS["pre-register_url"] , array( "done" => rawurlencode( $form["done"] ) ) ) . '"'."\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/cadastro_participante.js");
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
			$cadastro_participante = new cadastro_participante_model();
			$cadastro_participante->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$cadastro_participante->load_data();
			$data = current( $cadastro_participante->data );
			
			$form = array(
				"url" => sprintf( $GLOBALS["pre-register_url"] , $info["idx"] )
			) ;
		}
		else{
			$data = array( "cadastro_participante" => array() );
			$form = array(
				"url" => $GLOBALS["newcadastro_participante"]
			) ;
		}
		$page = 'Cadastro Participantes';
		$categorias_lists = categorias_controller::data4select("idx", array(" active = 'yes' "), "title");
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/cadastro_participante.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		$cadastro_participante = new cadastro_participante_model();
		if( isset( $info["idx"] ) ){
			$cadastro_participante->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		
		$cadastro_participante->populate( $info["post"] );
		$cadastro_participante->save();
		
		if(isset($info["post"]["aprovado"]) && $info["post"]["aprovado"] == "sim" ){

			$cadastro_participante = new cadastro_participante_model();
			$cadastro_participante->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$cadastro_participante->load_data();
			$data = current( $cadastro_participante->data );

			if ( isset($data["documento"]) ) {
				$data["documento"] = preg_replace("/[^0-9]+?/", "", $data["documento"]);
				$info["post"]["cpf"] = $data["documento"];
				$info["post"]["password"] = md5($data["documento"]);
				$info["post"]["first_name"]  = $data["nome"];
				$info["post"]["mail"]  = $data["email"];
				$info["post"]["login"]  = $data["documento"];
				$info["post"]["celphone"]  = $data["celular"];
				$info["post"]["genre"]  = $data["sexo"];
				$info["post"]["phone"]  = $data["telefone"];
				$info["post"]["city"]  = $data["cidade"];
				$info["post"]["uf"]  = $data["uf"];
				$info["post"]["cadastro_participante_id"] = $data["idx"];
				$info["post"]["profiles_id"] = 10;
				$info["post"]["no-redirect"] = true ;

				$users = new users_controller();		
				$r = $users->save( array( "post" => $info["post"] ) );
			}
			$cadastro_participante = new cadastro_participante_model();
			if( isset( $data["idx"] ) ){
				$cadastro_participante->set_filter( array( " idx = '" . $data["idx"] . "' " ) ) ;
			}	
			$info["post"]["aprovado"] = 'sim';
			$cadastro_participante->populate( $info["post"] );
			$cadastro_participante->save();
		}
		if( isset( $info["post"]["done"] ) ){
			basic_redir( urldecode( $info["post"]["done"] ) ) ;
		}
		else{
			basic_redir( $GLOBALS["pre-registers-aguardando_url"] ) ;
		}

	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$cadastro_participante = new cadastro_participante_model();
			$cadastro_participante->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$cadastro_participante->remove();			
		}	
		
		basic_redir( $GLOBALS["pre-register_url"] ) ;
	}
}
