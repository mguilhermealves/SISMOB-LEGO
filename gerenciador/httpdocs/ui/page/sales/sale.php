<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print(set_url($info["get"]["done"])) ?>">Vendas</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Pesquisar Imóvel</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Digite o nome do Proprietário:</label>
                                    <input type="text" class="form-control properties_search" value="<?php print(isset($data["properties_attach"][0]["users_attach"][0]) ? $data["properties_attach"][0]["users_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["users_attach"][0]["last_name"] . " (" . $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]] . ") " . " - Endereço: " . $data["properties_attach"][0]["address"] . ", N° " . $data["properties_attach"][0]["number_address"] . ", " . $data["properties_attach"][0]["complement"] . ", " . $data["properties_attach"][0]["code_postal"] . ", " . $data["properties_attach"][0]["district"] . ", " . $data["properties_attach"][0]["city"] . " - " . $data["properties_attach"][0]["uf"] : '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Pesquisar Comprador</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Digite o nome do Comprador:</label>
                                    <input type="text" class="form-control buyers_search" value="<?php print(isset($data["users_attach"][0]) ? $data["users_attach"][0]["first_name"] . " " . $data["users_attach"][0]["last_name"] . " (" . preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $data["users_attach"][0]["cpf"]) . ") " : "") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <input id="users_id" type="hidden" name="users_id" value="<?php print($data["users_attach"][0]["idx"]); ?>" required>
                    <input id="properties_id" type="hidden" name="properties_id" value="<?php print($data["properties_attach"][0]["idx"]); ?>" required>

                    <!-- Dados da Venda -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados da Venda</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <label>Valor Venda</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" id="price_sale" name="price_sale" value="<?php print(isset($data["properties_attach"][0]) ? number_format($data["properties_attach"][0]["price_sale"], 2, ".", ",") : "") ?>" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="is_apartmant">
                                            <div class="form-group">
                                                <label>Valor do Condominio</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" id="" name="price_condominium" value="<?php print(isset($data["properties_attach"][0]) ? number_format($data["properties_attach"][0]["price_condominium"], 2, ".", ",") : "") ?>" class="form-control price_condominium" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="object_propertie">Objetivo do Imovel</label>
                                                <select name="object_propertie" id="" class="form-control object_propertie" disabled>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["properties_attach"][0]["object_propertie"]) && $k == $data["properties_attach"][0]["object_propertie"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_propertie">Tipo de Propriedade</label>
                                                <select name="type_propertie" id="" class="form-control type_propertie" disabled>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["propertie_types"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["properties_attach"][0]["type_propertie"]) && $k == $data["properties_attach"][0]["type_propertie"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_work">Forma de Pagamento</label>
                                                <select name="payment_method" id="payment_method_sale" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["payment_method"]) && $k == $data["payment_method"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aprovação -->
                    <?php
                    if (isset($data["is_aproved"]) && $data["is_aproved"] == 'pending') { ?>
                        <div class="modal-content" id="status">
                            <div class="modal-header label">
                                <h5 class="modal-title ">Status da Locação</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="is_aproved">Status</label>
                                                    <select name="is_aproved" id="is_aproved" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["status_location"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["is_aproved"]) && $k == $data["is_aproved"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="n_contract">N° de Contrato</label>
                                                    <input id="n_contract" type="text" class="form-control" name="n_contract" value="<?php print(isset($data["n_contract"]) ? $data["n_contract"] : "") ?>" disabled>
                                                    <!-- <button type="button" id="download_contract" data-idlocation="<?php print($data["idx"]) ?>" class="btn btn-outline-primary btn-sm">Download Contrato</button> -->
                                                </div>
                                            </div>

                                            <div class="col-lg-12" id="text_reproved">
                                                <div class="form-group">
                                                    <label>Motivo da Reprovação</label>
                                                    <textarea name="comments" id="comments" rows="5" cols="100" style="overflow: auto; resize: none;"></textarea>
                                                </div>
                                            </div>

                                            <?php if (!empty($data["partners_attach"]["file"]) && file_exists(constant("cRootServer") . $data["partners_attach"]["file"])) { ?>
                                                <img class="img-fluid" src="/<?php print($data["partners_attach"]["file"]) ?>" />
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-sm-12 text-right">
                        <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print(isset($data["idx"]) ? "Salvar" : "Cadastrar") ?></button>
                    </div>
                </form>
            </div>
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
</style>