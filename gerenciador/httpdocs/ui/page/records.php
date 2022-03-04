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
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $form["search"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                    <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                    <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                    <label style="padding:5px">
                        Inicio da Solicitação
                        <input type="date"  name="filter_request_at" value="<?php print( isset( $info["get"]["filter_request_at"] ) ? $info["get"]["filter_request_at"] : "" ) ?>">
                    </label>
                    <label style="padding:5px">
                        Fim da Solicitação
                        <input type="date"  name="filter_request_to" value="<?php print( isset( $info["get"]["filter_request_to"] ) ? $info["get"]["filter_request_to"] : "" ) ?>">
                    </label>
                    <label style="padding:5px">
                        Nome do Cliente
                        <input type="text"  name="filter_client" value="<?php print( isset( $info["get"]["filter_client"] ) ? $info["get"]["filter_client"] : "" ) ?>">
                    </label>
                    <label style="padding:5px">
                        Nº Documento Fiscal
                        <input type="text"  name="filter_number" value="<?php print( isset( $info["get"]["filter_number"] ) ? $info["get"]["filter_number"] : "" ) ?>">
                    </label>
                    <label style="padding:5px">
                        Nome do Favorecido
                        <input type="text"  name="filter_favor" value="<?php print( isset( $info["get"]["filter_favor"] ) ? $info["get"]["filter_favor"] : "" ) ?>">
                    </label>
                    <label style="padding:5px">
                        Status
                        <select name="filter_status" name="filter_status">
                            <option value="" <?php print( !isset( $info["get"]["filter_status"] ) || $info["get"]["filter_status"] == "" ? " selected" : "" ) ?>></option>
                            <option value="-1" <?php print( isset( $info["get"]["filter_status"] ) && $info["get"]["filter_status"] == "-1" ? " selected" : "" ) ?>>Cancelado</option>
                            <?php 
                            foreach( recordstatus_controller::data4select("idx",array(" active = 'yes'" ) ) as $k => $v ){
                                printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_status"] ) && $info["get"]["filter_status"] == $k ? ' selected="selected"' : '' , $v);
                            }
                            ?>
                        </select>
                    </label>
                    <div>
                        <button style="white-space:nowrap" type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
                    </div>
                </form>
                <div id="solaris-head-data">

                    <table class="table large-12 columns">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align:center">Solicitação</th>
                                <th colspan="2" style="text-align:center">Favorecido</th>
                                <th rowspan="2" style="text-align:center">Nome do Cliente</th>
                                <th rowspan="2" style="text-align:center">Status</th>
                                <th rowspan="2" width="10%" style="text-align:center">Ação</th>
                            </tr>
                            <tr>
                                <th style="text-align:center">Data</th>
                                <th style="text-align:center">Solicitante</th>
                                <th style="text-align:center">Nº Documento Fiscal</th>
                                <th style="text-align:center">Nome</th>
                                <th style="text-align:center">Valor Documento Fiscal</th>                                
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="8">
                                    <select id="select_paginage" class="large-3 columns">
                                        <option <?php print( $paginate == 20 ? 'selected="selected"' : '' ) ?> value="20">20</option>
                                        <option <?php print( $paginate == 50 ? 'selected="selected"' : '' ) ?> value="50">50</option>
                                        <option <?php print( $paginate == 100 ? 'selected="selected"' : '' ) ?> value="100">100</option>
                                    </select>
                                    <div class="large-6 columns text-center">
                                        <button type="button" id="btn_sr_first" class="button btn secondary">|<</button>
                                        <button type="button" id="btn_sr_previus" class="button btn secondary"><</button>
                                        <button type="button" id="btn_sr_next" class="button btn secondary">></button>
                                        <button type="button" id="btn_sr_last" class="button btn secondary">>|</button>
                                    </div>
                                    <p class="large-3 columns text-right"><?php print( ( $info["sr"] + 1 ) . " de " . $recordset )?></p>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach( $data as $v){ ?>
                            <tr>
                                <td><?php print( preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$v["request_at"]) ) ?></td>
                                <td><?php print( $v["requestors_attach"][0]["first_name"] ) ?></td>
                                <td><?php print( $v["number"] ) ?></td>
                                <td><?php print( implode(", " , array_column( $v["users_attach"] , "first_name" ) ) ) ?></td>
                                <td><?php print( "R$ " . number_format( $v["amount"] , 2 , "," , "." ))?></td>
                                <td><?php print( $v["nfimports_attach"][0]["nome_cliente"] ) ?></td>
                                <td><?php print( !empty($v["canceled_at"]) ? 'Cancelado' : $v["recordstatus_attach"][0]["name"] ) ?></td>
                                <td>
                                    <?php
                                    if( !empty($v["canceled_at"]) ){
                                    }
                                    else{
                                        if( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] == 11 ){
                                            if( in_array( $v["recordstatus_attach"][0]["idx"] , array(1,2,3) ) ){
                                                ?><a class="btn button btn-info" href="<?php printf( $form["action"] , $v["idx"] ) ?>">[ editar ]</a><?php
                                            }
                                        }
                                        else{
                                            ?><a class="btn button btn-info" href="<?php printf( $form["action"] , $v["idx"] ) ?>">[ editar ]</a><?php
                                        }
                                    }
                                    ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    <table>
                    <div class="large-12 col text-right" > 
                    <a class="btn button bg-gray round" style="margin-top:10px" title="Incluir" href="<?php print( $form["new"] ) ?>"><i class="fontello-plus"></i> <?php print( $form["titlenew"] ) ?></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .row_js{ justify-content: space-around;flex-direction: row; display: flex; margin: 5px auto;width:95%; border:1px solid #707070; border-radius:7px; padding:0px 5px }
    .row_js .cell{ text-align:left; padding:5px; border-right: 1px solid #c0c0c0; width:100% }
    .row_js .cell_last{ border-right: none; }
    .row_js_header{ padding:10px 5px; font-weight: bold }

    .row_js .table_data_footer{ display: flex; flex-direction: row; align-items: baseline; }
    #per_page{ max-width: 100px; align-items: baseline; }
    #paginate_control{ justify-content: space-around; font-size: 2rem; }
    #paginate_display{ justify-content: flex-end; }
    .row_js_header button i{ float: right; font-weight: bold }
    #paginate_control button{ width: 100%; background-color: #ffffff; color: #707070; text-align: center; font-weight: bold; }
    #paginate_control button:disabled{ background-color: #f0f0f0; color: #ffffff; border:none ; opacity: 0.5; }
</style>