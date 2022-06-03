<?php

use Dompdf\Dompdf;

class locations_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new vw_locations_model();
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
		$filter = array(" active = 'yes' ", "in_progress = 'no'");

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

		if (isset($info["get"]["filter_status"]) && !empty($info["get"]["filter_status"])) {
			$done["filter_status"] = $info["get"]["filter_status"];
			$filter["filter_status"] = " is_aproved = '" . $info["get"]["filter_status"] . "' ";
		}

		if (isset($info["get"]["filter_type"]) && !empty($info["get"]["filter_type"])) {
			$done["filter_type"] = $info["get"]["filter_type"];
			$filter["filter_type"] = " object_propertie  = '" . $info["get"]["filter_type"] . "' ";
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
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'idx desc';

		list($done, $filter) = $this->filter($info);

		$locations = new vw_locations_model();

		if ($info["format"] != ".json") {
			$locations->set_paginate(array($info["sr"], $paginate));
		} else {
			$locations->set_paginate(array(0, 900000));
		}

		$locations->set_filter($filter);
		$locations->set_order(array($ordenation));

		list($total, $data) = $locations->return_data_vw();
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

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["locations_url"], $done) : $GLOBALS["locations_url"]),
					"pattern" => array(
						"new" => $GLOBALS["newlocation_url"],
						"action" => $GLOBALS["location_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["locations_url"], $info["get"]) : $GLOBALS["locations_url"]
					)
				);

				$ordenation_id = 'idx-asc';
				$ordenation_id_ordenation = 'bi bi-border';
				$ordenation_name = 'nome-asc';
				$ordenation_name_ordenation = 'bi bi-border';
				$ordenation_cpf = 'cpf-asc';
				$ordenation_cpf_ordenation = 'bi bi-border';
				$ordenation_type = 'object_propertie-asc';
				$ordenation_type_ordenation = 'bi bi-border';
				$ordenation_is_aproved = 'is_aproved-asc';
				$ordenation_is_aproved_ordenation = 'bi bi-border';
				$ordenation_ncontract = 'n_contract-asc';
				$ordenation_ncontract_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'idx asc':
						$ordenation_id = 'idx-desc';
						$ordenation_id_ordenation = 'bi bi-arrow-up';
						break;
					case 'idx desc':
						$ordenation_id = 'idx-asc';
						$ordenation_id_ordenation = 'bi bi-arrow-down';
						break;
					case 'nome asc':
						$ordenation_name = 'nome-desc';
						$ordenation_name_ordenation = 'bi bi-arrow-up';
						break;
					case 'nome desc':
						$ordenation_name = 'nome-asc';
						$ordenation_name_ordenation = 'bi bi-arrow-down';
						break;
					case 'cpf asc':
						$ordenation_cpf = 'cpf-desc';
						$ordenation_cpf_ordenation = 'bi bi-arrow-up';
						break;
					case 'cpf desc':
						$ordenation_cpf = 'cpf-asc';
						$ordenation_cpf_ordenation = 'bi bi-arrow-down';
						break;
					case 'object_propertie asc':
						$ordenation_type = 'object_propertie-desc';
						$ordenation_type_ordenation = 'bi bi-arrow-up';
						break;
					case 'object_propertie desc':
						$ordenation_type = 'object_propertie-asc';
						$ordenation_type_ordenation = 'bi bi-arrow-down';
						break;
					case 'n_contract asc':
						$ordenation_ncontract = 'n_contract-desc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-up';
						break;
					case 'n_contract desc':
						$ordenation_ncontract = 'n_contract-asc';
						$ordenation_ncontract_ordenation = 'bi bi-arrow-down';
						break;
					case 'is_aproved asc':
						$ordenation_is_aproved = 'is_aproved-desc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-up';
						break;
					case 'is_aproved desc':
						$ordenation_is_aproved = 'is_aproved-asc';
						$ordenation_is_aproved_ordenation = 'bi bi-arrow-down';
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
			$location->attach(array("users"), true);
			$location->attach(array("properties"));
			$location->attach_son("properties", array("users"), true);
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

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["locations_url"];

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
			$location->attach(array("users"), true);
			$location->attach(array("properties"));
			$location->attach_son("properties", array("users"), true);
			$data = current($location->data);

			if (empty($data["aproved_at"])) {
				$info["post"]["n_contract"] = $info["idx"];
				$info["post"]["aproved_by"] = $_SESSION[constant("cAppKey")]["credential"]["idx"];
				$info["post"]["aproved_at"] = date("Y-m-d H:i:s");

				/* update is used propertie */
				$info["post"]["is_used"] = "yes";

				$boiler = new properties_model();
				$boiler->set_filter(array(" idx = '" . $data["properties_attach"][0]["idx"] . "' "));

				$boiler->populate($info["post"]);
				$boiler->save();
			}
		}

		$location->populate($info["post"]);
		$location->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $location->con->insert_id;
		}

		$location->save_attach(array("idx" => $info["idx"], "post" => array("users_id" =>  $info["post"]["users_id"])), array("users"), true);
		$location->save_attach(array("idx" => $info["idx"], "post" => array("properties_id" =>  $info["post"]["properties_id"])), array("properties"));

		$_SESSION["messages_app"]["success"] = array("Cadastro efeutado com sucesso.");

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
		$location->attach(array("users"), true);
		$location->attach_son("users", array("offices"));
		$location->attach(array("properties"));
		$location->attach_son("properties", array("users"), true);
		$data = current($location->data);

		$date_start = date_format(new DateTime($data["aproved_at"]), "d/m/Y");

		if ($data["properties_attach"][0]["deadline_contract"] > 12) {
			$total_years = $data["properties_attach"][0]["deadline_contract"] / 12;
		} else {
			$total_years = 1;
		}

		$date_end = date('d/m/Y', strtotime("+" . $total_years . " years", strtotime($data["aproved_at"])));

		/* GERAR DOCX */
		include(constant("cRootServer_APP") . '/inc/lib/vendor/autoload.php');

		// //Instanciar o PhpWord
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$templateProcessor  = new \PhpOffice\PhpWord\TemplateProcessor(constant("cFurniture1") . 'docx/location/newnewcontract.docx');
		// $templateProcessor->setValue('NUMERO_CONTRATO', $data["n_contract"]);
		$templateProcessor->setValue('NOME_LOCADOR', $data["properties_attach"][0]["users_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["users_attach"][0]["last_name"]);
		$templateProcessor->setValue('RG_LOCADOR', $data["properties_attach"][0]["users_attach"][0]["rg"]);
		$templateProcessor->setValue('ESTADO_CIVIL_LOCADOR', $GLOBALS["marital_status"][$data["properties_attach"][0]["users_attach"][0]["marital_status"]]);
		$templateProcessor->setValue('CPF_LOCADOR', preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["properties_attach"][0]["users_attach"][0]["cpf"]));
		$templateProcessor->setValue('NOME_LOCATARIO', $data["users_attach"][0]["first_name"] . " " . $data["users_attach"][0]["last_name"]);
		$templateProcessor->setValue('RG_LOCATARIO', $data["rg"]);
		$templateProcessor->setValue('CPF_LOCATARIO', preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["users_attach"][0]["cpf"]));
		$templateProcessor->setValue('EMAIL_LOCATARIO', $data["users_attach"][0]["mail"]);
		$templateProcessor->setValue('ESTADO_CIVIL', $GLOBALS["marital_status"][$data["users_attach"][0]["marital_status"]]);
		$templateProcessor->setValue('PROFISSAO_LOCATARIO', $data["users_attach"][0]["offices_attach"][0]["office"]);
		$templateProcessor->setValue('ENDERECO_LOCATARIO', $data["users_attach"][0]["address"] . ', ' . 'N° ' . $data["users_attach"][0]["number"] . ', ' . $data["users_attach"][0]["district"] . ', ' . $data["users_attach"][0]["city"] . ', ' . $data["users_attach"][0]["uf"]);
		$templateProcessor->setValue('ENDERECO_PROPRIEDADE', $data["properties_attach"][0]["address"] . ', N° ' . $data["properties_attach"][0]["number"] . ', ' . $data["properties_attach"][0]["district"] . ', ' . $data["properties_attach"][0]["city"] . ', ' . $data["properties_attach"][0]["uf"]);
		$templateProcessor->setValue('FIM_EXCLUSIVO', $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]]);
		$templateProcessor->setValue('DATA_INICIO', $date_start);
		$templateProcessor->setValue('DATA_FIM', $date_end);

		$templateProcessor->setValue('VALOR_ALUGUEL', "R$ " . number_format($data["properties_attach"][0]["price_location"], 2, ",", "."));
		$templateProcessor->setValue('DIA_VENCIMENTO', $data["day_due"]);
		$templateProcessor->setValue('PRAZO_CONTRATO', $data["properties_attach"][0]["deadline_contract"] );
		$templateProcessor->setValue('NUMERO_PESSOAS', $data["number_residents"]);
		$templateProcessor->setValue('FORMA_PAGAMENTO', $GLOBALS["payment_method"][$data["payment_method"]]);
		$templateProcessor->setValue('PERCENTUAL_IPTU', $data["properties_attach"][0]["percentual_iptu"]);
		$templateProcessor->setValue('CLASSIFICACAO_FISCAL', $data["properties_attach"][0]["classification"]);
		$templateProcessor->setValue('N_SABESP', $data["properties_attach"][0]["instalation_sabesp"]);
		$templateProcessor->setValue('N_ENEL', $data["properties_attach"][0]["instalation_enel"]);
		$templateProcessor->setValue('DAY', date("d"));
		$templateProcessor->setValue('MONTH', $GLOBALS["month_name"][date("m")]);
		$templateProcessor->setValue('YEAR', date("Y"));

		$filename = "Contrato.docx";

		PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
		$templateProcessor->saveAs($filename);

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . $filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		ob_clean();
		flush();
		readfile($filename);
		unlink($filename);
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
