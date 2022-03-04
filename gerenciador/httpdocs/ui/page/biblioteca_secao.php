<!-- Container Begin -->
<div class="row">
    <div class="container-fluid">
        <div class="col-sm-12">
            <p class="h1">
                <span>
                    <?php print(isset($info["idx"]) && (int)$info["idx"] > 0 ? "Editar Sub-Categoria" : "Cadastrar Sub-Categoria") ?>
                </span>
            </p>
        </div>

        <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
            ?>
                <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
            <?php
            }
            ?>
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="parent" id="helpParent">
                                <?php
                                foreach (biblioteca_secoes_controller::data4select("idx", array(" parent = 0 "), "name") as $k => $v) {
                                ?>
                                    <option value="<?php print($k) ?>" <?php isset($data["parent"]) && print($data["parent"] == $k ? "selected" : ""); ?>> <?php print($v) ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                            <small id="helpParent" class="form-text text-muted">Categoria</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Título Sub Categoria:</label>
                            <input type="text" class="form-control" name="name" id="" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" aria-describedby="helpTitle">
                            <small id="helpTitle" class="form-text text-muted">Titulo da categoria</small>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select" name="status" id="helpStatus">
                                <option <?php print(isset($data[0]["status"]) && print ($data[0]["status"]) == "Publicado" ? 'selected="selected"' : "") ?> value="Publicado">Publicado</option>
                                <option <?php print(isset($data[0]["status"]) && print ($data[0]["status"]) == "Rascunho" ? 'selected="selected"' : "") ?> value="Rascunho">Rascunho</option>
                                <option <?php print(isset($data[0]["status"]) && print ($data[0]["status"]) == "Arquivado" ? 'selected="selected"' : "") ?> value="Arquivado">Arquivado</option>
                            </select>
                            <small id="helpStatus" class="form-text text-muted">Status da publicação</small>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descrição da SubCategoria</label>
                                    <textarea class="form-control editor" name="description" id="" cols="5" rows="3"></textarea>
                                    <small id="helpIco" class="form-text text-muted">Selecione o icone da categoria</small>
                                </div>
                            </div>

                            <div class="col-sm-6">
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
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Cor de fundo:</label>
                                    <input type="color" class="form-control color" name="backgroundcolor" id="helpBackgroundcolor" value="#FF8800" aria-describedby="helpId" onclick="myFunction()" placeholder="">
                                    <small id="helpBackgroundcolor" class="form-text text-muted">Help text</small>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Cor selecionada:</label>
                                    <input type="text" class="form-control color" name="backgroundcolor" id="helpBackgroundcolor" value="#FF8800" aria-describedby="helpId" disabled>
                                    <small id="helpBackgroundcolor" class="form-text text-muted">Help text</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($info["idx"])) { ?>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12 mt-5 mb-5">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="h5">Conteúdos da subcategoria:</p>
                                </div>

                                <div class="col-sm-6 mb-2 text-right">
                                    <a class="btn btn-outline-success btn-sm" title="Adicionar" href="<?php printf($GLOBALS["newsublibrarycontext_url"], $data["idx"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar novo conteúdo</a>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <table class="table table-striped table-inverse">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>ID</th>
                                                <th>Conteúdo</th>
                                                <th>Sub-Categoria</th>
                                                <th>Criado em</th>
                                                <th>Última Atualização</th>
                                                <th>Status</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $contexts = isset( $data["libarycontexts_attach"] ) ? $data["libarycontexts_attach"] : [];

                                            if (isset( $contexts ) ) {

                                                foreach ($contexts as $k => $context) { ?>
                                                    <tr>
                                                        <td scope="row"><?php print($context["idx"]); ?></td>
                                                        <td><?php print($context["name"]); ?></td>
                                                        <td><?php print($data["name"]); ?></td>
                                                        <td><?php print($context["published_at"]); ?></td>
                                                        <td><?php print($context["modified_at"]); ?></td>
                                                        <td><?php print($context["status"]); ?></td>
                                                        <td>
                                                            <a class="btn button btn-info btn-sm" href="<?php printf( $GLOBALS["sublibrarycontext_url"] , $context["idx"] ) ?>">Editar</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7">
                                                        <p class="alert alert-warning text-center">Nenhum conteúdo da subcategoria criada até o momento...</p>
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