
         <div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title ">Disponivel para os Perfis</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                     <div class="row">
                        <div class="row col-lg-12">
                           <input type="hidden" name="profiles_id[1]" id="profiles_id[1]" value="1">
                           <input type="hidden" name="profiles_id[2]" id="profiles_id[2]" value="2">
                           <?php 
                                foreach( profiles_controller::data4select("idx",array( " active = 'yes' " , " slug in ('adm-premier','gestor-hsol') " ) ) as $k => $v ){
                                    print(
                                        strtr(
                                            '<input style="display: none;" name="profiles_id[#KEY#]" id="profiles_id[#KEY#]" type="checkbox" value="#KEY#" checked><label class="w-50"><input type="checkbox" value="#KEY#" checked disabled> #VALUE#</label>'
                                            , array(
                                                "#KEY#" => $k
                                                , "#VALUE#" => $v
                                            )
                                        )
                                    ) ;
                                }
                                if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) || in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
                                    $array = array( " active = 'yes' " , " idx > 2 ", " not slug in ('adm-premier','gestor-hsol') " ) ;
                                }
                                else{
                                    $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
                                    $array = array( " active = 'yes' " , " idx > 2 " , " not slug in ('adm-premier','gestor-hsol') ", " not idx in ( '" . implode("','", $profiles_id ) . "' ) " ) ;
                                    foreach( profiles_controller::data4select("idx", $array ) as $k => $v ){ 
                                        print(
                                            strtr(
                                                '<input style="display:none" name="profiles_id[#KEY#]" id="profiles_id[#KEY#]" type="checkbox" value="#KEY#" #checked#>'
                                                , array(
                                                    "#KEY#" => $k
                                                    , "#checked#" => isset( $data[0]["profiles_attach"][0] ) && in_array( $k , array_column( $data[0]["profiles_attach"] , "idx" ) ) ? "checked" : ""
                                                )
                                            )
                                        ) ;
                                    }
                                    $array = array( " active = 'yes' " , " idx > 2 " , " idx in ( '" . implode("','", $profiles_id ) . "' ) " ) ;
                                }
                                foreach( profiles_controller::data4select("idx", $array ) as $k => $v ){ 
                                    if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == $k ){
                                        print(
                                            strtr(
                                                '<input style="display: none;" name="profiles_id[#KEY#]" id="profiles_id[#KEY#]" type="checkbox" value="#KEY#" checked><label class="w-50"><input type="checkbox" value="#KEY#" checked disabled> #VALUE#</label>'
                                                , array(
                                                    "#KEY#" => $k
                                                    , "#VALUE#" => $v
                                                )
                                            )
                                        ) ;
                                    }
                                    else{
                                        print(
                                            strtr(
                                                '<label class="w-50"><input type="checkbox" name="profiles_id[#KEY#]" id="profiles_id[#KEY#]" value="#KEY#" #checked#> #VALUE#</label>'
                                                , array(
                                                    "#KEY#" => $k
                                                    , "#VALUE#" => $v
                                                    , "#checked#" => isset( $data[0]["profiles_attach"][0] ) && in_array( $k , array_column( $data[0]["profiles_attach"] , "idx" ) ) ? "checked" : ""
                                                )
                                            )
                                        ) ;
                                    }
                                }
                            ?>
                        </div>
                     </div>
               </div>
            </div>
         </div>