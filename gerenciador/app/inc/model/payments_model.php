<?php 
class payments_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " active ", " description ", " status ", " fees ",  " fine ", " amount ", " day_due ", " payment_method ", " historic_bank ", " barcode ", " link ", " pdf ",  " expire_at ", " charge_id ", " status ", " total_atuality ", " payment ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "payments" , $bd );
	}
}
