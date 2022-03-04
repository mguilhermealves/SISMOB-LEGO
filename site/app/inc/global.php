<?php
date_default_timezone_set('America/Sao_Paulo');
define( "cPaginate" , 150 );
ini_set('post_max_size', '4096M');
ini_set('upload_max_filesize', '4096M');
ini_set('default_charset', 'UTF-8');

// define ("cHStr", '172.29.0.2');
// define ("cUserStr", 'root');
// define ("cPassStr", '123456');
// define ("cBancoStr", 'mysql_wikipet');

define ("cHStr", 'hotshopwp.cqum7xneaink.sa-east-1.rds.amazonaws.com');
define ("cUserStr", 'usr-hml-lms-wikipet');
define ("cPassStr", 'u5RhMlW1k1P3t');
define ("cBancoStr", 'homolog-lms-wikipet');

define( "mail_from_name" , "Universidade PremieRpet® WikiPet" );
define( "mail_from_mail" , "wikipet@hsollearn.com.br" );
define ("mail_from_port", 587);
define ("mail_from_host", 'email-smtp.us-east-1.amazonaws.com');
define ("mail_from_user", 'AKIAJTFQPUZR3QNKISHQ');
define ("mail_from_pwd", 'ApvsNBppEDP/ZCdRpJcOpujnhEtxcDhElZMNQiidF1cy');

define("prefix_tables" , "");

define( "cAppKey" , "wikipet.site" );
define( "cTitle" , "Universidade PremieRpet® WikiPet" );

define( "cAppRoot" , "/" );
define( "cRootServer" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") ) ) ;
define( "cRootServer_APP" ,  sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") . "../app"  ) ) ;
define( "cFrontend" , sprintf( "http://%s%s" , $_SERVER["HTTP_HOST"] , constant("cAppRoot") ) );
define( "cFurniture" , sprintf( "%s%s" , constant("cFrontend") , "furniture/" ) );
?>