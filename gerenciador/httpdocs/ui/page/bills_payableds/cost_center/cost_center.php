<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["account_pay_categories_url"]) ?>">Contas a Pagar</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Pesquisar Categoria</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Pesquisar Categoria:</label>
                                        <small class="text-muted">Digite o nome da Categoria</small>
                                        <input class="form-control categories_search" value="<?php print(isset($data["categories_attach"][0]) ? $data["categories_attach"][0]["name"] . " " . $data["categories_attach"][0]["name"] : '') ?>">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Categoria selecionada:</label>
                                        <strong id="categorie_name" style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php print(isset($data["categories_attach"][0]) ? $data["categories_attach"][0]["name"] : "") ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                <?php
                if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                ?>
                    <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                <?php
                }
                ?>

                <input type="hidden" id="cod_category" name="cod_category">

                <!-- Dados do Locatário -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Centro de Custo</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cost_center">N° Centro de Custo</label>
                                            <input id="cost_center" type="text" class="form-control" name="cost_center" value="<?php print(isset($data["idx"]) ? str_pad($data["idx"], 3, '0', STR_PAD_LEFT) : "") ?>" disabled>
                                            <input id="cost_center" type="hidden" class="form-control" name="cost_center" value="<?php print(isset($data["idx"]) ? $data["idx"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Nome do Centro de Custo:</label>
                                            <input id="name" type="text" class="form-control" name="name" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="comments">Observação</label>
                                            <input id="comments" type="text" class="form-control editor" name="comments" value="<?php print(isset($data["comments"]) ? $data["comments"] : "") ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 text-right">
                    <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print(isset($data["idx"]) ? "Salvar" : "Cadastrar") ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .blockquote p {
        color: rgb(85, 85, 85);
        font-size: 25px;
        font-weight: 600;
        font-family: Montserrat;
    }

    #atividades-tab {
        color: #FFFFFF;
        padding: 8px 16px;
        font-size: 16px;
        background: #077111;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 5px 5px 0px 0px;
    }

    #myTabContent {
        box-shadow: rgb(85 85 85) 0px 0px 3px;
        border-top: 10px solid rgb(7, 113, 17);
    }

    #helpId ul {
        position: relative;
        right: 35px;
    }

    #helpId li {
        list-style: none;
    }

    .bt.btn-primar.btn-sm {
        color: #FFFFFF;
        border: none;
        cursor: pointer;
        padding: 5px 30px;
        font-size: 16px;
        background: #077111;
        transition: all 400ms ease-in-out;
        font-weight: 600;
        border-radius: 5px 5px 0px 0px;
    }

    .label {
        padding: 4px 20px;
        position: relative;
        background: #999;
        box-shadow: #3d3d3f 0px -4px 3px -2px;
        transition: all 200ms ease-in-out;
        border-radius: 10px 10px 0px 0px;
        margin-bottom: 0px;
        color: #e8e8e8;
        font-size: 18px;
        font-weight: 600;
    }

    .modal-content {
        margin-bottom: 12px;
    }

    .modal-body {
        border: 1px solid #999;
        margin-bottom: 16px;
    }

    .bottom-green-reverse {
        display: inline-block;
        color: #999;
        cursor: pointer;
        border: 1px solid #999;
        padding: 5px 30px;
        text-align: center;
        background-color: #FFFFFF;
        align-items: center;
        font-weight: 600;
        border-radius: 5px 5px 5px 5px;
    }

    a:link {
        text-decoration: none;
    }

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

    .modal-lg {
        max-width: 80%;
    }

    .autocomplete-suggestions {
        background-color: #fff;
    }

    .autocomplete-suggestion {
        border-bottom: 1px solid #000;
    }
    .autocomplete-suggestion:hover {
        background-color: #9cb3f1;
    }
</style>