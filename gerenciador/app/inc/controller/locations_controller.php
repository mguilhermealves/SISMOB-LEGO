<?php

use Dompdf\Dompdf;

class locations_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new locations_model();
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

		$locations = new locations_model();

		if ($info["format"] != ".json") {
			$locations->set_paginate(array($info["sr"], $paginate));
		} else {
			$locations->set_paginate(array(0, 900000));
		}

		$locations->set_filter($filter);
		$locations->set_order(array($ordenation));

		list($total, $data) = $locations->return_data();
		$locations->attach(array("offices", "partners", "properties"));
		$locations->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = $locations->data;

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
				$page = 'Imoveis';
				$sidebar_color = "rgba(218, 165, 32, 1)";

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["locations_url"], $done) : $GLOBALS["locations_url"]), "pattern" => array(
						"new" => $GLOBALS["newlocation_url"],
						"action" => $GLOBALS["location_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["locations_url"], $info["get"]) : $GLOBALS["locations_url"]
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
				include(constant("cRootServer") . "ui/page/locations/locations.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_location_json = {' . "\n");
				print('        url: "' . $GLOBALS["locations_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["location_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/locations/locations.js");
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
			$location = new locations_model();
			$location->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$location->load_data();
			$location->attach(array("offices", "partners", "properties"));
			$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($location->data);
			$form = array(
				"title" => "Editar Locação",
				"url" => sprintf($GLOBALS["location_url"], $info["idx"]),
				"donwload_contract" => $GLOBALS["location_contract_url"]
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Locação",
				"url" => $GLOBALS["newlocation_url"]
			);
		}

		$sidebar_color = "rgba(218, 165, 32, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/locations/location.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/locations/location.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$location = new locations_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$location->set_filter(array(" idx = '" . $info["idx"] . "' "));
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

			$location->save_attach(array("idx" => $info["payments_id"], "post" => array("payments_id" =>  $info["payments_id"])), array("payments"));

			/* update is used propertie */
			$info["post"]["properties"]["is_used"] = "yes";

			$propertie = new properties_model();
			$propertie->set_filter(array(" idx = '" . $info["post"]["properties_id"] . "' "));

			$propertie->populate($info["post"]["properties"]);
			$propertie->save();
		}

		$location->populate($info["post"]);
		$location->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $location->con->insert_id;
		}

		$location->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["properties_id"])), array("properties"));

		/* save office */
		$office = new offices_model();
		$office->populate($info["post"]["offices"]);
		$office->save();
		$info["offices_id"] = $office->con->insert_id;

		$location->save_attach(array("idx" => $info["idx"], "post" => array("offices_id" => $info["offices_id"])), array("offices"));

		/* save partner */
		$partner = new partners_model();
		$partner->populate($info["post"]["partner"]);
		$partner->save();
		$info["partners_id"] = $office->con->insert_id;
		$location->save_attach(array("idx" => $info["idx"], "post" => array("partners_id" => $info["partners_id"])), array("partner"));

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

		$location = new locations_model();
		$location->set_filter(array(" idx = '" . $info["post"]["idx"] . "' "));
		$location->load_data();
		$location->attach(array("offices", "partners", "properties"));
		$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = current($location->data);

		/* GERAR PDF */
		include(constant("cRootServer_APP") . '/inc/lib/vendor/autoload.php');

		$dompdf = new DOMPDF();

		ob_start();
		require(constant("cFurniture1") . 'pdf/location/contract.php');
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
			$propertie = new locations_model();

			$propertie->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$propertie->remove();
		}

		basic_redir($GLOBALS["locations_url"]);
	}
}
