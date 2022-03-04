<?php
class estrutura_model extends DOLModel {
	protected $field = array( " idx " , " conteudo " ,  " imagem ", "imagem_estrutura_1", "imagem_estrutura_2", "imagem_estrutura_3", "imagem_estrutura_4", "imagem_estrutura_5", "estrutura_1", "estrutura_2", "estrutura_3",  "estrutura_4", "estrutura_5",  "imagens_infra" ) ;
	protected $filter = array( ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "estrutura" , $bd );
	}
}
?>