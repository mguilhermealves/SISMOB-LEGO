<?php
class biblioteca_secoes_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "name")
  {
    $libraries = new biblioteca_secoes_model();
    $libraries->set_field(array($key, $field));
    $libraries->set_filter($filters);
    $libraries->load_data();
    $out = array();
    foreach ($libraries->data as $value) {
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
      $filter["filter_title"] = " trail_title like '%" . $info["get"]["filter_title"] . "%' ";
    }

    // if (isset($info["get"]["filter_isFixed"]) && !empty($info["get"]["filter_isFixed"])) {
    //   $done["filter_isFixed"] = $info["get"]["filter_isFixed"];
    //   $filter["filter_isFixed"] = " isFixed like '%" . $info["get"]["filter_isFixed"] . "%' ";
    // }

    // if (isset($info["get"]["filter_isPrivate"]) && !empty($info["get"]["filter_isPrivate"])) {
    //   $done["filter_isPrivate"] = $info["get"]["filter_isPrivate"];
    //   $filter["filter_isPrivate"] = " isPrivate like '%" . $info["get"]["filter_isPrivate"] . "%' ";
    // }

    return array($done, $filter);
  }

  public function form($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (isset($info["idx"])) {
      $sublibrary = new biblioteca_secoes_model();
      $sublibrary->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $sublibrary->load_data();
      $sublibrary->attach(array("libarycontexts"), false);

      $data = current( $sublibrary->data );

      $form = array(
        "url" => sprintf( $GLOBALS["new_sublibrary_url"] , $info["idx"] ),
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newsublibrary_url"]
      );
    }

    $page = 'Sub Categoria';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/biblioteca_secao.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[name=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["libraries_url"]) . '" ');
    print('})' . "\n");
    include(constant("cRootServer") . "furniture/js/pages/library.js");
    print('</script>' . "\n");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }

  public function save($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $sublibrary = new biblioteca_secoes_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $sublibrary->set_filter(array(" idx = '" . $info["idx"] . "' "));
    }

    $sublibrary->populate($info["post"]);
    $sublibrary->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $sublibrary->con->insert_id;
    }

    if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
      basic_redir($info["post"]["done"]);
    } else {
      basic_redir($GLOBALS["libraries_url"]);
    }
  }

  public function remove($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (isset($info["idx"])) {
      $library = new biblioteca_secoes_model();

      $library->set_filter(array(" idx = '" . $info["idx"] . "' "));

      $library->remove();
    }

    basic_redir($GLOBALS["libraries_url"]);
  }
}
