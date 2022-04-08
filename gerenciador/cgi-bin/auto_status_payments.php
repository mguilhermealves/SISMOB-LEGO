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

$payments = new payments_model();
$payments->load_data();

$resto = 0;
$continue = false;

foreach ($payments->data as $k => $v) {

    if ($v["payment_method"] == "ticket" && $v["status"] == 'waiting') {

        $payments = new payments_model();

        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => true, // altere conforme o ambiente (true = desenvolvimento e false = produção)
            'timeout' => 10000
        ];

        $params = [
            'id' => $v["charge_id"] // $charge_id refere-se ao ID da transação ("charge_id")
        ];

        try {
            $api = new Gerencianet($options);
            $charge = $api->detailCharge($params, []);

            $info["post"]["update_status_gerencianet"]["status"] = $charge["data"]["status"];
            $info["post"]["update_status_gerencianet"]["historic_bank"] = serialize($charge["data"]["history"]);

            $payments->set_filter(array(" charge_id = '" . $v["charge_id"] . "' "));
            $payments->load_data();

            $payments->populate($info["post"]["update_status_gerencianet"]);
            $payments->save();

            // if ($charge["data"]["status"] != $v["status"]) {
            //     /* ENVIO E-MAIL DE ATUALIZACAO DE PAGAMENTO */

            //     $venciment = date('Y-m-') . $v["day_due"];

            //     $new_payments = new payments_model();
            //     $new_payments->set_filter(array(" idx = '" . $info["payments_idx"] . "' "));
            //     $new_payments->load_data();
            //     $data = current($new_payments->data);

            //     // print_pre($data, true);

            //     $page = strtr(file_get_contents(constant("cFurniture") . "mail/new-payment-billet.html"), array(
            //         "#HOST#" => constant("cFurniture") . "mail/new-payment-billet.html",
            //         "#NOME#" => $v["first_name"] . " " . $v["last_name"],
            //         "#CONTRACT#" => $v["n_contract"],
            //         "#DAY_DUE#" => date('d/m/Y', strtotime($venciment)),
            //         "#PAYMENT_METHOD#" => "Boleto Bancário",
            //         "#AMOUNT#" => number_format($v["properties_attach"][0]["price_location"], 2),
            //         "#BARCODE#" => $data["barcode"],
            //         "#LINK#" => $data["pdf"],
            //     ));

            //     $messages_model = new messages_model();
            //     $messages_model->populate(array(
            //         "name" => "SISMOB - Novo Boleto de Locação Gerado",
            //         "scheduled_at" => date("Y-m-d H:i:s"),
            //         "mailboxes" => serialize(array(
            //             "Address" => array(
            //                 "name" => $v["first_name"] . " " . $v["last_name"],
            //                 "mail" => $v["mail"]
            //             ),
            //             "from" => array(
            //                 "name" => constant("mail_from_name"),
            //                 "mail" => constant("mail_from_user")
            //             ),
            //             "replyTo" => array(
            //                 "name" => constant("mail_from_name"),
            //                 "mail" => constant("mail_from_user")
            //             )
            //         )), "htmlmsg" => $page, "textmsg" => strip_tags($page),
            //         "type" => "mail"
            //     ));
            //     $messages_model->save();
            // }
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    } 
}
