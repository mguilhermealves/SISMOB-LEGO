<?php 
class urls_model extends DOLModel{
	protected $field = array( " idx " , " name ", " slug " , " pattern ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "urls" , $bd );
	}
} 
?>