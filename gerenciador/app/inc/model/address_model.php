<?php 
class address_model extends DOLModel{
	protected $field = array( " idx " , " address ", " number " , " complement ", " neighborhood ", " uf ", " city " , " postal_code ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "address" , $bd );
	}
} 
?>