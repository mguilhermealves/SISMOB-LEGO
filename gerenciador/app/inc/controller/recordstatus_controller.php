<?php
class recordstatus_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$boiler = new recordstatus_model();
		$boiler->set_field( array( $key , $field  ) ) ;
        $boiler->set_filter( $filters ) ;
        $boiler->load_data();
        $boiler->set_order( array( $field . " asc " ) );
        $out = array();
		foreach( $boiler->data as $value ){
			$out[ $value[ $key ] ] = $value[ $field ] ;
		}
		return $out ;
	}
    private function filter( $info ){
        $done = array();
        $filter = array( " idx > 0 ",  "active = 'yes'" );
        if( isset( $info["get"]["filter_name"] ) && !empty( $info["get"]["filter_name"] ) ){
            $done["filter_name"] = $info["get"]["filter_name"] ;
            $filter["filter_name"] = " name like '%" . $info["get"]["filter_name"] . "%' " ;
        }
        if( isset( $info["get"]["filter_position"] ) && !empty( $info["get"]["filter_position"] ) ){
            $done["filter_position"] = $info["get"]["filter_position"] ;
            $filter["filter_position"] = " position = '" . $info["get"]["filter_position"] . "' " ;
        }
        return array( $done , $filter ) ;
    }
	public function display( $info ){
        if( ! site_controller::check_login() ){
        basic_redir( $GLOBALS["home_url"] ) ;
        }
        $paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

        $page = "Status do Lançamentos";
        list( $done , $filter ) = $this->filter( $info );
        $boiler = new recordstatus_model();
        $boiler->set_filter( $filter ) ;
        $boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
        list( $recordstatuset , $data ) = $boiler->return_data();
        $data = $boiler->data ;

        $form = array(
            "title" => "Listagem de Status do Lançamentos"
            , "titlenew" => "Novo Status do Lançamento"
            , "new" => $GLOBALS["newrecordstatu_url"]
            , "search" => $GLOBALS["recordstatus_url"]
            , "action" => set_url( $GLOBALS["recordstatu_url"] , $done )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/recordstatus.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        include( constant("cRootServer") . "ui/common/list_actions.php");
        include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        $page = "Status do Lançamentos";
        $data = array();
        $form = array(
            "title" => "Cadastrar Lançamento"
            , "url" => $GLOBALS["newrecordstatu_url"] 
        );
        $info["get"]["done"] =  set_url( $GLOBALS["recordstatus_url"] , $info["get"] );
        if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
            $boiler = new recordstatus_model();
            $boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
            $boiler->load_data();
            $boiler->set_paginate( array(1) ) ;
            $data = current( $boiler->data ) ;
            $form["title"] = "Editar Status do Lançamentos";
            $form["url"] = sprintf( $GLOBALS["recordstatu_url"] , $info["idx"] ) ;
        }

        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/recordstatu.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
    public function save( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        $boiler = new recordstatus_model();
        if( isset( $info["idx"] ) ){
            $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        }
        $boiler->populate( $info["post"] );
        $boiler->save();

        if( !isset( $info["idx"] ) ){
            $info["idx"] = $boiler->con->insert_id;
        }

        if( isset( $info["post"]["no-redirect"] ) ){
            print("ok");
        }
        else{
            if( isset( $info["post"]["done"] ) ){
                basic_redir( $info["post"]["done"] ) ;
            }
            else{
                basic_redir( $GLOBALS["recordstatus_url"] ) ;
            }
        }
    }
    public function remove( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        if( isset( $info["idx"] ) ){
            $boiler = new recordstatus_model();
            $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
            $boiler->remove();			
        }	
        if( isset( $info["post"]["no-redirect"] ) ){
            print("ok");
        }
        else{
            if( isset( $info["post"]["done"] ) ){
                basic_redir( $info["post"]["done"] ) ;
            }
            else{
                basic_redir( $GLOBALS["recordstatus_url"] ) ;
            }
        }
    }
}
