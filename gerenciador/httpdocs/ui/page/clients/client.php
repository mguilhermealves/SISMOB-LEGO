<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["clients_url"]) ?>">Clientes</a> / <?php print($form["title"]) ?></p>
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

                <!-- Info Cliente -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Informações</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input id="name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Sobrenome</label>
                                        <input id="name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">E-mail</label>
                                        <input id="name" type="email" class="form-control" name="mail" value="<?php print(isset($data["mail"]) ? $data["mail"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="document">CPF</label>
                                        <input id="document" type="text" class="form-control document" name="document" minlength="11" value="<?php print(isset($data["document"]) ? $data["document"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">RG</label>
                                        <input id="name" type="text" class="form-control" name="rg" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["rg"]) ? $data["rg"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">CNH</label>
                                        <input id="name" type="text" class="form-control" name="cnh" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["cnh"]) ? $data["cnh"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Telefone</label>
                                        <input id="phone" type="text" class="form-control" name="phone" value="<?php print(isset($data["phone"]) ? $data["phone"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Celular</label>
                                        <input id="celphone" type="text" class="form-control" name="celphone" value="<?php print(isset($data["celphone"]) ? $data["celphone"] : "") ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="genre">Genero</label>
                                        <select name="genre" id="genre" class="form-control" required>
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
                                        <select name="marital_status" id="marital_status" class="form-control" required>
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

                <!-- Endereço -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Endereço</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name">CEP</label>
                                            <input id="code_postal" type="text" class="form-control" name="code_postal" value="<?php print(isset($data["code_postal"]) ? $data["code_postal"] : "") ?>" required>
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
                                            <input type="text" class="form-control" name="number_address" value="<?php print(isset($data["number_address"]) ? $data["number_address"] : "") ?>" required>
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
                </div>

                <?php if (isset($data["idx"])) { ?>

                    <input type="hidden" name="partner[partners_id]" value="<?php print(isset($data["partners_attach"][0]["idx"]) ? $data["partners_attach"][0]["idx"] : ""); ?>">

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
                                                <input id="name" type="text" class="form-control" name="partner[last_name_partner]" value="<?php print(isset($data["partners_attach"][0]) ? $data["partners_attach"][0]["last_name_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="document">CPF</label>
                                                <input id="document" type="text" class="form-control document" minlength="11" name="partner[document_partner]" value="<?php print(isset($data["partners_attach"][0]) ? $data["partners_attach"][0]["document_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">RG</label>
                                                <input id="name" type="text" class="form-control" name="partner[rg_partner]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["partners_attach"][0]) ? $data["partners_attach"][0]["rg_partner"] : "") ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">CNH</label>
                                                <input id="name" type="text" class="form-control" name="partner[cnh_partner]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php print(isset($data["partners_attach"][0]) ? $data["partners_attach"][0]["cnh_partner"] : "") ?>">
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

                <?php } ?>

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
</style>