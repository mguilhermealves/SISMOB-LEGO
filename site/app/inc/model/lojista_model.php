<?php
class lojista_model extends DOLModel {
	protected $field = array( " idx " , " conteudo " ,  " imagem ", "conteudo_estrutura", "imagem_estrutura_1", "imagem_estrutura_2", "imagem_estrutura_3", "estrutura_1", "estrutura_2", "estrutura_3", "perguntas_frequentes", "imagem_beneficios", "conteudo_beneficios" ) ;
	protected $filter = array( ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "lojista" , $bd );
	}
}
?>
