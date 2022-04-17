<?php

include(constant("cRootServer_APP") . "/gn-api-sdk-php/vendor/autoload.php");

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$clientId = 'Client_Id_8f31bad8f7b617e1dd8c3f90b004b3a8bae64ffe'; // informe seu Client_Id
$clientSecret = 'Client_Secret_0c6477c6f0e9bc98d107f99a68c428c6b8f5e4ea'; // informe seu Client_Secret

$location = new locations_model();
$location->set_filter(array(" idx = '" . $info["idx"] . "' "));
$location->load_data();
$location->attach(array("offices", "partners", "properties", "payments"));
$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
$data = current($location->data);

print_pre($data, true);

$options = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'sandbox' => true, // altere conforme o ambiente (true = desenvolvimento e false = produção)
    'timeout' => 10000
];

$item_1 = [
    'name' => $data["first_name"] . " " . $data["last_name"],
    'amount' => 1,
    'value' => (int) $data["properties_attach"][0]["price_location"]
];

$items = [
    $item_1
];

//$metadata = array('notification_url'=>'sua_url_de_notificacao_.com.br'); //Url de notificações

$customer = [
    'name' => $data["first_name"] . " " . $data["last_name"],
    'cpf' => $data["document"],
    'phone_number' => $data["phone"],
    'email' => $data["mail"]
];

$configurations = [ // configurações de juros e mora
    'fine' => 100, // porcentagem de multa
    'interest' => 100 // porcentagem de juros
];

$dateNow = date('Y-m-');

$bankingBillet = [
    'expire_at' => $dateNow . $data["day_due"], // data de vencimento do titulo
    'message' => 'Boleto Gerado através do SISMOB - Sistema Imobiliario.', // mensagem a ser exibida no boleto
    'customer' => $customer
];

$payment = [
    'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
];

$body = [
    'items' => $items,
    'payment' => $payment
];

print_pre($body, true);

try {
    $api = new Gerencianet($options);
    $pay_charge = $api->oneStep([], $body);

    $ticket = new tickets_model();

    $info["post"]["ticket"]["barcode"] = $pay_charge["data"]["barcode"];
    $info["post"]["ticket"]["link"] = $pay_charge["data"]["link"];
    $info["post"]["ticket"]["pdf"] = $pay_charge["data"]["pdf"]["charge"];
    $info["post"]["ticket"]["expire_at"] = $pay_charge["data"]["expire_at"];
    $info["post"]["ticket"]["charge_id"] = $pay_charge["data"]["charge_id"];
    $info["post"]["ticket"]["status"] = $pay_charge["data"]["status"];
    $info["post"]["ticket"]["total"] = $pay_charge["data"]["total"];
    $info["post"]["ticket"]["payment"] = $pay_charge["data"]["payment"];

    $ticket->populate($info["post"]["ticket"]);
    $ticket->save();

    $info["ticket"]["idx"] = $ticket->con->insert_id;

    $ticket->save_attach(array("idx" => $info["ticket"]["idx"], "post" => array("payments_id" =>  $info["idx"])), array("payments"));
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
