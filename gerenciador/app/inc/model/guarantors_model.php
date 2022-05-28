<?php 
class guarantors_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " type_work ", " company_name ", " office ",  " registration_time ", " rent_monthly ", " address_file ", " cnpj_file ", " contract_file ", " rent_file ", " IRPF_file ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "guarantors" , $bd );
	}
}
