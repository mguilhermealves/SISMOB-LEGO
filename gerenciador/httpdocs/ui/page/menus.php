<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6">Menus</p>
    <hr />
    <!-- Button trigger modal -->
    <form class="col-lg-12" id="frm_filter" method="GET" action="<?php print($form["pattern"]["search"]) ?>">
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
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="filter_profile">Grupo de Acesso:</label>
                    <select class="form-control " id="filter_profile" name="filter_profile">
                        <option value="0" <?php print(!isset($info["get"]["filter_profile"]) || $info["get"]["filter_profile"] == "" ? " selected" : "") ?> placeholder="Digite o Email">Selecione o grupo de acesso</option>
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
                <button id="btn_search" type="submit" class="btn btn-primary jss38 btn-block btn-sm"><i class="bi bi-search"></i> Filtrar</button>
            </div>
            <div class="col-lg-2">
                <label for="btn_add">&nbsp;</label>
                <a id="btn_add" class="btn btn-primary jss38 btn-block btn-sm" title="Adicionar" href="<?php print($form["pattern"]["new"]) ?>"><i class="bi bi-plus"></i> Adicionar Menu</a>
            </div>
        </div>
    </form>
    <hr />
    <!-- Container Begin -->
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Posição</th>
                    <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Nome <i class="<?php print($ordenation_name_ordenation) ?>"></i></a>
                    </th>
                    <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_profile))) ?>">Perfil Disponivel <i class="<?php print($ordenation_profile_ordenation) ?>"></i></a>
                    </th>
                    <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_link))) ?>">Link <i class="<?php print($ordenation_link_ordenation) ?>"></i></a>
                    </th>
                    <th>Ação</th>
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
                <?php foreach ($data as $k => $v) { ?>
                    <tr>
                        <td><?php print($v["position"]); ?></td>
                        <td><?php print($v["name"]); ?></td>
                        <td><?php print(isset($v["profiles_attach"][0]) ? implode(", ", array_column($v["profiles_attach"], "name")) : ""); ?></td>
                        <td><?php print($v["urls_attach"][0]["name"]); ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="<?php printf($form["pattern"]["action"], $v["idx"]) ?>"><i class="bi bi-pencil"></i> Editar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary" style="float:right" href="<?php print($form["pattern"]["new"]) ?>">[ incluir ]</a>
    </div>
</div>
<script>
    window.setTimeout(function() {
        jQuery("a[id^='btn_remove_']").on("click", function() {
            var target = jQuery(this);
            if (confirm('Confirma a exclusão do item ?')) {
                jQuery.ajax({
                    type: "POST",
                    url: jQuery(target).attr("href"),
                    data: {
                        'btn_remove': 'yes'
                    },
                    success: function() {
                        jQuery(jQuery(target).closest("tr")).remove()
                    }
                })
            }
            return false;
        })
    }, 1000);
</script>