<?php
class properties_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new properties_model();
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

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " first_name like '%" . $info["get"]["filter_name"] . "%' ";
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " document like '%" . $info["get"]["filter_cpf"] . "%' ";
		}

		if (isset($info["get"]["filter_address"]) && !empty($info["get"]["filter_address"])) {
			$done["filter_address"] = $info["get"]["filter_address"];
			$filter["filter_address"] = " address like '%" . $info["get"]["filter_address"] . "%' ";
		}

		if (isset($info["get"]["filter_district"]) && !empty($info["get"]["filter_district"])) {
			$done["filter_district"] = $info["get"]["filter_district"];
			$filter["filter_district"] = " district like '%" . $info["get"]["filter_district"] . "%' ";
		}

		if (isset($info["get"]["filter_uf"]) && !empty($info["get"]["filter_uf"])) {
			$done["filter_uf"] = $info["get"]["filter_uf"];
			$filter["filter_uf"] = " uf like '%" . $info["get"]["filter_uf"] . "%' ";
		}

		if (isset($info["get"]["filter_title"]) && !empty($info["get"]["filter_title"])) {
			$done["filter_title"] = $info["get"]["filter_title"];
			$filter["filter_title"] = " first_name like '%" . $info["get"]["filter_title"] . "%' ";
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

		$properties = new properties_model();

		if ($info["format"] != ".json") {
			$properties->set_paginate(array($info["sr"], $paginate));
		} else {
			$properties->set_paginate(array(0, 900000));
		}

		$properties->set_filter($filter);
		$properties->set_order(array($ordenation));
		list($total, $data) = $properties->return_data();

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

				$sidebar_color = "rgba(127, 255, 212, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["properties_url"], $done) : $GLOBALS["properties_url"]), "pattern" => array(
						"new" => $GLOBALS["newpropertie_url"],
						"action" => $GLOBALS["propertie_url"],
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
				include(constant("cRootServer") . "ui/page/properties/properties.php");
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
				include(constant("cRootServer") . "furniture/js/properties/properties.js");
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
			$propertie = new properties_model();
			$propertie->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$propertie->load_data();
			$propertie->attach(array("clients"), true);
			$data = current($propertie->data);
			$form = array(
				"title" => "Editar Imovel",
				"url" => sprintf($GLOBALS["propertie_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Imovel",
				"url" => $GLOBALS["newpropertie_url"]
			);
		}

		$sidebar_color = "rgba(127, 255, 212, 1)";
		$page = 'Imovel';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/properties/propertie.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/properties/propertie.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	/**
	 * Search Client for Properties
	 * 
	 */
	public function search_client($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$done =  array();
		$client = new clients_model();

		if ($info["post"]["cod_client"] != null) {

			// $done["filter_id"] = $info["get"]["filter_id"];
			// $filter["filter_id"] = " idx like '%" . $info["get"]["filter_id"] . "%' ";

			$client->set_filter(array(" idx = '" . $info["post"]["cod_client"] . "' "));
		}

		if ($info["post"]["name_client"] != null) {

			$client->set_filter(array(" first_name = '" . $info["post"]["name_client"] . "' "));
		}

		if ($info["post"]["cpf_client"] != null) {

			$client->set_filter(array(" document = '" . $info["post"]["cpf_client"] . "' "));
		}

		$client->load_data();
		$data = $client->data;

		echo json_encode($data);
	}

	/**
	 * Select Client after search
	 * 
	 */
	public function select_client($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$client = new clients_model();

		$client->set_filter(array(" idx = '" . $info["post"]["client_id"] . "' "));

		$client->load_data();
		$data = current($client->data);

		echo json_encode($data);
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$propertie = new properties_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$propertie->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} else {
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$info["post"]["document"] = preg_replace("/[^0-9]/", "", $info["post"]["document"]);
		$info["post"]["price_location"] = preg_replace("/[^0-9]/", "", $info["post"]["price_location"]);
		if ($info["post"]["object_propertie"] == "location") {
			$info["post"]["price_iptu"] = preg_replace("/[^0-9]/", "", $info["post"]["price_iptu"]);
		} else {
			$info["post"]["price_iptu"] = preg_replace("/[^0-9]/", "", $info["post"]["price_iptu_sale"]);
		}
	
		$info["post"]["price_condominium"] = preg_replace("/[^0-9]/", "", $info["post"]["price_condominium"]);
		$info["post"]["price_propertie"] = preg_replace("/[^0-9]/", "", $info["post"]["price_propertie"]);

		/* Imagens */
		$arrayImages = [];
		if (isset($_FILES["images"]) && $_FILES["images"]["name"][0] != "") {

			for ($i = 0; $i < count($_FILES["images"]["name"]); $i++) {
				$d = preg_split("/\./", $_FILES["images"]["name"][$i]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["png", "jpg", "jpeg"];

				$t = array_search($extension, $extension_permited);

				if (array_search($extension, $extension_permited) >= 0) {
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["images"]["name"][$i]));

					$extension = date("YmdHis") . "." . $extension;

					$file = "furniture/upload/propertie/" . $info["idx"] . "/" . "images/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), 0777, true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}

					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}

					move_uploaded_file($_FILES["images"]["tmp_name"][$i], constant("cRootServer") . $file);
					array_push($arrayImages, $file);
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo, extensão nao permitida, tipo de imagem aceitas (.jpg, .png, .jpeg), entre na tela de edição e suba novamente o arquivo.";
				}
			}

			$info["post"]["imagem"] = serialize($arrayImages);
		}

		// /* Documentos */
		$arrayDocs = [];
		if (isset($_FILES["docs"]) && $_FILES["docs"]["name"][0] != "") {

			for ($i = 0; $i < count($_FILES["docs"]["name"]); $i++) {
				$d = preg_split("/\./", $_FILES["docs"]["name"][$i]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["pdf"];

				if (array_search($extension, $extension_permited) >= 0) {
					
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["docs"]["name"][$i]));

					$extension = date("YmdHis") . "." . $extension;

					$file = "furniture/upload/propertie/" . $info["idx"] . "/" . "docs/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), 0777, true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}

					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}

					move_uploaded_file($_FILES["docs"]["tmp_name"][$i], constant("cRootServer") . $file);
					array_push($arrayDocs, $file);
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo, extensão nao permitida, tipo de arquivo aceito: (.PDF), entre na tela de edição e suba novamente o arquivo.";
				}
			}

			$info["post"]["docs"] = serialize($arrayDocs);
		}

		$propertie->populate($info["post"]);
		$propertie->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $propertie->con->insert_id;
		}

		$propertie->save_attach( array("properties_id" => $info["idx"], "clients_id" => $info["post"]["clients_id"]) , array("clients" ), true );

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["properties_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$propertie = new properties_model();

			$propertie->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$propertie->remove();
		}

		basic_redir($GLOBALS["properties_url"]);
	}
}
