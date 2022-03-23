<div class="row">
    <p class="mb-0 col-lg-12">
        <a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["profiles_url"]) ?>">Perfis</a> / <?php print($form["title"]) ?>
    </p>
    <div class="container-fluid box solaris-head">
        <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
            <?php
            if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
            ?>
                <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
            <?php
            }
            ?>

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Dados</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input placeholder="Nome do Perfil" id="name" type="text" class="form-control" name="name" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Descrição:</label>
                                    <textarea class="form-control editor" name="description" id="description" rows="3"><?php print(isset($data["description"]) ? $data["description"] : "") ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                <div class="large-4 columns">
                    <a href="<?php print($info["get"]["done"]) ?>" class="btn btn-default btn-sm">Voltar</a>
                </div>
                <div class="large-7 columns">
                    <button type="submit" class="pull-right btn btn-primary btn-sm" name="btn_save">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .bxs_user {
        border: 1px solid #0A4C80;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        padding: 0px
    }

    .bxs_user .header {
        background-color: #0A4C80;
        color: #FFFFFF;
        padding: 5px 5px;
        font-size: 1.52rem;
    }
</style>