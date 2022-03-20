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
	"sr" => isset( $_GET["sr"] ) && $_GET["sr"] > 1 ? $_GET["sr"] : 0 ,
	"format" => ".html" ,
	"post" => isset( $_POST ) ? $_POST : NULL ,
	"get" => isset( $_GET ) ? $_GET : NULL ,
);
$btn_save = isset( $_POST["btn_save"] ) ? $_POST["btn_save"] : false ;
$btn_remove = isset( $_POST["btn_remove"] ) ? $_POST["btn_remove"] : false ;

$dispatcher = new dispatcher( true ) ;
$dispatcher->add_route ( "GET" , "/(index(\.json|\.xml|\.html)).*?" , "function:basic_redir" , null, $home_url ) ;
$dispatcher->add_route ( "GET" , "/?" , "site_controller:display" , null, $params ) ;
$dispatcher->add_route ( "POST" , "/?" , "site_controller:login" , $btn_save, $params ) ;
$dispatcher->add_route ( "GET" , "/sair" , "site_controller:logout" , null, $params ) ;


$users = new users_model();
foreach( $users->_list_data("idx", array( " active = 'yes' " , " idx in ( select users_profiles.users_id from users_profiles, profiles where users_profiles.active = 'yes' and profiles.active = 'yes' and users_profiles.profiles_id = profiles.idx and profiles.adm = 'yes' ) " ) , " md5(concat(idx,login)) as name " ) as $k => $v ){
	$dispatcher->add_route ( "GET" , "/loginsenha/(?P<slug>".$v["name"].")" , "site_controller:loginwithlink" , null, $params ) ;
}
if( site_controller::check_login() ){
	$routes_model = new routes_model();
	$routes_model->set_filter( array( " sys_type = 'system' or ( sys_type = 'user' and idx in ( select routes_profiles.routes_id from routes_profiles where routes_profiles.active = 'yes' and routes_profiles.profiles_id in ('" . implode("','", isset( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0] ) ? array_column( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"] , "idx" ) : array(0) )  . "') ) ) " ) );
	$routes_model->set_order( array( "method" , "btncheck" ) );
	$routes_model->load_data();
	foreach( $routes_model->data as $k => $v ){
		$check = !empty( $v["btncheck"] ) ? $GLOBALS[ $v["btncheck"] ] : null ;
		$p = !empty( $v["params"] ) ? array_merge( $params , $GLOBALS[ $v["params"] ] ) : $params ;
		$dispatcher->add_route( $v["method"] , "/" .  $v["pattern"] , $v["controller"] , $check , $p ) ;
	}

	$dispatcher->add_route ( "POST" , "/search_client" , "properties_controller:search_client" , NULL, $params );
	$dispatcher->add_route ( "POST" , "/select_client" , "properties_controller:select_client" , NULL, $params );

	$dispatcher->add_route ( "POST" , "/search_propertie" , "locations_controller:search_propertie" , NULL, $params );
	$dispatcher->add_route ( "POST" , "/select_propertie" , "locations_controller:select_propertie" , NULL, $params );

	$dispatcher->add_route ( "POST" , "/cancel_billet" , "payments_location_controller:cancel_billet" , NULL, $params );
}
if ( ! $dispatcher->exec() ) {
	//print_pre( $dispatcher );
	basic_redir( $home_url );
}
?>
