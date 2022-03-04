<?php 
class routes_model extends DOLModel{
	protected $field = array( " idx " , " name ", " method " , " pattern " , " controller " , " btncheck " , " params " , " sys_type ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "routes" , $bd );
	}
} 
?>