<?php

class tenants_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "")
	{
		$boiler = new users_model();
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
		$filter = array(" active = 'yes' ", " idx in ( select users_profiles.users_id from users_profiles where users_profiles.active = 'yes' and users_profiles.profiles_id = '8' ) ");

		if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
			$done["paginate"] = $info["get"]["paginate"];
		}
		if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
			$done["sr"] = $info["get"]["sr"];
		}
		if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
			$done["ordenation"] = $info["get"]["ordenation"];
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$info["get"]["filter_cpf"] = preg_replace("/[^0-9]/", "", $info["get"]["filter_cpf"]);
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " cpf like '%" . $info["get"]["filter_cpf"] . "%' ";
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

		$tenants = new users_model();

		if ($info["format"] != ".json") {
			$tenants->set_paginate(array($info["sr"], $paginate));
		} else {
			$tenants->set_paginate(array(0, 900000));
		}

		$tenants->set_filter($filter);
		$tenants->set_order(array($ordenation));

		list($total, $data) = $tenants->return_data();
		$tenants->attach(array("profiles"));
		$data = $tenants->data;

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
				$page = 'Locatários';

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["tenants_url"], $done) : $GLOBALS["tenants_url"]), "pattern" => array(
						"new" => $GLOBALS["newtenant_url"],
						"action" => $GLOBALS["tenant_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["tenants_url"], $info["get"]) : $GLOBALS["tenants_url"]
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
				include(constant("cRootServer") . "ui/page/tenants/tenants.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_tenant_json = {' . "\n");
				print('        url: "' . $GLOBALS["tenants_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , action: "' . set_url($GLOBALS["tenant_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/tenants/tenants.js");
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
			$tenant = new users_model();
			$tenant->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$tenant->load_data();
			$tenant->attach(array("offices", "partners"));
			$data = current($tenant->data);
			$form = array(
				"title" => "Editar Locatário",
				"url" => sprintf($GLOBALS["tenant_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Locatário",
				"url" => $GLOBALS["newtenant_url"]
			);
		}

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["tenants_url"];

		$sidebar_color = "rgba(218, 165, 32, 1)";
		$page = 'Locatário';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/tenants/tenant.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		include(constant("cRootServer") . "furniture/js/tenants/tenant.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$tenant = new users_model();

		$info["post"]["cpf"] = preg_replace("/[^0-9]/", "", $info["post"]["cpf"]);
		$info["post"]["phone"] = preg_replace("/[^0-9]/", "", $info["post"]["phone"]);
		$info["post"]["celphone"] = preg_replace("/[^0-9]/", "", $info["post"]["celphone"]);
		$info["post"]["postalcode"] = preg_replace("/[^0-9]/", "", $info["post"]["postalcode"]);

		$validCpf = $this->validaCPF($info["post"]["cpf"]);

		if (empty($validCpf)) {
			$_SESSION["messages_app"]["warning"][] = "CPF Inválido";

			basic_redir($GLOBALS["locations_url"]);
		}

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$tenant->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		}

		$tenant->populate($info["post"]);
		$tenant->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $tenant->con->insert_id;
		}

		$boiler = new users_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$boiler->set_filter(array(" idx = '" . $info["idx"] . "' "));
		}

		//upload files offices
		if ($info["post"]["offices"]["type_work"] == "clt") {
			$info["post"]["address_file"] = null;
			$info["post"]["cnpj_file"] = null;
			$info["post"]["contract_file"] = null;

			/* Comprovante de Renda */
			$arrayRent = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["rent_file"][0] != "") {

				for ($i = 0; $i < count($_FILES["offices"]["name"]["rent_file"]); $i++) {
					$d = preg_split("/\./", $_FILES["offices"]["name"]["rent_file"][$i]);

					$extension = $d[count($d) - 1];

					$extension_permited = ["pdf"];

					$t = array_search($extension, $extension_permited);

					if (array_search($extension, $extension_permited) >= 0) {
						$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["rent_file"][$i]));

						$extension = $i . "." . $extension;

						$file = "furniture/upload/location/" . $info["idx"] . "/offices/rent_file/" . $name . $extension;

						if (!file_exists(dirname(constant("cRootServer") . $file))) {
							mkdir(dirname(constant("cRootServer") . $file), 0777, true);
							chmod(dirname(constant("cRootServer") . $file), 0775);
						}

						if (file_exists(constant("cRootServer") . $file)) {
							unlink(constant("cRootServer") . $file);
						}

						move_uploaded_file($_FILES["offices"]["tmp_name"]["rent_file"][$i], constant("cRootServer") . $file);
						array_push($arrayRent, $file);
					} else {
						$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [Comprovante de Renda], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
					}
				}

				$info["post"]["offices"]["rent_file"] = serialize($arrayRent);
			}

			/* IRPF */
			$arrayIRPF = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["IRPF_file"][0] != "") {

				for ($i = 0; $i < count($_FILES["offices"]["name"]["IRPF_file"]); $i++) {
					$d = preg_split("/\./", $_FILES["offices"]["name"]["IRPF_file"][$i]);

					$extension = $d[count($d) - 1];

					$extension_permited = ["pdf"];

					$t = array_search($extension, $extension_permited);

					if (empty($t) != 1) {
						$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["IRPF_file"][$i]));

						$extension = $i . "." . $extension;

						$file = "furniture/upload/location/" . $info["idx"] . "/offices/IRPF/" . $name . $extension;

						if (!file_exists(dirname(constant("cRootServer") . $file))) {
							mkdir(dirname(constant("cRootServer") . $file), 0777, true);
							chmod(dirname(constant("cRootServer") . $file), 0775);
						}

						if (file_exists(constant("cRootServer") . $file)) {
							unlink(constant("cRootServer") . $file);
						}

						move_uploaded_file($_FILES["offices"]["tmp_name"]["IRPF_file"][$i], constant("cRootServer") . $file);
						array_push($arrayIRPF, $file);
					} else {
						$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [IRPF], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
					}
				}

				$info["post"]["offices"]["IRPF_file"] = serialize($arrayIRPF);
			}
		} else {
			$info["post"]["offices"]["IRPF_file"] = null;

			/* Comprovante de Renda */
			$arrayRent = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["rent_file"][0] != "") {

				for ($i = 0; $i < count($_FILES["offices"]["name"]["rent_file"]); $i++) {
					$d = preg_split("/\./", $_FILES["offices"]["name"]["rent_file"][$i]);

					$extension = $d[count($d) - 1];

					$extension_permited = ["pdf"];

					$t = array_search($extension, $extension_permited);

					if (array_search($extension, $extension_permited) >= 0) {
						$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["rent_file"][$i]));

						$extension = $i . "." . $extension;

						$file = "furniture/upload/location/" . $info["idx"] . "/offices/rent_file/" . $name . $extension;

						if (!file_exists(dirname(constant("cRootServer") . $file))) {
							mkdir(dirname(constant("cRootServer") . $file), 0777, true);
							chmod(dirname(constant("cRootServer") . $file), 0775);
						}

						if (file_exists(constant("cRootServer") . $file)) {
							unlink(constant("cRootServer") . $file);
						}

						move_uploaded_file($_FILES["offices"]["tmp_name"]["rent_file"][$i], constant("cRootServer") . $file);
						array_push($arrayRent, $file);
					} else {
						$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [Comprovante de Renda], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
					}
				}

				$info["post"]["offices"]["rent_file"] = serialize($arrayRent);
			}

			/* Endereço PJ */
			$arrayAddress = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["address_file"] != "") {

				$d = preg_split("/\./", $_FILES["offices"]["name"]["address_file"]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["pdf"];

				$t = array_search($extension, $extension_permited);

				if (array_search($extension, $extension_permited) >= 0) {
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["address_file"]));

					$extension = date("YmdHis") . "." . $extension;

					$file = "furniture/upload/location/" . $info["idx"] . "/offices/address_file/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), 0777, true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}

					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}

					move_uploaded_file($_FILES["offices"]["tmp_name"]["address_file"], constant("cRootServer") . $file);
					array_push($arrayAddress, $file);
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [Comprovante de Renda], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
				}

				$info["post"]["offices"]["address_file"] = serialize($arrayAddress);
			}

			/* CNPJ */
			$arrayCNPJ = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["cnpj_file"] != "") {

				$d = preg_split("/\./", $_FILES["offices"]["name"]["cnpj_file"]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["pdf"];

				$t = array_search($extension, $extension_permited);

				if (array_search($extension, $extension_permited) >= 0) {
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["cnpj_file"]));

					$extension = date("YmdHis") . "." . $extension;

					$file = "furniture/upload/location/" . $info["idx"] . "/offices/CNPJ/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), 0777, true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}

					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}

					move_uploaded_file($_FILES["offices"]["tmp_name"]["cnpj_file"], constant("cRootServer") . $file);
					array_push($arrayCNPJ, $file);
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [IRPF], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
				}

				$info["post"]["offices"]["cnpj_file"] = serialize($arrayCNPJ);
			}

			/* CONTRATO SOCIAL */
			$arrayContract = [];
			if (isset($_FILES["offices"]) && $_FILES["offices"]["name"]["contract_file"] != "") {

				$d = preg_split("/\./", $_FILES["offices"]["name"]["contract_file"]);

				$extension = $d[count($d) - 1];

				$extension_permited = ["pdf"];

				$t = array_search($extension, $extension_permited);

				if (array_search($extension, $extension_permited) >= 0) {
					$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["offices"]["name"]["contract_file"]));

					$extension = date("YmdHis") . "." . $extension;

					$file = "furniture/upload/location/" . $info["idx"] . "/offices/contract/" . $name . $extension;

					if (!file_exists(dirname(constant("cRootServer") . $file))) {
						mkdir(dirname(constant("cRootServer") . $file), 0777, true);
						chmod(dirname(constant("cRootServer") . $file), 0775);
					}

					if (file_exists(constant("cRootServer") . $file)) {
						unlink(constant("cRootServer") . $file);
					}

					move_uploaded_file($_FILES["offices"]["tmp_name"]["contract_file"], constant("cRootServer") . $file);
					array_push($arrayContract, $file);
				} else {
					$_SESSION["messages_app"]["warning"][] = "Não foi possível importar o arquivo [IRPF], extensão nao permitida, tipo de imagem aceitas (.pdf), faça o upload do arquivo novamente.";
				}

				$info["post"]["offices"]["contract_file"] = serialize($arrayContract);
			}
		}

		$office = new offices_model();
		if (isset($info["post"]["offices"]["offices_id"]) && $info["post"]["offices"]["offices_id"] > 0) {
			$office->set_filter(array(" idx = '" . $info["post"]["offices"]["offices_id"] . "' "));
		}

		$office->populate($info["post"]["offices"]);
		$office->save();

		$info["post"]["offices_id"] = $office->con->insert_id;
		$boiler->save_attach($info, array("offices", "profiles"));

		// is married
		if ($info["post"]["marital_status"] == "married") {
			$info["post"]["partner"]["document_partner"] = preg_replace("/[^0-9]/", "", $info["post"]["partner"]["document_partner"]);

			if (isset($_FILES["partner"]) && is_file($_FILES["partner"]["tmp_name"]["file"])) {

				$d = preg_split("/\./", $_FILES["partner"]["name"]["file"]);

				$extension = $d[count($d) - 1];

				$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["partner"]["name"]["file"]));
				$extension = date("YmdHis") . "." . $extension;
				$file = "furniture/upload/location/" . $info["idx"] . "/partner/certification/" . $name . $extension;

				if (!file_exists(dirname(constant("cRootServer") . $file))) {
					mkdir(dirname(constant("cRootServer") . $file), 0777, true);
					chmod(dirname(constant("cRootServer") . $file), 0775);
				}
				if (file_exists(constant("cRootServer") . $file)) {
					unlink(constant("cRootServer") . $file);
				}
				move_uploaded_file($_FILES["partner"]["tmp_name"]["file"], constant("cRootServer") . $file);

				$info["post"]["partner"]["certification"] = $file;
			}

			/* save partner */
			$partner = new partners_model();
			if (isset($info["post"]["partner"]["partners_id"]) && $info["post"]["partner"]["partners_id"] > 0) {
				$partner->set_filter(array(" idx = '" . $info["post"]["partner"]["partners_id"] . "' "));
			}

			$partner->populate($info["post"]["partner"]);
			$partner->save();

			$info["post"]["partners_id"] = $partner->con->insert_id;
			$boiler->save_attach($info, array("partners"));
		}

		$boiler->populate($info["post"]);
		$boiler->save();

		$_SESSION["messages_app"]["success"] = array("Cadastro efeutado com sucesso.");

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["tenants_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$propertie = new users_model();

			$propertie->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$propertie->remove();
		}

		basic_redir($GLOBALS["locations_url"]);
	}

	/**
	 * Validation CPF
	 */
	function validaCPF($cpf)
	{

		// Extrai somente os números
		$cpf = preg_replace('/[^0-9]/is', '', $cpf);

		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}

		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}

		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}

		return true;
	}
}
