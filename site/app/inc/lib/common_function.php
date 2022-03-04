<?php
function m_autoload( $name ) {
	$file_name = false ;
    try {
		foreach( array( "controller" , "lib" , "model" ) as $dir ){
			$file = sprintf(
				"%s/inc/%s/%s.php"
				, constant("cRootServer_APP")
				, $dir
				, $name
			) ;
			
			if ( file_exists( $file ) ) {
				$file_name = $file ;
				if ( ! class_exists( $name, false ) ) {
					require_once( $file );
				}
			}
		}
		if( $file_name === false ){
			throw new Exception('Class ' . $name . ' not exists');
		}
	}
	catch (Exception $e){
	   die("Error: " . $e->getMessage() ) ;
	}
}
spl_autoload_register('m_autoload');
function generate_key( $size = 10 ){ return substr( md5( uniqid( time() ) ), 0, $size ); }
function print_pre( $data , $stop = false ){
  print("<pre>");
  print_r( $data );
  print("</pre>");
  if( $stop ){
    exit();
  }
}
function var_pre( $data , $stop = false ){
  print("<pre>");
  var_dump( $data );
  print("</pre>");
  if( $stop ){
    exit();
  }
}
function html_accents( $text = NULL ){ return strtr( $text ,  array_flip( $GLOBALS["html_entities_list"] ) ) ; }
function up_accents($text = NULL){ return strtoupper( strtr( $text, $GLOBALS["accents_lists"] ) ) ; }
function down_accents($text = NULL){ return strtolower( strtr( $text, array_flip( $GLOBALS["accents_lists"] ) )); } 
function remove_accents( $text = NULL ){ return  strtr( $text, $GLOBALS["withoutaccents_lists"] ) ; }
function generate_slug( $text = NULL ){
  $text = strtolower( remove_accents( $text ) ) ;
  $text = preg_replace( "/[^0-9A-z]+/" , "_" , $text ) ;
  $text = preg_replace( "/\s+?|_+|-+/" , "-" , $text ) ;
  return $text ;
}
function set_url( $url = "" , $params = array() ){
  $tmp = preg_split('/\?/', $url ) ;
  $url = $tmp[0] ;
  $p = "" ;
  if( isset( $tmp[1] ) ){
    $p .= "?" ;
    foreach( explode("&", $tmp[1] ) as $tmp_params ){
      list( $kp , $vp ) = explode("=", $tmp_params ) ;
      if( ! in_array( $kp , $params ) ){
        $p .= $kp ."=".$vp."&" ;
      }
    }
  }
  foreach($params as $kp => $vp){
    if($p == ""){
      $p = "?";
    }
    $p .= $kp ."=".$vp."&" ;
  }
  $p = preg_replace("/\&$/","",$p);
  return $url.$p;
}
function basic_redir ( $url , $code = 301 , $use_html = false ) {
  if ( is_array ( $url ) ) {
    $url = $url[0] ;
  }
  #header( "Status: " . $code ) ;
  if ( $use_html ) {
    $dir = constant("AppLayout") ;
    ob_start();
    switch($code){
      case 301:
        require( $dir . "301.html" );
      break;
      case 404:
        require( $dir . "404.html" );
      break;
      default:
        require( $dir . "302.html" );
      break;
    }
    $out = ob_get_contents();
    ob_end_clean();
    print str_replace("{location}" , $url , $out ) ;
  }
  else {
    print("<script>document.location = '" . $url  . "'</script>");
    #header("Location: " . $url , true , $code ) ;
  }
  exit();
}
function get_request_server( $auth = false , $https = NULL ){
	$server_name = substr( addslashes( stripslashes(strip_tags( getenv( "SERVER_NAME" ) ) ) ) , 0 , 255 ) ;
	$server_protocol = substr( addslashes( stripslashes( strip_tags( getenv( "SERVER_PROTOCOL" ) ) ) ) , 0 , 255 ) ;
	$server_port = substr( addslashes( stripslashes( strip_tags( getenv( "SERVER_PORT" ) ) ) ) , 0 , 255 ) ;

	if ( strtoupper( getenv( "HTTPS" ) ) == strtoupper( "on" ) || ( isset( $https ) && $https == true ) ){
		$server_protocol = "https" ;
		$server_port = "443" ;
	}

	if ( isset( $https ) && $https === false ){
		$server_protocol = "http" ;
		if ( $server_port == "443" ){
			$server_port = "80" ;
		}
	}

	list( $server_protocol , )= explode( "/" , $server_protocol ) ;
	$server_protocol = strtolower( $server_protocol ) ;

	if ( $auth !== false ){
		$request_server = $server_protocol . "://" . $auth . "@" . $server_name ;
	}
	else{
		$request_server = $server_protocol . "://" . $server_name ;
	}

	if ( $server_port != "80" && $server_protocol == "http" ){
		$request_server .= ":" . $server_port ;
	}

	if ( $server_port != "443" && $server_protocol == "https" ){
		$request_server .= ":" . $server_port ;
	}
	return $request_server ;
}
function a_walk(&$array){
  if( is_array( $array ) ){
    foreach( $array as $k => $v){
      if( is_array( $v ) ) {
        $array{ $k } = a_walk( $v) ;
      }
      else{
        $array{ $k } = toUtf8( $v ) ;
      }
    }
  }
  return $array ;
}
function toUtf8( $item ) {
  return preg_match('%(?:
        [\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
        |\xE0[\xA0-\xBF][\x80-\xBF]               # excluding overlongs
        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
        |\xED[\x80-\x9F][\x80-\xBF]               # excluding surrogates
        |\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
        |[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
        |\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
        )+%xs', $item ) == 1 ? $item : utf8_encode( $item ) ;
}
function identifyDevice(){
	return preg_match( "/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i" , $_SERVER['HTTP_USER_AGENT'] ) || preg_match( "/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i" , substr( $_SERVER['HTTP_USER_AGENT'] , 0 , 4 ) ) ;
}
function json_domainmail( $mail ){ return preg_match('/^([a-zA-Z0-9\._-])*([@])([a-z0-9]).([a-z]{2,3})/' , $mail ) && ( checkdnsrr( preg_replace("/[^@\s]*@(.+)$/","$1", $mail ) , 'A' ) || checkdnsrr( preg_replace("/[^@\s]*@(.+)$/","$1", $mail ) , 'MX' ) ) ; }
function utf8_unserialize($data){
	return unserialize(preg_replace_callback('/s:([0-9]+):\"(.*?)\";/', function ($matches) {
		return "s:" . strlen($matches[2]) . ':"' . $matches[2] . '";';
	}, $data));
}
function findfile($path, $name = "x"){
	$dir_iterator = new RecursiveDirectoryIterator($path);
	$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
	foreach ($iterator as $file) {
		if ($file->isFile()) {
			if (basename($file->getPathname()) == $name . ".php") {
				return $file->getPathname();
			}
		}
	}
	return false;
}
$remote_address = substr( addslashes( stripslashes( strip_tags( getenv( "REMOTE_ADDR" ) ) ) ) , 0 , 15 ) ;
$http_user_agent = substr( addslashes( stripslashes( strip_tags( getenv( "HTTP_USER_AGENT" ) ) ) ) , 0 , 255 ) ;
$referrer = substr( addslashes( stripslashes( strip_tags( getenv( "HTTP_REFERER" ) ) ) ) , 0 , 255 ) ;
$request_uri = substr( addslashes( stripslashes( strip_tags( getenv( "SCRIPT_NAME" ) ) ) ) , 0 , 255 ) ;
$request_server = get_request_server() ;
$path_info = getenv( "PATH_INFO" ) ;
function html_notification_print(){ 
  if( isset( $_SESSION["messages_app"] ) ){
    foreach( $_SESSION["messages_app"] as $type => $context ){
      print('<div class="text-center alert alert-' . $type . '" role="alert">');
      print( implode("<br>" , $context ) );
      print('</div>');
    } 
    unset( $_SESSION["messages_app"] );
  }
}
?>