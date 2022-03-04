<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SERVER["DOCUMENT_ROOT"] = dirname( __FILE__ ) . "/../httpdocs/" ;
$_SERVER["HTTP_HOST"] = "gerenciador.onetooneclub.com.br";
putenv('SERVER_PORT=443');
putenv('SERVER_PROTOCOL=https');

//$_SERVER["DOCUMENT_ROOT"] = dirname( __FILE__ ) . "/../httpdocs/" ;
//$_SERVER["HTTP_HOST"] = "gerenciador.templus.local";
//putenv('SERVER_PORT=80');
//putenv('SERVER_PROTOCOL=http');

putenv('SERVER_NAME='.$_SERVER["HTTP_HOST"]);
putenv('SCRIPT_NAME=index.php') ;
set_include_path( $_SERVER["DOCUMENT_ROOT"]  . PATH_SEPARATOR . get_include_path());
require_once( $_SERVER["DOCUMENT_ROOT"] . "../app/inc/main.php");


$users = new users_model();
$users->set_filter( array( " active = 'yes' "," created_at >= '2022-01-10 00:00:00' "  ) );
$users->load_data();
$users->attach(array("tokens"));
foreach( $users->data as $k => $v ){

        $token_name = md5(date("YmdHis") . $v["idx"]) ;
		if ( !isset( $v["tokens_attach"][0] ) ) {
			$tokens = new tokens_model();
			$tokens->populate( array( "name" => $token_name ) );
			$tokens->save();
			$info = $tokens->con->insert_id;
            $tokens->save_attach(array( "idx" => $info , array( "post" => array("users_id" => $v["idx"] ) ) ) , array("users") , true ) ;
		}
        else{
            $token_name = $v["tokens_attach"][0]["name"] ;
	}

    $page = strtr( file_get_contents( "/git/site/public_html/furniture/mail/bem-vindo.html") , array(
        "#HOST#" => constant("cFrontend_USER") . "furniture/mail/"
        , "#NOME#" => $v["first_name"]
        , "#LOGIN#" => $v["mail"]
        , "#LINK#" => sprintf( $GLOBALS["tkpwd_url"] , $token_name )
    ) );

    $messages_model = new messages_model();
    $messages_model->populate( array(
        "name" => "Bem Vindo"
        , "scheduled_at" => date("Y-m-d H:i:s")
        , "mailboxes" => serialize( array( 
            "Address" => array( "name" => $v["first_name"] , "mail" => $v["mail"] )
            , "from" => array( "name" => constant( "mail_from_name") , "mail" => constant( "mail_from_user") )
            , "replyTo" => array( "name" => constant( "mail_from_name") , "mail" => constant( "mail_from_user") )
         ) ) 
        , "htmlmsg" => $page 
        , "textmsg" => strip_tags( $page )
        , "type" => "mail"
    ));
    $messages_model->save();
}
?>
