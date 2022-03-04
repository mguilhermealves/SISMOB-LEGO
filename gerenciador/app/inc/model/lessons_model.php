<?php
class lessons_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " lessons_type " , " lessons_title " , " lessons_description " , " lessons_content_url " , " lessons_status " , " lessons_duration " , " lessons_img_text " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "lessons"  , $bd );
	}
}
?>