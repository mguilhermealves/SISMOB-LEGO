<?php 
class like_model extends DOLModel{
	protected $field = array( " idx " , " type ", " user_id ", " object_id ", " is_liked ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "likes" , $bd );
	}
} 
?>