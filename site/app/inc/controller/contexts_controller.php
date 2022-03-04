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
	public function display( $info ){
    if (!site_controller::check_login()) {
      basic_redir($GLOBALS["home_url"]);
    }

    $contexts = new contexts_model();
    $contexts->set_filter( array( " active = 'yes' " , " slug = '" . $info["slug"] . "' " ) );
    $contexts->load_data();

    if (!isset( $contexts->data[0] ) ) {
      basic_redir($GLOBALS["home_url"]);
    }
    
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		include( constant("cRootServer") . "ui/page/context.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");
	}

	public function orientacoes_uso( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		if( ! site_controller::check_aceite() ){
			basic_redir( $GLOBALS["regulamento_url"] ) ;
		}

		$page = 'categorias';
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
				
		/* 	$homepage = new homepage_model();
		$homepage->set_filter( array( " idx = '1' " ) ) ;
		$homepage->load_data();
		 */
		
		include( constant("cRootServer") . "ui/page/orientacoes_uso.php");		
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");

	}
}
