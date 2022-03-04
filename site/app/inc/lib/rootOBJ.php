<?php
class rootOBJ{
	public $data = array() ;
	public function __call( $method, $paramters ) {
		if( preg_match( "/(?P<type>[sg]et)_(?P<method>\w+)/", $method , $match ) ){
			$var = $match{ "method" } ;
			switch( $match{ "type" } ){
				case 'set':
				  $this->$var = $paramters[0];
				break;
				case 'get':
				  return $this->$var;
				break;
			}
		}
	}
	public function render( $data , $format = NULL ){
		switch( $format ){
			case ".xml":
				header('Content-type: application/xml');
				render_xml( a_walk( $data ), "root" ) ;
			break;
			case ".json":
				header('Content-type: application/json');
				echo json_encode( a_walk( $data ) );
			break;
			default:
				return $data;
			break;
		}
	}

	public function loadcurrent_data( $filters = array() , $fields = array() , $attach = array() , $attach_son = array() , $availabled = false ){
		$field = count( $fields ) ? array_merge( $this->field , $fields ) : $this->field ; 
		$filter = count( $filters ) ? array_merge( $this->filter , $filters ) : $this->filter ; 
		return $this->_current_data( $filter , $field , $attach, $attach_son, $availabled ) ;
	}
}
?>