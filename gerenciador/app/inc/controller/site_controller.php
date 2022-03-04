<?php
class site_controller{
	public static function logout(){
		unset( $_SESSION[ constant("cAppKey") ] );
		basic_redir( $GLOBALS["home_url"] ) ;
	}
	public static function check_login(){
		return isset( $_SESSION[ constant("cAppKey") ]["credential"] ) && (int)$_SESSION[ constant("cAppKey") ]["credential"]["idx"] > 0 && $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["adm"] == "yes" ;
	}

	public static function error( $info ){
		$title = $info["title"];
		$msg = $info["msg"];
		$done = isset( $info["done"] ) ? $info["done"] :  $GLOBALS["home_url"];
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		include( constant("cRootServer") . "ui/page/error.php");
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function display( $info ){
		include( constant("cRootServer") . "ui/common/header.inc.php");
		include( constant("cRootServer") . "ui/common/head.inc.php");
		if( site_controller::check_login() ){
			$page = 'dashboard';
			include( constant("cRootServer") . "ui/page/dashboard.php");
		}
		else{
			$page = 'dashboard';
			include( constant("cRootServer") . "ui/components/login/login.php");
		}
		include( constant("cRootServer") . "ui/common/footer.inc.php");
		print('<script>'."\n");
		print('    $.ajax({'."\n");
		print('        type: "GET",'."\n");
		print('        url: "' . $GLOBALS["users_url"] . '.json"'."\n");
        print('        , data: ' . json_encode(array()) . ' '."\n");
		print('        ,success: function( data ){'."\n");
		print('            $.each( data.total , function(i,o){'."\n");
		print('                $( "#" + i + "SpanUser").html( o )'."\n");
		print('            })'."\n");
		print('        }'."\n");
		print('    })'."\n");
		print('</script>'."\n");
		include( constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function login( $info ){
		if( isset( $info["post"]["login"] ) && isset( $info["post"]["password"] ) ){
			$users = new users_model();
			$users->set_filter( array( " mail = '" . $users->con->real_escape_string( $info["post"]["login"] ) . "' " , " password = '" . $users->con->real_escape_string( md5( $info["post"]["password"] ) ) . "' " , " idx in ( select users_profiles.users_id from users_profiles, profiles where profiles.active = 'yes' and users_profiles.active = 'yes' and profiles.idx = users_profiles.profiles_id and profiles.adm = 'yes' ) " ) ) ;
			$users->set_paginate( array( " 1 " ) ) ;
			$users->load_data();
			if( isset( $users->data[0]["idx"] ) ){
				$users->attach( array("profiles") , false , " limit 1 " );
				$_SESSION[ constant("cAppKey") ] = array(
					"credential" => current( $users->data )
				) ;
				$users->populate( array( "last_login" => date("Y-m-d H:i:s") ) ) ;
				$users->save() ;
			}
		}
		else{
			unset( $_SESSION[ constant("cAppKey") ] );
		}
		basic_redir( $GLOBALS["home_url"] ) ;
	}

	// public function loginwithlink( $info ){
	// 	$users = new users_model();
	// 	$users->set_filter( array( " active = 'yes' " , " md5( concat( idx, login ) ) = '" . $info["slug"] . "' " , " idx in ( select users_profiles.users_id from users_profiles, profiles where users_profiles.active = 'yes' and profiles.active = 'yes' and users_profiles.profiles_id = profiles.idx and profiles.adm = 'yes' ) "  ) ) ;
	// 	$users->set_paginate( array( " 1 " ) ) ;
	// 	$users->load_data();
	// 	if( isset( $users->data[0]) ){
	// 		$users->attach( array("profiles") , false , " limit 1 " );
	// 		$_SESSION[ constant("cAppKey") ] = array(
	// 			"credential" => current( $users->data )
	// 		) ;
	// 	}
	// 	else{
	// 		unset( $_SESSION[ constant("cAppKey") ] );
	// 	}
	// 	basic_redir( $GLOBALS["home_url"] );
	// 	exit();
	// }
}
