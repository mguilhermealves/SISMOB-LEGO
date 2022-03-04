<?php 
class cadastro_participante_model extends DOLModel{
	protected $field = array( " idx " ,'nome','documento','email','celular','perfil','sexo','cep','logradouro','cidade','uf','tempo_profissao','formacao','data_nascimento','ano_inicio_funcao','formacao_academica','documentos_funcao','interesses','preferencia_alimentar','preferencia_alimentar_copy1','cod_profissional','registro_profissional','bairro','telefone','fax','comissao','obs','inscricao' , "aprovado","numero" , "socios") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {	
		return parent::__construct( "cadastro_participante" , $bd );
	}
}