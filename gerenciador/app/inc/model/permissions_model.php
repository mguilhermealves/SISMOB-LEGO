<?php
class permissions_model extends DOLModel {
	protected $field = array(" idx " , " name " , " slug "  ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "permissions" , $bd );
	}
}
?>