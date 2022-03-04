
        <div class="row">
            <div class="col-12 img-background">
                <div class="row">
                    <div class="col-3">
                        <?php if(isset( $_SESSION[ constant("cAppKey") ]["credential"]["image"] )){
                            print('<div class="avatar-nome jss462 MuiAvatar-colorDefault" style="background:url(\''.constant("cFrontend").$_SESSION[ constant("cAppKey") ]["credential"]["image"].'\') center center no-repeat transparent;background-size:cover"></div>');
                        }else{
                            print('<div class="avatar-nome jss462 MuiAvatar-colorDefault">' . substr($_SESSION[constant("cAppKey")]["credential"]["first_name"], 0, 1) . "" . substr($_SESSION[constant("cAppKey")]["credential"]["last_name"], 0, 1) . '</div>' );
                        } ?>
                    </div>

                    <div class="col">
                        <div class="linha"></div>
                    </div>

                    <div class="col-4">
                        <div class="nome">
                            <p>
                            <?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"] . " " . $_SESSION[constant("cAppKey")]["credential"]["last_name"]); ?>
                            </p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="linha"></div>
                    </div>

                    <div class="col-3 pilula-centro">
                        <div class="row">
                            <div class="col-6">
                                <div class="img-pilula">
                                    <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/treinamentos/transferir.png") ?>" class="flex-shrink-0 me-3">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="inform-pilula">
                                    <div class="lugar">
                                        <p>--lugar</p>
                                    </div>
                                    <div class="ponto">
                                        <p>0 ponto</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
