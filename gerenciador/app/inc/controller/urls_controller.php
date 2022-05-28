<?php
class urls_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
		$pjurls = new urls_model();
		$pjurls->set_field( array( $key , $field  ) ) ;
        $pjurls->set_filter( $filters ) ;
		$pjurls->set_order( array( $filed_name ) );
        $pjurls->load_data();
		$out = array_column( $pjurls->data , $filed_name , $key );
		return $out ;
	}
	private function filter($info){
		$done = array();
		$filter = array(" active = 'yes' ");
		if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
			$done["filter_name"] = $info["get"]["filter_name"];
			$filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
		}

		if (isset($info["get"]["filter_slug"]) && !empty($info["get"]["filter_slug"])) {
			$done["filter_slug"] = $info["get"]["filter_slug"];
			$filter["filter_slug"] = " slug like '%" . $info["get"]["filter_slug"] . "%' ";
		}
		if (isset($info["get"]["filter_url"]) && !empty($info["get"]["filter_url"])) {
			$done["filter_url"] = $info["get"]["filter_url"];
			$filter["filter_url"] = " pattern like '%" . $info["get"]["filter_url"] . "%' ";
		}
		if (isset($info["get"]["filter_pattern"]) && !empty($info["get"]["filter_pattern"])) {
			$done["filter_pattern"] = $info["get"]["filter_pattern"];
			$filter["filter_pattern"] = " pattern like '%" . $info["get"]["filter_pattern"] . "%' ";
		}
		if (isset($info["get"]["filter_slug"]) && !empty($info["get"]["filter_slug"])) {
			$done["filter_slug"] = $info["get"]["filter_slug"];
			$filter["filter_slug"] = " slug like '%" . $info["get"]["filter_slug"] . "%' ";
		}
		return array($done, $filter);
	}
	public function form( $info ){
		
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		if (isset($info["idx"])) {
			$pjurls = new urls_model();
			$pjurls->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$pjurls->load_data();
			$data = current($pjurls->data);
			
			$form = array(
				"url" => sprintf($GLOBALS["url_url"], $info["idx"])
				, "done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : set_url( $GLOBALS["urls_url"] , $info["get"] )
			);
		} else {
			$data = array();
			$form = array(
				"url" => $GLOBALS["newurl_url"]
				, "done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : set_url( $GLOBALS["urls_url"] , $info["get"] )
			);
		}
		$page = 'urls';
		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/url.php");
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
		$pjurls = new urls_model();
		$pjurls->set_order(array(" name asc "));
		if ($info["format"] == ".html") {
			$pjurls->set_paginate(array((int)$info["sr"] > $paginate ? (int)$info["sr"] : 0, $paginate));
		} else {
			$pjurls->set_paginate(array(0, 900000));
		}
		$pjurls->set_filter($filter);

		$pjurls->load_data();

		list( $total , $data ) = $pjurls->return_data();

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
				$page = 'urls';
		
				$ordenation_name = 'name-asc';
				$ordenation_name_ordenation = 'fas fa-border-none';
				$ordenation_slug = 'slug-asc';
				$ordenation_slug_ordenation = 'fas fa-border-none';
				$ordenation_pattern_url = 'pattern_url_at-asc';
				$ordenation_pattern_url_ordenation = 'fas fa-border-none';
				switch ($ordenation) {
				  case 'name asc':
					$ordenation_name = 'name-desc';
					$ordenation_name_ordenation = 'fas fa-angle-up';
					break;
				  case 'name desc':
					$ordenation_name = 'name-asc';
					$ordenation_name_ordenation = 'fas fa-angle-down';
					break;
				  case 'slug asc':
					$ordenation_slug = 'slug-desc';
					$ordenation_slug_ordenation = 'fas fa-angle-up';
					break;
				  case 'slug desc':
					$ordenation_slug = 'slug-asc';
					$ordenation_slug_ordenation = 'fas fa-angle-down';
					break;
				  case 'pattern_url_at asc':
					$ordenation_pattern_url = 'pattern_url_at-desc';
					$ordenation_pattern_url_ordenation = 'fas fa-angle-up';
					break;
				  case 'pattern_url_at desc':
					$ordenation_pattern_url = 'pattern_url_at-asc';
					$ordenation_pattern_url_ordenation = 'fas fa-angle-down';
					break;
				}
				$form = array(
					"done" => isset( $info["get"]["done"] ) ? $info["get"]["done"] : set_url( $GLOBALS["urls_url"] , $info["get"] )
					, "pattern" => array(
						"new" => $GLOBALS["newurl_url"], 
						"action" => $GLOBALS["url_url"], 
						"search" => !empty($info["get"]) ? set_url($GLOBALS["urls_url"], $info["get"]) : $GLOBALS["urls_url"]
					)
				);
				

				include( constant("cRootServer") . "ui/common/header.inc.php");
				include( constant("cRootServer") . "ui/common/head.inc.php");


				include( constant("cRootServer") . "ui/page/urls.php");

				include( constant("cRootServer") . "ui/common/footer.inc.php");
				print('<script>' . "\n");
				print('    data_pjurls_json = {' . "\n");
				print('        url: "' . $GLOBALS["urls_url"] . '.json"' . "\n");
				print('        , url_edit: "' . $GLOBALS["url_url"] . '"' . "\n");
				print('        , status_published_list: ' . json_encode($GLOBALS["status_published_list"]) . "\n");
				print('        , data: ' . json_encode($done) . "\n");
				print('        , template: ""' . "\n");
				print('        , page: 1' . "\n");
				print('    }' . "\n");
				include(constant("cRootServer") . "furniture/js/add/pjurls.js");
				print('</script>' . "\n");
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
		$pjurls = new urls_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$pjurls->set_filter(array(" idx = '" . $info["idx"] . "' "));
		} 

		$pjurls->populate($info["post"]);
		$pjurls->save();
		if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
			$info["idx"] = $pjurls->con->insert_id;
		}
		$pjurls->save_attach($info, array("profiles"));
		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["urls_url"]);
		}
	}
	public function remove($info)
	{
		if (!site_controller::check_login()) {
			basic_redir($GLOBALS["home_url"]);
		}
		$pjurls = new urls_model();
		if (isset($info["idx"]) && (int)$info["idx"] > 0) {
			$pjurls->set_filter(array(" idx = '" . $info["idx"] . "' "));
			$pjurls->remove();
		} 
		if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
			basic_redir($info["post"]["done"]);
		} else {
			basic_redir($GLOBALS["urls_url"]);
		}
	}
}	