<?php
class profiles_model extends DOLModel {
	protected $field = array(" idx " , " name " , " slug " , " editabled " , " adm " , " parent ", " description " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "profiles" , $bd );
	}
}
?>