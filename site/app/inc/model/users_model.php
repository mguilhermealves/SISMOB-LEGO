<?php 
class users_model extends DOLModel{
	protected $field = array( " idx " , " mail " , " login " , " first_name " , " last_name " , " cpf " , " last_login " , " phone " , " celphone " , " position " , " regional " , " distribuidora " , " genre " , " management_id " , " accept_at ", "postalcode", "address", "number", "complement", "district", "city", "uf", "image" ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "users" , $bd );
	}
} 
?> 
