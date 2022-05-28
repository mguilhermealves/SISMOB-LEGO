<?php
class routes_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
		$routes = new routes_model();
		$routes->set_field( array( $key , $field  ) ) ;
        $routes->set_filter( $filters ) ;
		$routes->set_order( array( $filed_name ) );
        $routes->load_data();
		$out = array_column( $routes->data , $filed_name , $key );
		return $out ;
	}
	private function filter($info){
		$done = array();
		$filter = array(" active = 'yes' ");
		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
		}
		if (isset($info["get"]["filter_pattern"]) && !empty($info["get"]["filter_pattern"])) {
			$done["filter_pattern"] = $info["get"]["filter_pattern"];
			$filter["filter_pattern"] = " pattern like '%" . $info["get"]["filter_pattern"] . "%' ";
		}
		if (isset($info["get"]["filter_controller"]) && !empty($info["get"]["filter_controller"])) {
			$done["filter_controller"] = $info["get"]["filter_controller"];
			$filter["filter_controller"] = " controller like '%" . $info["get"]["filter_controller"] . "%' ";
		}
		if (isset($info["get"]["filter_profile"]) && !empty($info["get"]["filter_profile"])) {
			$done["filter_profile"] = $info["get"]["filter_profile"];
			$filter["filter_profile"] = " idx in ( select routes_profiles.routes_id from routes_profiles where routes_profiles.active = 'yes' and routes_profiles.profiles_id = '" . $info["get"]["filter_profile"] . "' ) ";
		}
		return array($done, $filter);
	}
	public function form( $info ){
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		if (isset($info["idx"])) {
			$routes = new routes_model();
			$routes->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$routes->load_data();
			$routes->attach(array("profiles"));
			$data = current($routes->data);
			$form = array(
				"url" => sprintf($GLOBALS["route_url"], $info["idx"])
				, "done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : set_url( $GLOBALS["routes_url"] , $info["get"] )
			);
		} else {
			$data = array();
			$form = array(
				"url" => $GLOBALS["newroute_url"]
				, "done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : set_url( $GLOBALS["routes_url"] , $info["get"] )
			);
		}

		$page = 'pjroutes';

		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/route.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		print("<script>");
		print('$("button[name=\'btn_back\']").bind("click", function(){');
		print(' document.location = "' . $form["done"] . '" ');
		print('})' . "\n");
		print("</script>");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function display( $info ){
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'name asc';
	
		list($done, $filter) = $this->filter($info);
		$routes = new routes_model();
		$routes->set_order(array(" name asc "));
		if ($info["format"] == ".html") {
			$routes->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
		} else {
			$routes->set_paginate(array(0, 900000));
		}
		$routes->set_filter($filter);

		$routes->load_data();
		$routes->attach( array("profiles"));

		list( $total , $data ) = $routes->return_data();

		//$data = $routes->data;
		//$total = $routes->con->result($routes->con->select(" ifnull( count( idx ) , 0 ) as s ", " pjroutes ", " where " . implode(" and ", $filter)), "s", 0);

		switch ($info["format"]) {
			case ".json":
				$t = array("total" => 3);
				header('Content-type: application/json');
				echo json_encode(
					array(
						"total" => array_merge(array("total" => array_sum($t)), $t), "row" => $data
					)
				);
				break;
			default:
				$page = 'routes';

				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
					case 'name asc':
						$ordenation_positions = 'name-desc';
						$ordenation_positions_ordenation = 'fas fa-angle-up';
					break;
					case 'name desc':
						$ordenation_positions = 'name-asc';
						$ordenation_positions_ordenation = 'fas fa-angle-down';
					break;
				}


				$form = array(
					"done" => rawurlencode(!empty($done) ? set_url($GLOBALS["routes_url"], $done) : $GLOBALS["routes_url"])
					, "pattern" => array(
						"new" => $GLOBALS["newroute_url"]
						, "action" => $GLOBALS["route_url"]
						, "search" => !empty($info["get"]) ? set_url($GLOBALS["routes_url"], $info["get"]) : $GLOBALS["routes_url"]
					)
				);
				include( constant("cRootServer") . "ui/common/header.inc.php");
				include( constant("cRootServer") . "ui/common/head.inc.php");
				include( constant("cRootServer") . "ui/page/routes.php");
				include( constant("cRootServer") . "ui/common/footer.inc.php");
				include( constant("cRootServer") . "ui/common/list_actions.php");
				include( constant("cRootServer") . "ui/common/foot.inc.php");
				break;
		}
	}
	public function save($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$routes = new routes_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$routes->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} 

		$routes->populate($info["post"]);
		$routes->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $routes->con->insert_id;
		}
		$routes->save_attach($info, array("profiles"));
		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["routes_url"]);
		}
	}
	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$routes = new routes_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$routes->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$routes->remove();
		} 
		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["routes_url"]);
		}
	}
}	