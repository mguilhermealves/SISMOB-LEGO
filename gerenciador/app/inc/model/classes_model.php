<?php
class classes_model extends DOLModel {
	protected $field = array("  idx "  , " external_id " , " start_at " , " end_at ", " name ", " slug ", " classes_status " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( " classes "  , $bd );
	}
}
?>