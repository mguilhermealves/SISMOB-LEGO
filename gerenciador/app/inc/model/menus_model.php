<?php 
class menus_model extends DOLModel{
	protected $field = array( " idx " , " name ", " parent " , " position ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "menus" , $bd );
	}
} 
?>