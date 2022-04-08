<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["accounts_receivables_url"]) ?>">Contas a Receber</a> / Conta a Receber </p>
    <div class="container-fluid box solaris-head mt-5">
        <?php html_notification_print(); ?>

        <?php if (isset($info["idx"]) && $info["idx"] < 0) { ?>

            <div class="box-body">
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

                    <!-- Cadastrar Novo Pagamento -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Cadastrar Novo Pagamento</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="payment_method">Forma de Pagamento</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        printf('<option value="%s">%s</option>', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Dia de Vencimento</label>
                                                <input type="text" class="form-control" value="<?php print($data["day_due"]); ?>" disabled>
                                                <input type="hidden" id="day_due" name="day_due" class="form-control" value="<?php print($data["day_due"]); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle"></i> Gerar Pagamento</button>
                    </div>
                </form>

            <?php } ?>

            <br>

            <?php if ($data["payment_method"] != "ticket") { ?>

                <form action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
                    ?>
                        <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
                    <?php
                    }
                    ?>

                    <!-- Dados do Pagamento -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados do Pagamento</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_work">Método de Pagamento</label>
                                                <select name="payment_method" id="payment_method" class="form-control" disabled>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        if ($k != "ticket") {
                                                            printf('<option %s value="%s">%s</option>', isset($data["payment_method"]) && $k == $data["payment_method"] ? ' selected' : '', $k, $v);
                                                        }
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
                                                <input type="text" id="fees" name="fees" class="form-control" value="<?php print(isset($data['fees']) ? $data['fees'] : "") ?>" placeholder="1.00%" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Multa por Atraso</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="text" id="fine" name="fine" class="form-control" value="<?php print(isset($data['fine']) ? $data['fine'] : "") ?>" placeholder="1.00%" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Valor</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                                </div>
                                                <input type="text" id="amount" name="amount" class="form-control money" value="<?php print(isset($data['amount']) ? $data['amount'] : "") ?>" placeholder="1.00%" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Dia de Vencimento</label>
                                                <input id="day_due" type="text" class="form-control" name="day_due" value="<?php print(isset($data["day_due"]) ? $data["day_due"] : $data["day_due"]) ?>" disabled>
                                            </div>
                                        </div>

                                        <?php if ($data["payment_method"] != "ticket") { ?>

                                            <div class="col-lg-4" id="is_ticket">
                                                <div class="form-group">
                                                    <label for="type_work">Cancelar Pagamento?</label>
                                                    <select name="payment_cancel" id="payment_cancel" class="form-control" required>
                                                        <option value="">Selecione</option>
                                                        <?php
                                                        foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                                            printf('<option value="%s">%s</option>', $k, $v);
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 text-right">
                        <button type="submit" name="btn_save" class="btn btn-outline-danger btn-sm"><i class="bi bi-plus-circle"></i> Cancelar</button>
                    </div>
                </form>

            <?php } ?>

            <?php if ($data["payment_method"] == "ticket") { ?>
                <!-- Dados do Boleto -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados do Boleto</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="status">Status do Pagamento:</label>
                                            <select name="status" id="status" class="form-control" disabled>
                                                <option value="">Selecione</option>
                                                <?php
                                                foreach ($GLOBALS["payment_status_gerencianet"] as $k => $v) {
                                                    printf('<option %s value="%s">%s</option>', isset($data["status"]) && $k == $data["status"] ? ' selected' : '', $k, $v);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <?php if ($data["status"] != "canceled") { ?>

                                        <div class="col-lg-8 text-right">
                                            <button type="button" id="cancel_billet" class="btn btn-danger btn-sm" data-payment="<?php print($info["idx"]) ?>">Cancelar Boleto</button>
                                        </div>

                                    <?php } ?>



                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="status">PDF</label>
                                            <iframe class="pdf" src="<?php print($data["pdf"]) ?>" width="100%" height="350px"></iframe>
                                            <?php if ($data["status"] != "canceled") { ?>
                                                <button type="button" name="" id="send_billet" class="btn btn-primary btn-sm" data-payment="<?php print($info["idx"]) ?>"><i class="bi bi-envelope"></i> Enviar por e-mail</button>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3">

                                        <p class="lead">
                                            Historico de Cobrança
                                        </p>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Mensagem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (unserialize($data["historic_bank"]) as $v) { ?>
                                                    <tr>
                                                        <td scope="row"><?php print($v["created_at"]) ?></td>
                                                        <td><?php print($v["message"]) ?></td>
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