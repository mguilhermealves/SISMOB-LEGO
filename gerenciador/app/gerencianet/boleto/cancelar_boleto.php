<?php

include(constant("cRootServer_APP") . "/gn-api-sdk-php/vendor/autoload.php");

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_8f31bad8f7b617e1dd8c3f90b004b3a8bae64ffe'; // informe seu Client_Id
$clientSecret = 'Client_Secret_0c6477c6f0e9bc98d107f99a68c428c6b8f5e4ea'; // informe seu Client_Secret

$error = false;

$payment = new payments_model();
$payment->set_filter(array(" idx = '" . $info["post"]["idDetail"] . "' "));
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

try {
    $api = new Gerencianet($options);
    $charge = $api->cancelCharge($params, []);

    print_r( $_SESSION["messages_app"]["success"] = array("Boleto cancelado com sucesso.") );
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
    print_r( $_SESSION["messages_app"]["danger"] = array("Apenas transações com status: [Cobrança Gerada], [Aguardando] ou [Não Pago] podem ser canceladas.") );
} catch (Exception $e) {
    print_r($e->getMessage());
}
