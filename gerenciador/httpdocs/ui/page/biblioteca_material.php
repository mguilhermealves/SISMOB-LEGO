<!-- Container Begin -->
<div class="row">
    <div class="container-fluid">
        <div class="col-sm-12">
            <p class="h1">
                <span>
                    <?php print(isset($info["idx"]) && (int)$info["idx"] > 0 ? "Editar Material" : "Cadastrar Material") ?>
                </span>
            </p>
        </div>

        <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
            ?>
                <input type="hidden" id="done" name="done" value="<?php printf($GLOBALS["sublibrarycontext_url"], $material_id) ?>">
            <?php
            }
            ?>
            <?php
            if (isset($material_id)) {
            ?>
                <input type="hidden" id="libarycontexts_id" name="libarycontexts_id" value="<?php print($material_id) ?>">
            <?php
            }
            ?>
            <div class="col-sm-12 mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Título do material:</label>
                            <input type="text" class="form-control" name="name" id="" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" aria-describedby="helpTitle">
                            <small id="helpTitle" class="form-text text-muted">Titulo do material</small>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Conteúdo:</label>
                            <input type="text" class="form-control" name="" id="" value="<?php print( isset($data["libarycontexts_attach"][0] ) ? $data["libarycontexts_attach"][0]["name"] : "") ?>" aria-describedby="helpTitle" disabled>
                            <small id="helpTitle" class="form-text text-muted">Conteúdo do conteúdo</small>
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

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo do material:</label>
                                    <select class="form-control" name="type" id="">
                                        <?php
                                        foreach ($GLOBALS["type_materials_list"] as $key => $value) {
                                        ?>
                                            <option value="<?php print($key) ?>" <?php print(isset($data["type"]) && $data["type"] == $key ? "selected" : ""); ?>> <?php print($value) ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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