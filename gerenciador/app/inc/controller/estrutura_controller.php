<?php
class estrutura_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$estrutura = new estrutura_model();
		$estrutura->set_field( array( $key , $field  ) ) ;
		$estrutura->set_filter( $filters ) ;
		$estrutura->load_data();
		$out = array();
		foreach( $estrutura->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$estrutura = new estrutura_model();
			$estrutura->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$estrutura->load_data();
			$data = current( $estrutura->data );
			$data["imagens_infra"] = unserialize($data["imagens_infra"]);


			$form = array(
				"url" => sprintf( $GLOBALS["estrutura_url"] , $info["idx"] )
			) ;
		}
		
		$page = 'estrutura';

	

		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/estrutura.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/add/galeria-imagem.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");



	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$estrutura = new estrutura_model();
		if( isset( $info["idx"] ) ){
			$estrutura->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
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

		if( isset( $_FILES[ "imagem_estrutura_4" ] ) && is_file( $_FILES[ "imagem_estrutura_4" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_estrutura_4" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_estrutura_4" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_estrutura_4" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_estrutura_4"] = $file ;		  			
		}	

		if( isset( $_FILES[ "imagem_estrutura_5" ] ) && is_file( $_FILES[ "imagem_estrutura_5" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "imagem_estrutura_5" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagem_estrutura_5" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "imagem_estrutura_5" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["imagem_estrutura_5"] = $file ;		  			
		}	

		$arrayImages = [];
		if(isset( $_FILES[ "imagens_galery" ]) && $_FILES[ "imagens_galery" ]["name"][0] != ""){			

			for($i=0;$i<count($_FILES[ "imagens_galery" ]["name"]);$i++){								
				$d = preg_split("/\./", $_FILES[ "imagens_galery" ]["name"][$i] ) ;
					$extension = $d[ count( $d ) - 1 ];
					$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "imagens_galery" ]["name"][$i]  ) )  ;
					$extension = date("YmdHis") . "." . $extension;
					$file = "furniture/upload/images/" . $name . $extension ;
					
					if( file_exists( constant("cRootServer") . $file ) ){
						unlink( constant("cRootServer") . $file );
					}
					move_uploaded_file( $_FILES[ "imagens_galery" ]["tmp_name"][$i] , constant("cRootServer") . $file );
					array_push($arrayImages, $file);
			}

		}


		if(isset($info["post"]["imagens_galery_edit"])){
			foreach($info["post"]["imagens_galery_edit"] as $galeryedit){
				array_push($arrayImages, $galeryedit);
			}
		}
		
	
			
		$info["post"]["imagens_infra"] = serialize($arrayImages);

	
		$estrutura->populate( $info["post"] );
		$estrutura->save();
		basic_redir( $GLOBALS["estrutura_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$estrutura = new estrutura_model();
			$estrutura->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$estrutura->remove();			
		}	
		
		basic_redir( $GLOBALS["estrutura_url"] ) ;
	}
}
