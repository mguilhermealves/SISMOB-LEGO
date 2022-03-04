<?php
class surveys_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " title " , " description " , " status ", " questions_random_order " , " start_at ", " end_at ", " qtd_attempts " ) ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "surveys"  , $bd );
	}
}
?>