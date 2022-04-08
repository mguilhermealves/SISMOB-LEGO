<?php

include(constant("cRootServer_APP") . "/gn-api-sdk-php/vendor/autoload.php");

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_8f31bad8f7b617e1dd8c3f90b004b3a8bae64ffe'; // informe seu Client_Id
$clientSecret = 'Client_Secret_0c6477c6f0e9bc98d107f99a68c428c6b8f5e4ea'; // informe seu Client_Secret

$payment = new payments_model();
$payment->set_filter(array(" idx = '" . $info["post"]["idPayment"] . "' "));
$payment->load_data();
$payment->attach(array("locations"), true);
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

$body = [
    'email' => $data["locations_attach"][0]["mail"]
];

try {
    $api = new Gerencianet($options);
    $charge = $api->resendBillet($params, $body);

    $_SESSION["messages_app"]["success"] = array("Boleto enviado com sucesso.");
} catch (GerencianetException $e) {
    $_SESSION["messages_app"]["danger"] = array("Ocorreu um erro ao reenviar o boleto, comunique a equipe de TI ou tente novamente mais tarde.");
} catch (Exception $e) {
    $_SESSION["messages_app"]["danger"] = $e->getMessage();
}
