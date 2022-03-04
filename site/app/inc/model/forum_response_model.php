<?php 
class forum_response_model extends DOLModel{
	protected $field = array( " idx " , " response ", " like ", " slug ", " image ", " forum_id ", " created_at ", " modified_at ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "forum_response" , $bd );
	}
} 
?>