<?php
class biblioteca_conteudos_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "name")
  {
    $libraries = new biblioteca_conteudos_model();
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
      $context = new biblioteca_conteudos_model();
      $context->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $context->load_data();
      $context->attach(array("libarysections"), true);
      $context->attach(array("libaryfiles"));

      $data = current($context->data);

      $form = array(
        "url" => sprintf($GLOBALS["libraries_url"], $info["idx"]),
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newsublibrary_url"]
      );
    }

    $page = 'Conteudo';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/bilbioteca_conteudo.php");
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

    $context = new biblioteca_conteudos_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $context->set_filter(array(" idx = '" . $info["idx"] . "' "));
    }

    if (!isset($info["post"]["is_destak"])) {
      $info["post"]["is_destak"] = "no";
    }

    $context->populate($info["post"]);
    $context->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $context->con->insert_id;
    }

    $context->save_attach($info, array("libarysections"), true);

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
      $context = new biblioteca_conteudos_model();

      $context->set_filter(array(" idx = '" . $info["idx"] . "' "));

      $context->remove();
    }

    basic_redir($GLOBALS["libraries_url"]);
  }

  public function formnew($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $secao_id = isset($info["idx"]) && (int)$info["idx"] > 0 ? $info["idx"] : 0;

    $secao = new biblioteca_secoes_model();
    $secao->set_filter(array(" idx = '" . $secao_id . "' "));
    $secao->load_data();

    $data = array("libarysections_attach" => $secao->data );

    $form = array(
      "url" => $GLOBALS["newsublibrarycontextsave_url"]
    );

    $info["get"]["done"] =  set_url($GLOBALS["sublibrarycontexts_url"], $info["get"]);

    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/bilbioteca_conteudo.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }
}
