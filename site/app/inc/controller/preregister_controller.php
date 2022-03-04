<?php
class preregister_controller{
	public function cadastro($info){
		$page = 'cadastro';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
			$homepage = new homepage_model();
			$homepage->set_filter( array( " idx = '1' " ) ) ;
			$homepage->load_data();
		
		include( constant("cRootServer") . "ui/page/cadastro.php");
		include( constant("cRootServer") . "ui/common/foot.php");

		//if(isset($info["get"]["sucess"])){
		//	print('<script>');
		//	print('sendAlert("alert-success", "Cadastro enviado! Assim que o seu acesso a plataforma for liberado, você receberá um e-mail.");');
		//	print('</script>');
		//}
		if(isset($info["get"]["cpf"])){
			print('<script>');
			print('sendAlert("alert-danger", "CPF ja esta cadastrado");');
			print('</script>');
		}
		if(isset($info["get"]["email"])){
			print('<script>');
			print('sendAlert("alert-danger", "E-mail ja esta cadastrado");');
			print('</script>');
		}
		if(isset($info["get"]["erro"])){
			print('<script>');
			print('sendAlert("alert-danger", "Problemas ao realizar o cadastrado");');
			print('</script>');
		}
		if(isset($info["get"]["file"])){
			print('<script>');
			print('sendAlert("alert-warning", "Problemas ao subir o arquivo maior que 2 megas");');
			print('</script>');
		}
        print('<script>');
        print('$("#tipo_pessoa").trigger("change");');
        print('</script>');
     

        print('<script>');
        print("jQuery.validate({\n");
        print("lang: 'pt',\n");
        print("modules : 'security, brazil',\n");
        print("});\n");
        print('</script>');
		
		include( constant("cRootServer") . "ui/common/footer.php");
		unset( $_SESSION["CADASTRO"] ) ;

	}
	public function cadastrar_participante( $info ){
		$overhead = 1024;
		$max_size = -1;	
		$_SESSION["CADASTRO"] = $info["post"];



		if($info["post"]["tipo"] == 'fisica'){

            $info["post"]["documento"] = preg_replace("/\D+?/","", $info["post"]["documento"]) ;

            $cadastro_participante_model = new cadastro_participante_model();
            $cadastro_participante_model->set_filter( array( " email = '" . $cadastro_participante_model->con->real_escape_string( $info["post"]["email"] ) . "' or documento = '" . $cadastro_participante_model->con->real_escape_string( $info["post"]["documento"] ) . "' " , " aprovado in ('aguardando','nao' )") );
            $cadastro_participante_model->load_data();
            if( isset( $cadastro_participante_model->data[0] ) ){

                if( $info["post"]["email"] == $cadastro_participante_model->data[0]["email"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&email' ) ;
                    exit();
                }
                if( $info["post"]["documento"] == $cadastro_participante_model->data[0]["documento"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&cpf' ) ;
                    exit();
                }
            }
            $users_model = new users_model();
            $users_model->set_filter( array( " mail = '" . $users_model->con->real_escape_string( $info["post"]["email"] ) . "' or cpf = '" . $users_model->con->real_escape_string( $info["post"]["documento"] ) . "' " ) );
            $users_model->load_data();
            if( isset( $users_model->data[0] ) ){

                if( $info["post"]["email"] == $users_model->data[0]["mail"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&email' ) ;
                    exit();
                }
                if( $info["post"]["documento"] == $users_model->data[0]["cpf"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&cpf' ) ;
                    exit();
                }
            }


            if( isset( $_FILES[ "documentos_funcao" ] ) && $_FILES[ "documentos_funcao" ]["error"] == 0 && $_FILES[ "documentos_funcao" ]["size"] > 0 ){
                $size = filesize( $_FILES[ "documentos_funcao" ]["tmp_name"] );


                /*$ini = parse_ini_file( $_FILES[ "documentos_funcao" ]["tmp_name"] );
                $regex = '/^([0-9]+)([bkmgtpezy])$/i';
                if (!empty($ini['post_max_size']) && preg_match($regex, $ini['post_max_size'], $match)) {
                    $post_max_size = round( $match[1] * pow( 1024, stripos('bkmgtpezy', strtolower( $match[2] ) ) ) ) ;
                    if ($post_max_size > 0) {
                    $max_size = $post_max_size - $overhead;
                    }
                }
                if (!empty($ini['upload_max_filesize']) && preg_match($regex, $ini['upload_max_filesize'], $match)) {
                    $upload_max_filesize = round($match[1] * pow( 1024, stripos( 'bkmgtpezy', strtolower( $match[2] ) ) ) );
                    if ($upload_max_filesize > 0 && ($max_size <= 0 || $max_size > $upload_max_filesize) ) {
                    $max_size = $upload_max_filesize ;
                    }
		        }*/

                if( $size >= 2 * 1000 * 1000 ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&file' ) ;
                }
                $d = preg_split("/\./", $_FILES[ "documentos_funcao" ]["name"] ) ;
                $extension = $d[ count( $d ) - 1 ];
                $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "documentos_funcao" ]["name"]  ) )  ;
                $extension = date("YmdHis") . "." . $extension;
                $file = "furniture/upload/images/" . $name . $extension ;
                
                if( file_exists( constant("cRootServer") . $file ) ){
                    unlink( constant("cRootServer") . $file );
                }
                move_uploaded_file( $_FILES[ "documentos_funcao" ]["tmp_name"] , constant("cRootServer") . $file );
                $info["post"]["documentos_funcao"] = $file ;
                    
            }
            $cadastro_participante = new cadastro_participante_model();		
            $cadastro_participante->populate($info["post"]);
            $cadastro_participante->save();

            basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&sucess' ) ;
		}
        else{
            
            $info["post"]["documento"] = preg_replace("/\D+?/","", $info["post"]["documento"]) ;

            $info["post"]["nome"] = $info["post"]["razao_social"] ;
            
            $cadastro_participante_model = new cadastro_participante_model();
            $cadastro_participante_model->set_filter( array( " email = '" . $cadastro_participante_model->con->real_escape_string( $info["post"]["email"] ) . "' or documento = '" . $cadastro_participante_model->con->real_escape_string( $info["post"]["documento"] ) . "' " , " aprovado in ('aguardando','nao' )") );
            $cadastro_participante_model->load_data();
            if( isset( $cadastro_participante_model->data[0] ) ){

                if( $info["post"]["email"] == $cadastro_participante_model->data[0]["email"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&email' ) ;
                    exit();
                }
                if( $info["post"]["documento"] == $cadastro_participante_model->data[0]["documento"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&cpf' ) ;
                    exit();
                }
            }
            $users_model = new users_model();
            $users_model->set_filter( array( " mail = '" . $users_model->con->real_escape_string( $info["post"]["email"] ) . "' or cpf = '" . $users_model->con->real_escape_string( $info["post"]["documento"] ) . "' " ) );
            $users_model->load_data();
            if( isset( $users_model->data[0] ) ){

                if( $info["post"]["email"] == $users_model->data[0]["mail"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&email' ) ;
                    exit();
                }
                if( $info["post"]["documento"] == $users_model->data[0]["cpf"] ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&cpf' ) ;
                    exit();
                }
            }

            if( isset( $_FILES[ "documentos_escritorio" ] ) && $_FILES[ "documentos_escritorio" ]["error"] == 0 && $_FILES[ "documentos_escritorio" ]["size"] > 0 ){
                $size = filesize( $_FILES[ "documentos_escritorio" ]["tmp_name"] );
                /*$ini = parse_ini_file( $_FILES[ "documentos_escritorio" ]["tmp_name"] );
                $regex = '/^([0-9]+)([bkmgtpezy])$/i';
                if (!empty($ini['post_max_size']) && preg_match($regex, $ini['post_max_size'], $match)) {
                    $post_max_size = round( $match[1] * pow( 1024, stripos('bkmgtpezy', strtolower( $match[2] ) ) ) ) ;
                    if ($post_max_size > 0) {
                        $max_size = $post_max_size - $overhead;
                    }
                }
                if (!empty($ini['upload_max_filesize']) && preg_match($regex, $ini['upload_max_filesize'], $match)) {
                    $upload_max_filesize = round($match[1] * pow( 1024, stripos( 'bkmgtpezy', strtolower( $match[2] ) ) ) );
                    if ($upload_max_filesize > 0 && ($max_size <= 0 || $max_size > $upload_max_filesize) ) {
                        $max_size = $upload_max_filesize ;
                    }
                }

		        if( $max_size == -1 ){*/
                if( $size >= 2 * 1000 * 1000 ){
                    basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&file' ) ;
                }
                $d = preg_split("/\./", $_FILES[ "documentos_escritorio" ]["name"] ) ;
                $extension = $d[ count( $d ) - 1 ];
                $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "documentos_escritorio" ]["name"]  ) )  ;
                $extension = date("YmdHis") . "." . $extension;
                $file = "furniture/upload/images/" . $name . $extension ;
                
                if( file_exists( constant("cRootServer") . $file ) ){
                    unlink( constant("cRootServer") . $file );
                }
                move_uploaded_file( $_FILES[ "documentos_escritorio" ]["tmp_name"] , constant("cRootServer") . $file );
                //$info["post"]["documentos_escritorio"] = $file ;
                $info["post"]["documentos_funcao"] = $file ;
            }
            $info["post"]["socios"] = serialize( $info["post"]["socios"] );

            $cadastro_participante = new cadastro_participante_model();		
            $cadastro_participante->populate($info["post"]);
            $cadastro_participante->save();

            basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&sucess' ) ;

			/*
            $cadastro_juridica  = new cadastro_juridica_model();	
			$cadastro_juridica->populate($info["post"]);
			$cadastro_juridica->save();
			$info["post"]["cadastro_juridica_id"] = $cadastro_juridica->con->insert_id;

			$quantidade = $info["post"]["qtde_responsaveis"];

			for($i = 0; $i < $quantidade; $i++){

				$info["post"]["nome"] = $info["post"]["socios"]["nome"][$i];
				$info["post"]["data_nascimento"] = $info["post"]["socios"]["data_nascimento"][$i];;
				$info["post"]["perfil"] = $info["post"]["socios"]["perfil"][$i];
				$info["post"]["sexo"] = $info["post"]["socios"]["sexo"][$i];
				$info["post"]["ano_inicio_funcao"] = $info["post"]["socios"]["ano_inicio_funcao"][$i];
				$info["post"]["formacao_academica"] = $info["post"]["socios"]["formacao_academica"][$i];

				$cadastro_participante = new cadastro_participante_model();		
				$cadastro_participante->populate($info["post"]);
				$cadastro_participante->save();
				$info["idx"] = $cadastro_participante->con->insert_id;
				$cadastro_participante->save_attach($info, array("cadastro_juridica"));
			}
							
			basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&sucess' ) ;
            */
		}
		basic_redir( $GLOBALS["cadastro_url"].'?tipo=' . $info["post"]["tipo"] . '&erro' ) ;
	}
}
?>
