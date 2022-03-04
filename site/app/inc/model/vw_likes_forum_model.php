<?php 
class vw_likes_forum_model extends DOLModel{
	protected $field = array( " forum_id " , " response ", " type ", " user_id ", " object_id ", " active ");

	protected $filter = array( " active = 'yes' " );

	function __construct( $bd = false  ) {
		return parent::__construct( "vw_likes_forum" , $bd );
	}
} 
?>