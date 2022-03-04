<?php
class contexts_model extends DOLModel {
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " name " , " text " , " slug " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "contexts" , $bd );
	}
}
?>
