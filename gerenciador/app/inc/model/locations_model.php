<?php 
class locations_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , "aproved_by", "aproved_at"," is_aproved ", "comments", " day_due ", " payment_method ", " n_contract ",  " indice " , "in_progress", "qtd_payment_generator", " active ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "locations" , $bd );
	}
}
