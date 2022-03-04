<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Fórums</p>
    <hr class="col-lg-11 mx-auto" />
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php print($form["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_id">ID:</label>
                    <input type="text" id="filter_id" class="form-control" name="filter_id" value="<?php print(isset($info["get"]["filter_id"]) ? $info["get"]["filter_id"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o ID">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_title">Titulo:</label>
                    <input type="text" id="filter_title" class="form-control" name="filter_title" value="<?php print(isset($info["get"]["filter_title"]) ? $info["get"]["filter_title"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Titulo">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_isFixed">Tópico Fixado</label>
                    <select class="form-control" name="filter_isFixed">
                        <option value="" selected>Selecione...</option>
                        <?php
                        foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                            printf('<option value="%s"%s>%s</option>', $k, $info["get"]["filter_isFixed"] == $k  ? ' selected="selected"' : '', $v);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="filter_isPrivate">Tópico Privado</label>
                    <select class="form-control" name="filter_isPrivate">
                        <option value="" selected>Selecione...</option>
                        <?php
                        foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                            printf('<option value="%s"%s>%s</option>', $k, $info["get"]["filter_isPrivate"] == $k  ? ' selected="selected"' : '', $v);
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-outline-info btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Filtrar</button>
                <a class="btn btn-outline-success btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Tópico</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Resumo</th>
                    <th>Tópico Fixado</th>
                    <th>Tópico Privado</th>
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
                            <p class="col-lg-3 text-right"><?php print(($info["sr"] + 1) . " de " . $total) ?></p>
                        </div>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if ($total > 0) {
                    foreach ($data as $v) { ?>
                        <tr>
                            <td scope="row"><?php print($v["idx"]); ?></td>
                            <td><?php print($v["title"]); ?></td>
                            <td><?php print substr($v["resume"], 0, 80) . " ..."; ?></td>
                            <td><?php print($v["isFixed"] == "yes" ? "Sim" : "Não"); ?></td>
                            <td><?php print($v["isPrivate"] == "yes" ? "Sim" : "Não"); ?></td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="<?php print('forum/' . $v["idx"]); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                            </th>
                        </tr>
                    <?php
                    }
                } else {

                    ?>
                    <tr>
                        <td colspan="7">
                            <p class="alert alert-warning text-center">Nenhum tópico criado até o momento...</p>
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