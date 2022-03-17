<?php
class payments_location_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new payments_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" name asc "));
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
		if (!in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"], array(1, 2)) && !in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["slug"], array('adm-premier', 'gestor-hsol'))) {
			//$done["filter_profiles"] = $info["get"]["filter_profiles"];
			$profiles_id = array_keys(profiles_controller::data4select("idx", array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) ")));
			$filter["filter_profiles"] = " idx in ( select trails_profiles.trails_id from trails_profiles where trails_profiles.active = 'yes' and trails_profiles.profiles_id in ( '" . implode("','", $profiles_id) . "') ) ";
		} else {
			if (isset($info["get"]["filter_profiles"]) && !empty($info["get"]["filter_profiles"])) {
				$done["filter_profiles"] = $info["get"]["filter_profiles"];
				$filter["filter_profiles"] = " idx in ( select trails_profiles.trails_id from trails_profiles where trails_profiles.active = 'yes' and trails_profiles.profiles_id = '" . $info["get"]["filter_profiles"] . "' ) ";
			}
		}

		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
			$done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
			$done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}
		if (isset($info["get"]["filter_id"]) && !empty($info["get"]["filter_id"])) {
			$done["filter_id"] = $info["get"]["filter_id"];
			$filter["filter_id"] = " idx like '%" . $info["get"]["filter_id"] . "%' ";
		}

		if (isset($info["get"]["filter_title"]) && !empty($info["get"]["filter_title"])) {
			$done["filter_title"] = $info["get"]["filter_title"];
			$filter["filter_title"] = " trail_title like '%" . $info["get"]["filter_title"] . "%' ";
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " trail_title like '%" . $info["get"]["filter_name"] . "%' ";
		}
		if (isset($info["get"]["filter_trail_status"]) && !empty($info["get"]["filter_trail_status"])) {
			$done["filter_trail_status"] = $info["get"]["filter_trail_status"];
			$filter["filter_trail_status"] = " trail_status = '" . $info["get"]["filter_trail_status"] . "' ";
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
		$locations->attach(array("offices", "partners", "properties", "payments"));
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
				$page = 'Pagamento Locação';

				$sidebar_color = "rgba(0, 139, 139, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["location_payments_url"], $done) : $GLOBALS["location_payments_url"]), "pattern" => array(
						"new" => $GLOBALS["newlocationpayment_url"],
						"action" => $GLOBALS["location_payment_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["location_payments_url"], $info["get"]) : $GLOBALS["location_payments_url"]
					)
				);

				$ordenation_positions = 'display_position-asc';
				$ordenation_positions_ordenation = 'fas fa-border-none';
				$ordenation_trail = 'trail_title-asc';
				$ordenation_trail_ordenation = 'fas fa-border-none';
				$ordenation_modifiedat = 'modified_at-asc';
				$ordenation_modifiedat_ordenation = 'fas fa-border-none';
				$ordenation_trail_status = 'trail_status-asc';
				$ordenation_trail_status_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'display_position asc':
						$ordenation_positions = 'display_position-desc';
						$ordenation_positions_ordenation = 'fas fa-angle-up';
						break;
					case 'display_position desc':
						$ordenation_positions = 'display_position-asc';
						$ordenation_positions_ordenation = 'fas fa-angle-down';
						break;
					case 'trail_title asc':
						$ordenation_trail = 'trail_title-desc';
						$ordenation_trail_ordenation = 'fas fa-angle-up';
						break;
					case 'trail_title desc':
						$ordenation_trail = 'trail_title-asc';
						$ordenation_trail_ordenation = 'fas fa-angle-down';
						break;
					case 'modified_at asc':
						$ordenation_modifiedat = 'modified_at-desc';
						$ordenation_modifiedat_ordenation = 'fas fa-angle-up';
						break;
					case 'modified_at desc':
						$ordenation_modifiedat = 'modified_at-asc';
						$ordenation_modifiedat_ordenation = 'fas fa-angle-down';
						break;
					case 'trail_status asc':
						$ordenation_trail_status = 'trail_status-desc';
						$ordenation_trail_status_ordenation = 'fas fa-angle-up';
						break;
					case 'trail_status desc':
						$ordenation_trail_status = 'trail_status-asc';
						$ordenation_trail_status_ordenation = 'fas fa-angle-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/locations/payments/payments.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_agendas_json = {' . "\n");
				print('        url: "' . $GLOBALS["locations_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["location_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/locations/payments/payments.js");
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
			$location->attach(array("offices", "partners", "properties", "payments"));
			$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($location->data);
			$form = array(
				"title" => "Editar Pagamento de Locação",
				"url" => sprintf($GLOBALS["location_payment_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Pagamento de Locação",
				"url" => $GLOBALS["newlocationpayment_url"]
			);
		}

		// print_pre($data["payments_attach"][0]["tickets_attach"], true);

		$sidebar_color = "rgba(0, 139, 139, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/locations/payments/payment.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/locations/payments/payment.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function form_detail($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$payment = new payments_model();
		$payment->set_filter(array(" idx = '" . $info["idx_payment"] . "' "));
		$payment->load_data();
		$payment->attach(array("tickets"), true);
		$data = current($payment->data);
		$form = array(
			"title" => "Detalhes do Pagamento da Locação",
			"url" => sprintf($GLOBALS["location_payment_url"], $info["idx_location"])
		);

		$sidebar_color = "rgba(0, 139, 139, 1)";
		$page = 'Detalhe Pagamento Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/locations/payments/payment_detail.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/locations/payments/payment_detail.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$info["post"]["status"] = "waiting";

		$payment = new payments_model();
		$payment->populate($info["post"]);
		$payment->save();

		$info["payment_idx"] = $payment->con->insert_id;

		$payment->save_attach(array("idx" => $info["payment_idx"], "post" => array("locations_id" =>  $info["idx"])), array("locations"), true);

		if (isset($info["post"]["payment_method"]) && $info["post"]["payment_method"] == "ticket") {
			include(constant("cRootServer_APP") . "/gerencianet/boleto/gerar_boleto.php");
		}

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $payment->con->insert_id;
		}

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["location_payments_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$payment = new payments_model();

			$payment->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$payment->remove();
		}

		basic_redir($GLOBALS["location_payments_url"]);
	}
}
