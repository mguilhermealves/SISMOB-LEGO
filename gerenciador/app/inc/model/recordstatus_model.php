<?php
class recordstatus_model extends DOLModel {
    protected $field = array(" idx " , " name " , " position "  ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "recordstatus" , $bd );
	}
}
?>