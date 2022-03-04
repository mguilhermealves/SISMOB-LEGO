<?php
class courses_model extends DOLModel {
	protected $field = array("  idx "  , " slug " , " external_id " , " display_position " , " credits_value " , " credits_text " , " course_title " , " course_description " , " course_sub_title " , " course_public_description " , " course_public_title " , " course_resume " , " course_status " , " course_duration " , " course_img_text " , " course_instructor ", " course_img_url " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "courses"  , $bd );
	}
}
?>