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

foreach ($locations->data as $k => $v) {

    if ($v["properties_attach"][0]["object_propertie"] == "location") {
        if (empty($v["payments_attach"][0]) && $v["payment_method"] == "ticket") {
            $dateNow = date("Y-m-d");
            $due = date('Y-m-' . $v["day_due"]);
            $sumOneMonth = date('Y-m-d', strtotime($due . ' + 1 month'));
            // $lastTendays = date('Y-m-d', strtotime($sumOneMonth . ' - 15 days'));

            $price_iptu = $v["properties_attach"][0]["price_iptu"] / $v["properties_attach"][0]["deadline_contract"];
            $price_location = $v["properties_attach"][0]["price_location"] - $price_iptu;

            $v["properties_attach"][0]["price_location"] = preg_replace("/[^0-9]/", "", $v["properties_attach"][0]["price_location"]);

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

            $bankingBillet = [
                'expire_at' => $sumOneMonth, // data de vencimento do titulo
                'message' => 'Aluguel n° 1 com vencimento em ' .  date_format(new \DateTime( $sumOneMonth ), "d/m/Y") . "\n". ' Aluguel R$ ' . number_format($price_location, 2, ",", ".") . "\n". 'IPTU R$ ' . number_format($price_iptu, 2, ",", "."), // mensagem a ser exibida no boleto
                'customer' => $customer
            ];

            $payment = [
                'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
            ];

            $body = [
                'items' => $items,
                'payment' => $payment
            ];

            $info["post"]["payment"]["amount"] = $price_location + $price_iptu;
            $info["post"]["payment"]["day_due"] = $v["day_due"];
            $info["post"]["payment"]["payment_method"] = $v["payment_method"];

            $payments->populate($info["post"]["payment"]);
            $payments->save();

            $info["payments_id"] = $payments->con->insert_id;
            $info["idx"] = $v["properties_attach"][0]["idx"];

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

                $loadpayments->set_filter(array(" idx = '" . $info["payments_id"] . "' "));
                $loadpayments->load_data();

                $loadpayments->populate($info["post"]["payment_gerencianet"]);
                $loadpayments->save();
                $loadpayments->save_attach(array("locations"), true);
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
