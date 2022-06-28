<?php
class users_controller
{
	public static function data4select($key = "idx", $filters = array(), $field = "name")
	{
		$filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/", "$1", $field)));
		$users = new users_model();
		$users->set_field(array($key, $field));
		$users->set_filter($filters);
		$users->set_order(array($filed_name));
		$users->load_data();
		$out = array_column($users->data, $filed_name, $key);
		return $out;
	}
	private function filter($info)
	{
		$done = array();
		$filter = array(" active = 'yes' ", " idx in ( select users_profiles.users_id from users_profiles where users_profiles.active = 'yes' and users_profiles.profiles_id in (2, 3, 4, 5, 6) ) ");

		if (!in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"], array(1, 2)) && !in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["slug"], array('adm-premier', 'gestor-hsol'))) {
			$profiles_id = array_keys(profiles_controller::data4select("idx", array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) ")));
			$filter["filter_profiles"] = " idx in ( select users_profiles.trails_id from users_profiles where users_profiles.active = 'yes' and users_profiles.profiles_id in ( '" . implode("','", $profiles_id) . "') ) ";
		}

		if (isset($info["get"]["filter_profile"]) && !empty($info["get"]["filter_profile"])) {
			$done["filter_profile"] = $info["get"]["filter_profile"];
			$filter["filter_profile"] = " idx in ( select users_profiles.users_id from users_profiles where users_profiles.active = 'yes' and users_profiles.profiles_id = '" . $info["get"]["filter_profile"] . "' ) ";
		}

		if (isset($info["get"]["q_name"]) && !empty($info["get"]["q_name"])) {
			$filter["filter_q"] = " concat_ws(' ', first_name, last_name ) like '%" . $info["get"]["q_name"] . "%' ";
		}
		if (isset($info["get"]["q_mail"]) && !empty($info["get"]["q_mail"])) {
			$filter["filter_q"] = " mail like '%" . $info["get"]["q_mail"] . "%' ";
		}
		if (isset($info["get"]["q_cpf"]) && !empty($info["get"]["q_cpf"])) {
			$filter["filter_q"] = " cpf like '%" . $info["get"]["q_cpf"] . "%' ";
		}
		if (isset($info["get"]["filter_first_name"]) && !empty($info["get"]["filter_first_name"])) {
			$done["filter_first_name"] = $info["get"]["filter_first_name"];
			$filter["filter_first_name"] = " first_name like '%" . $info["get"]["filter_first_name"] . "%' ";
		}
		if (isset($info["get"]["filter_last_name"]) && !empty($info["get"]["filter_last_name"])) {
			$done["filter_last_name"] = $info["get"]["filter_last_name"];
			$filter["filter_last_name"] = " last_name like '%" . $info["get"]["filter_last_name"] . "%' ";
		}
		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " replace(replace(cpf , '.',''),'-','') = '" . preg_replace("/[^0-9]+?/", "", $info["get"]["filter_cpf"]) . "' ";
		}
		if (isset($info["get"]["filter_mail"]) && !empty($info["get"]["filter_mail"])) {
			$done["filter_mail"] = $info["get"]["filter_mail"];
			$filter["filter_mail"] = " mail like '%" . $info["get"]["filter_mail"] . "%' ";
		}
		return array($done, $filter);
	}

