<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["properties_url"]) ?>">Imoveis</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input id="name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Sobrenome</label>
                                        <input id="name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">E-mail</label>
                                        <input id="name" type="email" class="form-control" name="mail" value="<?php print(isset($data["mail"]) ? $data["mail"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">CPF</label>
                                        <input id="name" type="text" class="form-control" name="document" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">RG</label>
                                        <input id="name" type="text" class="form-control" name="rg" value="<?php print(isset($data["rg"]) ? $data["rg"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">CNH</label>
                                        <input id="name" type="text" class="form-control" name="cnh" value="<?php print(isset($data["cnh"]) ? $data["cnh"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Telefone</label>
                                        <input id="phone" type="text" class="form-control" name="phone" value="<?php print(isset($data["phone"]) ? $data["phone"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Celular</label>
                                        <input id="celphone" type="text" class="form-control" name="celphone" value="<?php print(isset($data["celphone"]) ? $data["celphone"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">CEP</label>
                                        <input id="code_postal" type="text" class="form-control" name="code_postal" value="<?php print(isset($data["code_postal"]) ? $data["code_postal"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Endereço</label>
                                        <input id="address" type="text" class="form-control" name="address" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Numero</label>
                                        <input type="text" class="form-control" name="number_address" value="<?php print(isset($data["number_address"]) ? $data["number_address"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Complemento</label>
                                        <input type="text" class="form-control" name="complement" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Bairro</label>
                                        <input id="district" type="text" class="form-control" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Cidade</label>
                                        <input id="city" type="text" class="form-control" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="uf">UF</label>
                                        <select name="uf" id="uf" class="form-control">
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                                printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dados do Imovel -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="object_propertie">Objetivo do Imovel</label>
                                            <select name="object_propertie" id="object_propertie" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="type_propertie">Tipo de Propriedade</label>
                                            <select name="type_propertie" id="type_propertie" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["propertie_types"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["type_propertie"]) && $k == $data["type_propertie"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" id="configs">
                                        <div class="row">
                                            <div class="col-lg-4" name="location">
                                                <label>Valor Locação</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" name="price_location" class="form-control money" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-4" name="sale">
                                                <label>Valor Venda</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" name="price_sale" class="form-control money" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <label>Valor IPTU</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" name="price_iptu" class="form-control money" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="is_apartmant">
                                                <div class="form-group">
                                                    <label>Valor do Condominio</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">R$</span>
                                                        </div>
                                                        <input type="text" name="price_condominium" class="form-control money" autofocus>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="sale">
                                                <label>Valor do Imóvel</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" name="price_propertie" class="form-control money" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="sale">
                                                <label>Valor da Comissão</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">%</span>
                                                    </div>
                                                    <input type="text" name="porcent_propertie" class="form-control percent" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="location">
                                                <div class="form-group">
                                                    <label for="deadline_contract">Prazo Contrato</label>
                                                    <select name="deadline_contract" id="deadline_contract" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["deadline_contract"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="sale">
                                                <div class="form-group">
                                                    <label for="financial_propertie">Aceita Financiamento</label>
                                                    <select name="financial_propertie" id="financial_propertie" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="is_financer">
                                                <div class="form-group">
                                                    <label>Nome da Financiadora</label>
                                                    <input type="text" name="financer_name" class="form-control" autofocus>
                                                </div>
                                            </div>

                                            <div class="col-lg-3" name="sale">
                                                <div class="form-group">
                                                    <label for="is_swap">Aceita Troca</label>
                                                    <select name="is_swap" id="is_swap" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["uf"]) && $k == $data["uf"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-9" name="text_exchange">
                                                <div class="form-group">
                                                    <label>Informações Complementares</label>
                                                    <textarea name="comments" id="comments" rows="5" cols="100" style="overflow: auto; resize: none;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fotos -->
                <div class="modal-content" id="conjuge">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Fotos do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="file">Fotos (.jpg, .png, .jpeg)</label>
                                            <input type="file" id="file" name="images[]" class="form-control">
                                        </div>
                                    </div>

                                    <?php if (!empty($data["file"]) && file_exists(constant("cRootServer") . $data["file"])) { ?>
                                        <img class="img-fluid" src="/<?php print($data["file"]) ?>" />
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documentação -->
                <div class="modal-content" id="conjuge">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Documentação do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="file">Documentação (.pdf)</label>
                                            <input type="file" id="file" name="docs[]" class="form-control">
                                        </div>
                                    </div>

                                    <?php if (!empty($data["file"]) && file_exists(constant("cRootServer") . $data["file"])) { ?>
                                        <img class="img-fluid" src="/<?php print($data["file"]) ?>" />
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <?php if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) { ?>
                        <a href="<?php print($info["get"]["done"]); ?>" class="btn btn-outline-secondary btn-sm">Voltar</a>
                    <?php } ?>
                </div>

                <div class="col-sm-6 text-right">
                    <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print(isset($data["idx"]) ? "Editar" : "Salvar") ?></button>
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
</style>