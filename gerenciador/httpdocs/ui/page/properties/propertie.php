<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print(set_url($info["get"]["done"])) ?>">Imoveis</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Pesquisar Proprietario</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Pesquisar Proprietario:</label>
                                    <small class="text-muted">Digite o nome ou email do Proprietario</small>
                                    <input type="text" class="form-control clients_search" value="<?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["first_name"] . " " . $data["clients_attach"][0]["last_name"] : '') ?>">
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

                <input type="hidden" id="clients_id" name="clients_id" value="<?php print($data["clients_attach"][0]["idx"]); ?>" required>

                <!-- Dados do Proprietário -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Proprietário</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nome:</label>
                                        <strong id="clients_first_name"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["first_name"] : "") ?></strong>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Sobrenome:</label>
                                        <strong id="clients_last_name"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["last_name"] : "") ?></strong>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">E-mail:</label>
                                        <strong id="clients_mail"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["mail"] : "") ?></strong>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">CPF:</label>
                                        <strong class="document" id="clients_document"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["document"] : "") ?></strong>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Telefone</label>
                                        <strong id="clients_phone"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["phone"] : "") ?></strong>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Celular</label>
                                        <strong id="clients_celphone"><?php print(isset($data["clients_attach"][0]) ? $data["clients_attach"][0]["celphone"] : "") ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Endereço do Imovel -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Endereço do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
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
                </div>

                <!-- Dados do Imovel -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Imovel <?php if (isset($data["idx"]) && $data["idx"] > 0) {
                                                                        print("N° " . $data["idx"]);
                                                                    } ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="object_propertie">Objetivo do Imovel</label>
                                            <select name="object_propertie" id="object_propertie" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["object_propertie"]) && $k == $data["object_propertie"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dados da Locação ou Venda -->
                <div class="modal-content" id="configs">
                    <div class="modal-header label" id="location">
                        <h5 class="modal-title ">Dados da Locação</h5>
                    </div>
                    <div class="modal-header label" id="sale">
                        <h5 class="modal-title ">Dados da Venda</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-4" id="location">
                                        <label>Valor Locação</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">R$</span>
                                            </div>
                                            <input type="text" name="price_location" id="price_location" class="form-control money" value="<?php print(isset($data["price_location"]) ? $data["price_location"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="location">
                                        <label>Valor IPTU</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">R$</span>
                                            </div>
                                            <input type="text" name="price_iptu" id="price_iptu" class="form-control money" value="<?php print(isset($data["price_iptu"]) ? $data["price_iptu"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="location">
                                        <label>Percentual Correspondente IPTU</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                            <input type="text" value="<?php print(isset($data["percentual_iptu"]) ? $data["percentual_iptu"] : "") ?>" class="form-control percentual_iptu" disabled>
                                            <input type="hidden" name="percentual_iptu" value="<?php print(isset($data["percentual_iptu"]) ? $data["percentual_iptu"] : "") ?>" class="form-control percentual_iptu">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Taxas Administrativas</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">R$</span>
                                            </div>
                                            <input type="text" id="administrative_fees" name="administrative_fees" value="<?php print(isset($data["administrative_fees"]) ? $data["administrative_fees"] : "") ?>" class="form-control money">
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="sale">
                                        <label>Valor Venda</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">R$</span>
                                            </div>
                                            <input type="text" name="price_sale" class="form-control money" value="<?php print(isset($data["price_sale"]) ? $data["price_sale"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="sale">
                                        <label>Porcentagem da Comissão</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                            <input type="text" name="porcent_propertie" class="form-control percent" value="<?php print(isset($data["porcent_propertie"]) ? $data["porcent_propertie"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" name="is_apartmant">
                                        <div class="form-group">
                                            <label>Valor do Condominio</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" name="price_condominium" class="form-control money" value="<?php print(isset($data["price_condominium"]) ? $data["price_condominium"] : "") ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="location">
                                        <div class="form-group">
                                            <label for="deadline_contract">Prazo Contrato</label>
                                            <select name="deadline_contract" id="deadline_contract" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["deadline_contract"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["deadline_contract"]) && $k == $data["deadline_contract"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" name="is_financer">
                                        <div class="form-group">
                                            <label>Nome da Financiadora</label>
                                            <input type="text" name="financer_name" class="form-control" value="<?php print(isset($data["financer_name"]) ? $data["financer_name"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" name="text_exchange">
                                        <div class="form-group">
                                            <label>Informações Complementares</label>
                                            <textarea name="comments" id="comments" rows="5" cols="100" style="overflow: auto; resize: none;"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="sale">
                                        <div class="form-group">
                                            <label for="financial_propertie">Aceita Financiamento</label>
                                            <select name="financial_propertie" id="financial_propertie" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["financial_propertie"]) && $k == $data["financial_propertie"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" name="is_financer">
                                        <div class="form-group">
                                            <label>Nome da Financiadora</label>
                                            <input type="text" name="financer_name" class="form-control" value="<?php print(isset($data["financer_name"]) ? $data["financer_name"] : "") ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="sale">
                                        <div class="form-group">
                                            <label for="is_swap">Aceita Troca</label>
                                            <select name="is_swap" id="is_swap" class="form-control">
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["is_swap"]) && $k == $data["is_swap"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="location">
                                        <div class="form-group">
                                            <label for="instalation_enel">Instalação ENEL</label>
                                            <input id="instalation_enel" type="text" class="form-control" name="instalation_enel" value="<?php print(isset($data["instalation_enel"]) ? $data["instalation_enel"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="location">
                                        <div class="form-group">
                                            <label for="instalation_sabesp">Instalação Sabesp</label>
                                            <input id="instalation_sabesp" type="text" class="form-control" name="instalation_sabesp" value="<?php print(isset($data["instalation_sabesp"]) ? $data["instalation_sabesp"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="classification">Classificação Fiscal Prefeitura</label>
                                            <input id="classification" type="text" maxlength="20" class="form-control" name="classification" value="<?php print(isset($data["classification"]) ? $data["classification"] : "") ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fotos do Imovel -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Fotos do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Fotos</label>
                                            <input type="file" class="form-control" name="images[]" aria-describedby="helpId" multiple>
                                            <small id="helpId" class="form-text text-muted">Arquivos Permitidos (.jpg, .png, .jpeg)</small>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12 mt-2 mb-2">
                                        <div class="row">
                                            <?php if (!empty($data["imagem"])) {
                                                foreach (unserialize($data["imagem"]) as $k => $img) { ?>
                                                    <div class="col-4 col-sm-4 col-lg-3">

                                                        <a class="example-image-link" href="/<?php print($img) ?>" data-lightbox="example-set" data-title="<?php print("Foto do Imovel Cod n° " . $data["idx"]) ?>"><img class="img-thumbnail d-block" id="<?php print("img_propertie_" . $k) ?>" src="/<?php print($img) ?>" alt="" style="width: 15vw; height: 15vw;"></a>


                                                        <!-- <a type="button" id="delete_img" data-propertieid="<?php print($data["idx"]) ?>" data-imgid="<?php print($k) ?>" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i> </a> -->
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documentação do Imovel -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Documentação do Imovel</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Documentação</label>
                                            <input type="file" class="form-control" name="docs[]" aria-describedby="helpId" multiple>
                                            <small id="helpId" class="form-text text-muted">Arquivos Permitidos (.pdf)</small>
                                        </div>
                                    </div>

                                    <?php if (!empty($data["docs"])) {
                                        foreach (unserialize($data["docs"]) as $key => $doc) {
                                    ?>
                                            <iframe class="pdf" src="/<?php print($doc) ?>" width="100%" height="200px"></iframe>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 text-right btn">
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