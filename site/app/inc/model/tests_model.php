<?php
class tests_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " title " , " description " , " status " , " show_correct_answers_end " , " show_result_end " , " questions_random_order " , " score_value ", " score_type ", " start_at ", " end_at ", " qtd_attempts " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "tests"  , $bd );
	}
}
?>