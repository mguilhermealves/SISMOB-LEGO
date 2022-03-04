<?php
class pills_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " pill_title " , " pill_question_text " , " pill_justification " , " pill_points " , " pill_show_random_alternatives " , " pill_start_date " , " pill_end_date ", " pill_status ", " pill_background_url ", " pill_background_mobile " , " slug " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "pills"  , $bd );
	}
}
?>