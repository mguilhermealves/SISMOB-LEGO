<?php
class categorianoticias_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "title" ){
		$categorianoticias = new categorianoticias_model();
		$categorianoticias->set_field( array( $key , $field  ) ) ;
		$categorianoticias->set_filter( $filters ) ;
        $categorianoticias->load_data();
        $out = array();
		foreach( $categorianoticias->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
  private function filter( $info ){
    $done = array();
    $filter = array( " idx > 0 ",  "active = 'yes'" );
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
    $categorianoticias = new categorianoticias_model();
    $categorianoticias->set_field( array( "idx", " title "  ) ) ;
    if( $info["format"] != ".json" ){
      $categorianoticias->set_paginate( array( $info["sr"] , $paginate ) ) ;
    }
    else{
      $categorianoticias->set_paginate( array( 0 , 900000 ) ) ;
    }
    
    $categorianoticias->set_filter( $filter ) ;

    $categorianoticias->load_data();
    $data = $categorianoticias->data;
    $total = $categorianoticias->con->result( $categorianoticias->con->select(" ifnull( count( idx ) , 0 ) as s " , " categorianoticias " , " where " . implode(" and " , $filter ) ) , "s" , 0 ) ;		    
    switch( $info["format"] ){
      case ".json":
        header('Content-type: application/json');
        echo json_encode( 
            array( 
                "total" => array( "total" => $total )
                , "row" => $data 
            ) 
        );
      break;
      default:
        $page = 'Categorias';
        $form = array(
          "done" => rawurlencode( !empty( $done ) ? set_url( $GLOBALS["categorynews_url"] , $done ) : $GLOBALS["categorynews_url"] ) 
          , "pattern" => array(
            "new" => $GLOBALS["new_categorynews_url"]
            , "action" => $GLOBALS["categorynew_url"]
            , "search" => !empty( $info["get"] ) ? set_url( $GLOBALS["categorynews_url"], $info["get"] ) : $GLOBALS["categorynews_url"] 
          )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/categorianoticias.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        print('<script>'."\n");
        print('    data_categorianoticias_json = {'."\n");
        print('        url: "' . $GLOBALS["categorynews_url"] . '.json"'."\n");
        print('        , action: "' . $GLOBALS["categorynew_url"] . '"'."\n");
        print('        , data: ' . json_encode( $done ) . "\n");
        print('        , template: ""'."\n");
        print('        , page: 1'."\n");
        print('    }'."\n");
        include( constant("cRootServer") . "furniture/js/add/categorianoticias.js");
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
      $categorianoticias = new categorianoticias_model();
      $categorianoticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
      $categorianoticias->load_data();
      $data = current( $categorianoticias->data );
      $form = array(
        "url" => sprintf( $GLOBALS["categorynew_url"] , $info["idx"] )
      ) ;
    }
    else{
      $data = array();
      $form = array(
        "url" => $GLOBALS["new_categorynews_url"]
      ) ;
    }
       
    $page = 'Categorias';
    include( constant("cRootServer") . "ui/common/header.inc.php");
    include( constant("cRootServer") . "ui/common/head.inc.php");
    include( constant("cRootServer") . "ui/page/categorianoticia.php");
    include( constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[title=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . ( isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["categorynews_url"] ) . '" ');
    print('})'."\n");
    print('</script>'."\n");
    include( constant("cRootServer") . "ui/common/foot.inc.php");
  }
  public function save( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $categorianoticias = new categorianoticias_model();
    if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
        $categorianoticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
    }
    else{
        $info["post"]["slug"] = generate_slug( $info["post"]["title"] );
    }
    if( isset( $_FILES[ "image_file" ] ) && is_file( $_FILES[ "image_file" ]["tmp_title"] ) ){
      $d = preg_split("/\./", $_FILES[ "image_file" ]["title"] ) ;
      $extension = $d[ count( $d ) - 1 ];
      $title = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "image_file" ]["title"]  ) )  ;
      $extension = date("YmdHis") . "." . $extension;
      $file = "furniture/upload/noticias/" . $title . $extension ;
      if( file_exists( constant("cRootServer") . $file ) ){
          unlink( constant("cRootServer") . $file );
      }
      move_uploaded_file( $_FILES[ "image_file" ]["tmp_title"] , constant("cRootServer") . $file );
      $info["post"]["image"] = $file ;
    }
    $categorianoticias->populate( $info["post"] );
    $categorianoticias->save();
    if( !isset( $info["idx"] ) || (int)$info["idx"] == 0 ){
      $info["idx"] = $categorianoticias->con->insert_id;
    }
    if( isset( $info["post"]["done"] ) && !empty( $info["post"]["done"] ) ){
      basic_redir( $info["post"]["done"] ) ;
    }
    else{
      basic_redir( $GLOBALS["categorynews_url"] ) ;
    }
  }
  public function remove( $info ){
    
    if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
        $categorianoticias = new categorianoticias_model();
        $categorianoticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        $categorianoticias->remove();			
    }	
    
    //basic_redir( $GLOBALS["categorynews_url"] ) ;
}
}
