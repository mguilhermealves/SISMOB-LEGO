<?php

use Dompdf\Dompdf;

class sales_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new sales_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" idx asc "));
		$boiler->set_filter($filters);
		$boiler->load_data();
		$out = array();
		foreach ($boiler->data as $value) {
			$out[$value[$key]] = $value[$field];
		}
		return $out;
	}

	private function filter($info)
	{
		$done = array();
		$filter = array(" active = 'yes' ");

		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
			$done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
			$done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}

		if (isset($info["get"]["filter_uf"]) && !empty($info["get"]["filter_uf"])) {
			$done["filter_uf"] = $info["get"]["filter_uf"];
			$filter["filter_uf"] = " uf like '%" . $info["get"]["filter_uf"] . "%' ";
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " document like '%" . $info["get"]["filter_cpf"] . "%' ";
		}

		if (isset($info["get"]["filter_contract"]) && !empty($info["get"]["filter_contract"])) {
			$done["filter_contract"] = $info["get"]["filter_contract"];
			$filter["filter_contract"] = " n_contract like '%" . $info["get"]["filter_contract"] . "%' ";
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " first_name like '%" . $info["get"]["filter_name"] . "%' ";
		}

		return array($done, $filter);
	}

	public function display($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'idx asc';

		list($done, $filter) = $this->filter($info);

		$sales = new sales_model();

		if ($info["format"] != ".json") {
			$sales->set_paginate(array($info["sr"], $paginate));
		} else {
			$sales->set_paginate(array(0, 900000));
		}

		$sales->set_filter($filter);
		$sales->set_order(array($ordenation));

		list($total, $data) = $sales->return_data();
		// $sales->attach(array("offices", "partners", "properties"));
		// $sales->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = $sales->data;

		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array("total" => $total), "row" => $data
					)
				);
				break;
			default:
				$page = 'Vendas';
				$sidebar_color = "rgba(218, 165, 32, 1)";

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["sales_url"], $done) : $GLOBALS["sales_url"]), "pattern" => array(
						"new" => $GLOBALS["newsale_url"],
						"action" => $GLOBALS["sale_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["sales_url"], $info["get"]) : $GLOBALS["sales_url"]
					)
				);

				$ordenation_address = 'address-asc';
				$ordenation_address_ordenation = 'fas fa-border-none';
				$ordenation_ncontract = 'n_contract-asc';
				$ordenation_ncontract_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'address asc':
						$ordenation_address = 'address-desc';
						$ordenation_address_ordenation = 'bi bi-arrow-up';
						break;
					case 'address desc':
						$ordenation_address = 'address-asc';
						$ordenation_address_ordenation = 'bi bi-arrow-down';
						break;
					case 'n_contract asc':
						$ordenation_ncontract = 'n_contract-desc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-up';
						break;
					case 'n_contract desc':
						$ordenation_ncontract = 'n_contract-asc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-down';
						break;
					case 'created_at asc':
						$ordenation_createdat = 'created_at-desc';
						$ordenation_createdat_ordenation = 'bi bi-arrow-up';
						break;
					case 'created_at desc':
						$ordenation_createdat = 'created_at-asc';
						$ordenation_createdat_ordenation = 'bi bi-arrow-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/sales/sales.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_location_json = {' . "\n");
				print('        url: "' . $GLOBALS["sales_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["sale_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/sales/sales.js");
				print('</script>' . "\n");
				include(constant("cRootServer") . "ui/common/foot.inc.php");
				break;
		}
	}

	public function form($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$sale = new sales_model();
			$sale->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$sale->load_data();
			// $sale->attach(array("offices", "partners", "properties"));
			// $sale->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($sale->data);
			$form = array(
				"title" => "Editar Venda",
				"url" => sprintf($GLOBALS["sale_url"], $info["idx"]),
				"donwload_contract" => $GLOBALS["sale_contract_url"]
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Venda",
				"url" => $GLOBALS["newsale_url"]
			);
		}

		$sidebar_color = "rgba(218, 165, 32, 1)";
		$page = 'Venda';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/sales/sale.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/sales/sale.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	/**
	 * Search Propertie for clients
	 * 
	 */
	public function search_propertie($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$done =  array();
		$properties = new properties_model();

		if ($info["post"]["cod_propertie"] != null) {
			$properties->set_filter(array(" idx = '" . $info["post"]["cod_propertie"] . "' "));

			$properties->load_data();
			$data = $properties->data;
		}

		$clients = new clients_model();

		if ($info["post"]["name_client"] != null) {

			$clients->set_filter(array(" first_name = '" . $info["post"]["name_client"] . "' "));

			$clients->load_data();
			$data = $clients->data;
		}

		if ($info["post"]["cpf_client"] != null) {

			$clients->set_filter(array(" document = '" . $info["post"]["cpf_client"] . "' "));

			$clients->load_data();
			$data = $clients->data;
		}

		echo json_encode($data);
	}

	/**
	 * Select Propertie after search
	 * 
	 */
	public function select_propertie($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$client = new properties_model();

		$client->set_filter(array(" idx = '" . $info["post"]["cod_propertie"] . "' and is_used = 'no' "));

		$client->load_data();
		$client->attach(array("clients"), true);
		$data = current($client->data);

		echo json_encode($data);
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$sale = new sales_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$sale->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		if (isset($info["post"]["is_aproved"]) && $info["post"]["is_aproved"] == "approved") {
			$info["post"]["n_contract"] = $info["idx"] . date("YmdHis");

			$payment = new payments_model();

			$info["post"]["day_due"] = $info["post"]["day_due"];

			$payment->populate($info["post"]);
			$payment->save();

			$info["payments_id"] = $payment->con->insert_id;

			$sale->save_attach(array("idx" => $info["payments_id"], "post" => array("payments_id" =>  $info["payments_id"])), array("payments"));

			/* update is used propertie */
			$info["post"]["properties"]["is_used"] = "yes";

			$propertie = new properties_model();
			$propertie->set_filter(array(" idx = '" . $info["post"]["properties_id"] . "' "));

			$propertie->populate($info["post"]["properties"]);
			$propertie->save();
		}

		$sale->populate($info["post"]);
		$sale->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $sale->con->insert_id;
		}

		$sale->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["properties_id"])), array("properties"));

		/* save office */
		$office = new offices_model();
		$office->populate($info["post"]["offices"]);
		$office->save();
		$info["offices_id"] = $office->con->insert_id;

		$sale->save_attach(array("idx" => $info["idx"], "post" => array("offices_id" => $info["offices_id"])), array("offices"));

		/* save partner */
		$partner = new partners_model();
		$partner->populate($info["post"]["partner"]);
		$partner->save();
		$info["partners_id"] = $office->con->insert_id;
		$sale->save_attach(array("idx" => $info["idx"], "post" => array("partners_id" => $info["partners_id"])), array("partner"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["locations_url"]);
		}
	}

	public function contract($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$sale = new sales_model();
		$sale->set_filter(array(" idx = '" . $info["post"]["idx"] . "' "));
		$sale->load_data();
		$sale->attach(array("offices", "partners", "properties"));
		$sale->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = current($sale->data);

		/* GERAR PDF */
		include(constant("cRootServer_APP") . '/inc/lib/vendor/autoload.php');

		$dompdf = new DOMPDF();

		ob_start();
		require(constant("cFurniture1") . 'pdf/sale/contract.php');
		$html = ob_get_contents();
		ob_end_clean();

		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		$dompdf->stream(
			"contrato.pdf",
			array(
				"Attachment" => true
			)
		);
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$sale = new sales_model();

			$sale->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$sale->remove();
		}

		basic_redir($GLOBALS["sales_url"]);
	}
}
