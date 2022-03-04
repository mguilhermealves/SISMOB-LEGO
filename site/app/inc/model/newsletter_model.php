<?php 
class newsletter_model extends DOLModel{
	protected $field = array( " idx " , " name " , " mail " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "newsletter" , $bd );
	}
} 
?>