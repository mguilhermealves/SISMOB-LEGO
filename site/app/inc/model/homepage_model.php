<?php
class homepage_model extends DOLModel {
	protected $field = array( " idx " , " titulo_inicio " , " subtitulo_inicio " , " texto_inicio ", " banner_baixo ", " info_contato ", " info_rodape_1 ", " info_rodape_2 ", " instagram ", " facebook ", " twitter ", " whatsapp ", " perguntas_frequentes ", " localizacao ") ;
	protected $filter = array( ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "homepage" , $bd );
	}
}
?>
