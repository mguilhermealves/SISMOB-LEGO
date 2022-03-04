<?php 
class biblioteca_materiais_model extends DOLModel{
	
	protected $field = array( " idx " , " external_id ", " display_position ", " name ", " description ", " type ", " url ", " status ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "libaryfiles" , $bd );
	}
} 
?>