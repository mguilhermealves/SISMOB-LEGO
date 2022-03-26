<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Contas a Pagar</p>
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
                    <label for="filter_company">Empresa Beneficiária:</label>
                    <input type="text" id="filter_company" class="form-control" name="filter_company" value="<?php print(isset($info["get"]["filter_company"]) ? $info["get"]["filter_company"] : "") ?>" class="form-control" placeholder="Digite o Nome">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_value">Valor:</label>
                    <input type="text" id="filter_value" class="form-control" name="filter_value" value="<?php print(isset($info["get"]["filter_value"]) ? $info["get"]["filter_value"] : "") ?>" class="form-control" placeholder="Digite o Valor">
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_payment">Método de Pagamento</label>
                    <select name="filter_payment" id="filter_payment" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["payment_method"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label for="filter_status">Status</label>
                    <select name="filter_status" id="filter_status" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["payment_status"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                
            </div>

            <div class="col-sm-3">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
            </div>
            <div class="col-sm-3">
                <label for="btn_add">&nbsp;</label>
                <a id="btn_add" class="btn btn-outline-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="bi bi-plus-circle"></i> Novo Pagamento</a>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Id</th>
                    <th>Empresa Beneficiária</th>
                    <!-- <th><a style="color:#707070; text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Endereço <i class="<?php print($ordenation_name_ordenation) ?>"></i></a></th> -->
                    <th>Centro de Custo</th>
                    <th>Forma de Pagamento</th>
                    <th>Valor (R$)</th>
                    <th>Status</th>
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
                            <td><?php print($v["company_beneficiary"]); ?></td>
                            <!-- <td><?php print($v["address"] . ", N° " . $v["number_address"]); ?></td> -->
                            <td><?php print(str_pad($v["cost_center_attach"][0]["idx"], 3, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php print($GLOBALS["payment_method"][$v["payment_method"]]); ?></td>
                            <td class="money"><?php print($v["amount"]); ?></td>
                            <td><?php print($GLOBALS["payment_status"][$v["status_payment"]]); ?></td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="/conta-a-pagar/<?php print($v["idx"]) ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                            </th>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">
                            <p class="alert alert-warning text-center">Nenhum pagamento encontrado...</p>
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