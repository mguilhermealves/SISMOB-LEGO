<?php
date_default_timezone_set('America/Sao_Paulo');
define( "cPaginate" , 150 );
ini_set('post_max_size', '4096M');
ini_set('upload_max_filesize', '4096M');
ini_set('default_charset', 'UTF-8');

define ("cHStr", '172.29.0.2');
define ("cUserStr", 'user_imobiliaria');
define ("cPassStr", '123456');
define ("cBancoStr", 'mysql_imobiliaria');

// define ("cHStr", 'mysql746.umbler.com');
// define ("cUserStr", 'system_homolog');
// define ("cPassStr", 'kmlp5842');
// define ("cBancoStr", 'system-homolog');

define("prefix_tables" , "");

define( "cAppKey" , "sismob.gerenciador" );
define( "cTitle" , "SysMob - Sistema Gestão Imobiliárias" );

define( "cAppRoot" , "/" );
define( "cRootServer" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "/" ) ) ;
define( "cRootServer_APP" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") . "../app"  ) ) ;
define( "cFrontend" , sprintf( "http://%s%s" , $_SERVER["HTTP_HOST"] , constant("cAppRoot") ) );
define( "cFrontend_USER" , "http://sismob.local/" );
define( "cFrontComponents" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "ui/components/" ) ) ;
define( "cFurniture1" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , "furniture/" ) ) ;
define( "cFurniture" , sprintf( "%s%s" , constant("cFrontend") , "furniture/" ) );


// define( "mail_from_port" , "587" );
// define( "mail_from_host" , "smtp.umbler.com" );
// define( "mail_from_user" , "atendimento@onetooneclub.com.br" );
// define( "mail_from_name" , "Atendimento One to One Club" );
// define( "mail_from_pwd" , "@t3Nd1M3nt0T3mpluz" );

define( "mail_from_port" , "2525" );
define( "mail_from_host" , "smtp.mailtrap.io" );
define( "mail_from_user" , "97e415f995a883" );
define( "mail_from_name" , "Atendimento SISMOB" );
define( "mail_from_pwd" , "1d8c1c6c618fb1" );
?>