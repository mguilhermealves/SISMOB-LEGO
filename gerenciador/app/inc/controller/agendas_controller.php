<?php
class agendas_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "title" ){
		$agendas = new agendas_model();
		$agendas->set_field( array( $key , $field  ) ) ;
		$agendas->set_filter( $filters ) ;
        $agendas->load_data();
        $out = array();
		foreach( $agendas->data as $value ){
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
    $agendas = new agendas_model();
    $agendas->set_field( array( "idx", " title "  ) ) ;
    if( $info["format"] != ".json" ){
      $agendas->set_paginate( array( $info["sr"] , $paginate ) ) ;
    }
    else{
      $agendas->set_paginate( array( 0 , 900000 ) ) ;
    }
    
    $agendas->set_filter( $filter ) ;

    $agendas->load_data();
    $data = $agendas->data;
    $total = $agendas->con->result( $agendas->con->select(" ifnull( count( idx ) , 0 ) as s " , " agendas " , " where " . implode(" and " , $filter ) ) , "s" , 0 ) ;		    
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
        $page = 'Agendas';
        $form = array(
          "done" => rawurlencode( !empty( $done ) ? set_url( $GLOBALS["scheduleds_url"] , $done ) : $GLOBALS["scheduleds_url"] ) 
          , "pattern" => array(
            "new" => $GLOBALS["newscheduled_url"]
            , "action" => $GLOBALS["scheduled_url"]
            , "search" => !empty( $info["get"] ) ? set_url( $GLOBALS["scheduleds_url"], $info["get"] ) : $GLOBALS["scheduleds_url"] 
          )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/agendas.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        print('<script>'."\n");
        print('    data_agendas_json = {'."\n");
        print('        url: "' . $GLOBALS["scheduleds_url"] . '.json"'."\n");
        print('        , data: ' . json_encode( $done ) . "\n");
        print('        , action: "' . set_url( $GLOBALS["scheduled_url"] , array( "done" => rawurlencode( $form["done"] ) ) ) . '"'."\n");
        print('        , template: ""'."\n");
        print('        , page: 1'."\n");
        print('    }'."\n");
        include( constant("cRootServer") . "furniture/js/add/agendas.js");
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
      $agendas = new agendas_model();
      $agendas->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
      $agendas->load_data();
     
                  
      $data = current( $agendas->data );
               
      $form = array(
        "url" => sprintf( $GLOBALS["scheduled_url"] , $info["idx"] )
      ) ;
    }
    else{
      $data = array();
      $form = array(
        "url" => $GLOBALS["newscheduled_url"]
      ) ;
    }
    
   

    $page = 'Agendas';
    include( constant("cRootServer") . "ui/common/header.inc.php");
    include( constant("cRootServer") . "ui/common/head.inc.php");
    include( constant("cRootServer") . "ui/page/agenda.php");
    include( constant("cRootServer") . "ui/common/footer.inc.php");
    print("<script>");
    print('$("button[title=\'btn_back\']").bind("click", function(){');
    print(' document.location = "' . ( isset( $info["get"]["done"] ) ? $info["get"]["done"] : $GLOBALS["scheduleds_url"] ) . '" ');
    print('})'."\n");
    print('</script>'."\n");
    include( constant("cRootServer") . "ui/common/foot.inc.php");
  }
  public function save( $info ){
    if( ! site_controller::check_login() ){
      basic_redir( $GLOBALS["home_url"] ) ;
    }
    $agendas = new agendas_model();
    if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
        $agendas->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
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
    
    $agendas->populate( $info["post"] );
    $agendas->save();
    if( !isset( $info["idx"] ) || (int)$info["idx"] == 0 ){
      $info["idx"] = $agendas->con->insert_id;
    }

    $agendas->save_attach($info, array("categoriaagendas"));

    if( isset( $info["post"]["done"] ) && !empty( $info["post"]["done"] ) ){
      basic_redir( $info["post"]["done"] ) ;
    }
    else{
      basic_redir( $GLOBALS["scheduleds_url"] ) ;
    }
  }
  public function remove( $info ){
    
    if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
    }
    if( isset( $info["idx"] ) ){
        $agendas = new agendas_model();
        $agendas->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        $agendas->remove();			
    }	
    
    basic_redir( $GLOBALS["scheduleds_url"] ) ;
}
}