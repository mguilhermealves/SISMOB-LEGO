<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / Cursos</p>
    <hr class="col-lg-11 mx-auto" />
    <!-- Button trigger modal -->
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php  print($form["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_name">Nome:</label>
                    <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_course_status">Status:</label>
                    <select class="form-control " id="filter_course_status" name="filter_course_status">
                        <option value="" <?php print(!isset($info["get"]["filter_course_status"]) || $info["get"]["filter_course_status"] == "" ? " selected" : "") ?> placeholder="Selecione o Status">Selecione o Status</option>
                        <?php 
                        foreach( $GLOBALS["display_status_list"] as $k => $v ){
                            printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_course_status"]) && $k == $info["get"]["filter_course_status"] ? ' selected' : '' , $v , $v ) ;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) || in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
                if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) || in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
                    $array = array( " idx > 2 ", " not slug in ('adm-premier','gestor-hsol') " ) ;
                }
                else{
                    $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
                    $array = array( " idx > 2 ", " idx in ( '" . implode("','", $profiles_id ) . "' ) " ) ;
                }
            ?>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="filter_profiles">Perfil:</label>
                    <select class="form-control " id="filter_profiles" name="filter_profiles">
                        <option value="" <?php print(!isset($info["get"]["filter_profiles"]) || $info["get"]["filter_profiles"] == "" ? " selected" : "") ?> placeholder="Selecione o Perfil">Selecione o Perfil</option>
                        <?php 
                        foreach( profiles_controller::data4select("idx", $array ) as $k => $v ){
                            printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_profiles"]) && $k == $info["get"]["filter_profiles"] ? ' selected' : '' , $k , $v ) ;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="col-lg-2">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm">Filtrar</button>
            </div>
            <div class="col-lg-2">
                <label for="btn_add">&nbsp;</label>
                <a  id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Novo Curso</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["search"], array("ordenation" => $ordenation_positions))) ?>">Posição <i class="<?php print($ordenation_positions_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["search"], array("ordenation" => $ordenation_course))) ?>">Curso <i class="<?php print($ordenation_course_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["search"], array("ordenation" => $ordenation_modifiedat))) ?>">Última Atualização <i class="<?php print($ordenation_modifiedat_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["search"], array("ordenation" => $ordenation_course_status))) ?>">Status <i class="<?php print($ordenation_course_status_ordenation) ?>"></i></a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr><th colspan="5">
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
                    <p class="col-lg-3 text-right"><?php print( ( $info["sr"] + 1 ) . " de " . ( isset( $total ) ? $total : 0 ) ) ?></p>
                </div>
                </th></tr>
            </tfoot>
            <tbody>
                <?php foreach( $data as $v){ ?>
                <tr>
                    <td style="text-align: center;" scope="row"><?php print($v["display_position"]); ?></td>
                    <td><?php print( $v["course_title"] ) ?></td>   
                    <td><?php print( preg_replace("/^(....).(..).(..).(.....).+/","$3/$2/$1 $4", isset($v["modified_at"]) ? $v["modified_at"] : $v["created_at"] ) ); ?></td>
                    <td><?php print( $v["course_status"] ) ?></td>                               
                    <td>
                        <a class="btn btn-outline-primary btn-sm" href="<?php print( set_url( sprintf( $form["action"] , $v["idx"] ) , array( "done" => $done_url ) ) )  ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                        <a class="btn btn-outline-primary btn-sm" href="<?php print( set_url( sprintf( $form["section"] , $v["idx"] ) , array( "done" => $done_url ) ) ) ?>"><i class="fa fa-cog" aria-hidden="true"></i> Seções</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        <table>
    </div>
</div>
    <style>
    .card-header {
        cursor: pointer;
    }

    .card-header .fa-chevron-up {
        display: none;
    }

    .card-header.collapsed .fa-chevron-up {
        display: inline-block;
    }

    .card-header.collapsed .fa-chevron-down {
        display: none;
    }
</style>