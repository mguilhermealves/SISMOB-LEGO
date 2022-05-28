<?php
class clients_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "first_name")
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
		$filter = array(" active = 'yes' ", " idx in ( select users_profiles.users_id from users_profiles where users_profiles.active = 'yes' and users_profiles.profiles_id = '7' ) ");

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["q_name"] = " concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["q_name"] . "%' ";
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
			$info["get"]["filter_cpf"] = preg_replace("/[^0-9]/", "", $info["get"]["filter_cpf"]);
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " cpf like '%" . $info["get"]["filter_cpf"] . "%' ";
		}

		if (isset($info["get"]["filter_district"]) && !empty($info["get"]["filter_district"])) {
			$done["filter_district"] = $info["get"]["filter_district"];
			$filter["filter_district"] = " district like '%" . $info["get"]["filter_district"] . "%' ";
		}

		if (isset($info["get"]["filter_city"]) && !empty($info["get"]["filter_city"])) {
			$done["filter_city"] = $info["get"]["filter_city"];
			$filter["filter_city"] = " city like '%" . $info["get"]["filter_city"] . "%' ";
		}

		if (isset($info["get"]["filter_uf"]) && !empty($info["get"]["filter_uf"])) {
			$done["filter_uf"] = $info["get"]["filter_uf"];
			$filter["filter_uf"] = " uf like '%" . $info["get"]["filter_uf"] . "%' ";
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

		$clients = new users_model();

		switch ($info["format"]) {
			case ".autocomplete":
				$clients->set_paginate(array(0, 12));

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
				$clients->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
				break;
		}
		list($done, $filter) = $this->filter($info);
		$clients->set_filter($filter);

		$clients->set_filter($filter);
		$clients->set_order(array($ordenation));
		list($total, $data) = $clients->return_data();
		$data = $clients->data;

		switch ($info["format"]) {
			case ".autocomplete":

				$out = array(
					"query" => "", "suggestions" => array()
				);

				foreach ($data as $key => $value) {
					$out["suggestions"][] = array(
						"data" => $value,
						"value" => sprintf("%s %s (%s) ", $value["first_name"], $value["last_name"], $value["mail"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			case ".xls":
				if (file_exists(constant("cFurniture1") . 'excel/clients/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/clients/Relatorio.xls');
				}

				$name = "Relatorio_Clientes_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("HSOL")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Clientes")
					->setSubject("Relatorio de Clientes")
					->setDescription("Relatorio de Clientes")
					->setKeywords("Clientes")
					->setCategory("Clientes");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/clients/modelo-clients.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Clientes');

				$x_in = 13;
				foreach ($data as $k => $v) {
					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["first_name"] . " " . $v["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $v["cpf"])));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $v["mail"]);
					if (!empty($v["complement"])) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["complement"] . ", " . $v["postalcode"] . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					} else {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $v["address"] . ", N° " . $v["number_address"] . ", " . $v["postalcode"] . ", " . $v["district"] . ", " . $v["city"] . " - " .  $v["uf"]);
					}
					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/clients/Relatorio.xlsx');
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
				readfile(constant("cFurniture1") . 'excel/clients/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			case ".json":
				$total = array("total" => 3);
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array_merge(array("total" => array_sum($total)), $total), "row" => $data
					)
				);
				break;
			default:
				$page = 'Proprietarios';

				$sidebar_color = "rgba(127, 255, 212, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["proprietaries_url"], $done) : $GLOBALS["proprietaries_url"]), "pattern" => array(
						"new" => $GLOBALS["newproprietary_url"],
						"action" => $GLOBALS["proprietary_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["proprietaries_url"], $info["get"]) : $GLOBALS["proprietaries_url"]
					)
				);

				$ordenation_name = 'first_name-asc';
				$ordenation_name_ordenation = 'bi bi-border';
				$ordenation_document = 'cpf-asc';
				$ordenation_document_ordenation = 'bi bi-border';
				$ordenation_address = 'address-asc';
				$ordenation_address_ordenation = 'bi bi-border';
				$ordenation_district = 'district-asc';
				$ordenation_district_ordenation = 'bi bi-border';
				$ordenation_city = 'city-asc';
				$ordenation_city_ordenation = 'bi bi-border';
				$ordenation_uf = 'uf-asc';
				$ordenation_uf_ordenation = 'bi bi-border';
				switch ($ordenation) {
					case 'first_name asc':
						$ordenation_name = 'first_name-desc';
						$ordenation_name_ordenation = 'bi bi-arrow-up';
						break;
					case 'first_name desc':
						$ordenation_name = 'first_name-asc';
						$ordenation_name_ordenation = 'bi bi-arrow-down';
						break;
					case 'cpf asc':
						$ordenation_document = 'cpf-desc';
						$ordenation_document_ordenation = 'bi bi-arrow-up';
						break;
					case 'cpf desc':
						$ordenation_document = 'cpf-asc';
						$ordenation_document_ordenation = 'bi bi-arrow-down';
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
					case 'uf asc':
						$ordenation_uf = 'uf-desc';
						$ordenation_uf_ordenation = 'bi bi-arrow-up';
						break;
					case 'uf desc':
						$ordenation_uf = 'uf-asc';
						$ordenation_uf_ordenation = 'bi bi-arrow-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/proprietaries/proprietaries.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
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
			$client = new users_model();
			$client->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$client->load_data();
			$client->attach(array("partners"));
			$data = current($client->data);

			$form = array(
				"title" => "Editar Proprietario",
				"url" => sprintf($GLOBALS["proprietary_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Proprietarios",
				"url" => $GLOBALS["newproprietary_url"]
			);
		}

		$info["get"]["done"] = isset($info["get"]["done"]) ? rawurldecode($info["get"]["done"]) : $GLOBALS["proprietaries_url"];

		$page = 'Proprietario';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/proprietaries/proprietary.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["proprietaries_url"]) . '" ');
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

		$client = new users_model();

		$info["post"]["cpf"] = preg_replace("/[^0-9]/", "", $info["post"]["cpf"]);

		$validCpf = $this->validaCPF($info["post"]["cpf"]);

		if (empty($validCpf)) {
			$_SESSION["messages_app"]["warning"][] = "CPF Inválido";

			basic_redir($GLOBALS["proprietaries_url"]);
		}

		$info["post"]["phone"] = preg_replace("/[^0-9]/", "", $info["post"]["phone"]);
		$info["post"]["celphone"] = preg_replace("/[^0-9]/", "", $info["post"]["celphone"]);
		$info["post"]["postalcode"] = preg_replace("/[^0-9]/", "", $info["post"]["postalcode"]);

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$client->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$info["post"]["modified_at"] = date("Y-m-d H:i:s");
		} else {
			$consult_client = new users_model();
			$consult_client->set_filter(array(" cpf = '" . $info["post"]["cpf"] . "' "));
			$consult_client->load_data();
			$data = current($consult_client->data);

			if (!empty($data)) {
				$_SESSION["messages_app"]["warning"][] = "Já existe um cadastro com esse CPF, favor verificar!";

				basic_redir($GLOBALS["proprietaries_url"]);
			}
		}

		$client->populate($info["post"]);
		$client->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $client->con->insert_id;
		}

		$boiler = new users_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$boiler->set_filter(array(" idx = '" . $info["idx"] . "' "));
		}

		//is married
		if ($info["post"]["marital_status"] == "married") {

			if (isset($_FILES["partner"]) && is_file($_FILES["partner"]["tmp_name"]["file"])) {
				$d = preg_split("/\./", $_FILES["partner"]["name"]["file"]);

				$extension = $d[count($d) - 1];

				$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["partner"]["name"]["file"]));
				$extension = date("YmdHis") . "." . $extension;
				$file = "furniture/upload/client/" . $info["idx"] . "/partner/certification/" . $name . $extension;

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

		$info["post"]["profiles_id"] = "7";

		$boiler->save_attach($info, array("profiles"));

		$_SESSION["messages_app"]["success"] = array("Cliente Cadastrado com sucesso.");

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["proprietaries_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$company = new users_model();

			$company->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$company->remove();
		}

		basic_redir($GLOBALS["proprietaries_url"]);
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

	public function consultar_cpf($info)
	{
		$validCpf = $this->validaCPF($info["post"]["cpf"]);

		if (empty($validCpf)) {
			$error = array('error' => true, "message" => "CPF Incorreto...");
			return print(json_encode($error));
		} else {
			$client = new users_model();
			$client->set_filter(array(" cpf = '" . $info["post"]["cpf"] . "' "));
			$client->load_data();
			$client->attach(array("profiles"));
			$data = current($client->data);
	
			if (isset($client->data[0])) {
				$error = array('error' => true, "message" => "Usuário não encontrato ou já utilizado na base.");
				return print(json_encode($error));
			}
		}
	}
}
