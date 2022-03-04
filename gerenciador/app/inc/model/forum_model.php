<?php 
class forum_model extends DOLModel{
	protected $field = array( " idx " , " title ", " slug ", " resume ", " image ", " isFixed ", " isPrivate ", " tags ", " display_position ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "forum" , $bd );
	}
} 
?>