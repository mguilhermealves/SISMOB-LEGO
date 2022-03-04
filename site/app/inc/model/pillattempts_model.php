<?php
class pillattempts_model extends DOLModel {
	protected $field = array("  idx "  ,  " user_id " , " pill_id " , " pillquestions_id " , " attempt " , " started_at " , " duration " , " execute_points " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "pillattempts"  , $bd );
	}
}
?>