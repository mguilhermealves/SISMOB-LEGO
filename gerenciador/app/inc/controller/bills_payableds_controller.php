<?php
class bills_payableds_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new account_pays_model();
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

		if (isset($info["get"]["filter_start_date"]) && !empty($info["get"]["filter_start_date"])) {
			$done["filter_start_date"] = $info["get"]["filter_start_date"];
			$filter["filter_start_date"] = " day_due >= '" . $info["get"]["filter_start_date"] . "' ";
		} else {
			$filter["filter_start_date"] = " day_due >= '" . date("Y-m-d") . "' ";
		}

		if (isset($info["get"]["filter_end_date"]) && !empty($info["get"]["filter_end_date"])) {
			$done["filter_end_date"] = $info["get"]["filter_end_date"];
			$filter["filter_end_date"] = " day_due <= '" . $info["get"]["filter_end_date"] . "' ";
		} else {
			$filter["filter_end_date"] = " day_due <= '" . date("Y-m-d") . "' ";
		}

		if (isset($info["get"]["filter_company"]) && !empty($info["get"]["filter_company"])) {
			$done["filter_company"] = $info["get"]["filter_company"];
			$filter["filter_company"] = " idx in (select account_pays_companies.account_pays_id from account_pays_companies, companies
			WHERE account_pays_companies.active = 'yes'  and companies.idx = account_pays_companies.companies_id and name like '%" . $info["get"]["filter_company"] . "%' ) ";
		}

		if (isset($info["get"]["filter_value"]) && !empty($info["get"]["filter_value"])) {
			$done["filter_value"] = $info["get"]["filter_value"];
			$filter["filter_value"] = " amount like '%" . $info["get"]["filter_value"] . "%' ";
		}

		if (isset($info["get"]["filter_payment"]) && !empty($info["get"]["filter_payment"])) {
			$done["filter_payment"] = $info["get"]["filter_payment"];
			$filter["filter_payment"] = " payment_method like '%" . $info["get"]["filter_payment"] . "%' ";
		}
		if (isset($info["get"]["filter_status"]) && !empty($info["get"]["filter_status"])) {
			$done["filter_status"] = $info["get"]["filter_status"];
			$filter["filter_status"] = " status_payment = '" . $info["get"]["filter_status"] . "' ";
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

		$bills_payableds = new account_pays_model();

		if ($info["format"] != ".json") {
			$bills_payableds->set_paginate(array($info["sr"], $paginate));
		} else {
			$bills_payableds->set_paginate(array(0, 900000));
		}

		$bills_payableds->set_filter($filter);
		$bills_payableds->set_order(array($ordenation));

		list($total, $data) = $bills_payableds->return_data();
		$bills_payableds->attach(array("account_pay_cost_center", "companies"));
		$data = $bills_payableds->data;

		$total_amount = 0;
		foreach ($data as $key => $v) {
			if ($v["active"] == "yes") {
				$total_amount = $v['amount'] + $total_amount;
			}
		}

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

				if (file_exists(constant("cFurniture1") . 'excel/pays_account/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/pays_account/Relatorio.xls');
				}

				$name = "Relatorio_Contas_a_Pagar_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SYSMOB")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Contas a Pagar")
					->setSubject("Relatorio de Contas a Pagar")
					->setDescription("Relatorio de Contas a Pagar")
					->setKeywords("Contas a Pagar")
					->setCategory("Contas a Pagar");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/pays_account/modelo-pays_account.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Contas a Pagar');

				$x_in = 13;
				foreach ($data as $k => $v) {
					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["companies_attach"][0]["name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), $v["account_pay_cost_center_attach"][0]["cost_center"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), date_format(new DateTime($v["day_due"]), "d/m/Y"));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), $GLOBALS["payment_method"][$v["payment_method"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($x_in - 1), number_format($v['amount'], 2, ",", "."));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . ($x_in - 1), $GLOBALS["payment_status"][$v["status_payment"]]);

					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/pays_account/Relatorio.xlsx');
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
				readfile(constant("cFurniture1") . 'excel/pays_account/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			default:
				$page = 'Contas a Pagar';

				$sidebar_color = "rgba(95, 158, 160, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["bills_payableds_url"], $done) : $GLOBALS["bills_payableds_url"]), "pattern" => array(
						"new" => $GLOBALS["newbills_payabled_url"],
						"action" => $GLOBALS["bills_payabled_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["bills_payableds_url"], $info["get"]) : $GLOBALS["bills_payableds_url"]
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
				include(constant("cRootServer") . "ui/page/bills_payableds/bills_payableds.php");
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
				include(constant("cRootServer") . "furniture/js/account_pay/account_pays.js");
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
			$bill_payabled = new account_pays_model();
			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$bill_payabled->load_data();
			$bill_payabled->attach(array("account_pay_cost_center", "companies"));
			$data = current($bill_payabled->data);
			$form = array(
				"title" => "Editar Contas a Pagar",
				"url" => sprintf($GLOBALS["bills_payabled_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Contas a Pagar",
				"url" => $GLOBALS["newbills_payabled_url"]
			);
		}

		$sidebar_color = "rgba(95, 158, 160, 1)";
		$page = 'Locação';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/bills_payableds/bills_payabled.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/account_pay/account_pay.js");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$bill_payabled = new account_pays_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$info["post"]["modified_at"] = date("Y-m-d H:i:s");

			if (isset($_FILES["receipt_payment"]) && is_file($_FILES["receipt_payment"]["tmp_name"])) {
				$d = preg_split("/\./", $_FILES["receipt_payment"]["name"]);

				$extension = $d[count($d) - 1];

				$name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["receipt_payment"]["name"]));
				$extension = date("YmdHis") . "." . $extension;
				$file = "furniture/upload/account_pay/" . $info["idx"] . "/receipt_payment/" . $name . $extension;

				if (!file_exists(dirname(constant("cRootServer") . $file))) {
					mkdir(dirname(constant("cRootServer") . $file), 0777, true);
					chmod(dirname(constant("cRootServer") . $file), 0775);
				}
				if (file_exists(constant("cRootServer") . $file)) {
					unlink(constant("cRootServer") . $file);
				}
				move_uploaded_file($_FILES["receipt_payment"]["tmp_name"], constant("cRootServer") . $file);

				$info["post"]["receipt_payment"] = $file;
			}
		}

		$str = str_replace('.', '', $info["post"]["amount"]);
		$info["post"]["amount"] = str_replace(',', '.', $str);

		$bill_payabled->populate($info["post"]);
		$bill_payabled->save();

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $bill_payabled->con->insert_id;
		}

		$bill_payabled->save_attach($info, array("account_pay_cost_center"));
		$bill_payabled->save_attach($info, array("companies"));

		if (!isset($info["idx"])) {
			$account_pay = new account_pays_model();
			$account_pay->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$account_pay->load_data();
			$account_pay->attach(array("account_pay_cost_center", "companies"));
			$data = current($account_pay->data);

			$page = strtr(file_get_contents(constant("cFurniture") . "mail/contas-a-pagar.html"), array(
				"#HOST#" => constant("cFurniture") . "mail/contas-a-pagar.html",
				"#NOME#" => $_SESSION[constant("cAppKey")]["credential"]["first_name"] . " " . $_SESSION[constant("cAppKey")]["credential"]["last_name"],
				"#COMPANY_NAME#" => $data["companies_attach"][0]["name"],
				"#DAY_DUE#" => date('d/m/Y', strtotime($data["day_due"])),
				"#PAYMENT_METHOD#" => $data["payment_method"],
				"#AMOUNT#" => $data["amount"],
			));

			$messages_model = new messages_model();
			$messages_model->populate(array(
				"name" => "SISMOB - Contas a Pagar",
				"scheduled_at" => date("Y-m-d H:i:s"),
				"mailboxes" => serialize(array(
					"Address" => array(
						"name" => $_SESSION[constant("cAppKey")]["credential"]["first_name"] . " " . $_SESSION[constant("cAppKey")]["credential"]["last_name"],
						"mail" => $_SESSION[constant("cAppKey")]["credential"]["mail"]
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

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["bills_payableds_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$bill_payabled = new account_pays_model();

			$bill_payabled->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$bill_payabled->remove();
		}

		basic_redir($GLOBALS["bills_payableds_url"]);
	}
}
