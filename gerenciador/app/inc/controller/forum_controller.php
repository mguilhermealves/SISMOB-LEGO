<?php
class forum_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "title")
  {
    $foruns = new forum_model();
    $foruns->set_field(array($key, $field));
    $foruns->set_filter($filters);
    $foruns->load_data();
    $out = array();
    foreach ($foruns->data as $value) {
      $out[$value[$key]] = $value[$field];
    }
    return $out;
  }

  private function filter($info)
  {
    $done = array();
    $filter = array(" idx > 0 ",  "active = 'yes'");

    if (isset($info["get"]["filter_id"]) && !empty($info["get"]["filter_id"])) {
      $done["filter_id"] = $info["get"]["filter_id"];
      $filter["filter_id"] = " idx like '%" . $info["get"]["filter_id"] . "%' ";
    }

    if (isset($info["get"]["filter_title"]) && !empty($info["get"]["filter_title"])) {
      $done["filter_title"] = $info["get"]["filter_title"];
      $filter["filter_title"] = " title like '%" . $info["get"]["filter_title"] . "%' ";
    }

    if (isset($info["get"]["filter_isFixed"]) && !empty($info["get"]["filter_isFixed"])) {
      $done["filter_isFixed"] = $info["get"]["filter_isFixed"];
      $filter["filter_isFixed"] = " isFixed like '%" . $info["get"]["filter_isFixed"] . "%' ";
    }
    
    if (isset($info["get"]["filter_isPrivate"]) && !empty($info["get"]["filter_isPrivate"])) {
      $done["filter_isPrivate"] = $info["get"]["filter_isPrivate"];
      $filter["filter_isPrivate"] = " isPrivate like '%" . $info["get"]["filter_isPrivate"] . "%' ";
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

    $foruns = new forum_model();

    if ($info["format"] != ".json") {
      $foruns->set_paginate(array($info["sr"], $paginate));
    } else {
      $foruns->set_paginate(array(0, 900000));
    }

    $foruns->set_filter($filter);

		list( $total , $data ) = $foruns->return_data();

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
        $page = 'Forum';
        $form = array(
          "done" => rawurlencode(!empty($done) ? set_url($GLOBALS["scheduleds_url"], $done) : $GLOBALS["scheduleds_url"]), "pattern" => array(
            "new" => $GLOBALS["newforum_url"], "action" => $GLOBALS["scheduled_url"], "search" => !empty($info["get"]) ? set_url($GLOBALS["scheduleds_url"], $info["get"]) : $GLOBALS["scheduleds_url"]
          )
        );
        include(constant("cRootServer") . "ui/common/header.inc.php");
        include(constant("cRootServer") . "ui/common/head.inc.php");
        include(constant("cRootServer") . "ui/page/foruns.php");
        include(constant("cRootServer") . "ui/common/footer.inc.php");
        /*print('<script>' . "\n");
        print('    data_agendas_json = {' . "\n");
        print('        url: "' . $GLOBALS["scheduleds_url"] . '.json"' . "\n");
        print('        , data: ' . json_encode($done) . "\n");
        print('        , action: "' . set_url($GLOBALS["scheduled_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
        print('        , template: ""' . "\n");
        print('        , page: 1' . "\n");
        print('    }' . "\n");
        //include(constant("cRootServer") . "furniture/js/add/foruns.js");
        print('</script>' . "\n");*/
        include( constant("cRootServer") . "ui/common/list_actions.php");
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
      $forum = new forum_model();
      $forum->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $forum->load_data();

      $data = $forum->data;

      $form = array(
        "url" => sprintf($GLOBALS["new_forum_url"], $info["idx"])
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newforum_url"]
      );
    }

    $page = 'Forum';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/forum.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[name=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["foruns_url"]) . '" ');
    print('})' . "\n");
    print('</script>' . "\n");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }

  public function save($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $forum = new forum_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $forum->set_filter(array(" idx = '" . $info["idx"] . "' "));
    } else {
      $info["post"]["slug"] = generate_slug($info["post"]["title"]);
    }

    if ( !isset( $info["post"]["isFixed"] ) ) {
      $info["post"]["isFixed"] = "no";
    }

    if ( !isset( $info["post"]["isPrivate"] ) ) {
      $info["post"]["isPrivate"] = "no";
    }

    $forum->populate($info["post"]);
    $forum->save();
    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $forum->con->insert_id;
    }
    $forum->save_attach($info, array("sections"));

    if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
      $d = preg_split("/\./", $_FILES["image"]["name"]);
      $extension = $d[count($d) - 1];
      $name = generate_slug(preg_replace("/\." . $extension . "$/", "", $_FILES["image"]["name"]));
      $extension = date("YmdHis") . "." . $extension;
      $file = "furniture/upload/forum/topicos/" . $info["idx"] . "images/" . $name . $extension;

      if (file_exists(constant("cRootServer") . $file)) {
        unlink(constant("cRootServer") . $file);
      }
      move_uploaded_file($_FILES["image"]["tmp_name"], constant("cRootServer") . $file);
      $info["post"]["image"] = $file;
    }

    if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
      basic_redir($info["post"]["done"]);
    } else {
      basic_redir($GLOBALS["foruns_url"]);
    }
  }

  public function remove($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }
    if (isset($info["idx"])) {
      $foruns = new forum_model();
      $foruns->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $foruns->remove();
    }

    basic_redir($GLOBALS["scheduleds_url"]);
  }
  public static function display_in_section($info){			

		$section = new sections_model();
		$section->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
		$section->load_data();
		$section->attach(array("forum"),true);
		$section_forum = $section->data;
		
		return $section_forum;
	}
	public static function form_modal( $key ){
			$boiler = new forum_model();
			$boiler->set_filter( array( " idx = '" . $key . "'" ) ) ;
			$boiler->load_data();
			$boiler->set_paginate( array(1) ) ;
			$data = current( $boiler->data ) ;     
			return $data;
	}
}
