<?php 
class cadastro_participante_model extends DOLModel{
	protected $field = array( " idx " , " nome " , " documento ", "lumens", " email ", " celular " , " perfil ",  " cep ", " logradouro ", " bairro " , " numero ", " cidade ", " uf "," tempo_profissao ", " formacao ", " data_nascimento ", " autonomo ", " colaborador ", " contato_whatsapp ", " receber_dados ", " sexo ", " interesses ", " preferencia_alimentar ", " aceite_termo " , " socios ",'ano_inicio_funcao','formacao_academica','documentos_funcao','cod_profissional','registro_profissional','telefone','fax','obs','inscricao' , "aprovado") ;

	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "cadastro_participante" , $bd );
	}
} 
?>