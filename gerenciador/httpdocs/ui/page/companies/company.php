<main>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="col-12 text-center">
                    <h1 class="display-4"><?php print(isset($info["idx"]) && (int)$info["idx"] > 0 ? "Editar Empresa " . "<p><strong>" . $data["name"] . "</strong></p>" : "Cadastrar Empresa") ?></h1>
                    <hr>
                </div>
                <div class="row">
                    <form action="<?php print($form["url"]) ?>" method="post">
                        <?php
                        if (isset($info["idx"]) && !empty($info["idx"])) {
                        ?>
                            <input type="hidden" id="idx" name="idx" value="<?php print($info["idx"]) ?>">
                        <?php
                        }
                        ?>
                        <div class="col-12 mt-5 mb-5">
                            <div class="row">
                                <div class="col-12 mb-4 text-center">
                                    <h1 class="display-5">Dados da Empresa</h1>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Razão Social</label>
                                        <input type="text" name="name" id="" class="form-control" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" placeholder="Digite o nome da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">CNPJ</label>
                                        <input type="text" name="CNPJ" id="" class="form-control" value="<?php print(isset($data["CNPJ"]) ? $data["CNPJ"] : "") ?>" placeholder="Digite o CNPJ da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Inscrição Municipal</label>
                                        <input type="text" name="inscricao_municipal" id="" class="form-control" value="<?php print(isset($data["inscricao_municipal"]) ? $data["inscricao_municipal"] : "") ?>" placeholder="Digite a Inscrição Municipal da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Inscrição Estadual</label>
                                        <input type="text" name="inscricao_estadual" id="" class="form-control" value="<?php print(isset($data["inscricao_estadual"]) ? $data["inscricao_estadual"] : "") ?>" placeholder="Digite a Inscrição Estadual da empresa">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 mb-4 text-center">
                                    <hr>
                                    <h1 class="display-5">Endereço</h1>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">CEP</label>
                                        <input type="text" name="postal_code" id="cep" class="form-control" value="<?php print(isset($data["postal_code"]) ? $data["postal_code"] : "") ?>" placeholder="Digite o CEP da empresa">
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Endereço</label>
                                        <input type="text" name="address" id="" class="form-control" value="<?php print(isset($data["address"]) ? $data["address"] : "") ?>" placeholder="Digite o Endereço da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Número</label>
                                        <input type="text" name="number" id="" class="form-control" value="<?php print(isset($data["number"]) ? $data["number"] : "") ?>" placeholder="Digite o Numero da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Complemento</label>
                                        <input type="text" name="complement" id="" class="form-control" value="<?php print(isset($data["complement"]) ? $data["complement"] : "") ?>" placeholder="Digite o Complemento da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Bairro</label>
                                        <input type="text" name="neighborhood" id="" class="form-control" value="<?php print(isset($data["neighborhood"]) ? $data["neighborhood"] : "") ?>" placeholder="Digite o Bairro da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Cidade</label>
                                        <input type="text" name="city" id="" class="form-control" value="<?php print(isset($data["city"]) ? $data["city"] : "") ?>" placeholder="Digite o Cidade da empresa">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Estado</label>
                                        <select class="form-control" name="uf" id="">
                                            <option value="" <?php print($data["uf"] == "" ? ' selected="selected"' : '') ?>></option>
                                            <?php
                                            foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                                printf('<option value="%s"%s>%s</option>', $k, $data["uf"] == $k  ? ' selected="selected"' : '', $v);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-plus-circle"></i> <?php print(isset($info["idx"]) && (int)$info["idx"] > 0 ? "Salvar" : "Cadastrar") ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>