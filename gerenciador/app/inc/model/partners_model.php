<?php 
class partners_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " first_name_partner " , " last_name_partner " , " mail " , " document_partner " , " rg_partner ", " cnh_partner ", " active " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "partners" , $bd );
	}
} 
?>