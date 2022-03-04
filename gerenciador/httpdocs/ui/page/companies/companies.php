<main>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-12 mt-5 mb-5 text-right">
                        <a name="" id="" class="btn btn-info btn-sm" href="/cadastrar_empresa" role="button"><i class="bi bi-plus-circle"></i> Nova Empresa</a>
                    </div>

                    <div class="col-12 mt-4 mb-4 text-center">
                        <h1 class="display-4">Listagem de Empresas</h1>
                    </div>

                    <div class="col-12 mb-5">
                        <form class=" margin-right-0" id="frm_filter" method="GET" action="<?php print($form["pattern"]["search"]) ?>">
                            <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
                            <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
                            <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Razão Social</label>
                                        <input type="text" name="filter_first_name" id="" class="form-control" value="<?php print(isset($info["get"]["filter_first_name"]) ? $info["get"]["filter_first_name"] : "") ?>" placeholder="">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">CNPJ</label>
                                        <input type="text" name="filter_cpf" id="" class="form-control" value="<?php print(isset($info["get"]["filter_last_name"]) ? preg_replace("/(.+)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\D+?/", "", $info["get"]["filter_cpf"])) : "") ?>" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-2 padding-top-20 columns">
                                    <button type="submit" class="btn btn-info btn-sm"><i class="bi bi-search"></i> Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12" style="overflow: auto;">
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_positions))) ?>">Código <i class="<?php print($ordenation_positions_ordenation) ?>"></i></a></th>
                                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_trail))) ?>">Nome <i class="<?php print($ordenation_trail_ordenation) ?>"></i></a></th>
                                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_modifiedat))) ?>">CNPJ <i class="<?php print($ordenation_modifiedat_ordenation) ?>"></i></a></th>
                                    <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_trail_status))) ?>">Ações <i class="<?php print($ordenation_trail_status_ordenation) ?>"></i></a></th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="5">
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
                                foreach ($data as $key => $company) { ?>
                                    <tr>
                                        <td scope="row"><?php strlen($company["idx"]) <= 10 ? print("00" . $company["idx"]) : print("0" . $company["idx"]) ?></td>
                                        <td><?php print($company["name"]) ?></td>
                                        <td><?php print($company["CNPJ"]) ?></td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary btn-sm" href="/empresa/<?php print($company["idx"]) ?>" role="button"><i class="bi bi-pencil-square"></i> Editar</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>