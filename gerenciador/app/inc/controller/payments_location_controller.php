<?php
class payments_location_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$payments = new payments_model();
		$payments->set_field(array($key, $field));
		$payments->set_order(array(" name asc "));
		$payments->set_filter($filters);
		$payments->load_data();
		$out = array();
		foreach ($payments->data as $value) {
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
			$filter["filter_start_date"] = " expire_at >= '" . $info["get"]["filter_start_date"] . "' ";
		} else {
			$filter["filter_start_date"] = " expire_at >= '" . date("Y-m-d") . "' ";
		}

		if (isset($info["get"]["filter_end_date"]) && !empty($info["get"]["filter_end_date"])) {
			$done["filter_end_date"] = $info["get"]["filter_end_date"];
			$filter["filter_end_date"] = " expire_at <= '" . $info["get"]["filter_end_date"] . "' ";
		} else {
			$filter["filter_end_date"] = " expire_at <= '" . date("Y-m-d") . "' ";
		}

		if (isset($info["get"]["filter_status"]) && !empty($info["get"]["filter_status"])) {
			$done["filter_status"] = $info["get"]["filter_status"];
			$filter["filter_status"] = " status = '" . $info["get"]["filter_status"] . "' ";
		}

		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$info["get"]["filter_cpf"] = preg_replace("/[^0-9]/", "", $info["get"]["filter_cpf"]);
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_name"] = " idx in ( select locations_payments.payments_id from locations_payments, locations
			WHERE locations_payments.active = 'yes' and locations.idx = locations_payments.locations_id and document = '" . $info["get"]["filter_cpf"] . "' ) ";
		}

		if (isset($info["get"]["filter_contract"]) && !empty($info["get"]["filter_contract"])) {
			$done["filter_contract"] = $info["get"]["filter_contract"];
			$filter["filter_contract"] = " idx in ( select locations_payments.payments_id from locations_payments, locations
			WHERE locations_payments.active = 'yes' and locations.idx = locations_payments.locations_id and n_contract like '%" . $info["get"]["filter_contract"] . "%' ) ";
		}

		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " idx in ( select locations_payments.payments_id from locations_payments, locations
			WHERE locations_payments.active = 'yes' and locations.idx = locations_payments.locations_id and concat_ws(' ' , first_name , last_name ) like '%" . $info["get"]["filter_name"] . "%' ) ";
		}

		if (isset($info["get"]["filter_type"]) && !empty($info["get"]["filter_type"])) {
			$done["filter_type"] = $info["get"]["filter_type"];
			$filter["filter_type"] = " idx in ( SELECT locations_payments.payments_id FROM locations_payments, locations_properties, properties WHERE locations_payments.active = 'yes' and locations_payments.locations_id = locations_properties.locations_id and properties.idx = locations_properties.locations_id and properties.object_propertie = '" . $info["get"]["filter_type"] . "' ) ";
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

		$payments = new payments_model();

		if ($info["format"] != ".json") {
			$payments->set_paginate(array($info["sr"], $paginate));
		} else {
			$payments->set_paginate(array(0, 900000));
		}

		$payments->set_filter($filter);
		$payments->set_order(array($ordenation));

		list($total, $data) = $payments->return_data();
		$payments->attach(array("locations"), true);
		$payments->attach_son("locations", array("properties"), null, null, null);
		$data = $payments->data;

		$total_amount = 0;
		foreach ($data as $v) {
			if ($v["status"] != "canceled") {
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

				if (file_exists(constant("cFurniture1") . 'excel/payments/Relatorio.xls')) {
					unlink(constant("cFurniture1") . 'excel/payments/Relatorio.xls');
				}

				$name = "Relatorio_Contas_a_Receber_" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SYSMOB")
					->setLastModifiedBy("SYSMOB")
					->setTitle("Relatorio de Contas a Receber")
					->setSubject("Relatorio de Contas a Receber")
					->setDescription("Relatorio de Contas a Receber")
					->setKeywords("Contas a Receber")
					->setCategory("Contas a Receber");

				$objPHPExcel = PHPExcel_IOFactory::load(constant("cFurniture1") . 'excel/payments/modelo-payments.xlsx');

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Contas a Receber');

				$x_in = 13;

				foreach ($data as $k => $v) {

					$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($x_in, 1);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . $x_in . ':E' . $x_in);

					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($x_in - 1), $v["locations_attach"][0]["first_name"] . " " . $v["locations_attach"][0]["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($x_in - 1), date_format(new DateTime($v["expire_at"]), "d/m/Y"));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($x_in - 1), $GLOBALS["payment_method"][$v["payment_method"]]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($x_in - 1), number_format($v['amount'], 2, ",", "."));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($x_in - 1), $GLOBALS["payment_status_gerencianet"][$v["status"]]);

					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save(constant("cFurniture1") . 'excel/payments/Relatorio.xlsx');
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
				readfile(constant("cFurniture1") . 'excel/payments/Relatorio.xlsx');
				unset($objPHPExcel);
				exit();
				break;
			default:
				$page = 'Contas a Receber';

				$sidebar_color = "rgba(218, 165, 32, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["accounts_receivables_url"], $done) : $GLOBALS["accounts_receivables_url"]),
					"pattern" => array(
						"new" => $GLOBALS["newaccountsreceivable_url"],
						"action" => $GLOBALS["accounts_receivable_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["accounts_receivables_url"], $info["get"]) : $GLOBALS["accounts_receivables_url"]
					)
				);

				$ordenation_n_contract = 'n_contract-asc';
				$ordenation_n_contract_ordenation = 'fas fa-border-none';
				$ordenation_name = 'first_name-asc';
				$ordenation_name_ordenation = 'fas fa-border-none';
				$ordenation_type_propertie = 'modified_at-asc';
				$ordenation_type_propertie_ordenation = 'fas fa-border-none';
				$ordenation_value = 'trail_status-asc';
				$ordenation_value_ordenation = 'fas fa-border-none';
				$ordenation_expire_at = 'trail_status-asc';
				$ordenation_expire_at_ordenation = 'fas fa-border-none';
				$ordenation_status = 'trail_status-asc';
				$ordenation_status_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'n_contract asc':
						$ordenation_n_contract = 'n_contract-desc';
						$ordenation_n_contract_ordenation = 'fas fa-angle-up';
						break;
					case 'n_contract desc':
						$ordenation_n_contract = 'n_contract-asc';
						$ordenation_n_contract_ordenation = 'fas fa-angle-down';
						break;
					case 'first_name asc':
						$ordenation_name = 'first_name-desc';
						$ordenation_name_ordenation = 'fas fa-angle-up';
						break;
					case 'first_name desc':
						$ordenation_name = 'first_name-asc';
						$ordenation_name_ordenation = 'fas fa-angle-down';
						break;
					case 'modified_at asc':
						$ordenation_type_propertie = 'modified_at-desc';
						$ordenation_type_propertie_ordenation = 'fas fa-angle-up';
						break;
					case 'modified_at desc':
						$ordenation_type_propertie = 'modified_at-asc';
						$ordenation_type_propertie_ordenation = 'fas fa-angle-down';
						break;
					case 'trail_status asc':
						$ordenation_value = 'trail_status-desc';
						$ordenation_value_ordenation = 'fas fa-angle-up';
						break;
					case 'trail_status desc':
						$ordenation_value = 'trail_status-asc';
						$ordenation_value_ordenation = 'fas fa-angle-down';
						break;
					case 'trail_status asc':
						$ordenation_expire_at = 'trail_status-desc';
						$ordenation_expire_at_ordenation = 'fas fa-angle-up';
						break;
					case 'trail_status desc':
						$ordenation_expire_at = 'trail_status-asc';
						$ordenation_expire_at_ordenation = 'fas fa-angle-down';
						break;
					case 'trail_status asc':
						$ordenation_status = 'trail_status-desc';
						$ordenation_status_ordenation = 'fas fa-angle-up';
						break;
					case 'trail_status desc':
						$ordenation_status = 'trail_status-asc';
						$ordenation_status_ordenation = 'fas fa-angle-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/locations/payments/payments.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				include(constant("cRootServer") . "furniture/js/locations/payments/payments.js");
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
			$payment = new payments_model();
			$payment->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$payment->load_data();
			$data = current($payment->data);

			$historic = unserialize($data["historic_bank"]);

			$form = array(
				"title" => "Editar Conta a Receber",
				"url" => sprintf($GLOBALS["accounts_receivable_url"], $info["idx"])
			);
		} else {
			$data = array();
			$form = array(
				"title" => "Cadastrar Conta a Receber",
				"url" => $GLOBALS["newaccountsreceivable_url"]
			);
		}

		$sidebar_color = "rgba(218, 165, 32, 1)";
		$page = 'Conta a Receber';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/locations/payments/payment.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		include(constant("cRootServer") . "furniture/js/locations/payments/payment.js");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["accounts_receivables_url"]) . '" ');
		print('})' . "\n");
		print('</script>' . "\n");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		$dateNow = date('Y-m-');

		$info["post"]["status"] = "waiting";
		$info["post"]["expire_at"] = $dateNow . $info["post"]["day_due"];

		$payment = new payments_model();
		$payment->populate($info["post"]);
		$payment->save();

		$info["payment_idx"] = $payment->con->insert_id;

		$payment->save_attach(array("idx" => $info["payment_idx"], "post" => array("locations_id" =>  $info["idx"])), array("locations"), true);

		if (isset($info["post"]["payment_method"]) && $info["post"]["payment_method"] == "ticket") {
			include(constant("cRootServer_APP") . "/gerencianet/boleto/gerar_boleto.php");
		}

		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $payment->con->insert_id;
		}

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["location_payments_url"]);
		}
	}

	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if (isset($info["idx"])) {
			$payment = new payments_model();

			$payment->set_filter(array(" idx = '" . $info["idx"] . "' "));

			$payment->remove();
		}

		basic_redir($GLOBALS["accountsreceivable_url"]);
	}

	public function cancel_billet($info)
	{
		include(constant("cRootServer_APP") . "/gerencianet/boleto/cancelar_boleto.php");
	}

	public function send_billet($info)
	{
		include(constant("cRootServer_APP") . "/gerencianet/boleto/reenviar_boleto.php");
	}
}
