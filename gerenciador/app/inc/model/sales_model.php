<?php 
class sales_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " first_name ", " last_name ", " mail ",  " document ", " rg ", " cnh ", " phone ", " celphone ", " genre ", " marital_status ", " is_children ", " is_pet ", " pet_species ", " number_residents ", " is_aproved ", " comments ", " day_due ", " payment_method ", " n_contract ",  " address " , " number_address " , " complement " , " code_postal " , " district ", " city " , " uf ", " active ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "sales" , $bd );
	}
}
