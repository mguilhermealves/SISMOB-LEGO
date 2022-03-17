<?php 
class account_pays_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " company_beneficiary ", " amount ", " payment_method ",  " comments ", " day_due ", " is_recorrency ", " status_payment ", " center_count ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "account_pays" , $bd );
	}
}
