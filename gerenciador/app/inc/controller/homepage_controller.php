<?php
class homepage_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$homepage = new homepage_model();
		$homepage->set_field( array( $key , $field  ) ) ;
		$homepage->set_filter( $filters ) ;
		$homepage->load_data();
		$out = array();
		foreach( $homepage->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
	public function form( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		
		if( isset( $info["idx"] ) ){
			$homepage = new homepage_model();
			$homepage->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$homepage->load_data();
			$data = current( $homepage->data );
			$data["perguntas_frequentes"] = unserialize($data["perguntas_frequentes"]);
			$form = array(
				"url" => $GLOBALS["management_home_url"] 
			) ;
		}
		
		$page = 'Home Page';
		
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/homepage.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		
		

		print("<script>" . "\n");
		include(constant("cRootServer") . "furniture/js/add/quiz.js");
		if (isset($data["perguntas_frequentes"]["data"])) {
		  $i = 1;
		  foreach ($data["perguntas_frequentes"]["data"] as $k => $v) {
			print("quiz.add_question({\n");
			print("    id_key : '" . $k . "'\n");
			print("    , num: '" . $i . "'\n");
			print("    , pergunta: '" . $v["pergunta"] . "'\n");
			print("    , resposta: '" . $v["resposta"] . "'\n");
			print("    , target: $(\"#accordionFlushExample\")\n");
			print("});\n");
			$i++;
		  }
		}
		print('</script>' . "\n");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
  	public function save( $info ){
		
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		$homepage = new homepage_model();
		if( isset( $info["idx"] ) ){
			$homepage->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
		}
		
		if( isset( $_FILES[ "banner_baixo" ] ) && is_file( $_FILES[ "banner_baixo" ]["tmp_name"] ) ){
			$d = preg_split("/\./", $_FILES[ "banner_baixo" ]["name"] ) ;
			$extension = $d[ count( $d ) - 1 ];
			$name = generate_slug( preg_replace("/\." . $extension . "$/","", $_FILES[ "banner_baixo" ]["name"]  ) )  ;
			$extension = date("YmdHis") . "." . $extension;
			$file = "furniture/upload/images/" . $name . $extension ;
			
			if( file_exists( constant("cRootServer") . $file ) ){
				unlink( constant("cRootServer") . $file );
			}
			move_uploaded_file( $_FILES[ "banner_baixo" ]["tmp_name"] , constant("cRootServer") . $file );
			$info["post"]["banner_baixo"] = $file ;
		  	
		
		}
		
		$info["post"]["perguntas_frequentes"] = serialize($info["post"]["perguntas_frequentes"]);
				
		$homepage->populate( $info["post"] );
		$homepage->save();
		basic_redir( $GLOBALS["management_home_url"] ) ;
	}
	public function remove( $info ){
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}
		if( isset( $info["idx"] ) ){
			$homepage = new homepage_model();
			$homepage->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
			$homepage->remove();			
		}	
		
		basic_redir( $GLOBALS["management_home_url"] ) ;
	}
}
