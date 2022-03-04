<?php
class contacts_model extends DOLModel {
	protected $field = array( " idx " , " enabled ", " name " , " telephone " , " email " , " message ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "contacts" , $bd );
	}
}
?>
