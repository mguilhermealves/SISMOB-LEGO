<?php
class clients_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "first_name")
	{
		$boiler = new clients_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" first_name asc "));
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

		$clients = new clients_model();

		if ($info["format"] != ".json") {
			$clients->set_paginate(array($info["sr"], $paginate));
		} else {
			$clients->set_paginate(array(0, 900000));
		}

		$clients->set_filter($filter);
		$clients->set_order(array($ordenation));
		list($total, $data) = $clients->return_data();

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
				$page = 'Clientes';

				$sidebar_color = "rgba(127, 255, 212, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["clients_url"], $done) : $GLOBALS["clients_url"]), "pattern" => array(
						"new" => $GLOBALS["newclient_url"],
						"action" => $GLOBALS["client_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["clients_url"], $info["get"]) : $GLOBALS["clients_url"]
					)
				);

				$ordenation_name = 'display_position-asc';
				$ordenation_name_ordenation = 'bi bi-arrow-up';
				$ordenation_trail = 'trail_title-asc';
				$ordenation_trail_ordenation = 'fas fa-border-none';
				$ordenation_modifiedat = 'modified_at-asc';
				$ordenation_modifiedat_ordenation = 'fas fa-border-none';
				$ordenation_trail_status = 'trail_status-asc';
				$ordenation_trail_status_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'display_position asc':
						$ordenation_name = 'display_position-desc';
						$ordenation_name_ordenation = 'fas fa-angle-up';
						break;
					case 'display_position desc':
						$ordenation_name = 'display_position-asc';
						$ordenation_name_ordenation = 'bi bi-arrow-down';
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
				include(constant("cRootServer") . "ui/page/clients/clients.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_agendas_json = {' . "\n");
				print('        url: "' . $GLOBALS["scheduleds_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["scheduled_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/client/clients.js");
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
			$client = new clients_model();
			$client->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$client->load_data();
			$client->attach(array("partners"));
			$data = current($client->data);

			$form = array(
				"title" => "Editar Cliente",
				"url" => sprintf($GLOBALS["client_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Cliente",
				"url" => $GLOBALS["newclient_url"]
			);
		}

		$sidebar_color = "rgba(127, 255, 212, 1)";
		$page = 'Cliente';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/clients/client.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/client/client.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$client = new clients_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$client->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$info["post"]["document"] = preg_replace("/[^0-9]/", "", $info["post"]["document"]);
		$info["post"]["phone"] = preg_replace("/[^0-9]/", "", $info["post"]["phone"]);
		$info["post"]["celphone"] = preg_replace("/[^0-9]/", "", $info["post"]["celphone"]);
		$info["post"]["code_postal"] = preg_replace("/[^0-9]/", "", $info["post"]["code_postal"]);

		$client->populate($info["post"]);
		$client->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $client->con->insert_id;
		}

		if ($info["post"]["marital_status"] == "married") {
			if (isset($_FILES["partner"]) && is_file($_FILES["partner"]["tmp_name"])) {

				$d = preg_split("/\./", $_FILES["partner"]["name"]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["pdf"];

				if (array_search($d[1], $extension_permited)) {
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["partner"]["name"]));
					$extension = date("YmdHis") . "." . $extension;
					$file = "furniture/upload/client/" . $info["idx"] . "/partner/certification/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}
					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}
					move_uploaded_file($_FILES["thumb"]["tmp_name"], constant("cRootServer") . $file);
					$info["post"]["ico"] = $file;
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo, extensão nao permitida. Somente (.PDF)";
				}
			}

			$partner = new partners_model();
			$partner->populate($info["post"]);
			$partner->save();

			$client->save_attach("partners");
		}

		print_r( $_SESSION["messages_app"]["success"] = array("Cliente Cadastrado com sucesso.") );

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["clients_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$company = new clients_model();

			$company->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$company->remove();
		}

		basic_redir($GLOBALS["clients_url"]);
	}
}
