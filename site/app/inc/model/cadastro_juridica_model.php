<?php 
class cadastro_juridica_model extends DOLModel{
	protected $field = array( " idx " , " razao_social " , " documento ", " email ", " celular " , " telefone " , " cep ", " logradouro ", " cidade ", " uf ", " documentos_escritorio ", " qtde_socios ") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "cadastro_juridica" , $bd );
	}
} 
?>