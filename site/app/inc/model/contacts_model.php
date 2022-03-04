<?php 
class contacts_model extends DOLModel{
	protected $field = array( " idx " , " name " , " phone " , " mail " , " message " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "contacts" , $bd );
	}
} 
?> 
