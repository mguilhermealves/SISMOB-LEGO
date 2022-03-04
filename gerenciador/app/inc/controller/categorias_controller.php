<?php
class categorias_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "title" ){
		$categorias = new categorias_model();
		$categorias->set_field( array( $key , $field  ) ) ;
		$categorias->set_filter( $filters ) ;
        $categorias->load_data();
        $out = array();
		foreach( $categorias->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
  private function filter( $info ){
    $done = array();
    $filter = array( " idx > 0 ",  " active = 'yes' " );
    if( isset( $info["get"]["filter_title"] ) && !empty( $info["get"]["filter_title"] ) ){
      $done["filter_title"] = $info["get"]["filter_title"] ;
      $filter["filter_title"] = " title like '%" . $info["get"]["filter_title"] . "%' " ;
    }
    return array( $done , $filter ) ;
  }
	public function display( $info ){
   
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $paginate = 10 ;
    list( $done , $filter ) = $this->filter( $info );
    $categorias = new categorias_model();
    $categorias->set_field( array( "idx", " title "  ) ) ;
    if( $info["format"] != ".json" ){
      $categorias->set_paginate( array( $info["sr"] , $paginate ) ) ;
    }
    else{
      $categorias->set_paginate( array( 0 , 900000 ) ) ;
    }
    
    $categorias->set_filter( $filter ) ;

    $categorias->load_data();
    $data = $categorias->data;
    $total = $categorias->con->result( $categorias->con->select(" ifnull( count( idx ) , 0 ) as s " , " categorias " , " where " . implode(" and " , $filter ) ) , "s" , 0 ) ;		    
    switch( $info["format"] ){
      case ".json":
        header('Content-type: application/json');
        echo json_encode( 
            array( 
                "total" => array( "total" => $total )
                , "row" => $data 
            ) 
        );
        exit();
      break;
      default:
        $page = 'Faixas';
        $form = array(
          "done" => rawurlencode( !empty( $done ) ? set_url( $GLOBALS["ranges_url"] , $done ) : $GLOBALS["ranges_url"] ) 
          , "pattern" => array(
            "new" => $GLOBALS["newrange_url"]
            , "action" => $GLOBALS["range_url"]
            , "search" => !empty( $info["get"] ) ? set_url( $GLOBALS["ranges_url"], $info["get"] ) : $GLOBALS["ranges_url"] 
          )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/categorias.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        print('<script>'."\n");
        print('    data_categorias_json = {'."\n");
        print('        url: "' . $GLOBALS["ranges_url"] . '.json"'."\n");
        print('        , action: "' . $GLOBALS["range_url"] . '"'."\n");
        print('        , data: ' . json_encode( $done ) . "\n");
        print('        , template: ""'."\n");
        print('        , page: 1'."\n");
        print('    }'."\n");
        include( constant("cRootServer") . "furniture/js/add/categorias.js");
        print('</script>'."\n");
        include( constant("cRootServer") . "ui/common/foot.inc.php");
      break;
    }
	}
	public function form( $info ){    
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
      $categorias = new categorias_model();
      $categorias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
      $categorias->load_data();
      $data = current( $categorias->data );
      $form = array(
        "url" => sprintf( $GLOBALS["range_url"] , $info["idx"] )
      ) ;
    }
    else{
      $data = array();
      $form = array(
        "url" => $GLOBALS["newrange_url"]
      ) ;
    }
       
    $page = 'Faixas';
    include( constant("cRootServer") . "ui/common/header.inc.php");
    include( constant("cRootServer") . "ui/common/head.inc.php");
    include( constant("cRootServer") . "ui/page/categoria.php");
    include( constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[title=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . ( isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["ranges_url"] ) . '" ');
    print('})'."\n");
    print('</script>'."\n");
    include( constant("cRootServer") . "ui/common/foot.inc.php");
  }
  public function save( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $categorias = new categorias_model();
    if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
        $categorias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
    }
    else{
        $info["post"]["slug"] = generate_slug( $info["post"]["title"] );
    }
    if( isset( $_FILES[ "icone" ] ) && is_file( $_FILES[ "icone" ]["tmp_name"] ) ){
      $d = preg_split("/\./", $_FILES[ "icone" ]["name"] ) ;
      $extension = $d[ count( $d ) - 1 ];
      $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "icone" ]["name"]  ) )  ;
      $extension = date("YmdHis") . "." . $extension;
      $file = "furniture/upload/images/" . $name . $extension ;
      
      if( file_exists( constant("cRootServer") . $file ) ){
          unlink( constant("cRootServer") . $file );
      }
      move_uploaded_file( $_FILES[ "icone" ]["tmp_name"] , constant("cRootServer") . $file );
      $info["post"]["icone"] = $file ;
            
    }
    $categorias->populate( $info["post"] );
    $categorias->save();
    if( !isset( $info["idx"] ) || (int)$info["idx"] == 0 ){
      $info["idx"] = $categorias->con->insert_id;
    }
  
    if( isset( $info["post"]["done"] ) && !empty( $info["post"]["done"] ) ){
      basic_redir( $info["post"]["done"] ) ;
    }
    else{
      basic_redir( $GLOBALS["ranges_url"] ) ;
    }
  }
  public function remove( $info ){
    
    if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
        $categorias = new categorias_model();
        $categorias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        $categorias->remove();		
        print_pre($categorias);	
    }	
    
    //basic_redir( $GLOBALS["categorianoticias_url"] ) ;
}
}
