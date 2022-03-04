<?php
class nfimports_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$boiler = new nfimports_model();
		$boiler->set_field( array( $key , $field  ) ) ;
        $boiler->set_filter( $filters ) ;
        $boiler->set_order( array( $field . " asc " ) );
        $boiler->load_data();
        $out = array();
		foreach( $boiler->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
    private function filter($info)
    {
      $done = array();
      $filter = array(" active = 'yes' " , " tipo_notas = 'S' ");
      if (isset($info["get"]["filter_not"]) && !empty($info["get"]["filter_not"]) && (int)$info["get"]["filter_not"] >  0) {
        $filter["filter_not"] = " idx = '" . $info["get"]["filter_not"] . "' ";
      }
      else{
        $filter["filter_not"] = " ( not idx in ( select records_nfimports.nfimports_id from records_nfimports where records_nfimports.active = 'yes' ) ) " ;
        if (isset($info["get"]["q_number"]) && !empty($info["get"]["q_number"])) {
          $filter["filter_q_number"] = " ( doc_fiscal like '%" . $info["get"]["q_number"] . "%' or doc_fiscal like '%" . $info["get"]["q_number"] . "' or doc_fiscal like '" . $info["get"]["q_number"] . "%' or doc_fiscal = '" . $info["get"]["q_number"] . "' ) ";
        }
      }
      if (isset($info["get"]["filter_cod_empresa"]) && !empty($info["get"]["filter_cod_empresa"])) {
        $filter["filter_cod_empresa"] = " cod_empresa = '" . $info["get"]["filter_cod_empresa"] . "' ";
      }
      return array($done, $filter);
    }
    public function display( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        $data = array();
        if (isset($info["get"]["query"]) && strlen(addslashes($info["get"]["query"]))) {
          $query = preg_replace("/\[+?|\]+?/", "", toUtf8($info["get"]["query"]));
          $query = preg_replace("/\s+?|\t+?|\n+?/", " ", $query);
          $query = preg_replace("/^ | $/", "", $query);
          $query = preg_replace("/([A-z0-9\ \-\_])+?/", "$1", $query);
    
          if (empty($query)) {
            $query = " ";
          }
          else{
            $query = preg_replace("/\D+?/im", "", $query);
            $info["get"]["q_number"] = $query;
            list($done, $filter) = $this->filter($info);
            $boiler = new nfimports_model();
            $boiler->set_field(array( "idx", "tipo_notas", "cod_empresa", "doc_fiscal", "remdes_nota_fiscal", "dat_movimento", "nome_cliente"));
            $boiler->set_paginate(array(0, 12));
            $boiler->set_filter($filter);
            $boiler->set_order(array("doc_fiscal"));
            $boiler->load_data();
            $data = $boiler->data;
          }
        }
        switch ($info["format"]) {
            case ".autocomplete":
                $out = array(
                    "query" => ""
                    , "suggestions" => array()
                );
                foreach ($data as $key => $value) {
                    $out["suggestions"][] = array(
                        "data" => $value
                        , "value" => $value["doc_fiscal"] 
                    );
                }
                header('Content-type: application/json');
                echo json_encode($out);
            break;
            default:
                header('Content-type: application/json');
                echo json_encode(array());
        }
    }
}
