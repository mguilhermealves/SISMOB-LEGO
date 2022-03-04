<?php
class questions_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " status " , " title " , " justification ", " points ", " show_random_alternatives ", " type ") ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "questions"  , $bd );
	}
}
?>