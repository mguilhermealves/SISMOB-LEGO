<?php
class account_pay_cost_center_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new account_pay_cost_center_model();
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

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["q_name"] = " cost_center LIKE '%" . $info["get"]["q_name"] . "%' ";
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

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
		}
		if (isset($info["get"]["filter_cost_center"]) && !empty($info["get"]["filter_cost_center"])) {
			$done["filter_cost_center"] = $info["get"]["filter_cost_center"];
			$filter["filter_cost_center"] = " idx like '%" . $info["get"]["filter_cost_center"] . "%' ";
		}

		if (isset($info["get"]["filter_category"]) && !empty($info["get"]["filter_category"])) {
			$done["filter_category"] = $info["get"]["filter_category"];
			$filter["filter_category"] = " trail_title like '%" . $info["get"]["filter_category"] . "%' ";
		}

		//VERIFICAR
		if (isset($info["get"]["filter_category"]) && !empty($info["get"]["filter_category"])) {
			$done["filter_category"] = $info["get"]["filter_category"];
			$filter["filter_category"] = " category IN ( select account_pay_categories.idx from account_pay_categories where account_pay_categories.active = 'yes' and account_pay_categories.idx = '" . $info["get"]["filter_category"] . "' ) ";
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

		$cost_centers = new account_pay_cost_center_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$cost_centers->set_paginate(array(0, 12));

				if (isset($info["get"]["query"]) && strlen(addslashes($info["get"]["query"]))) {
					$query = preg_replace("/\[+?|\]+?/", "", toUtf8($info["get"]["query"]));
					$query = preg_replace("/\s+?|\t+?|\n+?/", " ", $query);
					$query = preg_replace("/^ | $/", "", $query);
					$query = preg_replace("/([A-z0-9\ \-\_])+?/", "$1", $query);

					if (empty($query)) {
						$query = " ";
					} else {
						$info["get"]["q_name"] = $query;
					}
				}
				break;
			default:
				$cost_centers->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}
		list($done, $filter) = $this->filter($info);
		$cost_centers->set_filter($filter);

		$cost_centers->set_filter($filter);
		$cost_centers->set_order(array($ordenation));
		list($total, $data) = $cost_centers->return_data();
		$cost_centers->attach(array("account_pay_categories"));

		$data = $cost_centers->data;
		switch ($info["format"]) {
			case ".json":
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array("total" => $total), "row" => $data
					)
				);
				break;
			case ".autocomplete":
				$out = array(
					"query" => "", "suggestions" => array()
				);
				foreach ($data as $key => $value) {
					$out["suggestions"][] = array(
						"data" => $value,
						"value" => sprintf("%s - %s ", $value["cost_center"], $value["name"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			default:
				$page = 'Centro de Custo Contas a Pagar';

				$sidebar_color = "rgba(95, 158, 160, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["account_pay_cost_centers_url"], $done) : $GLOBALS["account_pay_cost_centers_url"]), "pattern" => array(
						"new" => $GLOBALS["newaccount_pay_cost_center_url"],
						"action" => $GLOBALS["account_pay_cost_center_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["account_pay_cost_centers_url"], $info["get"]) : $GLOBALS["account_pay_cost_centers_url"]
					)
				);

				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'bi bi-border';
				$ordenation_cost_center = 'cost_center-asc';
				$ordenation_cost_center_ordenation = 'bi bi-border';
				$ordenation_category = 'category-asc';
				$ordenation_category_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'name asc':
						$ordenation_name = 'name-desc';
						$ordenation_name_ordenation = 'bi bi-arrow-up';
						break;
					case 'name desc':
						$ordenation_name = 'name-asc';
						$ordenation_name_ordenation = 'bi bi-arrow-down';
						break;
					case 'cost_center asc':
						$ordenation_cost_center = 'cost_center-desc';
						$ordenation_cost_center_ordenation = 'bi bi-arrow-up';
						break;
					case 'cost_center desc':
						$ordenation_cost_center = 'cost_center-asc';
						$ordenation_cost_center_ordenation = 'bi bi-arrow-down';
						break;
					case 'category asc':
						$ordenation_category = 'category-desc';
						$ordenation_category_ordenation = 'bi bi-arrow-up';
						break;
					case 'category desc':
						$ordenation_category = 'category-asc';
						$ordenation_category_ordenation = 'bi bi-arrow-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/bills_payableds/cost_center/cost_centers.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/cost_centers/cost_center.js");
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
			$cost_center = new account_pay_cost_center_model();
			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$cost_center->load_data();
			$cost_center->attach(array("account_pay_categories"));
			$data = current($cost_center->data);
			$form = array(
				"title" => "Editar Centro de Custo",
				"url" => sprintf($GLOBALS["account_pay_cost_center_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Centro de Custo",
				"url" => $GLOBALS["newaccount_pay_cost_center_url"]
			);
		}

		$sidebar_color = "rgba(95, 158, 160, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/bills_payableds/cost_center/cost_center.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print('<script>' . "\n");
		include(constant("cRootServer") . "furniture/js/cost_centers/cost_center.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$cost_center = new account_pay_cost_center_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$cost_center->populate($info["post"]);
		$cost_center->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $cost_center->con->insert_id;
		}

		$cost_center->save_attach(array("idx" => $info["idx"], "post" => array("account_pay_categories_id" =>  $info["post"]["cod_category"])), array("account_pay_categories"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["account_pay_cost_centers_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$cost_center = new account_pay_cost_center_model();

			$cost_center->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$cost_center->remove();
		}

		basic_redir($GLOBALS["account_pay_cost_centers_url"]);
	}
}
