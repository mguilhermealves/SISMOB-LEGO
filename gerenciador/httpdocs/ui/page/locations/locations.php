<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Locações</p>
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
                    <label for="filter_name">Primeiro Nome:</label>
                    <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="form-control" placeholder="Digite o Nome">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_cpf">CPF:</label>
                    <input type="text" id="filter_cpf" class="form-control" name="filter_cpf" value="<?php print(isset($info["get"]["filter_cpf"]) ? $info["get"]["filter_cpf"] : "") ?>" class="form-control" placeholder="Digite o CPF">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_district">Bairro:</label>
                    <input type="text" id="filter_district" class="form-control" name="filter_district" value="<?php print(isset($info["get"]["filter_district"]) ? $info["get"]["filter_district"] : "") ?>" class="form-control" placeholder="Digite o Bairro">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_uf">UF</label>
                    <select name="filter_uf" id="filter_uf" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                            printf('<option %s value="%s">%s</option>', isset($info["get"]["filter_uf"]) && $k == $info["get"]["filter_uf"] ? ' selected' : '', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_contract">N° Contrato:</label>
                    <input type="text" id="filter_contract" class="form-control" name="filter_contract" value="<?php print(isset($info["get"]["filter_contract"]) ? $info["get"]["filter_contract"] : "") ?>" class="form-control" placeholder="Digite o n° do contrato">
                </div>
            </div>

            <div class="col-sm-2">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary btn-block btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
            </div>
            <div class="col-sm-2">
                <label for="btn_add">&nbsp;</label>
                <a id="btn_add" class="btn btn-outline-primary btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="bi bi-plus-circle"></i> Nova Locação</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Id</th>
                    <th>Nome do Locatário</th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_address))) ?>">Endereço <i class="<?php print($ordenation_address_ordenation) ?>"></i></a></th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Aprovado</th>
                    <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_ncontract))) ?>">N° Contrato <i class="<?php print($ordenation_ncontract_ordenation) ?>"></i></a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="8">
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
                            <td><?php print($v["first_name"] . " " . $v["last_name"]); ?></td>
                            <td><?php print($v["address"] . ", N° " . $v["number_address"]); ?></td>
                            <td><?php print($v["city"]); ?></td>
                            <td><?php print($v["uf"]); ?></td>
                            <td>
                                <?php
                                if ($v["is_aproved"] == "reproved" || $v["is_aproved"] == "pending") {
                                    print("Não");
                                } else {
                                    print("Sim");
                                }
                                ?>
                            </td>
                            <td><?php print($v["n_contract"]); ?></td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="/locacao/<?php print($v["idx"]) ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                            </th>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8">
                            <p class="alert alert-warning text-center">Nenhuma locação encontrada...</p>
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