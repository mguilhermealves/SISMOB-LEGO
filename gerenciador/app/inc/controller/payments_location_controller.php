<?php
class payments_location_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "name")
	{
		$boiler = new payments_model();
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

		if( isset( $info["get"]["filter_start_date"] ) && !empty( $info["get"]["filter_start_date"] ) ){
            $done["filter_start_date"] = $info["get"]["filter_start_date"] ;
            $filter["filter_start_date"] = " expire_at >= '" . $info["get"]["filter_start_date"] . "' " ;
        }else {
            $filter["filter_start_date"] = " expire_at >= '" . date("Y-m-d") . "' " ;
        }

        if( isset( $info["get"]["filter_end_date"] ) && !empty( $info["get"]["filter_end_date"] ) ){
            $done["filter_end_date"] = $info["get"]["filter_end_date"] ;
            $filter["filter_end_date"] = " expire_at <= '" . $info["get"]["filter_end_date"] . "' " ;
        } else {
            $filter["filter_end_date"] = " expire_at <= '" . date("Y-m-d") . "' " ;
        }

		if (isset($info["get"]["filter_end_date"]) && !empty($info["get"]["filter_contract"])) {
			$done["filter_contract"] = $info["get"]["filter_contract"];
			$filter["filter_contract"] = " n_contract like '%" . $info["get"]["filter_contract"] . "%' ";
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
		$data = $payments->data;

		

		$total_amount = 0;
		foreach ($data as $key => $v) {
			if ($v["status"] == "waiting" && $v["active"] == "yes") {
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
			default:
				$page = 'Contas a Receber';

				$sidebar_color = "rgba(218, 165, 32, 1)";
				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["accounts_receivables_url"], $done) : $GLOBALS["accounts_receivables_url"]), "pattern" => array(
						"new" => $GLOBALS["newaccountsreceivable_url"],
						"action" => $GLOBALS["accounts_receivable_url"],
						"search" => !empty($info["get"]) ? set_url($GLOBALS["accounts_receivables_url"], $info["get"]) : $GLOBALS["accounts_receivables_url"]
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
				include(constant("cRootServer") . "ui/page/locations/payments/payments.php");
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

			if ($data["payment_method"] == "ticket") {
				include(constant("cRootServer_APP") . "/gerencianet/boleto/atualizar_status.php");
			}

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
		print("<script>");
		include(constant("cRootServer") . "furniture/js/locations/payments/payment.js");
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
