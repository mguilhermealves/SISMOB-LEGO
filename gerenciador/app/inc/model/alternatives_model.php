<?php
class alternatives_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " title " , " title " , " is_correct ") ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "alternatives"  , $bd );
	}
}
?>