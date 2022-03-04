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
    if (isset($info["get"]["filter_title"]) && !empty($info["get"]["filter_title"])) {
      $done["filter_title"] = $info["get"]["filter_title"];
      $filter["filter_title"] = " title like '%" . $info["get"]["filter_title"] . "%' ";
    }
    return array($done, $filter);
  }

  public function display($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (!site_controller::check_aceite()) {
      basic_redir($GLOBALS["regulamento_url"]);
    }

    $page = 'Foruns';
    include(constant("cRootServer") . "ui/common/header.php");
    include(constant("cRootServer") . "ui/common/head.php");

    $foruns = new forum_model();
    $foruns->set_filter(array(" ( not idx in ( select forum_sections.forum_id from forum_sections where forum_sections.active = 'yes' ) ) ", " active = 'yes' "));
    $foruns->load_data();
    $foruns->join("users", "users", array("created_by" => "idx"));
    $forums = $foruns->data;

    $total_foruns = $foruns->con->result($foruns->con->select(" ifnull( count( idx ) , 0 ) as s ", " forum ", " where active = 'yes' and not idx in ( select forum_sections.forum_id from forum_sections where forum_sections.active = 'yes' )"), "s", 0);

    include(constant("cRootServer") . "ui/page/foruns.php");
    include(constant("cRootServer") . "ui/common/foot.php");
    include(constant("cRootServer") . "ui/common/footer.php");
  }

  public function form($info)
  {

    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }
    if (!site_controller::check_aceite()) {
      basic_redir($GLOBALS["regulamento_url"]);
    }

    $page = 'Topico';
    include(constant("cRootServer") . "ui/common/header.php");
    include(constant("cRootServer") . "ui/common/head.php");

    if (isset($info["slug"])) {
      $forum = new forum_model();
      $forum->set_filter(array(" slug = '" . $info["slug"] . "' "));
      $forum->load_data();
      $forum->attach( array( "forum_response" ) );
      $forum->attach_son("forum_response", array("users"), true, null, array("idx", "name"));
      $forum->attach_son("forum_response", array("likes"));
      $forum->attach( array( "users" ), true );
      $data = current( $forum->data );

      // print_pre($data, true);
    }

    include(constant("cRootServer") . "ui/page/forum.php");
    include(constant("cRootServer") . "ui/common/foot.php");
    print("<script src='".constant("cFurniture")."js/forum.js'></script>");
    include(constant("cRootServer") . "ui/common/footer.php");
  }

  public function save($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $forum_response = new forum_response_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $forum_response->set_filter(array(" idx = '" . $info["idx"] . "' "));
    }

    $info["post"]["users_id"] = $_SESSION[ constant("cAppKey") ]["credential"]["idx"];

    $forum_response->populate($info["post"]);
    $forum_response->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $forum_response->con->insert_id;
    }

    $forum_response->save_attach($info, array("forum", "users"), true);

    if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
      basic_redir($info["post"]["done"]);
    } else {
      basic_redir($GLOBALS["forum_url"]);
    }
  }
}
