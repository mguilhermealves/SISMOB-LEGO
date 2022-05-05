<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["locations_url"]) ?>">Locações e Vendas</a> / <?php print($form["title"]) ?></p>
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
                                    <label>Pesquisar Proprietario:</label>
                                    <small class="text-muted">Digite o nome do Proprietario:</small>
                                    <input type="text" class="form-control properties_search" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]) ? $data["properties_attach"][0]["clients_attach"][0]["first_name"] . " " . $data["properties_attach"][0]["clients_attach"][0]["last_name"] . " (" . $GLOBALS["propertie_objects"][$data["properties_attach"][0]["object_propertie"]] . ") " . " - Endereço: " . $data["properties_attach"][0]["address"] . ", N° " . $data["properties_attach"][0]["number_address"] . ", " . $data["properties_attach"][0]["complement"] . ", " . $data["properties_attach"][0]["code_postal"] . ", " . $data["properties_attach"][0]["district"] . ", " . $data["properties_attach"][0]["city"] . " - " . $data["properties_attach"][0]["uf"]: '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dados do Proprietário -->
            <!-- <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Dados do Proprietário</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input id="client_first_name" type="text" class="form-control" name="client_first_name" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]) ? $data["properties_attach"][0]["clients_attach"][0]["first_name"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Sobrenome</label>
                                    <input id="client_last_name" type="text" class="form-control" name="client_last_name" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]) ? $data["properties_attach"][0]["clients_attach"][0]["last_name"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">CPF</label>
                                    <input id="client_document" type="text" class="form-control" name="client_document" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]) ? $data["properties_attach"][0]["clients_attach"][0]["document"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">CEP</label>
                                    <input id="client_code_postal" type="text" class="form-control" name="client_code_postal" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["code_postal"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Endereço</label>
                                    <input id="client_address" type="text" class="form-control" name="client_address" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["address"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Numero</label>
                                    <input id="client_number_address" type="text" class="form-control" name="client_number_address" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["number_address"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Complemento</label>
                                    <input id="client_complement" type="text" class="form-control" name="client_complement" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["complement"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Bairro</label>
                                    <input id="client_district" type="text" class="form-control" name="client_district" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["district"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Cidade</label>
                                    <input id="client_city" type="text" class="form-control" name="client_city" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["city"] : "") ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="uf">UF</label>
                                    <select id="client_uf" name="client_uf" class="form-control" disabled>
                                        <option value="">Selecione</option>
                                        <?php
                                        foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                            printf('<option %s value="%s">%s</option>', isset($data["properties_attach"][0]) && $k == $data["properties_attach"][0]["uf"] ? ' selected' : '', $k, $v);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div>
                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <input id="cod_client" type="hidden" name="cod_client" value="<?php print($data["properties_attach"][0]["clients_attach"][0]["idx"]); ?>" required>
                    <input id="cod_propertie" type="hidden" name="cod_propertie" value="<?php print($data["properties_attach"][0]["idx"]); ?>" required>

                    <!-- Dados do Locatário -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados do Locatário / Comprador</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input id="first_name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sobrenome</label>
                                                <input id="last_name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CPF</label>
                                                <input id="document" type="text" class="form-control document" name="document" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">RG</label>
                                                <input id="name" type="text" class="form-control" name="rg" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["rg"]) ? $data["rg"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CNH</label>
                                                <input id="name" type="text" class="form-control" name="cnh" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["cnh"]) ? $data["cnh"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Telefone</label>
                                                <input id="phone" type="text" class="form-control phone" name="phone" value="<?php print(isset($data["phone"]) ? $data["phone"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Celular</label>
                                                <input id="celphone" type="text" class="form-control celphone" name="celphone" value="<?php print(isset($data["celphone"]) ? $data["celphone"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="genre">Genero</label>
                                                <select name="genre" id="genre" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["genres"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["genre"]) && $k == $data["genre"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="marital_status">Estado Civil</label>
                                                <select name="marital_status" id="marital_status" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["marital_status"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["marital_status"]) && $k == $data["marital_status"] ? ' selected' : '', $k, $v);
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

                    <!-- Endereço do Locatário -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Endereço do Locatário / Comprador</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">CEP</label>
                                            <input id="cep" type="text" class="form-control code_postal" name="code_postal" value="<?php print(isset($data["code_postal"]) ? $data["code_postal"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Endereço</label>
                                            <input id="address" type="text" class="form-control" name="address" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" required>
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
                                            <input id="district" type="text" class="form-control" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Cidade</label>
                                            <input id="city" type="text" class="form-control" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="uf">UF</label>
                                            <select name="uf" id="uf" class="form-control" required>
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

                    <!-- Dados Adicionais -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados Adicionais</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="is_children">Possui Filhos</label>
                                                <select name="is_children" id="is_children" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["is_children"]) && $k == $data["is_children"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="number_residents">Quantidade de Moradores</label>
                                                <select name="number_residents" id="number_residents" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    for ($i = 1; $i <= 20; $i++) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["number_residents"]) && $i == $data["number_residents"] ? ' selected' : '', $i, $i);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="is_pet">Possui Animais de Estimação</label>
                                                <select name="is_pet" id="is_pet" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["is_pet"]) && $k == $data["is_pet"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" id="type_pet">
                                            <div class="form-group">
                                                <label for="name">Especificar Espécie</label>
                                                <input id="pet_species" type="text" class="form-control editor" name="pet_species" value="<?php print(isset($data["pet_species"]) ? $data["pet_species"] : "") ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados da Locação -->
                    <div class="modal-content" id="location">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados da Locação</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <label>Valor Locação</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" id="price_location" name="price_location" value="<?php print(isset($data["properties_attach"][0]) ? number_format($data["properties_attach"][0]["price_location"], 2, ".", ",") : "") ?>" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Valor IPTU</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" id="" name="price_iptu" value="<?php print(isset($data["properties_attach"][0]) ? number_format($data["properties_attach"][0]["price_iptu"], 2, ".", ",") : "") ?>" class="form-control price_iptu money" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="is_apartmant">
                                            <div class="form-group">
                                                <label>Valor do Condominio</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" id="price_condominium" name="price_condominium" value="<?php print(isset($data["properties_attach"][0]) ? $data["price_condominium"] : "") ?>" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="deadline_contract">Prazo Contrato</label>
                                                <select name="deadline_contract" class="form-control deadline_contract" disabled>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["deadline_contract"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["properties_attach"][0]["deadline_contract"]) && $k == $data["properties_attach"][0]["deadline_contract"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="object_propertie">
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
                                                <label for="day_due">Melhor dia para Vencimento</label>
                                                <select name="day_due" id="day_due_location" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    for ($i = 1; $i <= 31; $i++) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["day_due"]) && $i == $data["day_due"] ? ' selected' : '', $i, $i);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_work">Forma de Pagamento</label>
                                                <select name="payment_method" id="payment_method_location" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["payment_method"]) && $k == $data["payment_method"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="indice">Índice</label>
                                                <select name="indice" id="indice" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <option value="igpm">IGP-M</option>
                                                    <option value="ipca">IPCA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Percentual Correspondente IPTU</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="text" name="percentual_iptu" class="form-control percentual_iptu" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="classification">Classificação Fiscal Prefeitura</label>
                                                <input id="classification" type="text" maxlength="20" class="form-control" name="classification" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Taxas Administrativas</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" id="administrative_fees" name="administrative_fees" value="<?php print(isset($data["properties_attach"][0]) ? $data["properties_attach"][0]["administrative_fees"] : "") ?>" class="form-control money">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados da Venda -->
                    <div class="modal-content" id="sale">
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
                                                <label for="day_due">Melhor dia para Vencimento</label>
                                                <select name="day_due" id="day_due_sale" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    for ($i = 1; $i <= 31; $i++) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["day_due"]) && $i == $data["day_due"] ? ' selected' : '', $i, $i);
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

                    <input type="hidden" name="offices[offices_id]" value="<?php print(isset($data["offices_attach"][0]["idx"]) ? $data["offices_attach"][0]["idx"] : ""); ?>">
                    <input type="hidden" name="partner[partners_id]" value="<?php print(isset($data["partners_attach"][0]["idx"]) ? $data["partners_attach"][0]["idx"] : ""); ?>">

                    <!-- Dados Financeiros -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados Financeiros</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="type_work">Tipo de Regime</label>
                                                <select name="offices[type_work]" id="type_work" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["type_work"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["offices_attach"][0]["type_work"]) && $k == $data["offices_attach"][0]["type_work"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Razão Social</label>
                                                <input type="text" class="form-control" name="offices[company_name]" value="<?php print(isset($data["offices_attach"][0]["company_name"]) ? $data["offices_attach"][0]["company_name"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>3 Ultimos comprovantes de renda</label>
                                                <input type="file" class="form-control" name="offices[rent_file][]" multiple>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <div class="row">
                                                <?php if (!empty($data["offices_attach"][0]["rent_file"])) {
                                                    foreach (unserialize($data["offices_attach"][0]["rent_file"]) as $key => $doc) {
                                                ?>
                                                        <div class="col-12 col-sm-6 col-lg-4">
                                                            <iframe class="pdf" src="/<?php print($doc) ?>" width="100%" height="300px"></iframe>
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

                    <!-- Dados Financeiros clt -->
                    <div class="modal-content" id="clt">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados Financeiros - CLT</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Cargo</label>
                                                <input type="text" class="form-control" name="offices[office]" value="<?php print(isset($data["offices_attach"][0]["office"]) ? $data["offices_attach"][0]["office"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tempo de Registro</label>
                                                <input type="text" class="form-control" name="offices[registration_time]" value="<?php print(isset($data["offices_attach"][0]["registration_time"]) ? $data["offices_attach"][0]["registration_time"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Renda Mensal</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" name="offices[rent_monthly]" class="form-control money" value="<?php print(isset($data["offices_attach"][0]["rent_monthly"]) ? $data["offices_attach"][0]["rent_monthly"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Comprovante IRPF</label>
                                                <input type="file" class="form-control" name="offices[IRPF_file][]" multiple>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-12">
                                            <?php if (!empty($data["offices_attach"][0]["IRPF_file"])) {
                                                foreach (unserialize($data["offices_attach"][0]["IRPF_file"]) as $key => $doc) {
                                            ?>
                                                    <iframe class="pdf" src="/<?php print($doc) ?>" width="100%" height="300px"></iframe>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados Financeiros pj -->
                    <div class="modal-content" id="pj">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados Financeiros - PJ</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <input type="file" class="form-control" name="offices[address_file]">
                                            </div>

                                            <?php if (!empty($data["offices_attach"][0])) {
                                                foreach (unserialize($data["offices_attach"][0]["address_file"]) as $key => $address_file) {
                                            ?>
                                                    <iframe class="pdf" src="/<?php print($address_file) ?>" width="100%" height="300px"></iframe>
                                            <?php
                                                }
                                            } ?>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>CNPJ</label>
                                                <input type="file" class="form-control" name="offices[cnpj_file]">
                                            </div>

                                            <?php if (!empty($data["offices_attach"][0])) {
                                                foreach (unserialize($data["offices_attach"][0]["cnpj_file"]) as $key => $cnpj_file) {
                                            ?>
                                                    <iframe class="pdf" src="/<?php print($cnpj_file) ?>" width="100%" height="300px"></iframe>
                                            <?php
                                                }
                                            } ?>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contrato Social</label>
                                                <input type="file" class="form-control" name="offices[contract_file]">
                                            </div>

                                            <?php if (!empty($data["offices_attach"][0])) {
                                                foreach (unserialize($data["offices_attach"][0]["contract_file"]) as $key => $contract_file) {
                                            ?>
                                                    <iframe class="pdf" src="/<?php print($contract_file) ?>" width="100%" height="300px"></iframe>
                                            <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conjuge -->
                    <div class="modal-content" id="conjuge">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados do Conjuge</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input id="name" type="text" class="form-control" name="partner[first_name_partner]" value="<?php print(isset($data["partners_attach"][0]) ? $data["partners_attach"][0]["first_name_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sobrenome</label>
                                                <input id="name" type="text" class="form-control" name="partner[last_name_partner]" value="<?php print(isset($data["partners_attach"][0]["last_name_partner"]) ? $data["partners_attach"][0]["last_name_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CPF</label>
                                                <input id="name" type="text" class="form-control document" name="partner[document_partner]" value="<?php print(isset($data["partners_attach"][0]["document_partner"]) ? $data["partners_attach"][0]["document_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">RG</label>
                                                <input id="name" type="text" class="form-control" name="partner[rg_partner]" value="<?php print(isset($data["partners_attach"][0]["rg_partner"]) ? $data["partners_attach"][0]["rg_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CNH</label>
                                                <input id="name" type="text" class="form-control" name="partner[cnh_partner]" value="<?php print(isset($data["partners_attach"][0]["cnh_partner"]) ? $data["partners_attach"][0]["cnh_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="file">Certidão de Casamento (.pdf)</label>
                                                <input type="file" id="file" name="partner[file]" class="form-control">
                                            </div>
                                        </div>

                                        <?php if (!empty($data["partners_attach"][0]) && file_exists(constant("cRootServer") . $data["partners_attach"][0]["certification"])) { ?>
                                            <iframe class="pdf" src="/<?php print($data["partners_attach"][0]["certification"]) ?>" width="100%" height="300px"></iframe>
                                        <?php
                                        } ?>
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

                <br>

                <?php
                if (isset($data["is_aproved"]) && $data["is_aproved"] == 'approved') { ?>
                    <form action="<?php print($form["donwload_contract"]) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idx" value="<?php print($data["idx"]) ?>">

                        <div class="modal-content" id="status">
                            <div class="modal-header label">
                                <h5 class="modal-title ">Contrato de Locação</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="row col-lg-12">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-outline-primary btn-sm">Download Contrato</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
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