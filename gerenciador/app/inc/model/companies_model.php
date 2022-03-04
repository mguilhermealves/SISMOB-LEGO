<?php 
class companies_model extends DOLModel{
	protected $field = array( " idx " , " created_at " , " created_by " , " modified_at " , "modified_by " , " name " , " CNPJ " , " inscricao_municipal " , " inscricao_estadual " , " shortname ", " address " , " number " , " complement " , " neighborhood " , " uf " , " city " , " postal_code " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "companies" , $bd );
	}
} 
?>