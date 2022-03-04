<?php
class libraries_controller
{
  public static function data4select($key = "idx", $filters = array(), $field = "name" , $order_by = false )
  {
    $libraries = new biblioteca_secoes_model();
    $libraries->set_field(array($key, $field));
    $libraries->set_filter($filters);
    $libraries->set_order( array( $order_by != false ? $order_by : $field . " asc" ) );
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


	public function biblioteca_material( $info ){
		$page = 'biblioteca';
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		$libarycontexts_model = new libarycontexts_model();
		$libarycontexts_model->set_filter( array( " external_id = '" . $info["slug_material"] . "' ") );
    $libarycontexts_model->load_data();
    $libarycontexts_model->attach( array( "libaryfiles" ) , false , " and status = 'Publicado' " );
    $libarycontexts_model->attach( array( "libarysections" ) , true , " and status = 'Publicado' " );
		
    $data = current( $libarycontexts_model->data  ) ;
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		include( constant("cRootServer") . "ui/page/biblioteca-material.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		include( constant("cRootServer") . "ui/common/footer.php");

		
	}
	public function biblioteca_conteudo( $info ){
		$page = 'biblioteca';
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		$key = (isset( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] ) ? (int) $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] : "xxxxx" ) ;
		
		$d = current( libraries_controller::data4select("parent" , array( " active = 'yes' " , " external_id = '" . $info["slug"]  . "' ") , "parent" ) ) ;
		$filter = array( 
			" active = 'yes' " 
			, " status = 'Publicado' "
			, " idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id = '" . $key . "' ) "  
			, " parent = '" . $d  . "' "
		) ;
		$libraries = new biblioteca_secoes_model();
		$libraries->set_field( array( " idx " , " name " , " external_id " , " parent " , " ico " ) );
		$libraries->set_filter( $filter );
		$libraries->set_order( array( "display_position asc" ) );
		$libraries->load_data();
		$libraries->attach( array( "libarycontexts" ) , false , " and status = 'Publicado' order by is_destak asc, display_position asc " );
		include( constant("cRootServer") . "ui/common/header.php");
		include( constant("cRootServer") . "ui/common/head.php");
		include( constant("cRootServer") . "ui/page/biblioteca-conteudo.php");
		include( constant("cRootServer") . "ui/common/foot.php");
		if(isset($info["slug"]) && $info["slug"] != null){	
			print('<script>'."\n");
			foreach( $libraries->data as $k => $v ){
				print('$("#' . $v["external_id"] . '-tab").bind("click", function(){'."\n");
				print('$("#title_libary").html("' . $v["name"] . '")'."\n");
				print('})'."\n");
			}
			print('</script>'."\n");
		}
		include( constant("cRootServer") . "ui/common/footer.php");

		
	}
	public function biblioteca( $info ){
		$page = 'biblioteca';
		if( ! site_controller::check_login() ){
			basic_redir( $GLOBALS["home_url"] ) ;
		}

		$key = (isset( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] ) ? (int) $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] : "xxxxx" ) ;
		
		$filter = array( 
			" active = 'yes' " 
			, " status = 'Publicado' "
			, " idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id = '" . $key . "' ) "  
		) ;

		if( isset( $info["slug"] ) ){
			$filter[] = " external_id = '" . $info["slug"] . "' " ;
		}
		else{
			$filter[] = " parent = '0' " ;
			$filter[] = " idx in ( select libarysections.parent from libarysections where libarysections.active = 'yes' and libarysections.parent > 0 and libarysections.idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id = '" . $key . "' ) ) "  ;
		}

		$libraries = new biblioteca_secoes_model();
		$libraries->set_field( array( " idx " , " name " , " external_id " , " parent " ) );
		$libraries->set_filter( $filter );
		$libraries->set_order( array( "display_position asc" ) );
		$libraries->load_data();
		$libraries->attach( array( "libarycontexts" ) );
		$libraries->join( "category", "libarysections", array( "parent" => "idx" ), " and idx in ( select libarysections_profiles.libarysections_id from libarysections_profiles where libarysections_profiles.active = 'yes' and libarysections_profiles.profiles_id = '" . $key . "' ) and status = 'Publicado' " );
		
		$librariesCategories = array_column( $libraries->data , "name" , "external_id" );

		switch( $info["format"] ){
			case ".partial":
				if(isset($info["slug"]) && $info["slug"] != null){		
					$librariesCategories = libraries_controller::data4select("external_id" , array( " active = 'yes' " , " parent = '" . $libraries->data[0]["parent"]  . "' ") , "ico" , "display_position asc" ) ;
					include( constant("cRootServer") . "ui/page/biblioteca-conteudo.php");
				}
				else{
					include( constant("cRootServer") . "ui/page/biblioteca.php");
				}
			break;
			default:
				include( constant("cRootServer") . "ui/common/header.php");
				include( constant("cRootServer") . "ui/common/head.php");
				if(isset($info["slug"]) && $info["slug"] != null){		
					$librariesCategories = libraries_controller::data4select("external_id" , array( " active = 'yes' " , " parent = '" . $libraries->data[0]["parent"]  . "' ") , "ico" , "display_position asc" );	
					include( constant("cRootServer") . "ui/page/biblioteca-conteudo.php");
				}
				else{
					include( constant("cRootServer") . "ui/page/biblioteca.php");
				}
				include( constant("cRootServer") . "ui/common/foot.php");
				if(isset($info["slug"]) && $info["slug"] != null){	
					print('<script>'."\n");
					foreach( libraries_controller::data4select("external_id" , array( " active = 'yes' " , " parent = '" . $libraries->data[0]["parent"]  . "' ") , "name" , "display_position asc" ) as $k => $v ){
						print('$("#' . $k . '-tab").bind("click", function(){'."\n");
						print('$("#title_libary").html("' . $v . '")'."\n");
						print('})'."\n");
					}
					print('</script>'."\n");
				}
				include( constant("cRootServer") . "ui/common/footer.php");
			break;
		}

		
	}
}
?>