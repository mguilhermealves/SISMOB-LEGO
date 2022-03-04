<?php
class contacts_controller
{
	public static function data4select($key = "idx", $filters = array(" active = 'yes' "), $field = "concat_ws(' ', name) as name")
	{
		$contacts = new contacts_model();
		$contacts->set_field(array($key, $field));
		$contacts->set_filter($filters);
		$contacts->load_data();
		$out = array();
		foreach ($contacts->data as $value) {
			$out[$value[$key]] = $value[preg_replace("/^.+ as (.+)$/", "$1", $field)];
		}
		return $out;
	}

	private function populateform(&$value,$key){
		foreach($value["goals_attach"] as $k=>$v){
			if( isset( $v["categorysectors_attach"][0] ) ){
				$value["goals_form"][ $v["categorysectors_attach"][0]["idx"] ] = $v["points"];
			}
		}
		foreach($value["partials_attach"] as $k=>$v){
			if( isset( $v["categorysectors_attach"][0] ) ){
				$value["partials_form"][ $v["categorysectors_attach"][0]["idx"] ] = $v["points"];
			}
		}
	}
	private function filter($info)
	{
		$done = array();
		$filter = array(" idx in ( select idx from contacts where active = 'yes' and idx > 1 ) ");
		if (isset($info["get"]["filter_first_name"]) && !empty($info["get"]["filter_first_name"])) {
			$done["filter_first_name"] = $info["get"]["filter_first_name"];
			$filter["filter_first_name"] = " first_name like '%" . $info["get"]["filter_first_name"] . "%' ";
		}
		if (isset($info["get"]["filter_last_name"]) && !empty($info["get"]["filter_last_name"])) {
			$done["filter_last_name"] = $info["get"]["filter_last_name"];
			$filter["filter_last_name"] = " last_name like '%" . $info["get"]["filter_last_name"] . "%' ";
		}
		if (isset($info["get"]["filter_mail"]) && !empty($info["get"]["filter_mail"])) {
			$done["filter_mail"] = $info["get"]["filter_mail"];
			$filter["filter_mail"] = " mail like '%" . $info["get"]["filter_mail"] . "%' ";
		}
		if (isset($info["get"]["filter_cpf"]) && !empty($info["get"]["filter_cpf"])) {
			$done["filter_cpf"] = $info["get"]["filter_cpf"];
			$filter["filter_cpf"] = " cpf like '%" . $info["get"]["filter_cpf"] . "%' ";
		}
		if (isset($info["get"]["filter_phone"]) && !empty($info["get"]["filter_phone"])) {
			$done["filter_phone"] = $info["get"]["filter_phone"];
			$filter["filter_phone"] = " phone like '%" . $info["get"]["filter_phone"] . "%' ";
		}
		if (isset($info["get"]["filter_celphone"]) && !empty($info["get"]["filter_celphone"])) {
			$done["filter_celphone"] = $info["get"]["filter_celphone"];
			$filter["filter_celphone"] = " celphone like '%" . $info["get"]["filter_celphone"] . "%' ";
		}

		return array($done, $filter);
	}
	public function display($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = 10;
		list($done, $filter) = $this->filter($info);
		$contacts = new contacts_model();
		$fields = array("idx", " name ", " telephone ", " email ", " message ") ;
		if ($info["format"] != ".json") {
			$contacts->set_paginate(array($info["sr"], $paginate));
		} else {
			$contacts->set_paginate(array(0, 900000));
			// $fields[] = " concat('" . constant("cFrontend_USER") . "loginsenha/' , md5( concat( idx , login ) ) ) as urlogin " ;
		}
		$contacts->set_field( $fields );
		//$contacts->set_filter($filter);

		list( $total , $data ) = $contacts->return_data();
		switch ($info["format"]) {
			case ".json":
				$t = array_count_values(array_column($contacts->con->results($contacts->con->select(" idx ", " contacts ", " where " . implode(" and ", $filter))),  "idx"));
				foreach (array_keys($GLOBALS["yes_no_lists"]) as $k) {
					if (!isset($t[$k])) {
						$t[$k] = 0;
					}
				}
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array( "total" => $total ) 
						, "row" => $data
					)
				);
				break;
			default:
				$page = 'Contatos';
				// $form = array(
				// 	"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["contacts_url"], $done) : $GLOBALS["contacts_url"]), "pattern" => array(
				// 		"new" => $GLOBALS["newuser_url"], "action" => $GLOBALS["user_url"], "search" => !empty($info["get"]) ? set_url($GLOBALS["contacts_url"], $info["get"]) : $GLOBALS["contacts_url"]
				// 	)
				// );
				include(constant("cRootServer") . "ui/common/header.inc.php");
				include(constant("cRootServer") . "ui/common/head.inc.php");
				include(constant("cRootServer") . "ui/page/contacts.php");
				include(constant("cRootServer") . "ui/common/footer.inc.php");
				print('<script>' . "\n");
				print('    data_contacts_json = {' . "\n");
				print('        url: "' . $GLOBALS["contacts_url"] . '.json"' . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/contacts.js");
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
			$contacts = new contacts_model();
			$contacts->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$contacts->load_data();
			$contacts->attach(array("profiles", "tokens"));

			$contacts->attach(array("goals"), false, null, array("idx", "points","name","created_at","tipo"));
			$contacts->attach(array("partials"), false, null, array("idx", "points"));
			$contacts->attach_son("goals", array("categorysectors"), true, null, array("idx", "name"));
			$contacts->attach_son("partials", array("categorysectors"), true, null, array("idx", "name"));

			array_walk( $contacts->data , array($this, 'populateform') );

			$contactsLogPoints = new contacts_model();
			$contactsLogPoints->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$contactsLogPoints->load_data();
			$contactsLogPoints->attach_all(array("goals"), false, null, array("idx", "points","name","created_at","tipo"));
			$contactsLogPoints->attach_all(array("partials"), false, null, array("idx", "points","created_at"));
			$contactsLogPoints->attach_son("goals", array("categorysectors"), true, null, array("idx", "name"));
			$contactsLogPoints->attach_son("partials", array("categorysectors"), true, null, array("idx", "name"));

			$goalsLog = array();			
			foreach($contactsLogPoints->data[0]["goals_attach"] as $k=>$v){				
				if( isset( $v["categorysectors_attach"][0] ) && $v["categorysectors_attach"][0]["name"] == 'Vendas'){
					$goalsLog["vendas"][$v["created_at"]] = $v["points"];					
				}
				/*if($v["categorysectors_attach"][0]["name"] == 'Positivação'){
					$goalsLog["positivacao"][$v["created_at"]] = $v["points"];					
				}
				if($v["categorysectors_attach"][0]["name"] == 'Exposição PDV'){
					$goalsLog["exposicao"][$v["created_at"]] = $v["points"];					
				}*/				
			}

			$partialsLog = array();
			foreach($contactsLogPoints->data[0]["partials_attach"] as $k=>$v){				
				if( isset( $v["categorysectors_attach"][0] ) && $v["categorysectors_attach"][0]["name"] == 'Vendas'){
					$partialsLog["vendas"][$v["created_at"]] = $v["points"];					
				}
				/*if($v["categorysectors_attach"][0]["name"] == 'Positivação'){
					$partialsLog["positivacao"][$v["created_at"]] = $v["points"];					
				}
				if($v["categorysectors_attach"][0]["name"] == 'Exposição PDV'){
					$partialsLog["exposicao"][$v["created_at"]] = $v["points"];					
				}*/				
			}

			

			$data = current($contacts->data);
									
			$form = array(
				"url" => sprintf($GLOBALS["user_url"], $info["idx"])
			);
		} else {
			$data = array(
				"avatar" => constant("cFrontend_USER") . "favicon.jpg", "created_at" => date("Y-m-d H:i:s"), "enabled" => "yes", "userCreated_attach" => array(array("first_name" => $_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["name"] . " - " .  $_SESSION[constant("cAppKey")]["credential"]["first_name"]))
			);
			foreach (array("occupation_area", "mail", "login", "first_name", "last_name", "cpf", "company", "crmv", "crmv_uf", "occupation_area", "phone", "genre", "birthdate", "address", "address_number", "address_complement", "address_neighborhood", "address_state", "address_city", "address_zip_code", "avatar", "campaings") as $k) {
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
		}

	

		$data["tk_pwd"] = sprintf($GLOBALS["tkpwd_url"], $data["tokens_name"]);
		$profiles_lists = profiles_controller::data4select("idx", array(" idx > 1 "), "name");
		$categorysectors_lists = categorysectors_controller::data4select("idx", array(" idx > 0 "), "name");
		$page = 'user';
		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/user.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["contacts_url"]) . '" ');
		print('})' . "\n");
		include(constant("cRootServer") . "furniture/js/add/user.js");
		if (isset($data["goals_attach"][0])) {
			foreach ($data["goals_attach"] as $v) {
				print("\n" . 'meta.add_table({ ' . "\n");
				print('	idx:  "' . $v["idx"] . '"' . "\n");
				print('	, id_key:  "' . $v["idx"] . '"' . "\n");
				print('	, date_meta: "' . preg_replace("/^(....).(..).(..).(.....).+/", "$1-$2-$3", $v["created_at"]) . '"' . "\n");
				print('	, date_meta_sql: "' . preg_replace("/^(....).(..).(..).(.....).+/", "$1-$2-$3", $v["created_at"]) . '"' . "\n");
				print('	, type_meta: "' . $v["tipo"] . '"' . "\n");
				print('	, name_meta: "' . $v["name"] . '"' . "\n");
				print('	, point_meta: "' . $v["points"] . '"' . "\n");
				print('})' . "\n");
			}
		}
		print('</script>' . "\n");
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
		if (isset($info["post"]["cpf"])) {
			$info["post"]["cpf"] = preg_replace("/[^0-9]+?/", "", $info["post"]["cpf"]);
		}

		
		$body = array(
			'nome' => $info["post"]["first_name"].' '.$info["post"]["last_name"],
			'cpf_cnpj' => $info["post"]["cpf"],
			'email' => $info["post"]["mail"],
			'senha' => $info["post"]["cpf"],
			'Id_ClienteCampanha' => constant("cCampanhaID"),
		);		
			
		$response = externalapi_controller::load($body,'cadastro');	
			
		if(!$response["error"]){

			$info["post"]["num_cartao"] = $response["cartao"]["cartao"];
			$info["post"]["login"] = $info["post"]["cpf"];
			$info["post"]["password"]  = md5($info["post"]["cpf"]);
				
				$contacts = new contacts_model();
				if (isset($info["idx"]) && (int)$info["idx"] > 0) {
					$contacts->set_filter(array(" idx = '" . $info["idx"] . "' "));
				}
				$contacts->populate($info["post"]);
				$contacts->save();
				if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
					$info["idx"] = $contacts->con->insert_id;
				}


				$contacts->save_attach($info, array("profiles", "goals", "partials", "tokens"));

				if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
					basic_redir($info["post"]["done"]);
				} else {
					basic_redir($GLOBALS["contacts_url"]);
				}
		
		}else{
			$_SESSION["messages_app"]["danger"] = array("Houve um erro na hora de cadastrar o usuário!");
			$this->form($info);
		}
			
	}
}
