<?php
class sections_model extends DOLModel {
	protected $field = array("  idx "  , " external_id " , " display_position " , " section_title ", " section_status " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "sections"  , $bd );
	}
}
?>