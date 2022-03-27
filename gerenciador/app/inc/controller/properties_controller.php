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

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["q_name"] = " first_name like '%" . $info["get"]["q_name"] . "%' and is_used = 'no' ";
			$filter["q_enables"] = " enabled = 'yes' ";
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

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["filter_name"] . "%' ";
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

		if (isset($info["get"]["filter_object_propertie"]) && !empty($info["get"]["filter_object_propertie"])) {
			$done["filter_object_propertie"] = $info["get"]["filter_object_propertie"];
			$filter["filter_object_propertie"] = " object_propertie = '%" . $info["get"]["filter_object_propertie"] . "%' ";
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

		switch ($info["format"]) {
			case ".autocomplete":
				$properties->set_paginate(array(0, 12));
				$info["get"]["enabled"] = 'yes';

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
				$properties->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}

		$properties->set_filter($filter);
		$properties->set_order(array($ordenation));
		list($total, $data) = $properties->return_data();
		$properties->attach(array("clients"), true);

		$data = $properties->data;
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
					if ($value["is_used"] == 'no') {
						$out["suggestions"][] = array(
							"data" => $value,
							"value" => sprintf("%s %s (%s) ", $value["clients_attach"][0]["first_name"], $value["clients_attach"][0]["last_name"], $value["clients_attach"][0]["mail"])
						);
					}
				}

				header('Content-type: application/json');
				echo json_encode($out);
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

				$ordenation_address = 'address-asc';
				$ordenation_address_ordenation = 'bi bi-border';
				$ordenation_district = 'district-asc';
				$ordenation_district_ordenation = 'bi bi-border';
				$ordenation_city = 'city-asc';
				$ordenation_city_ordenation = 'bi bi-border';
				$ordenation_uf = 'uf-asc';
				$ordenation_uf_ordenation = 'bi bi-border';
				$ordenation_objective = 'object_propertie-asc';
				$ordenation_objective_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'address asc':
						$ordenation_address = 'address-desc';
						$ordenation_address_ordenation = 'bi bi-arrow-up';
						break;
					case 'address desc':
						$ordenation_address = 'address-asc';
						$ordenation_address_ordenation = 'bi bi-arrow-down';
						break;
					case 'district asc':
						$ordenation_district = 'district-desc';
						$ordenation_district_ordenation = 'bi bi-arrow-up';
						break;
					case 'district desc':
						$ordenation_district = 'district-asc';
						$ordenation_district_ordenation = 'bi bi-arrow-down';
						break;
					case 'city asc':
						$ordenation_city = 'city-desc';
						$ordenation_city_ordenation = 'bi bi-arrow-up';
						break;
					case 'city desc':
						$ordenation_city = 'city-asc';
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
					case 'object_propertie asc':
						$ordenation_objective = 'object_propertie-desc';
						$ordenation_objective_ordenation = 'bi bi-arrow-up';
						break;
					case 'object_propertie desc':
						$ordenation_objective = 'object_propertie-asc';
						$ordenation_objective_ordenation = 'bi bi-arrow-down';
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
		print('<script>' . "\n");
		include(constant("cRootServer") . "furniture/js/properties/propertie.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
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

		$propertie->save_attach(array("properties_id" => $info["idx"], "clients_id" => $info["post"]["clients_id"]), array("clients"), true);

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
