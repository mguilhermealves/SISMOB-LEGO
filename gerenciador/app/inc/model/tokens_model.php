<?php
class tokens_model extends DOLModel {
	protected $field = array(" idx " , " name " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "tokens" , $bd );
	}
}
?>