<?php
class noticias_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "title" ){
		$noticias = new noticias_model();
		$noticias->set_field( array( $key , $field  ) ) ;
		$noticias->set_filter( $filters ) ;
        $noticias->load_data();
        $out = array();
		foreach( $noticias->data as $value ){
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
    $noticias = new noticias_model();
    $noticias->set_field( array( "idx", " title "  ) ) ;
    if( $info["format"] != ".json" ){
      $noticias->set_paginate( array( $info["sr"] , $paginate ) ) ;
    }
    else{
      $noticias->set_paginate( array( 0 , 900000 ) ) ;
    }
    
    $noticias->set_filter( $filter ) ;

    $noticias->load_data();
    $data = $noticias->data;
    $total = $noticias->con->result( $noticias->con->select(" ifnull( count( idx ) , 0 ) as s " , " noticias " , " where " . implode(" and " , $filter ) ) , "s" , 0 ) ;		    
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
        $page = 'Notícias';
        $form = array(
          "done" => rawurlencode( !empty( $done ) ? set_url( $GLOBALS["news_url"] , $done ) : $GLOBALS["news_url"] ) 
          , "pattern" => array(
            "new" => $GLOBALS["newnew_url"]
            , "action" => $GLOBALS["new_url"]
            , "search" => !empty( $info["get"] ) ? set_url( $GLOBALS["news_url"], $info["get"] ) : $GLOBALS["news_url"] 
          )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/noticias.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        print('<script>'."\n");
        print('    data_noticias_json = {'."\n");
        print('        url: "' . $GLOBALS["news_url"] . '.json"'."\n");
        print('        , action: "' . $GLOBALS["new_url"] . '"'."\n");
        print('        , data: ' . json_encode( $done ) . "\n");
        print('        , template: ""'."\n");
        print('        , page: 1'."\n");
        print('    }'."\n");
        include( constant("cRootServer") . "furniture/js/add/noticias.js");
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
      $noticias = new noticias_model();
      $noticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
      $noticias->load_data();
      $noticias->attach(array("categorianoticias"));
                  
      $data = current( $noticias->data );
               
      $form = array(
        "url" => sprintf( $GLOBALS["new_url"] , $info["idx"] )
      ) ;
    }
    else{
      $data = array();
      $form = array(
        "url" => $GLOBALS["newnew_url"]
      ) ;
    }
    
    $categorianoticias_lists =  categorianoticias_controller::data4select("idx", array(" active = 'yes' "), "title");

    $page = 'Notícias';
    include( constant("cRootServer") . "ui/common/header.inc.php");
    include( constant("cRootServer") . "ui/common/head.inc.php");
    include( constant("cRootServer") . "ui/page/noticia.php");
    include( constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[title=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . ( isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["news_url"] ) . '" ');
    print('})'."\n");
    print('</script>'."\n");
    include( constant("cRootServer") . "ui/common/foot.inc.php");
  }
  public function save( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $noticias = new noticias_model();
    if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
        $noticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
    }
    else{
        $info["post"]["slug"] = generate_slug( $info["post"]["title"] );
    }
    if( isset( $_FILES[ "image" ] ) && is_file( $_FILES[ "image" ]["tmp_name"] ) ){
        $d = preg_split("/\./", $_FILES[ "image" ]["name"] ) ;
        $extension = $d[ count( $d ) - 1 ];
        $name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "image" ]["name"]  ) )  ;
        $extension = date("YmdHis") . "." . $extension;
        $file = "furniture/upload/images/" . $name . $extension ;
        
        if( file_exists( constant("cRootServer") . $file ) ){
            unlink( constant("cRootServer") . $file );
        }
        move_uploaded_file( $_FILES[ "image" ]["tmp_name"] , constant("cRootServer") . $file );
        $info["post"]["image"] = $file ;
              
    }
    
    $noticias->populate( $info["post"] );
    $noticias->save();
    if( !isset( $info["idx"] ) || (int)$info["idx"] == 0 ){
      $info["idx"] = $noticias->con->insert_id;
    }

    $noticias->save_attach($info, array("categorianoticias"));

    if( isset( $info["post"]["done"] ) && !empty( $info["post"]["done"] ) ){
      basic_redir( $info["post"]["done"] ) ;
    }
    else{
      basic_redir( $GLOBALS["news_url"] ) ;
    }
  }
  public function remove( $info ){
    
    if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
        $noticias = new noticias_model();
        $noticias->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        $noticias->remove();			
    }	
    
    basic_redir( $GLOBALS["news_url"] ) ;
}
}