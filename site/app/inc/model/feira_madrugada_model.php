<?php
class feira_madrugada_model extends DOLModel {
	protected $field = array( " idx " , " titulo_inicio " , " subtitulo_inicio " , " conteudo ", " imagem ", " politica ") ;
	protected $filter = array( ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "feira_madrugada" , $bd );
	}
}
?>
