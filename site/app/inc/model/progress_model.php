<?php
class progress_model extends DOLModel {
	protected $field = array("  idx "  ,  " type " , " users_id " , " object_id " , " video_progress " , " valor " , " complete " , " calculate " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "progress"  , $bd );
	}
}
?>