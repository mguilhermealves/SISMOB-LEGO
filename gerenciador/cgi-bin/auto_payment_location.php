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

$locations = new locations_model();
$locations->load_data();
$locations->attach(array("properties", "payments"));
$locations->attach_son("properties", array("clients"), true, null, array("idx", "name"));

$resto = 0;
$continue = false;
$dayNow = date("d");

foreach ($locations->data as $k => $v) {

    if ($v["active"] == "yes" && $v["payment_method"] == "ticket" && $v["day_due"] == $dayNow) {
        $qtd_parcel = $v["properties_attach"][0]["deadline_contract"];

        $resto = $qtd_parcel - count($v["payments_attach"]);

        if ($resto > 0) {
            $payments = new payments_model();

            $options = [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'sandbox' => true, // altere conforme o ambiente (true = desenvolvimento e false = produção)
                'timeout' => 10000
            ];

            $item_1 = [
                'name' => $v["first_name"] . " " . $v["last_name"],
                'amount' => 1,
                'value' => (int) $v["properties_attach"][0]["price_location"]
            ];

            $items = [
                $item_1
            ];

            //$metadata = array('notification_url'=>'sua_url_de_notificacao_.com.br'); //Url de notificações

            $customer = [
                'name' => $v["first_name"] . " " . $v["last_name"],
                'cpf' => $v["document"],
                'phone_number' => $v["phone"],
                'email' => $v["mail"]
            ];

            $configurations = [ // configurações de juros e mora
                'fine' => 100, // porcentagem de multa
                'interest' => 100 // porcentagem de juros
            ];

            $dateNow = date('Y-m-');

            $bankingBillet = [
                'expire_at' => $dateNow . $v["day_due"], // data de vencimento do titulo
                'message' => 'Boleto da Locação do Imovel, gerado através do SISMOB Ref à ' .  date('04/Y') . '.', // mensagem a ser exibida no boleto
                'customer' => $customer
            ];

            $payment = [
                'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
            ];

            $body = [
                'items' => $items,
                'payment' => $payment
            ];

            $info["post"]["payment"]["amount"] = $v["properties_attach"][0]["price_location"];
            $info["post"]["payment"]["day_due"] = $v["day_due"];
            $info["post"]["payment"]["payment_method"] = $v["payment_method"];

            $payments->populate($info["post"]["payment"]);
            $payments->save();

            $info["payments_idx"] = $payments->con->insert_id;

            try {
                $api = new Gerencianet($options);
                $pay_charge = $api->oneStep([], $body);

                $info["post"]["payment_gerencianet"]["barcode"] = $pay_charge["data"]["barcode"];
                $info["post"]["payment_gerencianet"]["link"] = $pay_charge["data"]["link"];
                $info["post"]["payment_gerencianet"]["pdf"] = $pay_charge["data"]["pdf"]["charge"];
                $info["post"]["payment_gerencianet"]["expire_at"] = $pay_charge["data"]["expire_at"];
                $info["post"]["payment_gerencianet"]["charge_id"] = $pay_charge["data"]["charge_id"];
                $info["post"]["payment_gerencianet"]["status"] = $pay_charge["data"]["status"];
                $info["post"]["payment_gerencianet"]["total_atuality"] = $pay_charge["data"]["total"];
                $info["post"]["payment_gerencianet"]["payment"] = $pay_charge["data"]["payment"];

                $payments->set_filter(array(" idx = '" . $info["payments_idx"] . "' "));
                $payments->load_data();

                $payments->populate($info["post"]["payment_gerencianet"]);
                $payments->save();
                $payments->save_attach(array("idx" => $info["payments_idx"], "post" => array("locations_id" =>  $v["idx"])), array("locations"), true);

                /* ENVIO E-MAIL DE NOVO PAGAMENTO */

                $venciment = date('Y-m-') . $v["day_due"];

                $new_payments = new payments_model();
                $new_payments->set_filter(array(" idx = '" . $info["payments_idx"] . "' "));
                $new_payments->load_data();
                $data = current($new_payments->data);

                $page = strtr(file_get_contents(constant("cFurniture") . "mail/new-payment-billet.html"), array(
                    "#HOST#" => constant("cFurniture") . "mail/new-payment-billet.html",
                    "#NOME#" => $v["first_name"] . " " . $v["last_name"],
                    "#CONTRACT#" => $v["n_contract"],
                    "#DAY_DUE#" => date('d/m/Y', strtotime($venciment)),
                    "#PAYMENT_METHOD#" => "Boleto Bancário",
                    "#AMOUNT#" => number_format($v["properties_attach"][0]["price_location"], 2),
                    "#BARCODE#" => $data["barcode"],
                    "#LINK#" => $data["pdf"],
                ));

                $messages_model = new messages_model();
                $messages_model->populate(array(
                    "name" => "SISMOB - Novo Boleto de Locação Gerado",
                    "scheduled_at" => date("Y-m-d H:i:s"),
                    "mailboxes" => serialize(array(
                        "Address" => array(
                            "name" => $v["first_name"] . " " . $v["last_name"],
                            "mail" => $v["mail"]
                        ),
                        "from" => array(
                            "name" => constant("mail_from_name"),
                            "mail" => constant("mail_from_user")
                        ),
                        "replyTo" => array(
                            "name" => constant("mail_from_name"),
                            "mail" => constant("mail_from_user")
                        )
                    )), "htmlmsg" => $page, "textmsg" => strip_tags($page),
                    "type" => "mail"
                ));
                $messages_model->save();
            } catch (GerencianetException $e) {
                print_r($e->code);
                print_r($e->error);
                print_r($e->errorDescription);
            } catch (Exception $e) {
                print_r($e->getMessage());
            }
        }
    }
}
