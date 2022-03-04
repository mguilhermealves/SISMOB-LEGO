<?php 
class biblioteca_secoes_model extends DOLModel{
	
	protected $field = array( " idx " , " name ", " description ", " parent ", " ico ", " backgroundcolor ", " fontcolor ", " status ", " external_id ", " created_at ", " modified_at " , " display_position ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "libarysections" , $bd );
	}
} 
?>