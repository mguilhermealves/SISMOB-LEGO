<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6">Urls</p>
    <hr />
    <!-- Button trigger modal -->
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php  print($form["pattern"]["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="filter_name">Nome:</label>
                <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="filter_slug">Slug:</label>
                <input type="text" id="filter_slug" class="form-control" name="filter_slug" value="<?php print(isset($info["get"]["filter_slug"]) ? $info["get"]["filter_slug"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Slug">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="filter_pattern">Pattern:</label>
                <input type="text" id="filter_pattern" class="form-control" name="filter_pattern" value="<?php print(isset($info["get"]["filter_pattern"]) ? $info["get"]["filter_pattern"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Padrão">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="filter_profile">Perfil:</label>
                <select class="form-control " id="filter_profile" name="filter_profile">
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
                <a  id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Nova Url</a>
            </div>
        </div>
    </form>
    <hr />
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Nome <i class="<?php print($ordenation_name_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_url))) ?>">Url <i class="<?php print($ordenation_url_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_pattern))) ?>">Padrão <i class="<?php print($ordenation_pattern_ordenation) ?>"></i></a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr><th colspan="4">
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
                <?php
                    if ($total > 0) {
                        foreach ($data as $v) { ?>
                        <tr>
                            <td><?php print( $v["name"] ) ?></td>
                            <td><?php print( $v["slug"] . "_url" ) ?></td>
                            <td><?php print( $v["pattern"] ) ?></td>
                            <td><a class="btn button btn-info" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ editar ]</a> <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                        </tr>
                <?php
                        }
                    } else {
                ?>
                    <tr>
                        <td colspan="6">
                            <p class="alert alert-warning text-center">Nenhuma url criada até o momento...</p>
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