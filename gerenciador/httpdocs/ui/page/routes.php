<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / Trilhas</p>
    <hr class="col-lg-11 mx-auto" />
    
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php  print($form["pattern"]["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="filter_name">Nome:</label>
                    <input type="text" id="filter_name" class="form-control form-control-sm" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label for="filter_controller">Comando</label>
                <input class="form-control form-control-sm" type="text" id="filter_controller" name="filter_controller" value="<?php print( isset( $info["get"]["filter_controller"] ) ? $info["get"]["filter_controller"] : "" ) ?>">
            </div>
            <div class="form-group col-lg-2">
                <label for="filter_pattern">Padrão de Url</label>
                <input class="form-control form-control-sm" type="text" id="filter_pattern" name="filter_pattern" value="<?php print( isset( $info["get"]["filter_pattern"] ) ? $info["get"]["filter_pattern"] : "" ) ?>">
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="filter_profile">Perfil:</label>
                    <select class="form-control form-control-sm" id="filter_profile" name="filter_profile">
                        <option value="0" <?php print(!isset($info["get"]["filter_profile"]) || $info["get"]["filter_profile"] == "" ? " selected" : "") ?> placeholder="Digite o Email">Selecione o Perfil</option>
                        <?php
                        foreach (profiles_controller::data4select("idx", array(" active = 'yes' ", " idx > 2 "), "name") as $k => $v) {
                        printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($info["get"]["filter_profile"]) && $info["get"]["filter_profile"] == $k ? ' selected="selected"' : '', $v);
                        }
                        ?>
                    </select>
                </div>
            </div>
        
            <div class="col-lg-2">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm">Filtrar</button>
            </div>
            <div class="col-lg-2">
                <label for="btn_add">&nbsp;</label>
                <a  id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Nova Rota</a>
            </div>
        </div>
    </form>
    <hr />
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_namel))) ?>">Name <i class="<?php print($ordenation_namel_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_url))) ?>">Url <i class="<?php print($ordenation_url_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_command))) ?>">Comando <i class="<?php print($ordenation_command_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_profile))) ?>">Perfil <i class="<?php print($ordenation_profile_ordenation) ?>"></i></a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="6">
                <div class="row col-lg-12">
                    <div class="col-lg-3 form-group">
                        <select class="form-control" id="select_paginage" class="col-lg-3 ">
                            <option <?php print($paginate == 20 ? 'selected="selected"' : '') ?> value="20">20</option>
                            <option <?php print($paginate == 50 ? 'selected="selected"' : '') ?> value="50">50</option>
                            <option <?php print($paginate == 100 ? 'selected="selected"' : '') ?> value="100">100</option>
                        </select>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center form-group text-center">
                        <button type="button" id="btn_sr_first" class=" btn ">|<</button>
                        <button type="button" id="btn_sr_previus" class=" btn "><</button>
                        <button type="button" id="btn_sr_next" class=" btn ">></button>
                        <button type="button" id="btn_sr_last" class=" btn ">>|</button>
                    </div>
                    <p class="col-lg-3 text-right"><?php print( ( $info["sr"] + 1 ) . " de " . $total) ?></p>
                </div></th></tr>
            </tfoot>
            <tbody>
                <?php foreach( $data as $v){ ?>
                <tr>
                    <td><?php print( $v["name"] ) ?></td>
                    <td><?php print( $v["pattern"] ) ?></td>
                    <td><?php print( $v["controller"]) ?></td>
                    <td><?php print( isset( $v["profiles_attach"] ) && count( $v["profiles_attach"] ) ? implode( ", " , array_column( $v["profiles_attach"] , "name" ) ) : "" ) ?></td>
                        <td><a class="btn button btn-info" href="<?php printf(  $form["pattern"]["action"] , $v["idx"] ) ?>">[ editar ]</a> <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf(  $form["pattern"]["action"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
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