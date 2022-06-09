<?php 
class fiances_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " type_fiance ", " type_work ", " company_name ", " office ",  " registration_time ", " rent_monthly ",  " address " , " number " , " complement " , " postalcode " , " district ", " city " , " uf " , " security_name ", " security_start_date ", " security_end_date ", " address_file ", " cnpj_file ", " contract_file ", " rent_file ", " IRPF_file ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "fiances" , $bd );
	}
}
