<?php 
class vw_locations_model extends DOLModel{
	protected $field = array( " idx " , " is_aproved ", " n_contract ", "object_propertie",  " address " , "number_address", "complement", " code_postal ", " district ", " city ", " uf ", " nome ", " cpf ", " active ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "vw_locations" , $bd );
	}
}
