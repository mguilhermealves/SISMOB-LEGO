<?php 
class sales_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " is_aproved ", " comments ", " day_due ", " payment_method ", " n_contract ", " active ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "sales" , $bd );
	}
}
