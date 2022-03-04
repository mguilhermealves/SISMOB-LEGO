<?php
class pills_controller{
	public static function data4select( $key = "idx" , $filters = array( " active = 'yes' ") , $field = "name" ){
		$filed_name = ltrim(rtrim(preg_replace("/.+ as (.+)$/","$1" , $field )));
        $boiler = new pills_model();
        $boiler->set_field( array( $key , $field  ) ) ;
        $boiler->set_filter( $filters ) ;
        $boiler->set_order( array( $filed_name ) );
        $boiler->load_data();
        $out = array_column( $boiler->data , $filed_name , $key );
		return $out ;
	}
    private function filter($info)
    {
        $done = array();
        $filter = array(" active = 'yes' " , " pill_status = 'Publicado' " );
        if (isset($info["get"]["paginate"]) && !empty($info["get"]["paginate"])) {
            $done["paginate"] = $info["get"]["paginate"];
        }
        if (isset($info["get"]["sr"]) && !empty($info["get"]["sr"])) {
            $done["sr"] = $info["get"]["sr"];
        }
        if (isset($info["get"]["ordenation"]) && !empty($info["get"]["ordenation"])) {
            $done["ordenation"] = $info["get"]["ordenation"];
        }
        if( !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) && !in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
            $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
            $filter["filter_profiles"] = " idx in ( select pills_profiles.pills_id from pills_profiles where pills_profiles.active = 'yes' and pills_profiles.profiles_id in ( '" . implode("','",$profiles_id) . "') ) ";
        }
        if (isset($info["slug"]) && !empty($info["slug"])) {
            $filter["slug"] = " slug = '" . $info["slug"] . "' ";
        }
        return array($done, $filter);
    }
	public function pilulas_conteudo( $info ){
		$page = 'pilulas_conteudo';
			
		if( !site_controller::check_login() ){
            basic_redir($GLOBALS["home_url"]);
        }

        list( $done , $filter) = $this->filter( $info );

        $pills = new pills_model();
        $pills->set_filter( $filter );
        $pills->set_order( array( " pill_start_date desc " ) );
        list( $total , $data ) = $pills->return_data();

        $idxs = array_column($data,"idx");

        $pillattempts = pillattempts_controller::data4select( "idx" , array( " active = 'yes' " , " pill_id in (  '" . implode("','", $idxs ) . "' ) " ) , "duration" ); 

        $respondida = (int)count($pillattempts) ;

        $media =  gmdate("H:i:s", $respondida > 0 ? array_sum( $pillattempts ) / count( array_filter( $pillattempts ) ) : 0 ) ;
        $corretas = (int)count( pillattempts_controller::data4select( "idx" , array( " active = 'yes' " , " pill_id in ( '" . implode("','", $idxs ) . "' ) " , " execute_points > 0 " ) , "idx" ) ) ;

        $pills->set_filter( $filter );
        $pills->load_data();
        $pills->join("pillattempts","pillattempts",array( "pill_id" => "idx" ) , " and user_id = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' " );

        $data = $pills->data ;
        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/page/pilulas_conteudo.php");	
        include( constant("cRootServer") . "ui/common/foot.php");
        include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function pilulas( $info ){
		$page = 'pilulas';
			
		if( !site_controller::check_login() ){
            basic_redir($GLOBALS["home_url"]);
        }
        list( $done , $filter) = $this->filter( $info );

        $pills = new pills_model();
        $pills->set_filter( $filter );
        $pills->set_paginate( array( "1" ) );
        $pills->load_data();

		if( !isset( $pills->data[0] ) ){
            basic_redir($GLOBALS["pilulas_url"]);
        }

        $pills->attach( array( "pillquestions" ) );    
        $pills->join("pillattempts","pillattempts",array( "pill_id" => "idx" ) , " and user_id = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' " );    
        $data = current( $pills->data ) ;


        $execute = true ;
        $execute_text = '' ;
        if( (int)preg_replace("/^(....).(..).(..).(..).(..).+$/","$1$2$3$4$5",$data["pill_end_date"]) < (int)date("YmdHi") ){
            $execute = false ;
            $execute_text = "Pilula fora do prazo";
        }

        if( $execute && isset( $data["pillattempts_attach"][0] ) ){
            $execute = false ;
            $execute_text = "Pilula já respondida";
        }


        if( !isset( $_SESSION["started_at" . $data["idx"] ] ) ){
            $_SESSION["started_at" . $data["idx"] ] = date("Y-m-d H:i:s");
        }

        include( constant("cRootServer") . "ui/common/header.php");
        include( constant("cRootServer") . "ui/common/head.php");
        include( constant("cRootServer") . "ui/page/pilulas.php");		
        include( constant("cRootServer") . "ui/common/foot.php");
        include( constant("cRootServer") . "ui/common/footer.php");
	}
	public function save( $info ){
		$page = 'pilulas';
			
		if( !site_controller::check_login() ){
            basic_redir($GLOBALS["home_url"]);
        }
        list( $done , $filter) = $this->filter( $info );
        $pills = new pills_model();
        $pills->set_filter( $filter );
        $pills->set_paginate( array( "1" ) );
        $pills->load_data();
        $pills->attach( array( "pillquestions" ) , false , " and idx = '" . $info["post"]["pillquestions_id"] . "' " );        
        $info["post"]["attempt"] = serialize( $pills->data[0] ) ;

        $pills->attach( array( "pillquestions" ) , false , " and idx = '" . $info["post"]["pillquestions_id"] . "' " );        
        $data = current( $pills->data ) ;

        $info["post"]["user_id"] = $_SESSION[ constant("cAppKey") ]["credential"]["idx"] ;
        $info["post"]["pill_id"] = $data["idx"] ;
        $info["post"]["started_at"] = $_SESSION["started_at" . $data["idx"] ] ;

        $info["post"]["duration"] =date("YmdHis") - preg_replace("/^(....).(..).(..).(..).(..).(..)$/","$1$2$3$4$5$6",$_SESSION["started_at" . $data["idx"] ] ) ;
        $info["post"]["execute_points"] = $data["pillquestions_attach"][0]["is_correct"] == "yes" ? $data["pill_points"] : 0 ;
        unset( $_SESSION["started_at" . $data["idx"] ] );
        
        $pillattempts = new pillattempts_model();
        $pillattempts->populate( $info["post"] );
        $pillattempts->save();
        basic_redir($GLOBALS["pilulas_url"]);

    }
}
