<?php
class users_model extends DOLModel {
	protected $field = array( " idx " , " enabled ", " mail " , " login " , " first_name " , " last_name " , " cpf " , " last_login " , " phone " , " celphone " , " position " , " regional " , " distribuidora " , " genre " , " city " , " uf " , " management_id ", " parent " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "users" , $bd );
	}
}
?>