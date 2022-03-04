<?php 
class subjects_messages_model extends DOLModel{
	protected $field = array( " idx " , " name ", " para ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "subjects_messages" , $bd );
	}
} 
?>