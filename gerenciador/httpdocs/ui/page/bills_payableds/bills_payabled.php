<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / <a href="<?php print($GLOBALS["bills_payableds_url"]) ?>">Contas a Pagar</a> / <?php print($form["title"]) ?></p>
    <div class="container-fluid box solaris-head mt-5">
        <div class="box-body">
            <div>
                <!-- Centro de Custos -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Centro de Custo</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Pesquisar Centro de Custo:</label>
                                            <small class="text-muted">Digite o codigo do Centro de Custo</small>
                                            <input class="form-control center_count_search" value="<?php print(isset($data["account_pay_cost_center_attach"][0]) ? $data["account_pay_cost_center_attach"][0]["idx"] . " - " . $data["account_pay_cost_center_attach"][0]["name"] : '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Centro de Custo selecionado:</label>
                                            <strong id="center_count_name" style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php print(isset($data["account_pay_cost_center_attach"][0]) ? $data["account_pay_cost_center_attach"][0]["name"] : "") ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empresa Beneficiária -->
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Empresa Beneficiária</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Pesquisar Empresa Beneficiária:</label>
                                            <small class="text-muted">Digite o nome da Empresa Beneficiária:</small>
                                            <input class="form-control company_search" value="<?php print(isset($data["companies_attach"][0]) ? $data["companies_attach"][0]["idx"] . " - " . $data["companies_attach"][0]["name"] : '') ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Empresa Beneficiária selecionado:</label>
                                            <strong id="company_name" style="text-decoration: underline; text-transform: uppercase; font-weight: bold;"><?php print(isset($data["companies_attach"][0]) ? $data["companies_attach"][0]["name"] : "") ?></strong>
                                        </div>
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

                    <input type="hidden" name="account_pay_cost_center_id" id="account_pay_cost_center_id">
                    <input type="hidden" name="companies_id" id="companies_id">


                    <!-- Dados do Locatário -->
                    <div class="modal-content">
                        <div class="modal-header label">
                            <h5 class="modal-title ">Dados do Contas a Pagar</h5>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row col-lg-12">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="amount">Valor</label>
                                                <input id="amount" type="text" class="form-control money" name="amount" value="<?php print(isset($data["amount"]) ? $data["amount"] : "") ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="day_due">Dia de Vencimento</label>
                                                <input class="form-control" type="date" name="day_due" id="day_due" value="<?php print(isset($data["day_due"]) ? $data["day_due"] : "") ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="type_work">Método de Pagamento</label>
                                                <select name="payment_method" id="payment_method" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_method"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["payment_method"]) && $k == $data["payment_method"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="status_payment">Status</label>
                                                <select name="status_payment" id="status_payment" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($GLOBALS["payment_status"] as $k => $v) {
                                                        printf('<option %s value="%s">%s</option>', isset($data["status_payment"]) && $k == $data["status_payment"] ? ' selected' : '', $k, $v);
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="comments">Observação</label>
                                                <input id="comments" type="text" class="form-control editor" name="comments" value="<?php print(isset($data["comments"]) ? $data["comments"] : "") ?>">
                                            </div>
                                        </div>

                                        <?php if (isset($data["idx"]) && isset($data["idx"]) > 0) { ?>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="file">Comprovante de Pagamento</label>
                                                    <input type="file" id="file" name="receipt_payment" class="form-control">
                                                </div>
                                            </div>

                                            <?php if (!empty($data["receipt_payment"]) && file_exists(constant("cRootServer") . $data["receipt_payment"])) { ?>
                                                <iframe class="pdf" src="/<?php print($data["receipt_payment"]) ?>" width="100%" height="300px"></iframe>
                                            <?php
                                            } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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