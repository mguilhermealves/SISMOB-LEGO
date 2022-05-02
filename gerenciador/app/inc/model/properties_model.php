<?php 
class properties_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " address " , " number_address " , " complement " , " code_postal " , " district ", " city " , " uf " , " type_propertie " , " object_propertie " , " deadline_contract " , " financial_propertie " , " financer_name ", "price_condominium", "price_location", "percentual_iptu", "price_sale", "price_iptu", "porcent_propertie", "is_swap", "comments", "is_used", "imagem", "docs", "instalation_enel", "instalation_sabesp", "administrative_fees", "classification") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "properties" , $bd );
	}
} 
?>