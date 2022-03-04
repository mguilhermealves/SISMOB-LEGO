<?php 
class categorianoticias_model extends DOLModel{
	protected $field = array( " idx " , " title " , " slug ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "categorianoticias" , $bd );
	}
} 
?> 
