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

include(constant("cRootServer_APP") . "/gn-api-sdk-php/vendor/autoload.php");

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_8f31bad8f7b617e1dd8c3f90b004b3a8bae64ffe'; // informe seu Client_Id
$clientSecret = 'Client_Secret_0c6477c6f0e9bc98d107f99a68c428c6b8f5e4ea'; // informe seu Client_Secret

$payment = new payments_model();
$payment->set_filter(array(" idx = '" . $info["idx"] . "' "));
$payment->load_data();
$data = current($payment->data);

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => true, // altere conforme o ambiente (true = desenvolvimento e false = produção)
    'timeout' => 10000
];

// $charge_id refere-se ao ID da transação ("charge_id")
$params = [
    'id' => $data["charge_id"]
];

$api = new Gerencianet($options);
$charge = $api->detailCharge($params, []);

$info["post"]["status"] = $charge["data"]["status"];
$info["post"]["historic_bank"] = serialize($charge["data"]["history"]);

$payment->populate($info["post"]);
$payment->save();
