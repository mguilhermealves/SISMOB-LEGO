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

$locations = new locations_model();
$locations->load_data();
$locations->attach(array("properties", "payments"));
$locations->attach_son("properties", array("clients"), true, null, array("idx", "name"));

foreach ($locations->data as $k => $v) {

    if (sizeof($v["payments_attach"]) == 0 && $v["payment_method"] == "ticket") {
        $info["post"]["status"] = "waiting";
        $info["post"]["amount"] = $v["properties_attach"][0]["price_location"];
        $info["post"]["day_due"] = $v["day_due"];
        $info["post"]["payment_method"] = $v["payment_method"];

        $payment = new payments_model();
        $payment->populate($info["post"]);
        $payment->save();

        $info["idx"] = $payment->con->insert_id;

        $payment->save_attach(array("idx" => $info["idx"], "post" => array("locations_id" =>  $v["idx"])), array("locations"), true);

        include(constant("cRootServer_APP") . "/gerencianet/boleto/gerar_boleto.php");
    }
}
