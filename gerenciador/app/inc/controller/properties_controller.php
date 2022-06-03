<?php
class properties_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "idx")
	{
		$boiler = new properties_model();
		$boiler->set_field(array($key, $field));
		$boiler->set_order(array(" idx desc "));
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
		$filter = array(" active = 'yes'");

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["q_name"] = " idx in (select users_properties.properties_id from users_properties where active = 'yes' and users_properties.users_id in (select users.idx from users where first_name like '%" . $info["get"]["q_name"] . "%' and idx in (select users_profiles.users_id from users_profiles where users_profiles.profiles_id in (select profiles.idx from profiles where idx = '7')))) and is_used = 'no'";
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
			$filter["filter_name"] = " idx in ( select clients_properties.properties_id from clients_properties, clients
			WHERE clients_properties.active = 'yes' and clients.idx = clients_properties.clients_id and concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["filter_name"] . "%' ) ";
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " idx in ( select clients_properties.properties_id from clients_properties, clients
			WHERE clients_properties.active = 'yes' and clients.idx = clients_properties.clients_id and document like '%" . $info["get"]["filter_cpf"] . "%' ) ";
		}

		if (isset($info["get"]["filter_address"]) && !empty($info["get"]["filter_address"])) {
			$done["filter_address"] = $info["get"]["filter_address"];
			$filter["filter_address"] = " address like '%" . $info["get"]["filter_address"] . "%' ";
		}

		if (isset($info["get"]["filter_district"]) && !empty($info["get"]["filter_district"])) {
			$done["filter_district"] = $info["get"]["filter_district"];
			$filter["filter_district"] = " district like '%" . $info["get"]["filter_district"] . "%' ";
		}

		if (isset($info["get"]["cod_propertie"]) && !empty($info["get"]["cod_propertie"])) {
			$done["cod_propertie"] = $info["get"]["cod_propertie"];
			$filter["cod_propertie"] = " idx like '%" . $info["get"]["cod_propertie"] . "%' ";
		}

		if (isset($info["get"]["filter_object_propertie"]) && !empty($info["get"]["filter_object_propertie"])) {
			$done["filter_object_propertie"] = $info["get"]["filter_object_propertie"];
			$filter["filter_object_propertie"] = " object_propertie = '" . $info["get"]["filter_object_propertie"] . "' ";
		}
		return array($done, $filter);
	}

	public function display($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'idx desc';

		list($done, $filter) = $this->filter($info);

		$properties = new properties_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$properties->set_paginate(array(0, 12));

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

		list($done, $filter) = $this->filter($info);
		$properties->set_filter($filter);

		$properties->set_filter($filter);
		$properties->set_order(array($ordenation));
		list($total, $data) = $properties->return_data();
		$properties->attach(array("users"), true);
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

				foreach ($data as $k => $value) {
					$out["suggestions"][] = array(
						"data" => $value,
						"value" => sprintf("%s %s - %s ( %s )", $value["users_attach"][0]["first_name"], $value["users_attach"][0]["last_name"], $GLOBALS["propertie_objects"][$value["object_propertie"]], empty($value["address"]) ? $value["address"] . ", N° " . $value["number_address"] . ", " . $value["complement"] . ", " . $value["code_postal"] . ", " . $value["district"] . ", " . $value["city"] . " - " . $value["uf"] : $value["address"] . ", N° " . $value["number_address"] . ", " . $value["code_postal"] . ", " . $value["district"] . ", " . $value["city"] . " - " . $value["uf"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			case ".xls":

				if (file_exists(constant("cFurniture1") . 'excel/properties/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/properties/Relatorio.xls');
				}

				$name = "Relatorio_Imóveis_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SYSMOB")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Imóveis")
					->setSubject("Relatorio de Imóveis")
					->setDescription("Relatorio de Imóveis")
					->setKeywords("Imóveis")
					->setCategory("Imóveis");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/properties/modelo-properties.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Imóveis');

				$x_in = 13;
				foreach ($data as $k => $v) {
					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					if (!empty($v["complement"])) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["complement"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					} else {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					}

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), $GLOBALS["propertie_objects"][$v["object_propertie"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $GLOBALS["propertie_types"][$v["type_propertie"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["object_propertie"] == "location" ? $v["deadline_contract"] . " Meses" : "Não Possui");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($x_in - 1), number_format($v["price_location"], 2, ",", "."));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . ($x_in - 1), number_format($v["price_sale"], 2, ",", "."));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . ($x_in - 1), number_format($v["price_iptu"], 2, ",", "."));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . ($x_in - 1), $v["type_propertie"] == "apartmant" ? number_format($v["price_condominium"], 2, ",", ".") : 0);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($x_in - 1), $v["clients_attach"][0]["first_name"] . " " . $v["clients_attach"][0]["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["clients_attach"][0]["document"])));

					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/properties/Relatorio.xlsx');
				$objWriter->setOffice2003Compatibility(true);
				$objPHPExcel->disconnectWorksheets();
				$objPHPExcel->garbageCollect();
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $name . '.xlsx"');

				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
				header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header('Pragma: public'); // HTTP/1.0
				ob_clean();
				flush();
				readfile(constant("cFurniture1") . 'excel/properties/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
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

				$ordenation_id = 'idx-asc';
				$ordenation_id_ordenation = 'bi bi-border';
				$ordenation_address = 'address-asc';
				$ordenation_address_ordenation = 'bi bi-border';
				$ordenation_district = 'district-asc';
				$ordenation_district_ordenation = 'bi bi-border';
				$ordenation_city = 'city-asc';
				$ordenation_city_ordenation = 'bi bi-border';
				$ordenation_cod = 'cod_propertie-asc';
				$ordenation_cod_ordenation = 'bi bi-border';
				$ordenation_objective = 'object_propertie-asc';
				$ordenation_objective_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_id = 'idx-desc';
						$ordenation_id_ordenation = 'bi bi-arrow-up';
						break;
					case 'idx desc':
						$ordenation_id = 'idx-asc';
						$ordenation_id_ordenation = 'bi bi-arrow-down';
						break;
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
					case 'cod_propertie asc':
						$ordenation_cod = 'cod_propertie-desc';
						$ordenation_cod_ordenation = 'bi bi-arrow-up';
						break;
					case 'cod_propertie desc':
						$ordenation_cod = 'cod_propertie-asc';
						$ordenation_cod_ordenation = 'bi bi-arrow-down';
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
			$propertie->attach(array("users"), true);
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

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["properties_url"];

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
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$info["post"]["price_iptu"] = str_replace('.', '', $info["post"]["price_iptu"]);
		$info["post"]["price_iptu"] = str_replace(',', '.', $info["post"]["price_iptu"]);

		$info["post"]["price_condominium"] = str_replace('.', '', $info["post"]["price_condominium"]);
		$info["post"]["price_condominium"] = str_replace(',', '.', $info["post"]["price_condominium"]);

		if ($info["post"]["object_propertie"] == "location") {
			$info["post"]["price_location"] = str_replace('.', '', $info["post"]["price_location"]);
			$info["post"]["price_location"] = str_replace(',', '.', $info["post"]["price_location"]);
			$info["post"]["administrative_fees"] = str_replace(',', '.', $info["post"]["administrative_fees"]);

			$info["post"]["porcent_propertie"] = null;
			$info["post"]["price_sale"] = null;
		} else {
			$info["post"]["porcent_propertie"] = preg_replace("/[^0-9]/", "", $info["post"]["porcent_propertie"]);

			$info["post"]["price_sale"] = str_replace('.', '', $info["post"]["price_sale"]);
			$info["post"]["price_sale"] = str_replace(',', '.', $info["post"]["price_sale"]);

			$info["post"]["price_location"] = null;
		}

		$propertie->populate($info["post"]);
		$propertie->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $propertie->con->insert_id;
		}

		$boiler = new properties_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$boiler->set_filter(array(" idx = '" . $info["idx"] . "' "));
		}

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

		/* Documentos */
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

		$boiler->populate($info["post"]);
		$boiler->save();

		$boiler->save_attach(array("idx" => $info["idx"], "post" => array("users_id" =>  $info["post"]["users_id"])), array("users"), true);

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
