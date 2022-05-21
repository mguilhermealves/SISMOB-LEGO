<?php
class users_model extends DOLModel {
	protected $field = array( " idx " , " enabled ", " first_name " , " last_name " , " cpf " , " mail " , " marital_status ", " login " , " last_login " , " phone " , " celphone " , " genre " , " rg ", " cnh ", " postalcode ", " address ", " number ", " complement ", " district ", " city " , " uf " , " marital_status ", " created_at " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "users" , $bd );
	}
}
?>