<?php
class lojista_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$lojista = new lojista_model();
		$lojista->set_field( array( $key , $field  ) ) ;
		$lojista->set_filter( $filters ) ;
		$lojista->load_data();
		$out = array();
		foreach( $lojista->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$lojista = new lojista_model();
			$lojista->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$lojista->load_data();
			$data = current( $lojista->data );
			$data["perguntas_frequentes"] = unserialize($data["perguntas_frequentes"]);

			$form = array(
				"url" => sprintf( $GLOBALS["lojista_url"] , $info["idx"] )
			) ;
		}
		
		$page = 'lojista';
	
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/lojista.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["lojista_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/add/quiz.js");
			
		if (isset($data["perguntas_frequentes"]["data"])) {
		  $i = 1;
		  foreach ($data["perguntas_frequentes"]["data"] as $k => $v) {
			print("quiz.add_question({\n");
			print("    id_key : '" . $k . "'\n");
			print("    , num: '" . $i . "'\n");
			print("    , pergunta: '" . $v["pergunta"] . "'\n");
			print("    , resposta: '" . $v["resposta"] . "'\n");
			print("    , target: $(\"#accordionFlushExample\")\n");
			print("});\n");
			$i++;
		  }
		}
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");



	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$lojista = new lojista_model();
		if( isset( $info["idx"] ) ){
			$lojista->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}

		if( isset( $_FILES[ "imagem" ] ) && is_file( $_FILES[ "imagem" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem"] = $file ;		  			
		}	
		
		if( isset( $_FILES[ "imagem_estrutura_1" ] ) && is_file( $_FILES[ "imagem_estrutura_1" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_estrutura_1" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_estrutura_1" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_estrutura_1" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_estrutura_1"] = $file ;		  			
		}	

		if( isset( $_FILES[ "imagem_estrutura_2" ] ) && is_file( $_FILES[ "imagem_estrutura_2" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_estrutura_2" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_estrutura_2" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_estrutura_2" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_estrutura_2"] = $file ;		  			
		}	

		if( isset( $_FILES[ "imagem_estrutura_3" ] ) && is_file( $_FILES[ "imagem_estrutura_3" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_estrutura_3" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_estrutura_3" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_estrutura_3" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_estrutura_3"] = $file ;		  			
		}	

		if( isset( $_FILES[ "imagem_beneficios" ] ) && is_file( $_FILES[ "imagem_beneficios" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_beneficios" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_beneficios" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_beneficios" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_beneficios"] = $file ;		  			
		}	

		$info["post"]["perguntas_frequentes"] = serialize($info["post"]["perguntas_frequentes"]);
		
		#print("aguarde...");
		#print( count( $info["post"]["categories"]  ) );
		#exit();			
		$lojista->populate( $info["post"] );
		$lojista->save();
		basic_redir( $GLOBALS["lojista_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$lojista = new lojista_model();
			$lojista->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$lojista->remove();			
		}	
		
		basic_redir( $GLOBALS["lojista_url"] ) ;
	}
}
