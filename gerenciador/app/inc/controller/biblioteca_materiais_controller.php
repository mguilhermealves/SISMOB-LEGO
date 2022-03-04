<?php
class biblioteca_materiais_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "name")
  {
    $libraries = new biblioteca_materiais_model();
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
      $files = new biblioteca_materiais_model();
      $files->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $files->load_data();
      $files->attach(array("libarycontexts"), true);

      $data = current($files->data);

      $form = array(
        "url" => sprintf($GLOBALS["libraries_url"], $info["idx"]),
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newlibraryfile_url"]
      );
    }

    $page = 'Material';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/biblioteca_material.php");
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

    $material = new biblioteca_materiais_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $material->set_filter(array(" idx = '" . $info["idx"] . "' "));
    }

    $material->populate($info["post"]);
    $material->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $material->con->insert_id;
    }

    $material->save_attach($info, array("libarycontexts"), true);

    if (isset($info["post"]["done"]) && !empty($info["post"]["done"])) {
      basic_redir($info["post"]["done"]);
    } else {
      basic_redir(sprintf($GLOBALS["libraries_url"], $info["post"]["subcategory_id"]));
    }
  }

  public function remove($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    if (isset($info["idx"])) {
      $files = new biblioteca_materiais_model();

      $files->set_filter(array(" idx = '" . $info["idx"] . "' "));

      $files->remove();
    }

    basic_redir($GLOBALS["libraries_url"]);
  }

  public function formnew($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $material_id = isset($info["idx"]) && (int)$info["idx"] > 0 ? $info["idx"] : 0;

    $material = new biblioteca_conteudos_model();
    $material->set_filter(array(" idx = '" . $material_id . "' "));
    $material->load_data();

    $data = array("libarycontexts_attach" => $material->data );

    $form = array(
      "url" => $GLOBALS["newlibraryfilesave_url"]
    );

    $info["get"]["done"] =  set_url($GLOBALS["libraryfiles_url"], $info["get"]);

    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/biblioteca_material.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }
}