	public function display($info)
	{

		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'first_name asc';

		if (isset($info["get"]["query"]) && strlen(addslashes($info["get"]["query"]))) {
			$query = preg_replace("/\[+?|\]+?/", "", toUtf8($info["get"]["query"]));
			$query = preg_replace("/\s+?|\t+?|\n+?/", " ", $query);
			$query = preg_replace("/^ | $/", "", $query);
			$query = preg_replace("/([A-z0-9\ \-\_])+?/", "$1", $query);

			if (empty($query)) {
				$query = " ";
			}

			switch ($info["get"]["autcomplete_field"]) {
				case "cpf":
					$query = preg_replace("/\D+?/im", "", $query);
					$info["get"]["q_cpf"] = $query;
					break;
				case "name":
					$info["get"]["q_name"] = $query;
					break;
				case "mail":
					$info["get"]["q_mail"] = $query;
					break;
			}
		}

		list($done, $filter) = $this->filter($info);
		$users = new users_model();
		//   switch ($info["format"]) {
		// 	case ".xls":
		// 	case ".json":
		// 	  $users->set_paginate(array(0, 900000));
		// 	  break;
		// 	case ".autocomplete":
		// 	  $users->set_paginate(array(0, 12));
		// 	  break;
		// 	default:
		// 	  $users->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
		// 	  $filter[] = " idx in ( select users_profiles.users_id from users_profiles where users_profiles.active = 'yes' and not users_profiles.profiles_id in ('1','2') ) ";
		// 	  break;
		//   }
		$users->set_filter($filter);
		if ($info["format"] != ".xls") {
			$users->set_field(array("idx", "first_name", "last_name", "mail", "login", "cpf", "enabled"));
		}
		$users->set_order(array($ordenation));

		$users->load_data();
		$users->attach(array("profiles"), false, null, array("idx", "name"));
		$users->attach(array("address"));
		$data = $users->data;

		$profiles_lists = profiles_controller::data4select("idx", array(" idx in (2, 3, 4, 5, 6) "), "name");

		switch ($info["format"]) {
			case ".autocomplete":
				$out = array(
					"query" => isset($cod_cliente) ? $cod_cliente : "", "suggestions" => array(),
				);
				foreach ($data as $key => $value) {
					$out["suggestions"][] = array(
						"data" => $value, "value" => sprintf("%s %s (%s) ", $value["first_name"], $value["last_name"], $value["mail"])
					);
				}

				header('Content-type: application/json');
				echo json_encode($out);
				break;
			case ".json":
				$t = array();
				foreach (array("yes", "no") as $k) {
					$t[$k] = 0;
				}

				foreach (array_column($users->con->results($users->con->select(" count( idx ) as q , enabled ", " users ", " where " . implode(" and ", $filter))), "q", "enabled") as $k => $v) {
					$t[$k] = (int)$v;
				}

				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array_merge(array("total" => array_sum($t)), $t), "row" => $data, "profiles" => $profiles_lists
					)
				);
				break;
			case ".xls":
				$name = "Relatorio_de_Usuários" .  date("d-m-Y-H:s");
				require_once(constant("cRootServer_APP") . '/inc/lib/PHPExcel-1.8/Classes/PHPExcel.php');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator("SISMOB")
					->setLastModifiedBy("SISMOB")
					->setTitle("Relatorio Usuários")
					->setSubject("Relatorio Usuários SISMOB")
					->setDescription("Relatorio Usuários SISMOB")
					->setKeywords("Usuários")
					->setCategory("Usuários");

