<?php 
class nfimports_model extends DOLModel{
	protected $field = array( " idx " , " tipo_notas ", " cod_empresa " , " doc_fiscal ", " remdes_nota_fiscal ", " dat_movimento ", " nome_cliente ", " post ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "nfimports" , $bd );
	}
} 
?>