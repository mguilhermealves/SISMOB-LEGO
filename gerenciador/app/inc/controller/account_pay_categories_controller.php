<?php
class account_pay_categories_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new account_pay_categories_model();
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

		$categories = new account_pay_categories_model();

		if ($info["format"] != ".json") {
			$categories->set_paginate(array($info["sr"], $paginate));
		} else {
			$categories->set_paginate(array(0, 900000));
		}

		$categories->set_filter($filter);
		$categories->set_order(array($ordenation));

		list($total, $data) = $categories->return_data();
		// $categories->attach(array("offices", "partners", "properties"));
		// $categories->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = $categories->data;

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
				$page = 'Categorias Contas a Pagar';

				$sidebar_color = "rgba(95, 158, 160, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["account_pay_categories_url"], $done) : $GLOBALS["account_pay_categories_url"]), "pattern" => array(
						"new" => $GLOBALS["newaccount_pay_category_url"],
						"action" => $GLOBALS["account_pay_category_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["account_pay_categories_url"], $info["get"]) : $GLOBALS["account_pay_categories_url"]
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
				include(constant("cRootServer") . "ui/page/bills_payableds/categories/categories.php");
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
			$bill_payabled = new account_pay_categories_model();
			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$bill_payabled->load_data();
			// $bill_payabled->attach(array("offices", "partners", "properties"));
			// $bill_payabled->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($bill_payabled->data);
			$form = array(
				"title" => "Editar Categoria",
				"url" => sprintf($GLOBALS["account_pay_category_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Categoria",
				"url" => $GLOBALS["newaccount_pay_category_url"]
			);
		}

		$sidebar_color = "rgba(95, 158, 160, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/bills_payableds/categories/category.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/locations/location.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$bill_payabled = new account_pay_categories_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$bill_payabled->populate($info["post"]);
		$bill_payabled->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $bill_payabled->con->insert_id;
		}

		// $bill_payabled->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["properties_id"])), array("properties"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["account_pay_categories_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$bill_payabled = new account_pay_categories_model();

			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$bill_payabled->remove();
		}

		basic_redir($GLOBALS["account_pay_categories_url"]);
	}
}
