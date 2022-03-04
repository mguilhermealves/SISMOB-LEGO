<?php
class surveyalternatives_model extends DOLModel {
	protected $field = array("  idx "  ,  " external_id " , " display_position " , " title ") ;
	protected $filter = array( "  active = 'yes' "  ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "surveyalternatives"  , $bd );
	}
}
?>