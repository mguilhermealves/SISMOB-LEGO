<?php
class trails_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "title")
  {
    $foruns = new trails_model();
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
    $filter = array(" active = 'yes' ");
    if( !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) && !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
      //$done["filter_profiles"] = $info["get"]["filter_profiles"];
      $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
      $filter["filter_profiles"] = " idx in ( select trails_profiles.trails_id from trails_profiles where trails_profiles.active = 'yes' and trails_profiles.profiles_id in ( '" . implode("','",$profiles_id) . "') ) ";
    }
    else{
      if (isset($info["get"]["filter_profiles"]) && !empty($info["get"]["filter_profiles"])) {
        $done["filter_profiles"] = $info["get"]["filter_profiles"];
        $filter["filter_profiles"] = " idx in ( select trails_profiles.trails_id from trails_profiles where trails_profiles.active = 'yes' and trails_profiles.profiles_id = '" . $info["get"]["filter_profiles"] . "' ) ";
      }
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

    if (isset($info["get"]["filter_title"]) && !empty($info["get"]["filter_title"])) {
      $done["filter_title"] = $info["get"]["filter_title"];
      $filter["filter_title"] = " trail_title like '%" . $info["get"]["filter_title"] . "%' ";
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
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'display_position asc';

    list($done, $filter) = $this->filter($info);

    $trails = new trails_model();

    if ($info["format"] != ".json") {
      $trails->set_paginate(array($info["sr"], $paginate));
    } else {
      $trails->set_paginate(array(0, 900000));
    }

    $trails->set_filter($filter);
    $trails->set_order( array( $ordenation ) ) ;
    list( $total , $data ) = $trails->return_data();


    /*$total = $trails->con->result($trails->con->select(" ifnull( count( idx ) , 0 ) as s ", " trails ", " where " . implode(" and ", $filter)), "s", 0);

    $trails_published = $trails->con->result( $trails->con->select(" ifnull( count( idx ) , 0 ) as s ", " trails ", " where trail_status = 'Publicado' "), "s", 0 );
    $trails_scheduled = $trails->con->result($trails->con->select(" ifnull( count( idx ) , 0 ) as s ", " trails ", " where  trail_status = 'Arquivado' "), "s", 0);
    $trails_drafts = $trails->con->result($trails->con->select(" ifnull( count( idx ) , 0 ) as s ", " trails ", " where  trail_status = 'Rascunho' "), "s", 0);*/

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
        $page = 'Trilha';

        $sidebar_color = "rgba(255, 147, 0, 0.82)";
        $form = array(
          "done" => rawurlencode(!empty($done) ? set_url($GLOBALS["trails_url"], $done) : $GLOBALS["trails_url"])
          , "pattern" => array(
              "new" => $GLOBALS["newtrail_url"], 
              "action" => $GLOBALS["trail_url"], 
              "search" => !empty($info["get"]) ? set_url( $GLOBALS["trails_url"], $info["get"] ) : $GLOBALS["trails_url"]
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
        include(constant("cRootServer") . "ui/page/trails.php");
        include(constant("cRootServer") . "ui/common/footer.inc.php");
        include( constant("cRootServer") . "ui/common/list_actions.php");
        print('<script>' . "\n");
        print('    data_agendas_json = {' . "\n");
        print('        url: "' . $GLOBALS["scheduleds_url"] . '.json"' . "\n");
        print('        , data: ' . json_encode($done) . "\n");
        print('        , action: "' . set_url($GLOBALS["scheduled_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
        print('        , template: ""' . "\n");
        print('        , page: 1' . "\n");
        print('    }' . "\n");
        include(constant("cRootServer") . "furniture/js/add/foruns.js");
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
      $trail = new trails_model();
      $trail->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $trail->load_data();
      $trail->attach(array("profiles"));
      $data = $trail->data;
      $form = array(
        "url" => sprintf($GLOBALS["trail_url"], $info["idx"])
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newtrail_url"]
      );
    }

    $sidebar_color = "rgba(255, 147, 0, 0.82)";
    $page = 'Trilha';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/trail.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[name=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["trails_url"]) . '" ');
    print('})' . "\n");
    print('</script>' . "\n");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }

  public function save($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (!isset($info["post"]["trail_has_certification"])) {
      $info["post"]["trail_has_certification"] = "no";
    }

    $trail = new trails_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $trail->set_filter(array(" idx = '" . $info["idx"] . "' "));              
    } else {
      $info["post"]["slug"] = generate_slug($info["post"]["trail_title"]. "-" . date("Y-m-d H:i:s"));    
      $info["post"]["modified_at"] = date("Y-m-d H:i:s");
    }

    $trail->populate($info["post"]);
    $trail->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $trail->con->insert_id;
    }
    $trail->save_attach(  $info , array( "profiles" ) );
    

    if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
      basic_redir($info["post"]["done"]);
    } else {
      basic_redir($GLOBALS["trails_url"]);
    }
  }

  public function remove($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (isset($info["idx"])) {
      $trail = new trails_model();

      $trail->set_filter(array(" idx = '" . $info["idx"] . "' "));

      $trail->remove();
    }

    basic_redir($GLOBALS["scheduleds_url"]);
  }
}
