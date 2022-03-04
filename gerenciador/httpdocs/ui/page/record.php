<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( $form["title"] ) ?></span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form id="frm_sel" action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>
                    <div style="display: flex; justify-content: space-evenly; padding-top:15px;flex-direction: column;">
                        <div class="large-12 columns">
                            <div class="large-5 columns bxs_user margin-bottom-20">
                                <div class="header">Solicitação de Pontos</div>
                                <div class="large-5 columns padding-top-20">
                                    <label>
                                        A comissão será dividida?
                                        <?php
                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                        ?>
                                            <select name="split">
                                                <?php foreach( $GLOBALS["yes_no_lists"] as $k => $v ){ ?>
                                                <option value="<?php print( $k ) ?>" <?php print( isset( $data["split"] ) && $data["split"] == $k ? ' selected="selected"' : '' ) ?>><?php print( $v ) ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                        }
                                        else{
                                            print("<br><strong>" . $GLOBALS["yes_no_lists"][$data["split"] ] . "</strong>" ) ;
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="large-3 columns padding-top-20">
                                    <label>
                                        Solicitação
                                        <?php
                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                            print("
                                            <input type='hidden' name='request_at' value='". ( isset( $data["request_at"] ) ? $data["request_at"] : date("Y-m-d H:i:s") ) . "'><br><strong>" . preg_replace("/^(....).(..).(..).+/","$3/$2/$1", isset( $data["request_at"] ) ? $data["request_at"] : date("Y-m-d H") ) . "</strong>" ) ;
                                        }
                                        else{
                                            print("<br><strong>" . preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$data["request_at"]) . "</strong>" ) ;
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Solicitante
                                        <?php if( !isset( $data["idx"] ) ){ ?>
                                        <input type="hidden" name="request_by" value="<?php print( isset( $data["request_by"] ) ? $data["request_by"] : "" ) ?>">
                                        <?php } ?>
                                        <br><strong><?php print( isset( $data["request_name"] ) ? $data["request_name"] : "" ) ?></strong>
                                    </label>
                                </div>

                                <div class="large-9 columns padding-top-20 padding-bottom-20">
                                    <?php
                                    if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                    ?>
                                    <label>
                                        Favorecido 1
                                        <input type="hidden" id="users_1" name="users_id[]" value="<?php print( isset( $data["users_attach"][0] ) ? $data["users_attach"][0]["idx"] : '' ) ?>">

                                        <input type="text" id="users_1_search" value="<?php print( isset( $data["users_attach"][0] ) ? $data["users_attach"][0]["first_name"] . " " . $data["users_attach"][0]["last_name"] : '' ) ?>">
                                    </label>
                                    <?php
                                    }
                                    else{
                                        if( isset( $data["users_attach"][0] ) ){
                                            print("<label>Favorecido 1<br><strong>" . $data["users_attach"][0]["first_name"] . "</strong></label>" ) ;
                                    ?>
                                            <input type="hidden" id="users_1" name="users_id[]" value="<?php print( isset( $data["users_attach"][0] ) ? $data["users_attach"][0]["idx"] : '' ) ?>">
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                    ?>
                                        <label id="id_user_container">
                                            Favorecido 2
                                            <input type="hidden" id="users_2" name="users_id[]" value="<?php print( isset( $data["users_attach"][1] ) ? $data["users_attach"][1]["idx"] : '' ) ?>">

                                            <input type="text" id="users_2_search" value="<?php print( isset( $data["users_attach"][1] ) ? $data["users_attach"][1]["first_name"] . " " . $data["users_attach"][1]["last_name"] : '' ) ?>">
                                        </label>
                                    <?php
                                    }
                                    else{
                                        if( isset( $data["users_attach"][1] ) ){
                                            print("<label>Favorecido 2<br><strong>" . $data["users_attach"][1]["first_name"] . "</strong></label>" ) ;
                                            ?>
                                            <input type="hidden" id="users_2" name="users_id[]" value="<?php print( isset( $data["users_attach"][1] ) ? $data["users_attach"][1]["idx"] : '' ) ?>">
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>    
                                <div class="large-3 columns padding-top-20">
                                    <?php
                                    if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                    ?>
                                    <label>
                                        % Comissão
                                        <?php
                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                        ?>
                                            <input step="0.01" type="number" id="comissao_1" name="comissao_1" value="<?php print( isset( $data["comissao_1"] ) ? $data["comissao_1"] : '0' ) ?>">
                                            <?php
                                        }
                                        else{
                                            print("<br><strong>" . $data["comissao_1"] . "</strong>" ) ;
                                        }
                                        ?>
                                    </label>
                                    <?php
                                    }
                                    else{
                                        if( isset( $data["users_attach"][0] ) ){
                                            print("<label>% Comissão<br><strong>" . $data["comissao_1"] . "</strong></label>" ) ;
                                        }
                                    }
                                    ?>
                                    <?php
                                    if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                    ?>
                                        <label id="id_comissao_container">
                                            % Comissão
                                            <?php
                                            if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                            ?>
                                                <input step="0.01" type="number" id="comissao_2" name="comissao_2" value="<?php print( isset( $data["comissao_2"] ) ? $data["comissao_2"] : '0' ) ?>">
                                                <?php
                                            }
                                            else{
                                                print("<br><strong>" . $data["comissao_2"] . "</strong>" ) ;
                                            }
                                            ?>
                                        </label>
                                    <?php
                                    }
                                    else{
                                        if( isset( $data["users_attach"][1] ) ){
                                            print("<label>% Comissão<br><strong>" . $data["comissao_2"] . "</strong></label>" ) ;
                                        }
                                    }
                                    ?>
                                </div>  
                            </div>
                            <div class="large-6 columns bxs_user margin-bottom-20">
                                <div class="header">Dados NF</div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Empresa Emissora
                                            <?php
                                            if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                            ?>
                                            <select name="cod_empresa">
                                                <?php foreach( $companies_lists as $k => $v ){ ?>
                                                <option value="<?php print( $k ) ?>" <?php print( isset( $data["nfimports_attach"][0]["cod_empresa"] ) && $data["nfimports_attach"][0]["cod_empresa"] == $k ? ' selected="selected"' : '' ) ?>><?php print( $v ) ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php 
                                            }
                                            else{
                                                print("<br><strong>" . $companies_lists[ $data["nfimports_attach"][0]["cod_empresa"] ] . "</strong>" ) ;
                                            }
                                            ?>
                                        </label>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Nº Documento Fiscal
                                            <?php
                                            if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                            ?>
                                            <input type="hidden" id="nfimports_id" name="nfimports_id" value="<?php print( isset( $data["nfimports_attach"][0] ) ? $data["nfimports_attach"][0]["idx"] : "" ) ?>">
                                            <input type="text" required name="number" value="<?php print( isset( $data["number"] ) ? $data["number"] : "" ) ?>">
                                            <?php 
                                            }
                                            else{
                                                print("<input type='hidden' id='nfimports_id' name='nfimports_id' value='" . (  isset( $data["nfimports_attach"][0] ) ? $data["nfimports_attach"][0]["idx"] : "" ) . "'><br><strong>" . $data["number"] . "</strong>" ) ;
                                            }
                                            ?>
                                        </label>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Valor Documento Fiscal
                                            <?php
                                            if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                            ?>
                                            <input type="number" required step="0.01" min="1" name="amount" value="<?php print( isset( $data["amount"] ) ? number_format( $data["amount"] , 2 , "." , "" ) : "" ) ?>">
                                            <?php
                                            }
                                            else{
                                                print('<input type="hidden" required step="0.01" min="0" name="amount" value="' . number_format( $data["amount"] , 2 , "." , "" ) . '">');
                                                print("<br><strong>R$ " . number_format( $data["amount"] , 2 , "," , "." ) . "</strong>" ) ;
                                            } ?>
                                        </label>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Data da Emissão
                                            <br><strong id="nf_emissao"><?php print( isset( $data["nfimports_attach"][0]["dat_movimento"] ) ? $data["nfimports_attach"][0]["dat_movimento"] : "" ) ?></strong>
                                        </label>
                                    </div>
                                    <div class="large-8 columns padding-top-20">
                                        <label>
                                            Nome do Cliente
                                            <br><strong id="nf_client"><?php print( isset( $data["nfimports_attach"][0]["nome_cliente"] ) ? $data["nfimports_attach"][0]["nome_cliente"] : "" ) ?></strong>
                                        </label>
                                    </div>

                                    <div class="large-12 columns padding-top-20 padding-bottom-20">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">Descrição</th>
                                                    <th style="text-align:center">Valor Total Documento Fiscal</th>
                                                    <th style="text-align:center">% da Comissão</th>
                                                    <th style="text-align:center">Valor da Comissão</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align:right">TOTAL</th>
                                                    <th id="total" style="text-align:right">R$ 0,00</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>Produtos Templuz</td>
                                                    <td>
                                                        <?php
                                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                                        ?>
                                                        <input id="product_templuz" name="product_templuz" type="number" step="0.01" min="0" value="<?php print( isset( $data["product_templuz"] ) ? number_format( $data["product_templuz"] , 2 , "." , "" ) : "0" ) ?>">
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
                                                        <input id="product_templuz" type="hidden" step="0.01" min="0" value="<?php print( isset( $data["product_templuz"] ) ? number_format( $data["product_templuz"] , 2 , "." , "" ) : "0" ) ?>"><?php print( isset( $data["product_templuz"] ) ? number_format( $data["product_templuz"] , 2 , "," , "." ) : "0" ) ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center">10%</td>
                                                    <td id="total_product_templuz" style="text-align:right">R$ 0,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Serviços Templuz</td>
                                                    <td>
                                                        <?php
                                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                                        ?>
                                                        <input id="service_templuz" name="service_templuz" type="number" step="0.01" min="0" value="<?php print( isset( $data["service_templuz"] ) ? number_format( $data["service_templuz"] , 2 , "." , "" ) : "0" ) ?>">
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
                                                        <input id="service_templuz" type="hidden" step="0.01" min="0" value="<?php print( isset( $data["service_templuz"] ) ? number_format( $data["service_templuz"] , 2 , "." , "" ) : "0" ) ?>"><?php print( isset( $data["service_templuz"] ) ? number_format( $data["service_templuz"] , 2 , "," , "." ) : "0" ) ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center">5%</td>
                                                    <td id="total_service_templuz" style="text-align:right">R$ 0,00</td>
                                                </tr>
                                                <tr>
                                                    <td>Produtos Loja Eletrica</td>
                                                    <td>
                                                        <?php
                                                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                                                        ?>
                                                        <input id="loja_eletrica" name="loja_eletrica" type="number" step="0.01" min="0" value="<?php print( isset( $data["loja_eletrica"] ) ? number_format( $data["loja_eletrica"] , 2 , "." , "" ) : "0" ) ?>">
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
                                                        <input id="loja_eletrica" type="hidden" step="0.01" min="0" value="<?php print( isset( $data["loja_eletrica"] ) ? number_format( $data["loja_eletrica"] , 2 , "." , "" ) : "0" ) ?>"><?php print( isset( $data["loja_eletrica"] ) ? number_format( $data["loja_eletrica"] , 2 , "," , "." ) : "0" ) ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center">3%</td>
                                                    <td id="total_loja_eletrica" style="text-align:right">R$ 0,00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>    
                            </div>
                        </div>


                        
                        <?php
                        if( !isset( $data["recordstatus_attach"][0] ) || $data["recordstatus_attach"][0]["idx"] < 3 ){
                            print('<input type="hidden" name="recordstatus_id" value="3">');
                            if( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 2 && !empty( $data["approved_obs"] )  ){ 
                            ?>
                            <div class="large-12 columns bxs_user">
                                <div class="header">Observação</div>
                                    <div class="large-12 columns padding-top-20 padding-bottom-20">
                                        <label>
                                            <?php  print( isset( $data["approved_obs"] ) ? $data["approved_obs"] : "" ) ; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        }
                        else{
                        ?>
                        <div class="large-12 columns bxs_user margin-bottom-20">
                            <div class="header">Aprovação</div>

                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Data da Aprovação
                                    <?php
                                    if( $data["recordstatus_attach"][0]["idx"] > 3 ){
                                        print("<br><strong>" . preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$data["approved_at"]) . "</strong>" ) ;
                                    }
                                    else{
                                    ?>
                                    <input type="hidden" required name="approved_at" value="<?php print( isset( $data["approved_at"] ) && !empty( $data["approved_at"] ) ? preg_replace("/^(....).(..).(..).+/","$1-$2-$3",$data["approved_at"] ) : date("Y-m-d") ) ?>">
                                    <?php
                                    print('<strong>'.date("d/m/Y").'</strong>');
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Aprovado por
                                    <?php if( $data["recordstatus_attach"][0]["idx"] > 3 ){ ?>
                                    <input type="hidden" name="approved_by" value="<?php print( isset( $data["approved_by"] ) ? $data["approved_by"] : "" ) ?>">
                                    <?php } ?>
                                    <br><strong><?php print( isset( $data["approved_name"] ) ? $data["approved_name"] : "" ) ?></strong>
                                </label>
                            </div>
                            <?php if( $data["recordstatus_attach"][0]["idx"] < 5 ){ ?>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Status Lançamento
                                    <select name="recordstatus_id">
                                        <option value="5" <?php print( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 5 ? ' selected="selected"' : '' ) ?>>Aprovado</option>
                                        <option value="2" <?php print( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 2 ? ' selected="selected"' : '' ) ?>>Revisão</option>
                                        <option value="0">Reprovado</option>
                                    </select>
                                </label>
                            </div>
                            <?php } ?>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Observação
                                    <?php if( $data["recordstatus_attach"][0]["idx"] < 5 ){ ?>
                                    <textarea name="approved_obs"><?php print( isset( $data["approved_obs"] ) ? $data["approved_obs"] : "" ) ?></textarea>
                                    <?php }
                                    else{
                                        print( isset( $data["approved_obs"] ) ? $data["approved_obs"] : "" ) ;
                                    } ?>
                                </label>
                            </div>
                        </div>
                        <?php
                            if( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 4 && !empty( $data["libered_obs"] )  ){ 
                            ?>
                            <div class="large-12 columns bxs_user margin-top-20">
                                <div class="header">Observação do Erro da Liberação</div>
                                    <div class="large-12 columns padding-top-20 padding-bottom-20">
                                        <label>
                                            <?php  print( isset( $data["libered_obs"] ) ? $data["libered_obs"] : "" ) ; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            if( $data["recordstatus_attach"][0]["idx"] >= 5 ){
                        ?>
                                <div class="large-12 columns bxs_user margin-top-20">
                                    <div class="header">Liberação</div>
        
                                    
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Data da Liberação
                                            <?php
                                            if( $data["recordstatus_attach"][0]["idx"] > 5 ){
                                                print("<br><strong>" . preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$data["libered_at"]) . "</strong>" ) ;
                                            }
                                            else{
                                            ?>
                                            <input type="hidden" required name="libered_at" value="<?php print( isset( $data["libered_at"] ) && !empty( $data["libered_at"] ) ? preg_replace("/^(....).(..).(..).+/","$1-$2-$3",$data["libered_at"] ) : date("Y-m-d") ) ?>">
                                            <?php
                                            print('<strong>'.date("d/m/Y").'</strong>');
                                            }
                                            ?>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Liberado por
                                            <?php if( $data["recordstatus_attach"][0]["idx"] > 3 ){ ?>
                                            <input type="hidden" name="libered_by" value="<?php print( isset( $data["libered_by"] ) ? $data["libered_by"] : "" ) ?>">
                                            <?php } ?>
                                            <br><strong><?php print( isset( $data["libered_name"] ) ? $data["libered_name"] : "" ) ?></strong>
                                        </label>
                                    </div>
                                            <?php if( $data["recordstatus_attach"][0]["idx"] < 6 ){ ?>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Liberar Lançamento
                                            <select name="recordstatus_id">
                                                <option value="6" <?php print( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 6 ? ' selected="selected"' : '' ) ?>>Aprovar</option>
                                                <option value="4" <?php print( isset( $data["recordstatus_attach"][0] ) && $data["recordstatus_attach"][0]["idx"] == 4 ? ' selected="selected"' : '' ) ?>>Revisar</option>
                                                <option value="0">Reprovado</option>
                                            </select>
                                        </label>
                                    </div>
                                            <?php } ?>
                                    <div class="large-6 columns padding-top-20">
                                        <label>
                                            Observação 
                                            <?php if( $data["recordstatus_attach"][0]["idx"] < 6 ){ ?>
                                            <textarea name="libered_obs"><?php print( isset( $data["libered_obs"] ) ? $data["libered_obs"] : "" ) ?></textarea>
                                            <?php }
                                            else{
                                                print( isset( $data["libered_obs"] ) ? $data["libered_obs"] : "" ) ;
                                            } ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php print( $info["get"]["done"] ) ?>" class="round hollow button secondary" >Voltar</a>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    label{ font-size:1rem }
    .autocomplete-suggestions{overflow:auto;background-color:#fff; border: 1px solid #c0c0c0}
    .autocomplete-suggestion{background-color:#fff;clear:both;cursor:pointer;display:block; font-size:0.9rem; padding: 0.5rem;}
    .autocomplete-suggestion p{vertical-align:middle;padding-top:15px;color:#0A4C80;font-size:1.5rem}
    .autocomplete-selected{background-color:#0A4C80;color:#fff;}
    .autocomplete-selected p{color:#fff!important; font-size:0.9rem}
    input[type=number]{ text-align: right;}
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>