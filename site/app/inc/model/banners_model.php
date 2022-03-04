<?php
class banners_model extends DOLModel {
	protected $field = array( " idx " , " name " , " link " , " img " , " target " , " slug " , " logged " , " status_published " ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "banners" , $bd );
	}
}