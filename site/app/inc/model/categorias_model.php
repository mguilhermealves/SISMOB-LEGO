<?php 
class categorias_model extends DOLModel{
	protected $field = array( " idx " , " title " , " icone ", " acelerador ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "categorias" , $bd );
	}
} 
?>