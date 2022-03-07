<?php
class locations_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new locations_model();
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
		$locations->attach(array("offices", "partners", "properties"));
		$locations->attach_son("properties", array("clients"), true, null, array("idx", "name"));
		$data = $locations->data ; 

		// print_pre($data, true);

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

				$sidebar_color = "rgba(0, 139, 139, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["properties_url"], $done) : $GLOBALS["properties_url"]), "pattern" => array(
						"new" => $GLOBALS["newlocation_url"],
						"action" => $GLOBALS["location_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["properties_url"], $info["get"]) : $GLOBALS["properties_url"]
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
				include(constant("cRootServer") . "ui/page/locations/locations.php");
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
			$location = new locations_model();
			$location->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$location->load_data();
			$location->attach(array("offices", "partners", "properties"));
			$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($location->data);
			$form = array(
				"title" => "Editar Locação",
				"url" => sprintf($GLOBALS["location_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Locação",
				"url" => $GLOBALS["newlocation_url"]
			);
		}

		//print_pre($data, true);

		$sidebar_color = "rgba(0, 139, 139, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/locations/location.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/locations/location.js");
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

		$client->set_filter(array(" idx = '" . $info["post"]["cod_propertie"] . "' "));

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

		$location = new locations_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$location->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		if (isset($info["post"]["is_aproved"]) && $info["post"]["is_aproved"] == "approved") {
			$info["post"]["n_contract"] = $info["idx"] . date("YmdHis");
		}

		$location->populate($info["post"]);
		$location->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $location->con->insert_id;
		}

		$location->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["properties_id"] ) ), array("properties"));

		/* save office */
		$office = new offices_model();
		$office->populate($info["post"]["offices"]);
		$office->save();
		$info["offices_id"] = $office->con->insert_id;

		$location->save_attach(array("idx" => $info["idx"], "post" => array("offices_id" => $info["offices_id"] ) ), array("offices"));

		/* save partner */
		$partner = new partners_model();
		$partner->populate($info["post"]["partner"]);
		$partner->save();
		$info["partners_id"] = $office->con->insert_id;
		$location->save_attach(array("idx" => $info["idx"], "post" => array("partners_id" => $info["partners_id"] ) ), array("partner"));

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["locations_url"]);
		}
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

		basic_redir($GLOBALS["properties_url"]);
	}
}
