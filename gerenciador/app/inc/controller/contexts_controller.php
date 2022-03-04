<?php
class contexts_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
        $filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
        $contexts = new contexts_model();
        $contexts->set_field( array( $key , $field  ) ) ;
        $contexts->set_filter( $filters ) ;
        $contexts->set_order( array( $filed_name ) );
        $contexts->load_data();
        $out = array_column( $contexts->data , $filed_name , $key );
		return $out ;
	}
  private function filter( $info ){
    $done = array();
    $filter = array( " active = 'yes' "  );
    if( isset( $info["get"]["filter_name"] ) && !empty( $info["get"]["filter_name"] ) ){
      $done["filter_name"] = $info["get"]["filter_name"] ;
      $filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' " ;
    }
    return array( $done , $filter ) ;
  }
	public function display( $info ){
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }
		$paginate = isset($info["get"]["paginate"]) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20;
		$ordenation = isset($info["get"]["ordenation"]) ? preg_replace("/-/", " ", $info["get"]["ordenation"]) : 'name asc';
    
    list( $done , $filter ) = $this->filter( $info );

    $sidebar_color = "rgba(255, 235, 0, 0.92)";
    $contexts = new contexts_model();
    if ($info["format"] != ".json") {
      $contexts->set_paginate(array($info["sr"], $paginate));
    } else {
      $contexts->set_paginate(array(0, 900000));
    }
    $contexts->set_filter($filter);
    $contexts->set_order( array( $ordenation ) ) ;

    
    if( $info["format"] == ".html" ){
      $contexts->set_paginate( array( $info["sr"] , $paginate ) ) ;
    }
    else{
      $contexts->set_paginate( array( 0 , 900000 ) ) ;
    }
    $contexts->set_filter( $filter ) ;
    list( $total , $data ) = $contexts->return_data();

    switch( $info["format"] ){
      case ".json":
        header('Content-type: application/json');
        echo json_encode(
          array(
            "total" => array("total" => $total)
            , "row" => $data
          )
        );
      break;
      default:
        $page = 'contexts';
        $form = array(
          "done" => rawurlencode( !empty( $done ) ? set_url( $GLOBALS["contexts_url"] , $done ) : $GLOBALS["contexts_url"] ) 
          , "pattern" => array(
            "new" => $GLOBALS["newcontext_url"]
            , "action" => $GLOBALS["context_url"]
            , "search" => !empty( $info["get"] ) ? set_url( $GLOBALS["contexts_url"], $info["get"] ) : $GLOBALS["contexts_url"] 
          )
        ) ;
        $ordenation_name = 'name-asc';
        $ordenation_name_ordenation = 'fas fa-border-none';
        switch ($ordenation) {
          case 'name asc':
            $ordenation_name = 'name-desc';
            $ordenation_name_ordenation = 'fas fa-angle-up';
            break;
          case 'name desc':
            $ordenation_name = 'name-asc';
            $ordenation_name_ordenation = 'fas fa-angle-down';
            break;
          }


          include(constant("cRootServer") . "ui/common/header.inc.php");
          include(constant("cRootServer") . "ui/common/head.inc.php");
          include( constant("cRootServer") . "ui/page/contexts.php");
          include(constant("cRootServer") . "ui/common/footer.inc.php");
          include( constant("cRootServer") . "ui/common/list_actions.php");
          print('<script>' . "\n");
          print('    data_agendas_json = {' . "\n");
          print('        url: "' . $GLOBALS["contexts_url"] . '.json"' . "\n");
          print('        , data: ' . json_encode($done) . "\n");
          print('        , action: "' . set_url($GLOBALS["context_url"], array("done" => rawurlencode($form["done"]))) . '"' . "\n");
          print('        , status_published_list: ' . json_encode( $GLOBALS["status_published_list"] ) . "\n");
          print('        , template: ""' . "\n");
          print('        , page: 1' . "\n");
          print('    }' . "\n");
          include(constant("cRootServer") . "furniture/js/add/contexts.js");
          print('</script>' . "\n");
          include(constant("cRootServer") . "ui/common/foot.inc.php");

      break;
    }
	}
	public function form( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
      $contexts = new contexts_model();
      $contexts->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
      $contexts->load_data();
      $data = current( $contexts->data );
      $form = array(
        "url" => sprintf( $GLOBALS["context_url"] , $info["idx"] )
      ) ;
    }
    else{
      $data = array();
      $form = array(
        "url" => $GLOBALS["newcontext_url"]
      ) ;
    }
    $sidebar_color = "rgba(255, 235, 0, 0.92)";
    $page = 'contexts';
    include( constant("cRootServer") . "ui/common/header.inc.php");
    include( constant("cRootServer") . "ui/common/head.inc.php");
    include( constant("cRootServer") . "ui/page/context.php");
    include( constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[name=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . ( isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["contexts_url"] ) . '" ');
    print('})'."\n");
    print("</script>");
    include( constant("cRootServer") . "ui/common/foot.inc.php");
  }
  public function save( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $contexts = new contexts_model();
    if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
        $contexts->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
    }
    else{
        $info["post"]["slug"] = generate_slug( $info["post"]["name"] );
    }

    $contexts->populate( $info["post"] );
    $contexts->save();
    if( !isset( $info["idx"] ) || (int)$info["idx"] == 0 ){
      $info["idx"] = $contexts->con->insert_id;
    }  
    if( isset( $info["post"]["done"] ) && !empty( $info["post"]["done"] ) ){
      basic_redir( $info["post"]["done"] ) ;
    }
    else{
      basic_redir( $GLOBALS["contexts_url"] ) ;
    }
  }
}
