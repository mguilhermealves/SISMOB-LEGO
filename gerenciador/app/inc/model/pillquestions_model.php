<?php
class pillquestions_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " type " , " is_correct " , " text ") ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "pillquestions"  , $bd );
	}
}
?>