<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / Banners</p>
    <hr class="col-lg-11 mx-auto" />

    <!-- Button trigger modal -->
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php  print($form["pattern"]["search"]) ?>">
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
                    <label for="filter_profile">Perfil:</label>
                    <select class="form-control " id="filter_profile" name="filter_profile">
                        <option value="" <?php print(!isset($info["get"]["filter_profile"]) || $info["get"]["filter_profile"] == "" ? " selected" : "") ?> placeholder="Selecione o Status">Selecione o Status</option>
                        <?php 
                        foreach( profiles_controller::data4select("name", array( " idx > 2 " ) ) as $k => $v ){
                            printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_profile"]) && $k == $info["get"]["filter_profile"] ? ' selected' : '' , $v , $v ) ;
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
                <a  id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Novo Banner</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Imagem <i class="<?php print($ordenation_name_ordenation) ?>"></i></a></th>
                    <th>Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="3">
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
                        </div>
                    </th></tr>
            </tfoot>
            <tbody>
                <?php
                    if ($total > 0) {
                        foreach ($data as $v) { ?>
                        <tr>
                            <td><img src="/<?php print($v["img"]); ?>" class="img-fluid"></td>
                            <td><?php print( implode(", " ,  array_column( $v["profiles_attach"], "name" ) ) ); ?></td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="<?php print( set_url( sprintf($form["pattern"]["action"] , $v["slug"]) , array("done" => $form["done"] ) ) ); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                            </th>
                        </tr>
                <?php
                        }
                    } else {
                ?>
                    <tr>
                        <td colspan="6">
                            <p class="alert alert-warning text-center">Nenhum banner encontrado...</p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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