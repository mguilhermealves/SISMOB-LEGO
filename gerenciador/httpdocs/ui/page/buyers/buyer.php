<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print(set_url($info["get"]["done"])) ?>">Compradores</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">
            <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                <?php if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) { ?>
                    <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                <?php  } ?>

                <input id="profiles_id" type="hidden" name="profiles_id" value="9" required>

                <div class="col-lg-12 text-center mb-2 d-none" id="error_cpf"></div>

                <!-- Dados do Comprador -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Comprador</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="first_name">Nome</label>
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="last_name">Sobrenome</label>
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input id="cpf" type="text" class="form-control document" name="cpf" value="<?php print(isset($data["cpf"]) ? $data["cpf"] : "") ?>">
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
                                            <select id="genre" name="genre" class="form-control">
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
                                            <select id="marital_status" name="marital_status" class="form-control">
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

                <!-- Endereço do Comprador -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Endereço do Comprador</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="postalcode">CEP</label>
                                        <input id="postalcode" type="text" class="form-control postalcode" name="postalcode" value="<?php print(isset($data["postalcode"]) ? $data["postalcode"] : "") ?>">
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
                                        <label for="number">Numero</label>
                                        <input id="number" type="text" class="form-control" name="number" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input id="complement" type="text" class="form-control" name="complement" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="district">Bairro</label>
                                        <input id="district" type="text" class="form-control" name="district" value="<?php print(isset($data["district"]) ? $data["district"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="city">Cidade</label>
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
                                            <input type="file" class="form-control" name="offices[IRPF_file][]" aria-describedby="helpId" multiple>
                                            <small id="helpId" class="form-text text-muted">Arquivos Permitidos (.pdf)</small>
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

                <div class="col-sm-12 text-right">
                    <button type="submit" id="btn_save" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print(isset($data["idx"]) ? "Salvar" : "Cadastrar") ?></button>
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