<?php 
class account_pay_cost_center_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " name ", " cost_center ", " category ", " comments ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "account_pay_cost_center" , $bd );
	}
}
