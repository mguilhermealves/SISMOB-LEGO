<?php 
class regulamento_model extends DOLModel{
	protected $field = array( " idx " , " context " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "regulamento" , $bd );
	}
} 
?>