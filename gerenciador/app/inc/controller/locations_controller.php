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
			$info["get"]["filter_cpf"] = preg_replace("/[^0-9]/", "", $info["get"]["filter_cpf"]);
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
			case ".xls":

				if (file_exists(constant("cFurniture1") . 'excel/locations/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/locations/Relatorio.xls');
				}

				$name = "Relatorio_Alugueis_e_Vendas_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SYSMOB")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Aluguel e Vendas")
					->setSubject("Relatorio de Aluguel e Vendas")
					->setDescription("Relatorio de Aluguel e Vendas")
					->setKeywords("Aluguel e Vendas")
					->setCategory("Aluguel e Vendas");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/locations/modelo-locations.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Aluguel e Vendas');

				$x_in = 13;
				foreach ($data as $k => $v) {
					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["first_name"] . " " . $v["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["document"])));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $v["mail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["number_residents"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($x_in - 1), $GLOBALS["status_location"][$v["is_aproved"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . ($x_in - 1), $v["day_due"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . ($x_in - 1), $GLOBALS["payment_method"][$v["payment_method"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . ($x_in - 1), $v["n_contract"]);

					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M' . $x_in . ':N' . $x_in);

					if (!empty($v["complement"])) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["complement"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					} else {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . preg_replace("/(.....)(...)$/", "$1-$2", preg_replace("/\.|-/", "", $v["code_postal"])) . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					}

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . ($x_in - 1), $v["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $v["properties_attach"][0]["clients_attach"][0]["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["properties_attach"][0]["clients_attach"][0]["document"])));

					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/locations/Relatorio.xlsx');
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
				readfile(constant("cFurniture1") . 'excel/locations/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			default:
				$page = 'Locações e Vendas';
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
			$location->attach(array("offices", "properties"));
			$location->attach(array("partners"));
			$location->attach_son("properties", array("clients"), true, null, array("idx", "name"));
			$data = current($location->data);
			$form = array(
				"title" => "Editar Locação e Venda",
				"url" => sprintf($GLOBALS["location_url"], $info["idx"]),
				"donwload_contract" => $GLOBALS["location_contract_url"]
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Locação e Venda",
				"url" => $GLOBALS["newlocation_url"]
			);
		}

		$sidebar_color = "rgba(218, 165, 32, 1)";
		$page = 'Locação e Venda';

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
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		// is approved
		if (isset($info["post"]["is_aproved"]) && $info["post"]["is_aproved"] == "approved") {
			$location->load_data();
			$location->attach(array("properties"));
			$data = current($location->data);

			if (empty($data["aproved_at"])) {
				$info["post"]["n_contract"] = $info["idx"] . date("YmdHis");
				$info["post"]["aproved_by"] = $_SESSION[constant("cAppKey")]["credential"]["idx"];
				$info["post"]["aproved_at"] = date("Y-m-d H:i:s");

				$user_adm = new users_model();
				$user_adm->set_filter(array(" idx in ( SELECT users_profiles.users_id from users_profiles where profiles_id in ( select profiles.idx from profiles where slug = 'administrador-sismob' ) )"));
				$user_adm->load_data();
				$data_useradm = $user_adm->data;

				$user_approved = new users_model();
				$user_approved->set_filter(array(" idx = '" . $info["post"]["aproved_by"] . "' "));
				$user_approved->load_data();
				$data_useraproved = current($user_approved->data);

				foreach ($data_useradm as $k => $v) {
					if ($data["properties_attach"][0]["object_propertie"] == "location") {
						$page = strtr(file_get_contents(constant("cFurniture") . "mail/new_location.html"), array(
							"#HOST#" => constant("cFurniture") . "mail/new_location.html",
							"#CONTRACT#" => $info["post"]["n_contract"],
							"#OBJECT_PROPERTIE#" => $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]],
							"#TYPE_PROPERTIE#" => $GLOBALS["propertie_types"][$data["properties_attach"][0]["type_propertie"]],
							"#APROVED_BY#" => $data_useraproved["first_name"] . " " . $data_useraproved["last_name"],
							"#APROVED_AT#" => date_format(new DateTime($info["post"]["aproved_at"]), "d/m/Y H:i:s"),
							"#DAY_DUE#" => $data["day_due"],
							"#PAYMENT_METHOD#" => $data["payment_method"],
							"#AMOUNT_MONTH#" => $data["properties_attach"][0]["price_location"], // ajustar valor
						));
					} else {
						$page = strtr(file_get_contents(constant("cFurniture") . "mail/new_location.html"), array(
							"#HOST#" => constant("cFurniture") . "mail/new_location.html",
							"#CONTRACT#" => $info["post"]["n_contract"],
							"#OBJECT_PROPERTIE#" => $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]],
							"#TYPE_PROPERTIE#" => $GLOBALS["propertie_types"][$data["properties_attach"][0]["type_propertie"]],
							"#APROVED_BY#" => $data_useraproved["first_name"] . " " . $data_useraproved["last_name"],
							"#APROVED_AT#" => date_format(new DateTime($info["post"]["aproved_at"]), "d/m/Y H:i:s"),
							"#PAYMENT_METHOD#" => $data["payment_method"],
							"#AMOUNT_MONTH#" => $data["properties_attach"][0]["price_sale"],
						));
					}

					$messages_model = new messages_model();
					$messages_model->populate(array(
						"name" => "SISMOB - Locação Aprovada",
						"scheduled_at" => date("Y-m-d H:i:s"),
						"mailboxes" => serialize(array(
							"Address" => array(
								"name" => $v["first_name"] . " " . $v["last_name"],
								"mail" => $v["mail"]
							),
							"from" => array(
								"name" => constant("mail_from_name"),
								"mail" => constant("mail_from_user")
							),
							"replyTo" => array(
								"name" => constant("mail_from_name"),
								"mail" => constant("mail_from_user")
							)
						)), "htmlmsg" => $page, "textmsg" => strip_tags($page),
						"type" => "mail"
					));
					$messages_model->save();
				}

				/* update is used propertie */
				$info["post"]["properties"]["is_used"] = "yes";

				$propertie = new properties_model();
				$propertie->set_filter(array(" idx = '" . $info["post"]["cod_propertie"] . "' "));

				$data = current($propertie->data);

				$propertie->populate($info["post"]["properties"]);
				$propertie->save();
			}
		}

		$info["post"]["document"] = preg_replace("/[^0-9]/", "", $info["post"]["document"]);
		$info["post"]["phone"] = preg_replace("/[^0-9]/", "", $info["post"]["phone"]);
		$info["post"]["celphone"] = preg_replace("/[^0-9]/", "", $info["post"]["celphone"]);
		$info["post"]["code_postal"] = preg_replace("/[^0-9]/", "", $info["post"]["code_postal"]);

		$location->populate($info["post"]);
		$location->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $location->con->insert_id;
		}

		$location->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["cod_propertie"])), array("properties"));

		// is married
		if ($info["post"]["marital_status"] == "married") {
			$info["post"]["partner"]["document_partner"] = preg_replace("/[^0-9]/", "", $info["post"]["partner"]["document_partner"]);

			/* save partner */
			$partner = new partners_model();
			$partner->populate($info["post"]["partner"]);
			$partner->save();
			$info["partners_id"] = $partner->con->insert_id;
			$location->save_attach(array("idx" => $info["idx"], "post" => array("partners_id" => $info["partners_id"])), array("partners"));
		}

		/* save office */
		$office = new offices_model();
		$office->populate($info["post"]["offices"]);
		$office->save();
		$info["offices_id"] = $office->con->insert_id;

		$location->save_attach(array("idx" => $info["idx"], "post" => array("offices_id" => $info["offices_id"])), array("offices"));

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

		/* GERAR DOCX */
		include(constant("cRootServer_APP") . '/inc/lib/vendor/autoload.php');

		// //Instanciar o PhpWord
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$templateProcessor  = new \PhpOffice\PhpWord\TemplateProcessor(constant("cFurniture1") . 'docx/location/newcontract.docx');
		// $templateProcessor->setValue('NUMERO_CONTRATO', $data["n_contract"]);
		$templateProcessor->setValue('NOME_LOCADOR', $data["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["clients_attach"][0]["last_name"]);
		$templateProcessor->setValue('RG_LOCADOR', $data["properties_attach"][0]["clients_attach"][0]["rg"]);
		$templateProcessor->setValue('CPF_LOCADOR', preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["properties_attach"][0]["clients_attach"][0]["document"]));
		$templateProcessor->setValue('NOME_LOCATARIO', $data["first_name"] . " " . $data["last_name"]);
		$templateProcessor->setValue('RG_LOCATARIO', $data["rg"]);
		$templateProcessor->setValue('CPF_LOCATARIO', preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["document"]));
		$templateProcessor->setValue('EMAIL_LOCATARIO', $data["mail"]);
		$templateProcessor->setValue('ENDERECO_LOCATARIO', $data["properties_attach"][0]["clients_attach"][0]["address"] . ', ' . 'N° ' . $data["properties_attach"][0]["clients_attach"][0]["number_address"] . ', ' . $data["properties_attach"][0]["clients_attach"][0]["district"] . ', ' . $data["properties_attach"][0]["clients_attach"][0]["city"] . ', ' . $data["properties_attach"][0]["clients_attach"][0]["uf"]);
		$templateProcessor->setValue('ENDERECO_PROPRIEDADE', $data["properties_attach"][0]["address"] . ', N° ' . $data["properties_attach"][0]["number_address"] . ', ' . $data["properties_attach"][0]["district"] . ', ' . $data["properties_attach"][0]["city"] . ', ' . $data["properties_attach"][0]["uf"]);
		$templateProcessor->setValue('FIM_EXCLUSIVO', $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]]);

		$templateProcessor->setValue('VALOR_ALUGUEL', "R$ " . number_format($data["properties_attach"][0]["price_location"], 2, ",", "."));
		$templateProcessor->setValue('DIA_VENCIMENTO', $data["day_due"]);
		$templateProcessor->setValue('PRAZO_CONTRATO', $data["properties_attach"][0]["deadline_contract"]);
		$templateProcessor->setValue('NUMERO_PESSOAS', $data["number_residents"]);
		$templateProcessor->setValue('FORMA_PAGAMENTO', $GLOBALS["payment_method"][$data["payment_method"]]);

		$templateProcessor->saveAs('contract.docx');
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
