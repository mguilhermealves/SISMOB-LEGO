<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["foruns_url"]) ?>">Fórums</a> / <?php print(isset($data[0]["idx"]) ? "Editar Tópico: " . "<strong>" . $data[0]["title"] . "</strong>" : "Cadastrar Tópico") ?></p>
    <hr class="col-lg-11 mx-auto" />
    <form class="form-group col-lg-12 row" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
        <?php
        if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
        ?>
            <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
        <?php
        }
        ?>
        <div class="col-lg-12">
            <div class="form-group">
                <label><i class="fa fa-pencil" aria-hidden="true"></i> Título do Tópico <span style="color: red;">*</span></label>
                <input type="text" name="title" id="" class="form-control" value="<?php print(isset($data[0]["title"]) ? $data[0]["title"] : "") ?>">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label><i class="fa fa-comments-o" aria-hidden="true"></i> Resumo</label>
                <textarea class="form-control" name="resume" id="mytextarea" rows="10" cols="10"><?php print(isset($data[0]["resume"]) ? $data[0]["resume"] : "") ?></textarea>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label><i class="fa fa-picture-o" aria-hidden="true"></i> Imagem</label>
                <input type="file" class="form-control" name="image" id="" value="<?php print(isset($data[0]["image"]) ? $data[0]["image"] : "") ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="col-lg-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="isFixed" id="" value="yes" <?php print(isset($data[0]["isFixed"]) && $data[0]["isFixed"] == "yes" ? "checked" : "") ?>>
                        <i class="fa fa-exclamation" aria-hidden="true"></i> Definir tópico como Fixo
                    </label>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="isPrivate" id="" value="yes" <?php print(isset($data[0]["isPrivate"]) && $data[0]["isPrivate"] == "yes" ? "checked" : "") ?>>
                        <i class="fa fa-eye-slash" aria-hidden="true"></i> Tópico privado
                    </label>
                </div>
            </div>
        </div>

        <div class="col-lg-12 row mt-5">
            <div class="col-lg-6 text-left">
                <button type="button" name="btn_back" class="btn btn-outline-secondary btn-sm">Voltar</button>
            </div>
            
            <div class="col-lg-6 text-right">
                <button type="submit" name="btn_save" class="btn btn-outline-success btn-sm"><?php print(isset($data[0]["idx"]) ? "Salvar" : "Cadastrar Tópico") ?></button>
            </div>
        </div>
    </form>
</div>