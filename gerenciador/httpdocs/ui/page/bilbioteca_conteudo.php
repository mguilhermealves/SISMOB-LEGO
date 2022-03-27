<!-- Container Begin -->
<div class="row">
    <div class="container-fluid">
        <div class="col-sm-12">
            <p class="h1">
                <span>
                    <?php print(!isset($secao_id) ? "Editar Conteúdo" : "Cadastrar Conteúdo") ?>
                </span>
            </p>
        </div>

        <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
            ?>
                <input type="hidden" id="done" name="done" value="<?php printf($GLOBALS["new_sublibrary_url"], $secao_id) ?>">
            <?php
            }
            ?>
            <?php
            if (isset($secao_id)) {
            ?>
                <input type="hidden" id="libarysections_id" name="libarysections_id" value="<?php print($secao_id) ?>">
            <?php
            }
            ?>
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Título do conteúdo:</label>
                            <input type="text" class="form-control" name="name" id="" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" aria-describedby="helpTitle">
                            <small id="helpTitle" class="form-text text-muted">Titulo do conteúdo</small>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Categoria:</label>
                            <input type="text" class="form-control" name="" id="" value="<?php print(isset($data["libarysections_attach"][0]["name"]) ? $data["libarysections_attach"][0]["name"] : "") ?>" aria-describedby="helpTitle" disabled>
                            <small id="helpTitle" class="form-text text-muted">Titulo da categoria</small>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select" name="status" id="helpStatus">
                                <option <?php print(isset($data["status"]) && print ($data["status"]) == "Publicado" ? 'selected="selected"' : "") ?> value="Publicado">Publicado</option>
                                <option <?php print(isset($data["status"]) && print ($data["status"]) == "Rascunho" ? 'selected="selected"' : "") ?> value="Rascunho">Rascunho</option>
                                <option <?php print(isset($data["status"]) && print ($data["status"]) == "Arquivado" ? 'selected="selected"' : "") ?> value="Arquivado">Arquivado</option>
                            </select>
                            <small id="helpStatus" class="form-text text-muted">Status da publicação</small>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Descrição da Sub Categoria</label>
                                    <textarea class="form-control editor" name="description" id="" cols="5" rows="3"><?php print(isset($data["description"]) ? $data["description"] : "") ?></textarea>
                                </div>
                            </div>

                            <div class="col-sm-3 mt-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="is_destak" id="" value="yes" <?php print(isset($data["is_destak"]) && $data["is_destak"] == "yes" ? "checked" : "") ?>>
                                        Conteúdo em destaque
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Capa para subcategoria</label>
                                    <input type="file" class="form-control" name="ico" id="" aria-describedby="helpIco" placeholder="">
                                    <small id="helpIco" class="form-text text-muted">Selecione a capa para subcategoria</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Data de publicação:</label>
                                    <input type="text" class="form-control datepicker" name="published_at" id="" value="<?php print(isset($data["published_at"]) ? date('d/m/Y', strtotime($data["published_at"])) : "") ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($data["libaryfiles_attach"])) { ?>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12 mt-5 mb-5">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="h5">Materiais:</p>
                                </div>

                                <div class="col-sm-6 mb-2 text-right">
                                    <a class="btn btn-outline-success btn-sm" title="Adicionar" href="<?php printf($GLOBALS["newlibraryfile_url"], $data["idx"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar novo material</a>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <table class="table table-striped table-inverse">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>ID</th>
                                                <th>Material</th>
                                                <th>Conteúdo</th>
                                                <th>Criado em</th>
                                                <th>Última Atualização</th>
                                                <th>Status</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $materials = isset( $data["libaryfiles_attach"] ) && $data["libaryfiles_attach"] > 1 ? $data["libaryfiles_attach"] : [];

                                            if ($materials) {

                                                foreach ($materials as $k => $material) { ?>
                                                    <tr>
                                                        <td scope="row"> <?php printf($material["idx"]) ?> </td>
                                                        <td><?php print($material["name"]) ?></td>
                                                        <td><?php print($data["name"]) ?></td>
                                                        <td><?php print(date( 'd/m/Y', strtotime( $material["created_at"] ) ) ) ?></td>
                                                        <td><?php isset($material["modified_at"]) ? print(date( 'd/m/Y', strtotime( $material["modified_at"] ) ) ) : "" ?></td>
                                                        <td><?php print($material["status"]) ?></td>
                                                        <td>
                                                            <a class="btn button btn-info" href="<?php printf($GLOBALS["libraryfile_url"], $material["idx"]) ?>">Editar</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7">
                                                        <p class="alert alert-warning text-center">Nenhum material criado até o momento...</p>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="col-sm-12">
                        <hr>
                    </div>

                    <div class="col-sm-12 mt-5">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" name="btn_save" class="btn btn-outline-success btn-sm"><?php print(isset($data[0]["idx"]) ? "Editar" : "Salvar") ?></button>
                                <button type="button" name="btn_back" class="btn btn-outline-secondary btn-sm">Voltar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .color {
        height: 35px;
        /* border: none; */
        /* padding: 5px; */
        /* background-color: #fff; */
        cursor: pointer;
        width: 40%;
    }

    .color:focus {
        box-shadow: 0 0 0 0;
        border: 0 none;
        outline: 0;
    }
</style>