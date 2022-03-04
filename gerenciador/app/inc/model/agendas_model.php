<?php 
class agendas_model extends DOLModel{
	protected $field = array( " idx " , " date_event ", " title " , " slug ", " resume ", " context ", " image ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "agendas" , $bd );
	}
} 
?>