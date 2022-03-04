<?php
class sorteios_model extends DOLModel {
	protected $field = array( " idx " , "titulo","title_regulamento","data_extenso","arquivo_regulamento","title_permissionarios","arquivo_permissionarios","title_naopermissionarios","arquivo_naopermissionarios" ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "sorteios" , $bd );
	}
}