<?php
class site_controller{
	public function logout(){
		unset( $_SESSION[ constant("cAppKey") ] );
		basic_redir( $GLOBALS["home_url"] ) ;
	}
	public static function check_login(){
		return isset( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) && (int)$_SESSION[ constant("cAppKey") ]["credential"]["idx"] > 0 ;
	}
	public static function check_aceite(){
		return true ;
		$users = new users_model();
		$users->set_filter( array( " idx = '".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]."' " )) ;
		$users->load_data();								
		
		if($users->data[0]["accept_at"] != null){
			return 1;
		}else{
			return 0;
		}		

	}
	public function display( $info ){
		$page = 'homepage';
			
		if( site_controller::check_login() ){

			if( ! site_controller::check_aceite() ){
				basic_redir( $GLOBALS["regulamento_url"] ) ;
			}

			$key = (isset( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] ) ? (int) $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] : "xxxxx" ) ;

			$banners_model = new banners_model();
			$banners_model->set_field( array( "name" , "img" , "target" , "link") );
			$banners_model->set_filter( array( " active = 'yes' " , " status_published = 'yes' " , " idx in ( select banners_profiles.banners_id from banners_profiles where banners_profiles.active = 'yes' and banners_profiles.profiles_id = '" . $key . "' ) " ) );			
			$banners_model->load_data();
			$banners = $banners_model->data ; 

			$trail_filter = array( 
				" active = 'yes' "
				, " idx in ( select trails_profiles.trails_id from trails_profiles where trails_profiles.active = 'yes' and trails_profiles.profiles_id = '" . $key . "' ) " 
				, " idx in ( select trails_courses.trails_id from trails_courses where trails_courses.active = 'yes' and trails_courses.courses_id in ( select courses_profiles.courses_id from courses_profiles where courses_profiles.active = 'yes' and courses_profiles.profiles_id = '" . $key . "' ) ) " 
			) ;
			$trilhas = new trails_model();			
			$trilhas->set_filter( $trail_filter ) ;					
			$trilhas->set_order( array( " display_position asc " ) ) ;			
			$trilhas->load_data();
			$trilhas->attach(array("courses"),false," and course_status = 'Publicado' and idx in ( select courses_profiles.courses_id from courses_profiles where courses_profiles.active = 'yes' and courses_profiles.profiles_id = '" . $key . "' ) ");			
			$trails = $trilhas->data;

			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");
			include( constant("cRootServer") . "ui/page/homepage.php");
			include( constant("cRootServer") . "ui/common/foot.php");
			include( constant("cRootServer") . "ui/common/footer.php");
		
		}
		else{			
			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/page/login.php");		
			include( constant("cRootServer") . "ui/common/foot.php");	
			if(isset($_SESSION["messages_app"])){
				print('<div class="alert" id="alertaReturn"></div><script>');
				foreach( $_SESSION["messages_app"] as $k => $v ){
					print('sendAlert("alert-' . $k . '" , "' . implode("<br>" , $v ) . '");');
				}
				print('</script>');
				unset( $_SESSION["messages_app"] );
			}
		//	include( constant("cRootServer") . "ui/page/dash.php");
		}
		
	}	
	public function minhas_notas( $info ){
		$page = 'minhas_notas';
			
		if( site_controller::check_login() ){
	

			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");
			
				include( constant("cRootServer") . "ui/page/minhas_notas.php");
						
			include( constant("cRootServer") . "ui/common/foot.php");
			include( constant("cRootServer") . "ui/common/footer.php");
		
		}
		
	}
	public function notificacoes( $info ){
		$page = 'notificacoes';
			
		if( site_controller::check_login() ){
	

			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");
			
				include( constant("cRootServer") . "ui/page/notificacoes.php");
						
			include( constant("cRootServer") . "ui/common/foot.php");
			include( constant("cRootServer") . "ui/common/footer.php");
		
		}
		
	}
	public function contato( $info ){
		$page = 'contato';
			
		if( site_controller::check_login() ){
	

			include( constant("cRootServer") . "ui/common/header.php");
			include( constant("cRootServer") . "ui/common/head.php");
			
				include( constant("cRootServer") . "ui/page/contato.php");
						
			include( constant("cRootServer") . "ui/common/foot.php");
			include( constant("cRootServer") . "ui/common/footer.php");
		
		}
		
	}
	public function rules( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$page = 'regulamento';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		
		

		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();

		$regulamento = new regulamento_model();
		$regulamento->set_filter( array( " idx = '1' " ) ) ;
		$regulamento->load_data();

		include( constant("cRootServer") . "ui/page/regulamento.php");		

		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
		
	}
	public function regulamento( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$users = new users_model();
		$users->set_filter( array( " idx = '".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]."' " )) ;
		$users->load_data();								
		if($users->data[0]["accept_at"] == null){
			$info["post"]["accept_at"] = date('Y-m-d H:i:s');
			$users->populate( $info["post"] );
			$users->save();
     	}
		basic_redir( $GLOBALS["home_url"] ) ;
	}
	public function categorias( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}
		$page = 'categorias';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");		
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
		include( constant("cRootServer") . "ui/page/categorias.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function meus_certificados( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}

		$page = 'categorias';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		/* 	$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
		 */
		
		include( constant("cRootServer") . "ui/page/meus_certificados.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");

	}
	public function duvidas( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}

		$page = 'duvidas';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
		
		
		$perguntas_frequentes = unserialize($homepage->data[0]["perguntas_frequentes"]);
		
		
		include( constant("cRootServer") . "ui/page/duvidas.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
		
	}
	public function construction_page( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}
		$page = 'construcao';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
								
		
		include( constant("cRootServer") . "ui/page/construction.php");		
		include( constant("cRootServer") . "ui/common/foot.php");	
		include( constant("cRootServer") . "ui/common/footer.php");
		
	}
	public function meus_dados( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}
		$page = 'meus_dados';
		
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
		
		$users = new users_model();
		$users->set_filter( array( " idx = '".$_SESSION[ constant("cAppKey") ]["credential"]["idx"]."' " )) ;
		$users->load_data();
								
		$users->attach(array("cadastro_participante"));
				
		$data = $users->data[0]["cadastro_participante_attach"][0];

		include( constant("cRootServer") . "ui/page/meus-dados.php");		
		include( constant("cRootServer") . "ui/common/foot.php");

		print('<script>'."\n");				
		print('$(".data-nasc input").focus()'."\n");
		print('  $(".interesses_open").click(function(){ if( $(".interesses_open").is(":checked") ) { $(".interesses_wrapper").removeClass("hidden"); }else{ $(".interesses_wrapper").addClass("hidden"); $(".outros-interesses").val(""); } });'."\n");					
		print('</script>'."\n");
		
		if(isset($info["get"]["sucess"])){
			print('<script>');
			print('sendAlert("alert-success", "Atualizado com sucesso!");');
			print('</script>');
		}

		include( constant("cRootServer") . "ui/common/footer.php");


		
	}
	public function reset_password( $info ){
		$user = new users_model();
		$user->set_filter( array( " ( mail = '" . $user->con->real_escape_string( $info["post"]["text"] ) . "' or cpf = '" . $user->con->real_escape_string( $info["post"]["text"] ) . "' ) " ) ) ;
		$user->load_data();
		if( isset( $user->data[0] ) ){
			$user->attach( array("tokens") );
			if( isset( $user->data[0]["tokens_attach"][0] ) ){
				$tokens_name = $user->data[0]["tokens_attach"][0]["name"] ;
			}
			else{
				$tokens_name = md5(date("YmdHis") . $user->data[0]["idx"] ) ;
				$tokens = new tokens_model();
				$tokens->populate(array("name" => $tokens_name ));
				$tokens->save();
				$info["idx"] = $tokens->con->insert_id ; 
				$info["post"]["users_id"] = $user->data[0]["idx"] ; 
				$tokens->save_attach( $info , array("users") , true );				
			}

			$page = strtr( file_get_contents( constant("cRootServer") . "furniture/mail/nova-senha.html") , array(
				"#HOST#" => constant("cFurniture") . "mail/"
				, "#SITE#" => constant("cTitle")
				, "#NOME#" => $user->data[0]["first_name"]
				, "#LOGIN#" => $user->data[0]["mail"]
				, "#LINK#" => sprintf( $GLOBALS["tkpwd_url"] , $tokens_name )
			) );

			$messages_model = new messages_model();
			$messages_model->populate( array(
				"name" => "Renovação da Senha"
				, "scheduled_at" => date("Y-m-d H:i:s")
				, "mailboxes" => serialize( array( 
					"Address" => array( "name" => $user->data[0]["first_name"] , "mail" => $user->data[0]["mail"] )
					, "from" => array( "name" => constant( "mail_from_name") , "mail" => constant( "mail_from_mail") )
					, "replyTo" => array( "name" => constant( "mail_from_name") , "mail" => constant( "mail_from_mail") )
				 ) ) 
				, "htmlmsg" => $page 
				, "textmsg" => strip_tags( $page )
				, "type" => "mail"
			));
			$messages_model->save();
			$_SESSION["messages_app"]["info"] = array("Processo de reenvio de senha enviado para o seu e-mail");
		}
		else{
			$_SESSION["messages_app"]["warning"] = array("Não foi localizado em nossa base de dados dados com o e-mail cadastrado");
		}
			basic_redir( $GLOBALS["home_url"] );
		exit();
	}
	public function password( $info ){
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/page/esqueceu-senha.php");
	}
	public function display_data( $info ){

		$data = array();
		foreach( array( "mail" , "login" , "first_name" , "last_name" , "cpf" , "company" , "crmv" , "crmv_uf" , "occupation_area" , "phone" , "genre" , "birthdate" , "address" , "address_number" , "address_complement" , "address_neighborhood" , "address_state" , "address_city" , "address_zip_code" , "avatar" ) as $k ){
			$data[ $k ] = isset( $_SESSION[ constant("cAppKey") ]["credential"][ $k ] ) && !empty( $_SESSION[ constant("cAppKey") ]["credential"][ $k ] ) ? $_SESSION[ constant("cAppKey") ]["credential"][ $k ] : "" ;
		}
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		include( constant("cRootServer") . "ui/includes/menuTopoOnline.php");
		include( constant("cRootServer") . "ui/page/mydata.php");
		include( constant("cRootServer") . "ui/includes/footerOnline.php"); 
		include( constant("cRootServer") . "ui/common/foot.php");
        print("<script>");
        include( constant("cRootServer") . "furniture/js/mydata.js");
        print("</script>");
		include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function meus_dados_salvar( $info ){
		
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		else{

			if(isset($info["post"]["interesses"])){
				$interesses = serialize($info["post"]["interesses"]);
				$info["post"]["interesses"] = $interesses;			
			}

			$user = new users_model();
			$user->set_filter( array( " idx = '" . $user->con->real_escape_string( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) . "' " ) ) ;			
			$user->load_data();
			$user->attach(array("cadastro_participante"));
			
			$idcadastro_participante = $user->data[0]["cadastro_participante_attach"][0]["idx"];			
			$cadastro_participante = new cadastro_participante_model();	
			$cadastro_participante->set_filter( array( " idx = '" . $idcadastro_participante . "' " ) ) ;	
			$cadastro_participante->populate($info["post"]);
			$cadastro_participante->save();

			basic_redir( $GLOBALS["meusdados_url"].'?sucess' ) ;
			// echo json_encode([
			// 	"alert" => "alert-success",
			// 	"message" => "Dados Atualizados com sucesso!"
			// ]);
		}
	}
	public function save( $info ){
        if( !site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] );
            exit();
        }
		else{
			if( isset( $info["post"][ "pwd" ] ) && !empty( $info["post"][ "pwd" ] ) ){
				$info["post"]["password"] = md5( $info["post"][ "pwd" ] ) ;
			}
			$user = new users_model();
			$user->set_filter( array( " idx = '" . $user->con->real_escape_string( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) . "' " ) ) ;
			$user->set_paginate( array( " 1 " ) ) ;
			$user->populate( $info["post"] );
			$user->save();

			$user = new users_model();
			$user->set_filter( array( " idx = '" . $user->con->real_escape_string( $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ) . "' " ) ) ;
			$user->load_data();
			$_SESSION[ constant("cAppKey") ] = array(
				"credential" => current( $user->data )
			) ;
			$_SESSION["messages_app"]["warning"] = array("Dados Atualizados com Sucesso");
		}
		basic_redir( $GLOBALS["mydata_url"] );
		exit();
	}
	public function loginwithlink( $info ){
		$users = new users_model();
		$users->set_filter( array( " md5( concat( idx, login ) ) = '" . $info["slug"] . "' "  ) ) ;
		$users->set_paginate( array( " 1 " ) ) ;
		$users->load_data();
		if( isset( $users->data[0]) ){
			$users->attach( array("profiles") , false , null , array( "idx" , "name" , "adm" , "slug" ) );
			$_SESSION[ constant("cAppKey") ] = array(
				"credential" => current( $users->data )
			) ;
		}
		else{
			unset( $_SESSION[ constant("cAppKey") ] );
		}
		basic_redir( $GLOBALS["home_url"] );
		exit();
	}
	public function logar( $info ){
		
		if( isset( $info["post"]["login"] ) && isset( $info["post"]["password"] ) ){
			$users = new users_model();
			$users->set_filter( array( " ( '" . $users->con->real_escape_string( $info["post"]["login"] ) . "' in (mail,login) or '" . $users->con->real_escape_string( preg_replace("/[^0-9]+?/","",$info["post"]["login"]) ) . "' = cpf ) " , " password in ( '" . $users->con->real_escape_string( md5( $info["post"]["password"] ) ) . "' , '" . $users->con->real_escape_string( md5( preg_replace("/[^0-9]+?/","",$info["post"]["login"] ) ) ) . "' ) " ) ) ;
			$users->set_paginate( array( " 1 " ) ) ;
			$users->load_data();
			if( isset( $users->data[0]["idx"] ) ){
				$users->attach( array("profiles") , false , null , array( "idx" , "name" , "adm" , "slug" ) );
				$_SESSION[ constant("cAppKey") ] = array(
					"credential" => current( $users->data )
				) ;
				$nusers = new users_model();
				$nusers->set_filter( array( "idx = '" .  $_SESSION[ constant("cAppKey") ]["credential"]["idx"]  . "' " ) );
				$nusers->populate( array( "last_login" => date("Y-m-d H:i:s") ) ) ;
				$nusers->save() ;								
			}
			else{
				$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha informados não conferem");
			}
		}
		else{
			$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha são obrigatórios para realizar o login");
		}
		
		basic_redir( $GLOBALS["home_url"] );
		exit();
	}
	public static function validateRecaptcha( $obj ){

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => constant("RECAPTCHA_V3_SECRET_KEY"), 'response' => $obj["token"])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);
        if($arrResponse["success"] == '1' && $arrResponse["action"] ==  $obj["action"] && $arrResponse["score"] >= 0.5) {

			return true;

        }else{

			return false;

        }

	}
	public static function contatosend($info){
		

		$subjects = new subjects_messages_model();
		$subjects->set_filter( array( " idx = ".$info["post"]["body"]["subject"] ) ) ;
		$subjects->load_data();
		
		
	
		$emailenviar[] = $subjects->data[0]["para"];

        $body = "Novo contato do Wikipet:<br/>
		Nome: <b>".$info["post"]["body"]["fullname"]."</b><br/>
		E-mail: <b>".$info["post"]["body"]["email"]."</b><br/>		
        Mensagem: <b>".$info["post"]["body"]["message"]."</b>";

        $header = array([
			'to' => $emailenviar,
			'Bcc' => array(),
			'cc' => array(),
			'subject' => $subjects->data[0]["name"],
			'scheduled_at' => date('Y-m-d H:i:s'),		
			'scheduled_by' => 1,
			'created_at' => date('Y-m-d H:i:s'),	
			'created_by' => 1,
		]);

        $datamessage = array(
			'header' => serialize($header),
			'body' => $body,
			'status' => 1,
			'scheduled_at' => date('Y-m-d H:i:s'),		
			'scheduled_by' => 1,				
		);

		$boiler = new service_messages_model();
		$boiler->populate( $datamessage );		
		$boiler->save();
		return true;
	}
	public static function subjects_messages(){
		$subjects = new subjects_messages_model();
		$subjects->load_data();
		$subjects->set_filter( array( " active = 'yes' " ) ) ;
		return $subjects->data;
	}
}
?>
