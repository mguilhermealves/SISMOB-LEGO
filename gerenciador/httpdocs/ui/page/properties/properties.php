<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Imóveis</p>
    <hr class="col-lg-11 mx-auto" />

    <!-- Button trigger modal -->
    <form class="col-lg-12 mb-4" id="frm_filter" method="GET" action="<?php print($form["pattern"]["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
            <div class="col-sm-12">
                <p class="h6 text-blue">Filtros de Busca:</p>
                <hr>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_name">Nome do Proprietário:</label>
                    <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_cpf">CPF do Proprietário:</label>
                    <input type="text" id="filter_cpf" class="form-control" name="filter_cpf" value="<?php print(isset($info["get"]["filter_cpf"]) ? $info["get"]["filter_cpf"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o CPF">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_address">Endereço do Imóvel:</label>
                    <input type="text" id="filter_address" class="form-control" name="filter_address" value="<?php print(isset($info["get"]["filter_address"]) ? $info["get"]["filter_address"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Endereço">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_district">Bairro do Imóvel:</label>
                    <input type="text" id="filter_district" class="form-control" name="filter_district" value="<?php print(isset($info["get"]["filter_district"]) ? $info["get"]["filter_district"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Bairro">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_uf">UF do Imóvel</label>
                    <select name="filter_uf" id="filter_uf" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_object_propertie">Objetivo da Propriedade</label>
                    <select name="filter_object_propertie" id="filter_object_propertie" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-8">

            </div>

            <div class="col-sm-2">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
            </div>
            <div class="col-sm-2">
                <label for="btn_add">&nbsp;</label>
                <a id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="bi bi-plus-circle"></i> Novo Imóvel</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <?php html_notification_print(); ?>
        
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Código</th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_address))) ?>">Endereço <i class="<?php print($ordenation_address_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_district))) ?>">Bairro <i class="<?php print($ordenation_district_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_city))) ?>">Cidade <i class="<?php print($ordenation_city_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_uf))) ?>">UF <i class="<?php print($ordenation_uf_ordenation) ?>"></i></a></th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_objective))) ?>">Objetivo <i class="<?php print($ordenation_objective_ordenation) ?>"></i></a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="row col-lg-12">
                            <div class="col-lg-3 form-group">
                                <select class="form-control" id="select_paginage" class="col-lg-3 ">
                                    <option <?php print($paginate == 20 ? 'selected="selected"' : '') ?> value="20">20</option>
                                    <option <?php print($paginate == 50 ? 'selected="selected"' : '') ?> value="50">50</option>
                                    <option <?php print($paginate == 100 ? 'selected="selected"' : '') ?> value="100">100</option>
                                </select>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-center form-group text-center">
                                <button type="button" id="btn_sr_first" class=" btn ">|<< /button>
                                        <button type="button" id="btn_sr_previus" class=" btn ">
                                            << /button>
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
                            <td><?php print($v["idx"]); ?></td>
                            <td><?php print($v["address"] . ", N° " . $v["number_address"]); ?></td>
                            <td><?php print($v["district"]); ?></td>
                            <td><?php print($v["city"]); ?></td>
                            <td><?php print($v["uf"]); ?></td>
                            <td>
                                <?php
                                if ($v["object_propertie"] == "location") {
                                    print("Locação");
                                } else {
                                    print("Venda");
                                }
                                ?>
                            </td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="/imovel/<?php print($v["idx"]) ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                                <a class="btn btn-outline-danger btn-sm" id="btn_remove_<?php print($v["idx"]) ?>" href="<?php printf($form["pattern"]["action"], $v["idx"]) ?>"><i class="bi bi-x-circle"></i> Excluir</a>
                            </th>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">
                            <p class="alert alert-warning text-center">Nenhum imovel encontrado...</p>
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

    .text-blue {
        color: blue !important;
    }
</style>