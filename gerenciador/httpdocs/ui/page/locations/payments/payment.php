<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["location_payments_url"]) ?>">Pagamento de Locações</a> / Dados da Locação N° Contrato <?php print($data["n_contract"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">

            <?php if ($data["payment_method"] != "ticket") { ?>

                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <input type="hidden" id="amount" name="amount" class="form-control" value="<?php print(isset($data["properties_attach"]) ? $data["properties_attach"][0]["price_location"] : "") ?>">
                    <input type="hidden" id="day_due" name="day_due" class="form-control" value="<?php print($data["day_due"]) ?>">

                    <!-- Cadastrar Pagamento -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Cadastrar Pagamento</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_work">Método de Pagamento</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["offices_attach"][0]["payment_method"]) && $k == $data["offices_attach"][0]["payment_method"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Juros por Atraso</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="text" id="fees" name="fees" class="form-control" placeholder="1.00%">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Multa por Atraso</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="text" id="fine" name="fine" class="form-control" placeholder="1.00%">
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="is_ticket">
                                            <div class="form-group">
                                                <label for="type_work">Pagamento Automático ?</label>
                                                <select name="auto_payment" id="auto_payment" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["offices_attach"][0]["auto_payment"]) && $k == $data["offices_attach"][0]["auto_payment"] ? ' selected' : '', $k, $v);
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

                    <div class="col-sm-6">
                        <?php if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) { ?>
                            <a href="<?php print($info["get"]["done"]); ?>" class="btn btn-outline-secondary btn-sm">Voltar</a>
                        <?php } ?>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> Gerar Pagamento</button>
                    </div>
                </form>

            <?php } ?>

            <?php if (isset($data["payments_attach"])) { ?>

                <br>

                <!-- Lista de Pagamentos -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Historico de Cobranças</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-inverse">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Tipo de Pagamento</th>
                                                    <th>Valor</th>
                                                    <th>Dia de Vencimento</th>
                                                    <th>Mês / Ano Referência</th>
                                                    <th>Status</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data["payments_attach"] as $v) { ?>
                                                    <tr>
                                                        <td><?php print($GLOBALS["payment_method"][$v["payment_method"]]); ?></td>
                                                        <td class="money"><?php print($v["amount"]); ?></td>
                                                        <td><?php print($v["day_due"]); ?></td>
                                                        <td>Mar / 2022</td>
                                                        <td><?php print($GLOBALS["payment_status"][$v["status"]]); ?></td>
                                                        <td>
                                                            <a type="button" class="btn btn-outline-primary btn-sm" href="/locacao/pagamento/<?php print($data["idx"]) ?>/detalhe/<?php print($v["idx"]) ?>"><i class="bi bi-pencil-square"></i> Ver Dados</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
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