<?php 
class rescues_model extends DOLModel{
	protected $field = array( " idx " , " user_id ", " Id_ClienteCampanhaCartao " , " Id_ClienteCampanhaCartaoExtrato ", " valor ", " Id_FornecedorProduto ", " Id_UsuarioResgate ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "rescues" , $bd );
	}
} 
?>