				$objPHPExcel->setActiveSheetIndex(0)->setTitle('Usuários');
				$x_in = 1;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $x_in, 'Nome');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $x_in, 'Sobrenome');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $x_in, 'E-mail');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $x_in, 'CPF');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $x_in, 'Telefone');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $x_in, 'Sexo');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $x_in, 'Nascimento');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $x_in, 'Endereço');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $x_in, 'Número');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $x_in, 'Complemento');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $x_in, 'Bairro');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . $x_in, 'Estado');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $x_in, 'Cidade');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . $x_in, 'CEP');
				$x_in++;
				foreach ($data as $row) {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $x_in, $row["first_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $x_in, $row["last_name"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $x_in, $row["mail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $x_in, preg_replace("/(...)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\.|-/", "", $row["cpf"])));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $x_in, $row["celphone"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $x_in, isset($GLOBALS["genre_lists"][$row["genre"]]) ? $GLOBALS["genre_lists"][$row["genre"]] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $x_in, !empty($row["birthday"]) ? preg_replace("/(....).(..).(..)$/", "$3/$2/$1", $row["birthday"]) : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["address"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["number"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["complement"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["neighborhood"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["uf"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["city"] : "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . $x_in, isset($row["address_attach"][0]) ? $row["address_attach"][0]["postal_code"] : "-");
					$x_in++;
				}

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');

				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
				header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header('Pragma: public'); // HTTP/1.0
				$objWriter->setIncludeCharts(TRUE);
				$objWriter->save('php://output');
				$objWriter->setOffice2003Compatibility(true);
				$objPHPExcel->disconnectWorksheets();
				$objPHPExcel->garbageCollect();
				unset($objPHPExcel);
				exit();
				break;
			default:
				$page = 'users';

				$p = array();
				foreach ($profiles_lists as $k => $v) {
					$p[$k] = 0;
				}

				foreach (array_column($users->con->results($users->con->select(" count( users_id ) as q, profiles_id ", " users_profiles ", " where active = 'yes' and users_id in ( select idx from users where " . implode(" and ", $filter) . ") group by profiles_id ")), "q", "profiles_id") as $k => $v) {
					$p[$k] = $v;
				}

				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["users_url"], $done) : $GLOBALS["users_url"]), "pattern" => array(
						"new" => $GLOBALS["newuser_url"], "action" => $GLOBALS["user_url"], "search" => !empty($info["get"]) ? set_url($GLOBALS["users_url"], $info["get"]) : $GLOBALS["users_url"]
					)
				);

				$dash["profiles"] = array();
				foreach ($profiles_lists as $k => $v) {
					$dash["profiles"][$k] = array("name" => $v, "total" => $p[$k]);
				}

				$dash["users"] = array_column($users->con->results($users->con->select(" count( idx ) as q , enabled ", " users ", " where " . implode(" and ", $filter) . " group by enabled ")), "q", "enabled");
				$dash["users"]["total"] = array_sum($dash["users"]);

				$total = $users->con->result($users->con->select(" ifnull( count( idx ) , 0 ) as s ", " users ", " where " . implode(" and ", $filter)), "s", 0);

				$t = array();
				foreach (array("yes", "no") as $k) {
					$t[$k] = 0;
				}

				foreach (array_column($users->con->results($users->con->select(" count( idx ) as q , enabled ", " users ", " where " . implode(" and ", $filter))), "q", "enabled") as $k => $v) {
					$t[$k] = (int)$v;
				}
				$template = '<div class="row_js#CLASS#"#ADD#>';
				$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_NAME#>#NAME#</div>';
				$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_USER#>#USER#</div>';
				$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_GRUPO#>#GRUPO#</div>';
				$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_MAIL#>#MAIL#</div>';
				$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_CPF#>#CPF#</div>';
				$template .= '  <div class="cell" style="min-width: 70px !important;overflow:hidden;"#ADD_STATUS#>#STATUS#</div>';
				$template .= '  <div class="cell cell_last" style="min-width: 70px !important;overflow:hidden;">#ACAO#</div>';
				$template .= '</div>';

				$footer = '<div class="row_js table_data_footer">';
				$footer = ' <div class="cell cell_last table_data_footer">';
				$footer = '     Linha por Página ';
				$footer = '     <select id="per_page">';
				$footer = '         <option value="20" selected>20</option>';
				$footer = '         <option value="50">50</option>';
				$footer = '         <option value="100">100</option>';
				$footer = '     </select>';
				$footer = ' </div>';
				$footer = ' <div class="cell cell_last table_data_footer" style="justify-content: space-around;" id="paginate_control"></div>';
				$footer = ' <div class="cell cell_last table_data_footer" id="paginate_display">#DATA_TOTAL#</div>';
				$footer = '</div>';

				$ordenation_name = 'first_name-asc';
				$ordenation_name_ordenation = 'fas fa-border-none';
				$ordenation_login = 'login-asc';
				$ordenation_login_ordenation = 'fas fa-border-none';
				$ordenation_grupo = 'grupo-asc';
				$ordenation_grupo_ordenation = 'fas fa-border-none';
				$ordenation_mail = 'mail-asc';
				$ordenation_mail_ordenation = 'fas fa-border-none';
				$ordenation_cpf = 'cpf-asc';
				$ordenation_cpf_ordenation = 'fas fa-border-none';
				$ordenation_enabled = 'enabled-asc';
				$ordenation_enabled_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'first_name asc':
						$ordenation_name = 'first_name-desc';
						$ordenation_name_ordenation = 'fas fa-angle-up';
						break;
					case 'first_name desc':
						$ordenation_name = 'first_name-asc';
						$ordenation_name_ordenation = 'fas fa-angle-down';
						break;
					case 'login asc':
						$ordenation_login = 'login-desc';
						$ordenation_login_ordenation = 'fas fa-angle-up';
						break;
					case 'login desc':
						$ordenation_login = 'login-asc';
						$ordenation_login_ordenation = 'fas fa-angle-down';
						break;
					case 'grupo asc':
						$ordenation_grupo = 'grupo-desc';
						$ordenation_grupo_ordenation = 'fas fa-angle-up';
						break;
					case 'grupo desc':
						$ordenation_grupo = 'grupo-asc';
						$ordenation_grupo_ordenation = 'fas fa-angle-down';
						break;
					case 'mail asc':
						$ordenation_mail = 'mail-desc';
						$ordenation_mail_ordenation = 'fas fa-angle-up';
						break;
					case 'mail desc':
						$ordenation_mail = 'mail-asc';
						$ordenation_mail_ordenation = 'fas fa-angle-down';
						break;
					case 'cpf asc':
						$ordenation_cpf = 'cpf-desc';
						$ordenation_cpf_ordenation = 'fas fa-angle-up';
						break;
					case 'cpf desc':
						$ordenation_cpf = 'cpf-asc';
						$ordenation_cpf_ordenation = 'fas fa-angle-down';
						break;
					case 'enabled asc':
						$ordenation_enabled = 'enabled-desc';
						$ordenation_enabled_ordenation = 'fas fa-angle-up';
						break;
					case 'enabled desc':
						$ordenation_enabled = 'enabled-asc';
						$ordenation_enabled_ordenation = 'fas fa-angle-down';
						break;
				}

				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/users/users.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				include(constant("cRootServer") . "ui/common/list_actions.php");
				print('<script>' . "\n");
				print('    data_users_json = {' . "\n");
				print('        url: "' . $GLOBALS["users_url"] . '.json"' . "\n");
				print('        , url_edit: "' . $GLOBALS["user_url"] . '"' . "\n");
				print('        , out_data: ' . json_encode(array("total" => array("total" => $total))) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: ' . (isset($info["sr"]) && (int)$info["sr"] > 1 ? $info["sr"] : 1) . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/users.js");
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
			$users = new users_model();
			$users->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$users->load_data();
			$users->attach(array("profiles", "tokens", "address"));
			$users->join("userCreated", "users", array("idx" => "created_by"), null, array("first_name"));
			$users->join("userModified", "users", array("idx" => "modified_by"), null, array("first_name"));
			$data = current($users->data);
			$form = array(
				"url" => sprintf($GLOBALS["user_url"], $info["idx"])
			);
		} else {
			$data = array(
				"avatar" => constant("cFrontend_USER") . "favicon.jpg", "created_at" => date("Y-m-d H:i:s"), "userCreated_attach" => array(array("first_name" => $_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["name"] . " - " .  $_SESSION[constant("cAppKey")]["credential"]["first_name"]))
			);
			foreach (array("cpf", "mail ", "name ", "first_name ", "last_name", "login", "password", "external_id") as $k) {
				$data[$k] = !isset($data[$k]) ? "" : $data[$k];
			}
			$form = array(
				"url" => $GLOBALS["newuser_url"]
			);
		}

		if (isset($data["tokens_attach"][0])) {
			$data["tokens_name"] = $data["tokens_attach"][0]["name"];
			$data["tokens_id"] = $data["tokens_attach"][0]["idx"];
		} else {
			$data["tokens_name"] = md5(date("YmdHis") . $_SESSION[constant("cAppKey")]["credential"]["idx"]);
			$data["tokens_id"] = 0;
			if (isset($info["idx"]) && (int)$info["idx"] > 0) {
				$tokens = new tokens_model();
				$tokens->populate(array("name" => $data["tokens_name"]));
				$tokens->save();
				$data["tokens_id"] = $tokens->con->insert_id;
				$tokens->save_attach(array("idx" => $data["tokens_id"], "post" => array("users_id" => (int)$info["idx"])), array("users"), true);
			}
		}

		$data["tk_pwd"] = sprintf($GLOBALS["tkpwd_url"], $data["tokens_name"]);

		$profiles_lists = profiles_controller::data4select("idx", array(" idx in (3, 4, 5, 6) "), "name");
		
		$page = 'user';
		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/users/user.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["users_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/add/user.js");
		print("</script>");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}

		if ((int)$info["post"]["tokens_id"] == 0) {
			$tokens = new tokens_model();
			$tokens->populate(array("name" => $info["post"]["tokens_name"]));
			$tokens->save();
			$info["post"]["tokens_id"] = $tokens->con->insert_id;
		}
		$users = new users_model();

		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$users->set_filter(array(" idx = '" . $info["idx"] . "' "));
		}

		if (isset($info["post"]["cpf"]) && !empty($info["post"]["cpf"])) {
			$info["post"]["cpf"] = preg_replace("/[^0-9]+?/", "", $info["post"]["cpf"]);
		}

		$users->populate($info["post"]);
		$users->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $users->con->insert_id;
		}

		$users->save_attach($info, array("profiles", "tokens"));

		if (isset($info["post"]["address"])) {
			$post_address = array();

			if (isset($info["post"]["address_id"])) {
				$post_address["idx"] = (int)$info["post"]["address_id"];
			}

			foreach ($info["post"]["address"] as $k => $v) {
				if (!empty($v)) {
					$post_address["post"][$k] = $v;
				}
			}

			if (count($post_address)) {
				$address = new address_model();

				if (isset($post_address["idx"])) {
					$address->set_filter(array(" idx = '" . $post_address["idx"] . "' "));
				}

				$address->populate($post_address["post"]);
				$address->save();

				if (!isset($post_address["idx"])) {
					$info["post"]["address_id"] = $address->con->insert_id;
				}

				$users->save_attach($info, array("address"));
			}
		}

		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["users_url"]);
		}
	}
}
