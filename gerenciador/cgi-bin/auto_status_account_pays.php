<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $_SERVER["DOCUMENT_ROOT"] = dirname( __FILE__ ) . "/../httpdocs/" ;
// $_SERVER["HTTP_HOST"] = "gerenciador.onetooneclub.com.br";
// putenv('SERVER_PORT=443');
// putenv('SERVER_PROTOCOL=https');

$_SERVER["DOCUMENT_ROOT"] = dirname(__FILE__) . "/../httpdocs/";
$_SERVER["HTTP_HOST"] = "gerenciador.imobiliaria.local";
putenv('SERVER_PORT=80');
putenv('SERVER_PROTOCOL=http');

putenv('SERVER_NAME=' . $_SERVER["HTTP_HOST"]);
putenv('SCRIPT_NAME=index.php');
set_include_path($_SERVER["DOCUMENT_ROOT"]  . PATH_SEPARATOR . get_include_path());
require_once($_SERVER["DOCUMENT_ROOT"] . "../app/inc/main.php");

$date_now = date("Y-m-d");

$account_pays = new account_pays_model();
$account_pays->set_filter(array(" day_due < '" . $date_now . "' and active = 'yes' and status_payment = 'waiting' "));
$account_pays->load_data();

foreach ($account_pays->data as $k => $v) {

    $info["post"]["status_payment"] = "unpaid";

    $account_pays->populate($info["post"]);
    $account_pays->save();
}
