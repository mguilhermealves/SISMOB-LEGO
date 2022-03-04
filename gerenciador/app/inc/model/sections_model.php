<?php
class sections_model extends DOLModel {
	protected $field = array("  idx " , " created_at " , " modified_at "  , " external_id " , " display_position " , " section_title ", " section_status ", " mongo_id " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "sections"  , $bd );
	}
}
?>