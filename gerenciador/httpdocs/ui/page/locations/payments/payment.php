<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["locations_url"]) ?>">Locações</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Pesquisar Imóvel ou Proprietário</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Código do Imóvel</label>
                                    <input type="text" id="cod_propertie" name="cod_propertie" class="form-control" placeholder="Codigo do Imóvel" autofocus>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nome do Proprietário</label>
                                    <input type="text" id="name_client" name="name_client" class="form-control" placeholder="Nome do Proprietário" autofocus>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>CPF do Proprietário</label>
                                    <input type="text" id="cpf_client" name="cpf_client" class="form-control" placeholder="CPF do Proprietário" autofocus>
                                </div>
                            </div>

                            <div class="col-sm-12 text-right">
                                <a name="" id="" class="btn btn-info btn-sm pesquisarImovel" role="button"><i class="bi bi-search"></i> Pesquisar</a>
                            </div>

                            <div class="col-sm-12">
                                <div class="mt-5" id="table_find_clients"></div>
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

                    <input type="hidden" name="clients_id" id="clients_id" class="form-control">
                    <input type="hidden" name="properties_id" id="properties_id" class="form-control">

                    <!-- Dados do Proprietário -->
                    <?php
                    if (!isset($data["properties_attach"])) { ?>
                        <div class="modal-content">
                            <div class="modal-header label">
                                <h5 class="modal-title ">Dados do Proprietário</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input id="first_name_search" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sobrenome</label>
                                                <input id="last_name_search" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CPF</label>
                                                <input id="document_search" type="text" class="form-control" name="document" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CEP</label>
                                                <input type="text" class="form-control" id="cep_search" name="code_postal" value="<?php print(isset($data["code_postal"]) ? $data["code_postal"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Endereço</label>
                                                <input type="text" class="form-control" id="address_search" name="address_search" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Numero</label>
                                                <input type="text" class="form-control" id="number_address_search" name="number_address" value="<?php print(isset($data["number_address"]) ? $data["number_address"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Complemento</label>
                                                <input type="text" class="form-control" id="complement_search" name="complement" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Bairro</label>
                                                <input type="text" class="form-control" id="district_search" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Cidade</label>
                                                <input type="text" class="form-control" id="city_search" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="uf">UF</label>
                                                <select id="uf_search" name="uf" class="form-control" disabled>
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
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($data["properties_attach"])) { ?>
                        <div class="modal-content">
                            <div class="modal-header label">
                                <h5 class="modal-title ">Dados do Proprietário</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input id="first_name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]["first_name"]) ? $data["properties_attach"][0]["clients_attach"][0]["first_name"] : $data["first_name"]) ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sobrenome</label>
                                                <input id="last_name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]["last_name"]) ? $data["properties_attach"][0]["clients_attach"][0]["last_name"] : $data["last_name"]) ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CPF</label>
                                                <input id="document" type="text" class="form-control" name="document" value="<?php print(isset($data["properties_attach"][0]["clients_attach"][0]["document"]) ? $data["properties_attach"][0]["clients_attach"][0]["document"] : $data["document"]) ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CEP</label>
                                                <input type="text" class="form-control" name="code_postal" value="<?php print(isset($data["properties_attach"][0]["code_postal"]) ? $data["properties_attach"][0]["code_postal"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Endereço</label>
                                                <input type="text" class="form-control" name="address_search" value="<?php print(isset($data["properties_attach"][0]["address"]) ? $data["properties_attach"][0]["address"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Numero</label>
                                                <input type="text" class="form-control" name="number_address" value="<?php print(isset($data["properties_attach"][0]["number_address"]) ? $data["properties_attach"][0]["number_address"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Complemento</label>
                                                <input type="text" class="form-control" name="complement" value="<?php print(isset($data["properties_attach"][0]["complement"]) ? $data["properties_attach"][0]["complement"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Bairro</label>
                                                <input type="text" class="form-control" name="district" value="<?php print(isset($data["properties_attach"][0]["district"]) ? $data["properties_attach"][0]["district"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Cidade</label>
                                                <input type="text" class="form-control" name="city" value="<?php print(isset($data["properties_attach"][0]["city"]) ? $data["properties_attach"][0]["city"] : "") ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="uf">UF</label>
                                                <select name="uf" class="form-control" disabled>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["properties_attach"][0]["uf"]) && $k == $data["properties_attach"][0]["uf"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- Dados do Locatário -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados do Locatário</h5>
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
                                                <input id="document" type="text" class="form-control" name="document" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>">
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
                            <h5 class="modal-title ">Endereço do Locatário</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">CEP</label>
                                            <input id="cep" type="text" class="form-control" name="code_postal" value="<?php print(isset($data["code_postal"]) ? $data["code_postal"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Endereço</label>
                                            <input id="address" type="text" class="form-control" name="address" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" disabled>
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
                                            <input id="district" type="text" class="form-control" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">Cidade</label>
                                            <input id="city" type="text" class="form-control" name="city" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="uf">UF</label>
                                            <select name="uf" id="uf" class="form-control" disabled>
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
                                                <input id="pet_species" type="text" class="form-control" name="pet_species" value="<?php print(isset($data["pet_species"]) ? $data["pet_species"] : "") ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados da Locação -->
                    <?php
                    if (!isset($data["properties_attach"])) { ?>
                        <div class="modal-content">
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
                                                    <input type="text" id="price_location_search" name="price_location" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>Valor IPTU</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" id="price_iptu_search" name="price_iptu" class="form-control money" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-4" name="is_apartmant">
                                                <div class="form-group">
                                                    <label>Valor do Condominio</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">R$</span>
                                                        </div>
                                                        <input type="text" id="price_condominium_search" name="price_condominium" class="form-control money" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="deadline_contract">Prazo Contrato</label>
                                                    <select name="deadline_contract" id="deadline_contract_search" class="form-control" disabled>
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["deadline_contract"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["deadline_contract"]) && $k == $data["deadline_contract"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="object_propertie">Objetivo do Imovel</label>
                                                    <select name="object_propertie" id="object_propertie_search" class="form-control" disabled>
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["propertie_objects"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["object_propertie"]) && $k == $data["object_propertie"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="type_propertie">Tipo de Propriedade</label>
                                                    <select name="type_propertie" id="type_propertie_search" class="form-control" disabled>
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["propertie_types"] as $k => $v) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["type_propertie"]) && $k == $data["type_propertie"] ? ' selected' : '', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="due_day">Dia de Vencimento</label>
                                                    <select name="due_day" id="due_day" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["due_day"]) && $i == $data["due_day"] ? ' selected' : '', $i, $i);
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
                    <?php } ?>

                    <?php
                    if (isset($data["properties_attach"])) { ?>
                        <div class="modal-content">
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
                                                    <input type="text" id="price_location_search" name="price_location" value="<?php print(isset($data["properties_attach"][0]["price_location"]) ? $data["properties_attach"][0]["price_location"] : $data["price_location"]) ?>" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>Valor IPTU</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">R$</span>
                                                    </div>
                                                    <input type="text" id="price_iptu_search" name="price_iptu" value="<?php print(isset($data["properties_attach"][0]["price_iptu"]) ? $data["properties_attach"][0]["price_iptu"] : $data["price_iptu"]) ?>" class="form-control money" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-4" id="is_apartmant">
                                                <div class="form-group">
                                                    <label>Valor do Condominio</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">R$</span>
                                                        </div>
                                                        <input type="text" id="price_condominium_search" name="price_condominium" value="<?php print(isset($data["properties_attach"][0]["price_condominium"]) ? $data["properties_attach"][0]["price_condominium"] : $data["price_condominium"]) ?>" class="form-control money" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="deadline_contract">Prazo Contrato</label>
                                                    <select name="deadline_contract" id="deadline_contract_search" class="form-control" disabled>
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
                                                    <select name="object_propertie" id="object_propertie_search" class="form-control" disabled>
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
                                                    <select name="type_propertie" id="type_propertie_search" class="form-control" disabled>
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
                                                    <label for="day_due">Dia de Vencimento</label>
                                                    <select name="day_due" id="day_due" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            printf('<option %s value="%s">%s</option>', isset($data["day_due"]) && $i == $data["day_due"] ? ' selected' : '', $i, $i);
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
                    <?php } ?>

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
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>CNPJ</label>
                                                <input type="file" class="form-control" name="offices[cnpj_file]">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Contrato Social</label>
                                                <input type="file" class="form-control" name="offices[contract_file]">
                                            </div>
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
                                                <input id="name" type="text" class="form-control" name="partner[first_name_partner]" value="<?php print(isset($data["partners_attach"]["first_name_partner"]) ? $data["partners_attach"]["first_name_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sobrenome</label>
                                                <input id="name" type="text" class="form-control" name="partner[last_name_partner]" value="<?php print(isset($data["partners_attach"]["last_name_partner"]) ? $data["partners_attach"]["last_name_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CPF</label>
                                                <input id="name" type="text" class="form-control" name="partner[document_partner]" value="<?php print(isset($data["partners_attach"]["document_partner"]) ? $data["partners_attach"]["document_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">RG</label>
                                                <input id="name" type="text" class="form-control" name="partner[rg_partner]" value="<?php print(isset($data["partners_attach"]["rg_partner"]) ? $data["partners_attach"]["rg_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CNH</label>
                                                <input id="name" type="text" class="form-control" name="partner[cnh_partner]" value="<?php print(isset($data["partners_attach"]["cnh_partner"]) ? $data["partners_attach"]["cnh_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="file">Certidão de Casamento (.pdf)</label>
                                                <input type="file" id="file" name="partner[file]" class="form-control">
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

                    <!-- Aprovação -->
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

                    <div class="col-sm-6">
                        <?php if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) { ?>
                            <a href="<?php print($info["get"]["done"]); ?>" class="btn btn-outline-secondary btn-sm">Voltar</a>
                        <?php } ?>
                    </div>

                    <div class="col-sm-6 text-right">
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