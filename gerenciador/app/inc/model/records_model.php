<?php
class records_model extends DOLModel {
    protected $field = array(" idx " , " slug " , " number " , " split " , " amount " , " product_templuz " , " service_templuz " , " loja_eletrica ", " request_by " , " request_at " , " approved_by " , " approved_at " , " libered_by " , " libered_at ", " approved_obs " , " libered_obs " , " comissao_1 " , " comissao_2 " , " canceled_by " , " canceled_at " , " cod_empresa ", " user2 "  ) ;
	protected $filter = array( " active = 'yes' " ) ;
	function __construct( $bd = false  ) {
		return parent::__construct( "records" , $bd );
	}
}
?>