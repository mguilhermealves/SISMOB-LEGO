<?php
class transparencias_model extends DOLModel {
	protected $field = array( " idx " , "titulo","ano","arquivo") ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "transparencias" , $bd );
	}
}