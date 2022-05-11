<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Contas a Receber</p>
    <hr class="col-lg-11 mx-auto" />

    <!-- Button trigger modal -->
    <form class="col-lg-12 mb-4" id="frm_filter" method="GET" action="<?php print($form["pattern"]["search"]) ?>">
        <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
        <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
        <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_start_date">Data Inicio:</label>
                    <input type="date" id="filter_start_date" class="form-control" name="filter_start_date" value="<?php print(isset($info["get"]["filter_start_date"]) ? $info["get"]["filter_start_date"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o CPF">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_end_date">Data Fim:</label>
                    <input type="date" id="filter_end_date" class="form-control" name="filter_end_date" value="<?php print(isset($info["get"]["filter_end_date"]) ? $info["get"]["filter_end_date"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o CPF">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_name">Nome:</label>
                    <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_cpf">CPF:</label>
                    <input type="text" id="filter_cpf" class="form-control document" name="filter_cpf" value="<?php print(isset($info["get"]["filter_cpf"]) ? $info["get"]["filter_cpf"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o CPF">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_status">Status:</label>
                    <select name="filter_status" id="filter_status" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["payment_status_gerencianet"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_type">Tipo de Propriedade:</label>
                    <select name="filter_type" id="filter_type" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                            printf('<option value="%s">%s</option>', $k, $v);
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="filter_district">N° Contrato:</label>
                    <input type="text" id="filter_contract" class="form-control" name="filter_contract" value="<?php print(isset($info["get"]["filter_contract"]) ? $info["get"]["filter_contract"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o N° do contrato">
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="form-group">
                    <label for="">Valor total:</label>
                    <input type="text" id="total_amount" class="form-control" name="total_amount" value="<?php print("R$ " . number_format($total_amount, 2, ",", ".")); ?>" class="form-control" disabled>
                </div>
            </div>

            <div class="col-sm-12 col-lg-2">
                <label for="btn_export">&nbsp;</label>
                <button id="btn_export" type="submit" class="btn btn-outline-primary btn-block btn-sm"><i class="bi bi-file-excel"></i> Exportar</button>
            </div>

            <div class="col-sm-12 col-lg-2">
                <label for="btn_search">&nbsp;</label>
                <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm"><i class="bi bi-search"></i> Filtrar</button>
            </div>
        </div>
    </form>
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>N° Contrato</th>
                    <th>Nome</th>
                    <th>Objetivo do Imovel</th>
                    <th>Forma de Pagamento</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Status</th>
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
                            <td><?php print($v["locations_attach"][0]["n_contract"]); ?></td>
                            <td><?php print($v["locations_attach"][0]["first_name"] . " " . $v["locations_attach"][0]["last_name"]); ?></td>
                            <td><?php print($GLOBALS["propertie_objects"][$v["locations_attach"][0]["properties_attach"][0]["object_propertie"]]); ?></td>
                            <td><?php print($GLOBALS["payment_method"][$v["payment_method"]]); ?></td>
                            <td><?php print("R$ " . number_format($v["amount"], 2, ".", ",")); ?></td>
                            <td><?php print(date_format(new DateTime($v["expire_at"]), "d/m/Y")); ?></td>
                            <td><?php print($GLOBALS["payment_status_gerencianet"][$v["status"]]); ?></td>
                            <th>
                                <a type="button" class="btn btn-outline-primary btn-sm" href="<?php printf(  $form["pattern"]["action"] , $v["idx"] ) ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                            </th>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8">
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

<script>
    //export
    window.setTimeout(function() {
        jQuery("#btn_export").on("click", function() {
            jQuery("#frm_filter").prop({
                "action": "<?php print(set_url($GLOBALS["accounts_receivables_url"] . ".xls", $info["get"])) ?>"
            }).submit();
        })
    }, 1000);

    //filter
    window.setTimeout(function() {
        jQuery("#btn_search").on("click", function() {
            jQuery("#frm_filter").prop({
                "action": "<?php print(set_url($GLOBALS["accounts_receivables_url"])) ?>"
            }).submit();
        })
    }, 1000);
</script>

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