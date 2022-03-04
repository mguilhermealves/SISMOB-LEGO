<?php
class records_controller{
	public static function data4select( $key = "idx" , $filters = array() , $field = "name" ){
		$boiler = new records_model();
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
        if( isset( $info["get"]["filter_request_at"] ) && !empty( $info["get"]["filter_request_at"] ) ){
            $done["filter_request_at"] = $info["get"]["filter_request_at"] ;
            $filter["filter_request_at"] = " request_at >= '" . $info["get"]["filter_request_at"] . " 00:00:00' " ;
        }
        if( isset( $info["get"]["filter_request_to"] ) && !empty( $info["get"]["filter_request_to"] ) ){
            $done["filter_request_to"] = $info["get"]["filter_request_to"] ;
            $filter["filter_request_to"] = " request_at <= '" . $info["get"]["filter_request_to"] . " 23:59:59' " ;
        }
        if( isset( $info["get"]["filter_number"] ) && !empty( $info["get"]["filter_number"] ) ){
            $done["filter_number"] = $info["get"]["filter_number"] ;
            $filter["filter_number"] = " number like '%" . $info["get"]["filter_number"] . "%' " ;
        }

        if( isset( $info["get"]["filter_status"] ) && !empty( $info["get"]["filter_status"] ) ){
            $done["filter_status"] = $info["get"]["filter_status"] ;
            if( $info["get"]["filter_status"] == "-1" ){
                $filter["filter_status"] = " ( not canceled_at is null ) " ;
            }
            else{
                $filter["filter_status"] = " idx in ( select records_recordstatus.records_id from records_recordstatus where records_recordstatus.active = 'yes' and records_recordstatus.recordstatus_id = '" . $info["get"]["filter_status"] . "' ) " ;
            }
        }
        if( isset( $info["get"]["filter_client"] ) && !empty( $info["get"]["filter_client"] ) ){
            $done["filter_client"] = $info["get"]["filter_client"] ;
            $filter["filter_client"] = " idx in ( select records_nfimports.records_id from records_nfimports, nfimports where records_nfimports.active = 'yes' and nfimports.active = 'yes' and nfimports.idx = records_nfimports.nfimports_id and nfimports.nome_cliente like '%" . $info["get"]["filter_client"] . "%' ) " ;
        } 
        if( isset( $info["get"]["filter_favor"] ) && !empty( $info["get"]["filter_favor"] ) ){
            $done["filter_favor"] = $info["get"]["filter_favor"] ;
            $filter["filter_favor"] = " idx in ( select users_records.records_id from users_records, users where users_records.active = 'yes' and users.active = 'yes' and users.idx = users_records.users_id and concat_ws( ' ' , users.first_name , users.last_name ) like '%" . $info["get"]["filter_favor"] . "%' ) " ;
        }        
        switch( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] ){
            case 8:
                $filter["filter_request"] = " request_by = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' " ;
                $filter["filter_profile"] = " idx in ( select records_recordstatus.records_id from records_recordstatus where records_recordstatus.active = 'yes' and records_recordstatus.recordstatus_id in (1,2,3) ) " ;
            break;
            case 7:
                $filter["filter_request"] = " request_by in ( select idx from users where active = 'yes' and  parent = '" . $_SESSION[ constant("cAppKey") ]["credential"]["idx"] . "' ) " ;
                $filter["filter_profile"] = " idx in ( select records_recordstatus.records_id from records_recordstatus where records_recordstatus.active = 'yes' and records_recordstatus.recordstatus_id in (3,4) ) " ;
            break;
            //case 7:
            //    $filter["filter_profile"] = " idx in ( select records_recordstatus.records_id from records_recordstatus where records_recordstatus.active = 'yes' and records_recordstatus.recordstatus_id in (5,6,7) ) " ;
            //break;
        }
        return array( $done , $filter ) ;
    }
	public function display( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        if( !isset( $info["get"]["filter_request_at"] ) ){
            basic_redir( set_url( $GLOBALS["records_url"] , array_merge( $info["get"] , array( "filter_request_at" => date("Y-m-d") ) ) ) ) ;
        }
        if( !isset( $info["get"]["filter_request_to"] ) ){
            basic_redir( set_url( $GLOBALS["records_url"] , array_merge( $info["get"] , array( "filter_request_to" => date("Y-m-d") ) ) ) ) ;
        }
        $paginate = isset( $info["get"]["paginate"] ) && (int)$info["get"]["paginate"] > 20 ? $info["get"]["paginate"] : 20 ;

        $page = "Lançamentos";
        list( $done , $filter ) = $this->filter( $info );
        $boiler = new records_model();
        $boiler->set_filter( $filter ) ;
        $boiler->set_paginate( array( $info["sr"] , $paginate ) ) ;
        list( $recordset , $data ) = $boiler->return_data();
        $boiler->attach( array( "users" ) , true ) ;
        $boiler->attach( array( "recordstatus" , "nfimports") ) ;
        $boiler->join("requestors","users",array("idx" => "request_by"));
        
        $data = $boiler->data ;

        $form = array(
            "title" => "Listagem de Lançamentos"
            , "titlenew" => "Novo Lançamento"
            , "new" => $GLOBALS["newrecord_url"]
            , "search" => $GLOBALS["records_url"]
            , "action" => set_url( $GLOBALS["record_url"] , $done )
        ) ;
        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/records.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        include( constant("cRootServer") . "ui/common/list_actions.php");
        include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
	public function form( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        $page = "Lançamentos";
        $data = array(
            "split" => "no"
            , "request_at" => date("Y-m-d H:i:s")
            , "request_by" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"]
            , "request_name" => $_SESSION[ constant("cAppKey") ]["credential"]["first_name"]
            , "approved_by" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"]
            , "approved_name" => $_SESSION[ constant("cAppKey") ]["credential"]["first_name"]
            , "libered_by" => $_SESSION[ constant("cAppKey") ]["credential"]["idx"]
            , "libered_name" => $_SESSION[ constant("cAppKey") ]["credential"]["first_name"]
            , "amount" => 0
            , "product_templuz" => 0
            , "service_templuz" => 0
            , "loja_eletrica" => 0
        );
        $form = array(
            "title" => "Cadastrar Lançamento"
            , "url" => $GLOBALS["newrecord_url"] 
        );
        $info["get"]["done"] =  set_url( $GLOBALS["records_url"] , $info["get"] );
        $companies_lists = companies_controller::data4select("cod_empresa",array(" active = 'yes' ")) ;

        if( isset( $info["idx"] ) && (int)$info["idx"] > 0 ){
            $boiler = new records_model();
            $boiler->set_filter( array( " idx = '" . $info["idx"] . "'" ) ) ;
            $boiler->load_data();
            $boiler->attach( array( "users" ) , true ) ;
            $boiler->attach( array( "recordstatus" , "nfimports" ) ) ;
            $boiler->join("requestors","users",array("idx" => "request_by"));
            $boiler->join("approveds","users",array("idx" => "approved_by"));
            $boiler->join("libereds","users",array("idx" => "approved_by"));
            $boiler->set_paginate( array(1) ) ;
            $data = current( $boiler->data ) ;
            $data["request_name"] = $data["requestors_attach"][0]["first_name"] ;
            $data["approved_name"] = isset( $data["approveds_attach"][0] ) ? $data["approveds_attach"][0]["first_name"] : $_SESSION[ constant("cAppKey") ]["credential"]["first_name"] ;
            $data["libered_name"] = isset( $data["libereds_attach"][0] ) ? $data["libereds_attach"][0]["first_name"] : $_SESSION[ constant("cAppKey") ]["credential"]["first_name"] ;
            $form["title"] = "Editar record";
            $form["url"] = sprintf( $GLOBALS["record_url"] , $info["idx"] ) ;
        }

        include( constant("cRootServer") . "ui/common/header.inc.php");
        include( constant("cRootServer") . "ui/common/head.inc.php");
        include( constant("cRootServer") . "ui/page/record.php");
        include( constant("cRootServer") . "ui/common/footer.inc.php");
        ?>
        <script>
            $("select[name='split']").bind("change",function(){
                if( $("option:selected",this).val() == "yes" ){
                    $("#id_comissao_container").show();
                    $("#id_user_container").show();
                    $("#comissao_1").val('50');
                    $("#comissao_2").val('50');
                }
                else{
                    $("#id_comissao_container").hide();
                    $("#id_user_container").hide();
                    $("#comissao_2").val('');
                    $("#users_2").val('');
                    $("#comissao_1").val('100');
                }
            });

            $("#comissao_1").bind("change", function(){
                if( $("#comissao_1").val() > 100  ){
                    $("#comissao_1").val(100)
                }
                if( $("option:selected","select[name='split']").val() == "yes" ){
                    var vl = $(this).val();
                    $("#comissao_2").val(100 - vl );
                }
                else{
                    $("#comissao_1").val(100);
                }
            });
            $("#comissao_2").bind("change", function(){
                if( $("#comissao_2").val() > 100  ){
                    $("#comissao_2").val(100)
                }
                if( $("option:selected","select[name='split']").val() == "yes" ){
                    var vl = $(this).val();
                    $("#comissao_1").val(100 - vl );
                }
                else{
                    $("#comissao_1").val(100);
                }
            });
            $("select[name='split']").change();
            function favorecidos(){
                if( $("#users_1").val() != "" ){
                    if( $("#users_2").val() == "" && $("option:selected","select[name='split']").val() == "yes" ){
                        $("#users_2_search").focus();
                        alert("Atenção é necessário escolher o segundo favorecido");
                        return false ;
                    }
                    else{
                        if( $("#users_1").val() == $("#users_2").val() ) {
                            $("#users_2_search").focus();
                            $("#users_2").val('');
                            $("#users_2_search").val('');
                            alert("Atenção não é possivel selecionar o mesmo favorecido");
                            return false ;
                        }
                    }
                }
                else{
                    if( $("#users_1").val() == ""  ){
                        $("#users_1_search").focus();
                        alert("Atenção é necessário escolher o primeiro favorecido");
                        return false ;
                    }
                }
                return true ;
            }
            function calculate(){
                var valproduct_templuz = Number( $("#product_templuz").val() ).toFixed(2) ;
                var valservice_templuz = Number( $("#service_templuz").val() ).toFixed(2) ; 
                var valloja_eletrica = Number( $("#loja_eletrica").val() ).toFixed(2) ;
                var nf = Number( $("input[name='amount']").val() ).toFixed(2) ;
                if( nf >=  Number( valproduct_templuz ) +  Number( valservice_templuz ) +  Number( valloja_eletrica ) ){
                    var valproduct_templuz = Number( valproduct_templuz * 10 / 100 ).toFixed(2) ;
                    var valservice_templuz = Number( valservice_templuz * 5 / 100 ).toFixed(2) ; 
                    var valloja_eletrica = Number( valloja_eletrica * 3 / 100 ).toFixed(2) ;
                    $("#total_product_templuz").html( 'R$ ' + valproduct_templuz );
                    $("#total_service_templuz").html( 'R$ ' + valservice_templuz );
                    $("#total_loja_eletrica").html( 'R$ ' + valloja_eletrica );
                    $("#total").html( 'R$ ' + Number( Number( valproduct_templuz ) + Number( valservice_templuz ) + Number( valloja_eletrica ) ).toFixed(2) ) ;
                    return true;
                }
                else{
                    alert("Atenção o valor da NF precisa ser maior ou igual a soma dos produtos");
                    return false;
                }
            }
            $("#product_templuz").bind("keyup",function(){ calculate()} )
            $("#service_templuz").bind("keyup",function(){ calculate()} )
            $("#loja_eletrica").bind("keyup",function(){ calculate()} )
            calculate();
            $("#frm_sel").bind("submit",function(){
                var nf = true ;
                <?php if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){ ?>
                if( $("#nfimports_id").val() == "" ){
                    alert( "Necessário informar uma NF válida para")
                    nf = false ;
                    $("input[name='number']").focus();
                }
                <?php } ?>
                return nf && calculate() && favorecidos();
            })
            $("input[name='number']").autocomplete({
                serviceUrl: '<?php print( $GLOBALS["nfssearchs_url"] ) ?>' ,
                params: {
                    'filter_not':<?php print(isset( $data["nfimports_attach"][0] ) && (int)$data["nfimports_attach"][0]["idx"] > 0 ? $data["nfimports_attach"][0]["idx"] : 0 ) ?>
                    , 'filter_cod_empresa': function() {
                        return $("option:selected","select[name='cod_empresa']").val();
                    }
                } ,
                minChars: 3,
                deferRequestBy: 5,
                noCache: false,
                onSelect: function(sugestion) {
                    $("#nf_emissao").html( sugestion.data.dat_movimento );
                    $("#nf_client").html( sugestion.data.nome_cliente );
                    $("#nfimports_id").val( sugestion.data.idx );
                }
            });
            $("input[id='users_1_search']").autocomplete({
                serviceUrl: '<?php print( $GLOBALS["users_url"] ) ?>.autocomplete' ,
                minChars: 3,
                deferRequestBy: 5,
                noCache: true,
                onSelect: function(sugestion) {
                    $("#users_1").val( sugestion.data.idx );
                    favorecidos();
                }
            });
            $("input[id='users_2_search']").autocomplete({
                serviceUrl: '<?php print( $GLOBALS["users_url"] ) ?>.autocomplete' ,
                minChars: 3,
                deferRequestBy: 5,
                noCache: true,
                onSelect: function(sugestion) {
                    $("#users_2").val( sugestion.data.idx );  
                    favorecidos();
                }
            });


        </script>
        <?php
        include( constant("cRootServer") . "ui/common/foot.inc.php");
	}
    public function save( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        $boiler = new records_model();
        if( isset( $info["idx"] ) ){
            $boiler->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
        }
        else{
            $info["post"]["slug"] = generate_key(12) . md5( date("YmdHis") ) ;
            $info["post"]["request_by"] = $_SESSION[ constant("cAppKey") ]["credential"]["idx"];
        }

        if( $info["post"]["recordstatus_id"] == 0 ){
            $info["post"]["canceled_at"] = date("Y-m-d H:i:s");
            $info["post"]["canceled_by"] = $_SESSION[ constant("cAppKey") ]["credential"]["idx"];
        }

        if( $info["post"]["split"] == "yes" ){
            $info["post"]["user2"] = $info["post"]["users_id"][1];
        }
        

        $boiler->populate( $info["post"] );
        $boiler->save();

        if( !isset( $info["idx"] ) ){
            $info["idx"] = $boiler->con->insert_id;
        }

        if( $info["post"]["recordstatus_id"] == 5 ){

            $calc = new records_model();
            $calc->set_filter( array( " idx = '" . $info["idx"] . "' " ) ) ;
            $calc->load_data();
            $c = current( $calc->data );

            $tot = (int)$c["product_templuz"] > 0 ? $c["product_templuz"] * 10 / 100 : 0 ;
            $tot += (int)$c["service_templuz"] > 0 ? $c["service_templuz"] * 5 / 100 : 0 ;
            $tot += (int)$c["loja_eletrica"] > 0 ? $c["loja_eletrica"] * 3 / 100 : 0 ;
            if( $tot < 1000 ){
                $info["post"]["recordstatus_id"] = array(6);
            }
        }
        $boiler->save_attach( $info , array( "users" ) , true );
        $boiler->save_attach( $info , array( "recordstatus" , "nfimports" ) );
    
        if( isset( $info["post"]["no-redirect"] ) ){
            print("ok");
        }
        else{
            if( isset( $info["post"]["done"] ) ){
                basic_redir( $info["post"]["done"] ) ;
            }
            else{
                basic_redir( $GLOBALS["records_url"] ) ;
            }
        }
    }
    public function remove( $info ){
        if( ! site_controller::check_login() ){
            basic_redir( $GLOBALS["home_url"] ) ;
        }
        if( isset( $info["idx"] ) ){
            $boiler = new records_model();
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
                basic_redir( $GLOBALS["records_url"] ) ;
            }
        }
    }
}
