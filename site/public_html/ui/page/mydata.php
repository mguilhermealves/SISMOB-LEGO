<form action="<?php print( $GLOBALS["mydata_url"] )?>" method="post" class="main-section">
    <div class="contact-page">
        <div class="container">
            <div class="content-header d-flex justify-content-center mb-3">
                <h1 class="mb-0">Meu perfil</h1>
            </div>
            <hr>
    <?php html_notification_print() ?>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="form-group mb-3">
                            <label for="name-input">Nome:</label>
                            <input type="text"  id="name-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["first_name"] . " " . $_SESSION[ constant("cAppKey") ]["credential"]["last_name"] )?>">
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="genre-input">Sexo:</label>
                                    <select name="genre" id="genre-input" class="form-control">
                                        <option <?php print( $_SESSION[ constant("cAppKey") ]["credential"]["genre"] == "female" ? "selected" : "" )?> value="female">Feminino</option>
                                        <option <?php print( $_SESSION[ constant("cAppKey") ]["credential"]["genre"] == "male" ? "selected" : "" )?> value="male">Masculino</option>
                                        <option <?php print( $_SESSION[ constant("cAppKey") ]["credential"]["genre"] == "wait" ? "selected" : "" )?> value="others">Outros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="telephone-input">Telefone:</label>
                                    <input id="telephone-input" name="phone" class="form-control" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["phone"] )?>">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="cellphone-input">Celular:</label>
                                    <input id="cellphone-input" name="celphone" class="form-control" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["celphone"] )?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cpf-input">CPF / CNPJ:</label>
                                    <input type="text" id="cpf-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["cpf"] )?>">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="office_post-input">Cargo:</label>
                                    <input type="text" id="office_post-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["position"] )?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="regional-input">Regional:</label>
                                    <input type="text"  id="regional-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["regional"] )?>">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="subsidiary-input">Distribuidora:</label>
                                    <input type="text"  id="subsidiary-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["distribuidora"] )?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="email-input">E-mail:</label>
                                    <input type="email"  id="email-input" class="form-control" disabled="" value="<?php print( $_SESSION[ constant("cAppKey") ]["credential"]["mail"] )?>">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>