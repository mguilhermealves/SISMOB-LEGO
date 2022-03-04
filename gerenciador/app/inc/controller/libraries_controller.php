<?php
class libraries_controller
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
    $filter = array( "active = 'yes'");

    if( !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) && !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
      //$done["filter_profiles"] = $info["get"]["filter_profiles"];
      $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
      $filter["filter_profiles"] = " idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id in ( '" . implode("','",$profiles_id) . "') ) ";
    }
    if (isset($info["get"]["filter_id"]) && !empty($info["get"]["filter_id"])) {
      $done["filter_id"] = $info["get"]["filter_id"];
      $filter["filter_id"] = " idx like '%" . $info["get"]["filter_id"] . "%' ";
    }
    if (isset($info["get"]["filter_name"]) && !empty($info["get"]["filter_name"])) {
      $done["filter_name"] = $info["get"]["filter_name"];
      $filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' ";
    }
    if (isset($info["get"]["filter_status"]) && !empty($info["get"]["filter_status"])) {
      $done["filter_status"] = $info["get"]["filter_status"];
      $filter["filter_status"] = " status = '" . $info["get"]["filter_status"] . "' ";
    }
    if (isset($info["get"]["filter_parent"]) && !empty($info["get"]["filter_parent"])) {
      $done["filter_parent"] = $info["get"]["filter_parent"];
      $filter["filter_parent"] = " parent = '" . $info["get"]["filter_parent"] . "' ";
    }

    if (isset($info["get"]["filter_profiles"]) && !empty($info["get"]["filter_profiles"])) {
      $done["filter_profiles"] = $info["get"]["filter_profiles"];
      $filter["filter_profiles"] = " idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id = '" . $info["get"]["filter_profiles"] . "' ) ";
    }

    
    return array($done, $filter);
  }

  public function display($info){

    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 2000 ? $info["get"]["paginate"] : 2000;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'display_position asc';

    list($done, $filter) = $this->filter($info);

    $libraries = new biblioteca_secoes_model();

    if ($info["format"] != ".json") {
      $libraries->set_paginate(array($info["sr"], $paginate));
    } else {
      $libraries->set_paginate(array(0, 900000));
    }
    $libraries->set_order(array($ordenation));

    $libraries->set_filter($filter);
    list( $total , $data ) = $libraries->return_data();

    $libraries->join( "category", "libarysections", array( "idx" => "parent" ) );

    $data = $libraries->data;

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
        if( isset( $info["get"]["filter_parent"] ) ){
          $_SESSION["action_js"] = array( '$("#subcategoria-tab").click();' );
        }
        

        $sidebar_color = "rgba(23, 194, 201, 0.92)";
        $page = 'Bibliotecas';

        $ordenation_name = 'name-asc';
        $ordenation_name_ordenation = 'fas fa-border-none';
        $ordenation_createdat = 'created_at-asc';
        $ordenation_createdat_ordenation = 'fas fa-border-none';
        $ordenation_modifiedat = 'modified_at-asc';
        $ordenation_modifiedat_ordenation = 'fas fa-border-none';
        $ordenation_status = 'status-asc';
        $ordenation_status_ordenation = 'fas fa-border-none';
        $ordenation_display_position = 'display_position-asc';
        $ordenation_display_position_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
          case 'name asc':
            $ordenation_name = 'name-desc';
            $ordenation_name_ordenation = 'fas fa-angle-up';
            break;
          case 'name desc':
            $ordenation_name = 'name-asc';
            $ordenation_name_ordenation = 'fas fa-angle-down';
            break;
          case 'created_at asc':
            $ordenation_createdat = 'created_at-desc';
            $ordenation_createdat_ordenation = 'fas fa-angle-up';
            break;
          case 'created_at desc':
            $ordenation_createdat = 'created_at-asc';
            $ordenation_createdat_ordenation = 'fas fa-angle-down';
            break;
          case 'modified_at asc':
            $ordenation_modifiedat = 'modified_at-desc';
            $ordenation_modifiedat_ordenation = 'fas fa-angle-up';
            break;
          case 'modified_at desc':
            $ordenation_modifiedat = 'modified_at-asc';
            $ordenation_modifiedat_ordenation = 'fas fa-angle-down';
            break;
            case 'status asc':
              $ordenation_status = 'status-desc';
              $ordenation_status_ordenation = 'fas fa-angle-up';
              break;
            case 'status desc':
              $ordenation_status = 'status-asc';
              $ordenation_status_ordenation = 'fas fa-angle-down';
              break;
            case 'display_position asc':
              $ordenation_display_position = 'display_position-desc';
              $ordenation_display_position_ordenation = 'fas fa-angle-up';
              break;
            case 'display_position desc':
              $ordenation_display_position = 'display_position-asc';
              $ordenation_display_position_ordenation = 'fas fa-angle-down';
              break;
        }
        $info_get = $info["get"] ;
        unset( $info_get["filter_parent"] );
        $form = array(
          "categorias" => array( 
            "done" => rawurlencode(!empty($done) ? set_url($GLOBALS["libraries_url"], $done) : $GLOBALS["libraries_url"]) , 
            "pattern" => array(
              "new" => $GLOBALS["newlibrary_url"],
              "action" => $GLOBALS["library_url"], 
              "search" => !empty($info["get"]) ? set_url($GLOBALS["libraries_url"], $info_get) : $GLOBALS["libraries_url"]
            )
          ),
          "subcategorias" => array( 
            "done" => rawurlencode(!empty($done) ? set_url($GLOBALS["libraries_url"], $done) : $GLOBALS["libraries_url"]) , 
            "pattern" => array(
              "new" => $GLOBALS["newsublibrary_url"],
              "action" => $GLOBALS["sublibrary_url"], 
              "search" => !empty($info["get"]) ? set_url($GLOBALS["libraries_url"], $info["get"]) : $GLOBALS["libraries_url"]
            )
          )
        );

        include(constant("cRootServer") . "ui/common/header.inc.php");
        include(constant("cRootServer") . "ui/common/head.inc.php");
        include(constant("cRootServer") . "ui/page/bibliotecas.php");
        include(constant("cRootServer") . "ui/common/footer.inc.php");
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
      $library = new biblioteca_secoes_model();
      $library->set_filter(array(" idx = '" . $info["idx"] . "' "));
      $library->load_data();

      $data = $library->data;

      $form = array(
        "url" => sprintf($GLOBALS["library_url"], $info["idx"])
      );
    } else {
      $data = array();
      $form = array(
        "url" => $GLOBALS["newlibrary_url"]
      );
    }
    
    $sidebar_color = "rgba(23, 194, 201, 0.92)";
    $page = 'Biblioteca';
    include(constant("cRootServer") . "ui/common/header.inc.php");
    include(constant("cRootServer") . "ui/common/head.inc.php");
    include(constant("cRootServer") . "ui/page/biblioteca.php");
    include(constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[name=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . (isset($info["get"]["done"]) ? $info["get"]["done"] : $GLOBALS["libraries_url"]) . '" ');
    print('})' . "\n");
    print('</script>' . "\n");
    include(constant("cRootServer") . "ui/common/foot.inc.php");
  }

  public function save($info)
  {
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $library = new biblioteca_secoes_model();

    if (isset($info["idx"]) && (int)$info["idx"] > 0) {
      $library->set_filter(array(" idx = '" . $info["idx"] . "' "));
    }
    else{
      $info["post"]["external_id"] = generate_slug( $info["post"]["name"] ) . generate_key(15) ;
    }
    
		if (isset($_FILES["thumb"]) && is_file($_FILES["thumb"]["tmp_name"])) {
      $d = preg_split("/\./", $_FILES[ "thumb" ]["name"] ) ;
      $extension = $d[ count( $d ) - 1 ];
      $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "thumb" ]["name"]  ) )  ;
      $extension = date("YmdHis") . "." . $extension;
      $file = "furniture/upload/category/" . $name . $extension ;

      if (!file_exists(dirname(constant("cRootServer") . $file))) {
          mkdir(dirname(constant("cRootServer") . $file), true);
          chmod( dirname( constant("cRootServer") . $file )  , 0775 ) ;
      }
      if (file_exists(constant("cRootServer") . $file)) {
          unlink(constant("cRootServer") . $file);
      }
      move_uploaded_file($_FILES["thumb"]["tmp_name"], constant("cRootServer") . $file);
      $info["post"]["ico"] = $file;
    }

    $library->populate($info["post"]);
    $library->save();

    if (!isset($info["idx"]) || (int)$info["idx"] == 0) {
      $info["idx"] = $library->con->insert_id;
    }
    $library->save_attach(  $info , array( "profiles" ) );
    if( isset( $info["post"]["parent"] ) ){
      $_SESSION["action_js"] = array( '$("#subcategoria-tab").click();' );
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

    basic_redir($GLOBALS["scheduleds_url"]);
  }
}
