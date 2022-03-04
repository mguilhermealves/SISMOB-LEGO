<?php 
class service_messages_model extends DOLModel{
	protected $field = array( " idx " , " header ", " body " , " status ", " resume ", " context ", " image ", "scheduled_at",	"scheduled_by",	"created_at",	"created_by", "sent_at",	"sent_by",	"modified_at",	"modified_by",	"removed_at",	"removed_by",	"updated_at",	"status_msg") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "service_messages" , $bd );
	}
} 
?>