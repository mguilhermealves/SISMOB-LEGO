<?php 
class attempts_model extends DOLModel{
	protected $field = array( " idx " , " user_id ", " tests_id " , " questions_id ", " alternatives_id ", " attempt ", " attempt_number ", " started_at ", " duration ", "created_at" , "alternatives_text" , "execute_corrections" , "execute_points" ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "attempts" , $bd );
	}
} 
?> 