<?php
class noticias_controller{


	public static function data4select( $key = "idx" , $filters = array() , $field = "title" ){
		$noticias = new forum_model();
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

  public function noticias( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
    if( ! site_controller::check_aceite() ){
      basic_redir( $GLOBALS["regulamento_url"] ) ;
    }
		$page = 'noticias';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		
		$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();

		$noticias = new forum_model();
		$noticias->load_data();
    $noticias->attach(array("categorianoticias"));

		include( constant("cRootServer") . "ui/page/noticias.php");		
		include( constant("cRootServer") . "ui/common/foot.php");      
		include( constant("cRootServer") . "ui/common/footer.php");
	}

  public function noticia( $info ){
    
      if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
      }
      if( ! site_controller::check_aceite() ){
				basic_redir( $GLOBALS["regulamento_url"] ) ;
			}
      $page = 'noticia';
      include( constant("cRootServer") . "ui/common/header.php");
      include( constant("cRootServer") . "ui/common/head.php");

      if( isset( $info["slug"] ) ){
        $noticia = new forum_model();
        $noticia->set_filter( array( " slug = '" . $info["slug"] . "' " ) ) ;
        $noticia->load_data();
        $noticia->attach(array("categorianoticias"));
      }

      include( constant("cRootServer") . "ui/page/noticia.php");		
		  include( constant("cRootServer") . "ui/common/foot.php");      
		  include( constant("cRootServer") . "ui/common/footer.php");

  }

}