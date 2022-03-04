<?php 
class biblioteca_conteudos_model extends DOLModel{
	
	protected $field = array( " idx " , " external_id ", " display_position ", " name ", " description ", " is_destak ", " image ", " published_at ", " ico ", " status ", " backgroundcolor ", " fontcolor ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "libarycontexts" , $bd );
	}
} 
?>