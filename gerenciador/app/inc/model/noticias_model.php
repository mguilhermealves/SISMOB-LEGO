<?php 
class noticias_model extends DOLModel{
	protected $field = array( " idx " , " title " , " slug ", " resume ", " context ", " image ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "noticias" , $bd );
	}
} 
?>