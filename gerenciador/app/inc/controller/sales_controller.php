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
			$filter["filter_name"] = " concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["filter_name"] . "%' ";
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
		$sales->attach(array("users"), true);
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

				$ordenation_first_name = 'first_name-asc';
				$ordenation_first_name_ordenation = 'bi bi-border';
				$ordenation_address = 'address-asc';
				$ordenation_address_ordenation = 'bi bi-border';
				$ordenation_district = 'district-asc';
				$ordenation_district_ordenation = 'bi bi-border';
				$ordenation_city = 'city-asc';
				$ordenation_city_ordenation = 'bi bi-border';
				$ordenation_uf = 'uf-asc';
				$ordenation_uf_ordenation = 'bi bi-border';
				$ordenation_is_aproved = 'is_aproved-asc';
				$ordenation_is_aproved_ordenation = 'bi bi-border';
				$ordenation_ncontract = 'is_aproved-asc';
				$ordenation_ncontract_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'first_name asc':
						$ordenation_first_name = 'first_name-desc';
						$ordenation_first_name_ordenation = 'bi bi-arrow-up';
						break;
					case 'first_name desc':
						$ordenation_first_name = 'first_name-asc';
						$ordenation_first_name_ordenation = 'bi bi-arrow-down';
						break;
					case 'address asc':
						$ordenation_address = 'address-desc';
						$ordenation_address_ordenation = 'bi bi-arrow-up';
						break;
					case 'address desc':
						$ordenation_address = 'address-asc';
						$ordenation_address_ordenation = 'bi bi-arrow-down';
						break;
					case 'n_contract asc':
						$ordenation_district = 'n_contract-desc';
						$ordenation_district_ordenation = 'bi bi-arrow-up';
						break;
					case 'city desc':
						$ordenation_district = 'city-asc';
						$ordenation_district_ordenation = 'bi bi-arrow-down';
						break;
					case 'city asc':
						$ordenation_city = 'city-desc';
						$ordenation_city_ordenation = 'bi bi-arrow-up';
						break;
					case 'n_contract desc':
						$ordenation_city = 'n_contract-asc';
						$ordenation_city_ordenation = 'bi bi-arrow-down';
						break;
					case 'uf asc':
						$ordenation_uf = 'uf-desc';
						$ordenation_uf_ordenation = 'bi bi-arrow-up';
						break;
					case 'uf desc':
						$ordenation_uf = 'uf-asc';
						$ordenation_uf_ordenation = 'bi bi-arrow-down';
						break;
					case 'is_aproved asc':
						$ordenation_is_aproved = 'is_aproved-desc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-up';
						break;
					case 'is_aproved desc':
						$ordenation_is_aproved = 'is_aproved-asc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-down';
						break;
					case 'n_contract asc':
						$ordenation_ncontract = 'n_contract-desc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-up';
						break;
					case 'n_contract desc':
						$ordenation_ncontract = 'n_contract-asc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-down';
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
			$sale->attach(array("users"), true);
			$sale->attach(array("properties"));
			$sale->attach_son("properties", array("users"), true);
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

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["sales_url"];

		$page = 'Venda';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/sales/sale.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/sales/sale.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$sale = new sales_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$sale->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		if (isset($info["post"]["is_aproved"]) && $info["post"]["is_aproved"] == "approved") {
			$info["post"]["n_contract"] = $info["idx"] . date("YmdHis");

			$payment = new payments_model();

			$payment->populate($info["post"]);
			$payment->save();

			$info["payments_id"] = $payment->con->insert_id;

			$sale->save_attach(array("idx" => $info["payments_id"], "post" => array("payments_id" =>  $info["payments_id"])), array("payments"));

			/* update is used propertie */
			$info["post"]["properties"]["is_used"] = "yes";

			$propertie = new properties_model();
			$propertie->set_filter(array(" idx = '" . $info["post"]["cod_propertie"] . "' "));

			$propertie->populate($info["post"]["properties"]);
			$propertie->save();
		}

		$sale->populate($info["post"]);
		$sale->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $sale->con->insert_id;
		}

		$sale->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["cod_propertie"])), array("properties"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["sales_url"]);
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
			"contrato-de-venda.pdf",
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
