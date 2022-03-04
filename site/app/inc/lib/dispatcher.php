<?php
class dispatcher{
	private $_class_args = array () ;
	private $_request_server = "" ;
	private $_request_uri = "" ;
	private $_path_info = "" ;
	private $_file_default_list = array ( "index" , "index.php" , "dispatcher.php" , "webapp.php", "index.html" ) ;
	private $_rewrite = true ;
	private $_routes = array () ;
	public function __construct ( $rewrite = true , $class_args = array () ) {
		$this->_rewrite = $rewrite ;
		$this->_class_args = $class_args ;
		$this->_request_server = get_request_server () ;
		$this->_request_uri = $this->get_request_uri () ;
		$this->_path_info = $this->get_path_info () ;
		$this->normalize_request () ;
	}
	private function normalize_request () {
		$path_length = strlen( $this->_path_info );
		if ( $path_length > 0 && $this->_path_info[ $path_length - 1 ] == "/" ) {
			basic_redir( $this->_request_server . rtrim ( $_SERVER["REQUEST_URI"] , "/" ) );
		}
	}
	public function set_file_default_list ( array $value ) {
		$this->_file_default_list = array_merge ( $this->_file_default_list , $value ) ;
	}
	public function get_path_info ( $levels = false ) {
		if ( ! empty ( $this->_path_info ) ) {
			$path = $this->_path_info ;
		}
		else {
			$path = getenv( "PATH_INFO" ) ;
			$path = getenv( "REQUEST_URI" ) ;
			$path = preg_replace("/^(.+)\?.+$/","$1", getenv( "REQUEST_URI" ) ) ;
			if( $path == "/" ){
				$path = "index.php";
			}
			if ( in_array ( trim ( $path , "/" ) , $this->_file_default_list ) ) {
				$path = "" ;
			}
		}
		if ( $levels ) {
			return (array) explode ( "/" , trim ( $path , "/" ) ) ;
		}
		return $path ;
	}
	public function get_request_uri() {
		if ( empty ( $_SERVER["SCRIPT_NAME"] ) ) {
			return "" ;
		}
		$tmp_script_name = $_SERVER["SCRIPT_NAME"] ;
		$tmp_file_name = basename ( $_SERVER["SCRIPT_NAME"] ) ;
		if ( in_array ( $tmp_file_name , $this->_file_default_list ) ) {
			if ( $this->_rewrite ) {
				$tmp_script_name = str_replace ( $tmp_file_name , "" , $tmp_script_name ) ;
			}
		}
		return rtrim ( $tmp_script_name , "/" ) ;
	}
	public function get_request_full_uri() {
		return $this->_request_server . $this->_request_uri ;
	}
	public function add_route( $http_method , $url_pattern , $exec , $check = null , $args = array () , $name = null ) {
		if ( ( $http_method === "POST" || $http_method === "GET" ) && ! empty ( $exec ) ) {
			$this->_routes[ ( $name == null ? count( $this->_routes ) : $name ) ] = array (
				"http_method" => $http_method ,
				"url_pattern" => $url_pattern ,
				"exec" => $exec ,
				"check" => $check ,
				"args" => is_array ( $args ) ? $args : array ( $args )
			) ;
		}
	}
	public function exec() {
		$server_method = $_SERVER["REQUEST_METHOD"] ;
		foreach ( $this->_routes as $entry ) {
			if ( $server_method === $entry["http_method"] ) {
				if ( ! is_null ( $entry["check"] ) && $entry["check"] === false ){
					continue ;
				}
				if ( preg_match ( "/^" . str_replace ( "/" , "\\/" , $entry["url_pattern"] ) . "$/" , $this->_path_info , $matches ) ) {
					$class = $method_name = NULL ;
					if ( is_string( $entry["exec"] ) ){
						if ( ( $pos = strpos ( $entry["exec"] , "function:" ) ) !== false ) {
							$function_name = substr ( $entry["exec"] , $pos + strlen ( "function:" ) ) ;
							if ( function_exists ( $function_name ) ) {
								$entry["args"] = array_merge ( $entry["args"] , $matches ) ;
								return call_user_func ( $function_name , $entry["args"] ) ;
							}
						}
						else {
							$class_method = explode ( ":" , $entry["exec"] ) ;
							if ( is_array ( $class_method ) && count ( $class_method ) == 2 ) {
								list( $class_name , $method_name ) = $class_method ;
					
								if ( class_exists ( $class_name ) ) {
									if ( empty( $this->_class_args ) ) {
										$class = new $class_name ;
									}
									else {
										$class = new $class_name ( $this->_class_args ) ;
									}
								}
							}
						}
					}
					$class_address_num_elements = 2 ;
					if ( is_array( $entry["exec"] ) && count( $entry["exec"] ) == $class_address_num_elements ){
						list( $class , $method_name ) = $entry["exec"] ;
					}
					if ( isset( $class ) && isset( $method_name ) && is_string( $method_name ) && is_object( $class ) && method_exists( $class , $method_name ) ) {
						$matches["server_uri"] = $this->_path_info ;
						$matches = array_merge( $entry["args"] , $matches ) ;
						$class->{$method_name}( $matches ) ;
						return true ;
					}

				}
			}
		}
		return false ;
	}
}
?>
