<?php 
class trails_model extends DOLModel{
	protected $field = array( " idx " , " trail_title ", " trail_status ", " trail_sub_title ", " trail_description ", " display_position ", " trail_has_certification ", " external_id ", " slug ", " created_at ", " modified_at ", " mongo_id " , " display_number " , " after_destak ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "trails" , $bd );
	}
} 
?>