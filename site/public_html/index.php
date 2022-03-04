<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once( $_SERVER["DOCUMENT_ROOT"] . "/../app/inc/main.php");
if( isset( $_GET["logout"] ) && $_GET["logout"] == "yes" ){
	unset( $_SESSION[ constant("cAppKey") ] );
	basic_redir( $GLOBALS["home_url"] ) ;
}
$params = array(
	"sr" => isset( $_GET["sr"] ) && $_GET["sr"] > 1 ? $_GET["sr"] : 0  ,
	"format" => ".html" ,
	"post" => isset( $_POST ) ? $_POST : NULL ,
	"get" => isset( $_GET ) ? $_GET : NULL ,
);
$btn_save = isset( $_POST["btn_save"] ) ? true : null ;
$btn_remove = isset( $_POST["btn_remove"] ) ? true : null ;

$strCanal = "";
$dispatcher = new dispatcher( true ) ;
$dispatcher->add_route ( "GET" , "/(index(\.json|\.xml|\.html)).*?" , "function:basic_redir" , null, $home_url ) ;
$dispatcher->add_route ( "GET" , "/?" , "site_controller:display" , null, $params ) ;
$dispatcher->add_route ( "GET" , "/login" , "site_controller:login" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/logar" , "site_controller:logar" , $btn_save, $params ) ;
$dispatcher->add_route ( "GET" , "/sair" , "site_controller:logout" , null, $params ) ;

/** esqueceu a senha */
$dispatcher->add_route ( "GET" , "/senha" , "site_controller:password" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/senha" , "site_controller:reset_password" , $btn_save, $params ) ;

/** cadastro participante */
$dispatcher->add_route ( "GET" , "/cadastro" , "preregister_controller:cadastro" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/cadastrar_participante" , "preregister_controller:cadastrar_participante" , $btn_save, $params ) ;

foreach( tokens_controller::data4select("idx", array( " active = 'yes' " ) , "name" ) as $k => $v ){
	$dispatcher->add_route ( "GET" , "/tkpwd/(?P<key>".$v.")" , "tokens_controller:display" , null, $params ) ;
	$dispatcher->add_route ( "POST" , "/tkpwd/(?P<key>".$v.")" , "tokens_controller:renew" , $btn_save, $params ) ;
}
if( site_controller::check_login() ){	
	foreach( contexts_controller::data4select("slug", array( " active = 'yes' " ) , " idx " ) as $k => $v ){
		$dispatcher->add_route ( "GET" , "/(?P<slug>".$k.")" , "contexts_controller:display" , null, $params ) ;
	}
	$dispatcher->add_route ( "GET" , "/construcao" , "site_controller:construction_page" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/treinamentos" , "trails_controller:treinamentos" ,  null, $params ) ;


	/* Biblioteca */
	$dispatcher->add_route ( "GET" , "/biblioteca" , "libraries_controller:biblioteca" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/biblioteca/(?P<slug_secao>.+)/(?P<slug_material>.+)" , "libraries_controller:biblioteca_material" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/biblioteca/(?P<slug>.+)" , "libraries_controller:biblioteca_conteudo" ,  null, $params ) ;
	

	$dispatcher->add_route ( "GET" , "/treinamento/(?P<slug>.+)" , "trails_controller:treinamento" ,  null, $params ) ;

	$dispatcher->add_route ( "GET" , "/curso/(?P<slug>.+)" , "course_controller:curso" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/conteudo-treinamento/(?P<slug>.+)/(?P<slug2>.+)/(?P<idx>.+)" , "course_controller:section_content" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/conteudo-treinamento/(?P<slug>.+)/(?P<slug2>.+)/(?P<idx>.+)" , "course_controller:section_content" ,  null, $params ) ;

	/* Meu Cadastro Wikipet */
	$dispatcher->add_route ( "GET" , "/usuario/meu-cadastro" , "users_controller:meu_cadastro" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/usuario/meu-cadastro" , "users_controller:meu_cadastro_salvar" ,  $btn_save, $params ) ;
	
	$dispatcher->add_route ( "GET" , "/usuario/minhas_notas" , "site_controller:minhas_notas" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/usuario/notificacoes" , "site_controller:notificacoes" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/usuario/contato" , "site_controller:contato" ,  null, $params ) ;

	/* Pilulas */
	$dispatcher->add_route ( "GET" , "/usuario/pilulas-de-conteudo" , "pills_controller:pilulas_conteudo" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/usuario/pilula/(?P<slug>.+)" , "pills_controller:pilulas" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/usuario/pilula/(?P<slug>.+)" , "pills_controller:save" ,  $btn_save, $params ) ;
	

	/** meus dados */
	$dispatcher->add_route ( "GET" , "/meus-dados" , "site_controller:meus_dados" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/meus-dados" , "site_controller:meus_dados_salvar" ,  $btn_save, $params ) ;
	
	/**Noticias */
	$dispatcher->add_route ( "GET" , "/noticias" , "noticias_controller:noticias" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/noticia/(?P<slug>.+)" , "noticias_controller:noticia" ,  null, $params ) ;
	
	/**Duvidas */
	$dispatcher->add_route ( "GET" , "/duvidas" , "site_controller:duvidas" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/duvidas" , "site_controller:search_duvidas" ,  $btn_save, $params ) ;
	
	/**Forum */
	$dispatcher->add_route ( "GET" , "/foruns" , "forum_controller:display" ,  null, $params ) ;
	$dispatcher->add_route ( "GET" , "/forum/(?P<slug>.+)" , "forum_controller:form" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/send_response" , "forum_controller:save" ,  null, $params ) ;
	
	/**Likes */
	$dispatcher->add_route ( "POST" , "/like_response" , "like_controller:likeresponse" ,  $btn_save, $params ) ;
	
	/**contato */
	$dispatcher->add_route ( "GET" , "/contatos" , "contact_controller:contatos" ,  null, $params ) ;
	$dispatcher->add_route ( "POST" , "/contato" , "contact_controller:save" ,  $btn_save, $params ) ;
	

	/** save progress */
	$dispatcher->add_route ( "POST" , "/salvar-progresso" , "course_controller:saveprogress" ,  $btn_save, $params ) ;
	/** save tests */
	$dispatcher->add_route ( "POST" , "/salvar-avaliacao" , "course_controller:savetests" ,  $btn_save, $params ) ;
	/** send contact */
	$dispatcher->add_route ( "POST" , "/enviar-contato" , "site_controller:contatosend" ,  $btn_save, $params ) ;

	/** orientações gerais de uso */
	$dispatcher->add_route ( "GET" , "/orientacoes_uso" , "contexts_controller:orientacoes_uso" ,  null, $params ) ;

	/** meus certificados */
	$dispatcher->add_route ( "GET" , "/meus_certificados" , "site_controller:meus_certificados" ,  null, $params ) ;
}
if ( ! $dispatcher->exec() ) {
	basic_redir( $home_url );
}
?>