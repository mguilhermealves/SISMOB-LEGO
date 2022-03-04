        <div class="body_login">
            <div class="login_container col-lg-5 col-xl-3 col-md-6 col-sm-12 col-xs-12 mx-auto">
                <div class="container_custom py-3">
                    <div class="login_header">
                        <img class="mt-4 mx-auto img-fluid" src="<?php printf( "%simg/wikipet.png" , constant("cFurniture") ) ?>">
                    </div>
                    <div class="login_body">
                        <?php 
                        if( isset( $_SESSION[ constant("cAppKey") ]["messages"] ) ){
                            foreach( $_SESSION[ constant("cAppKey") ]["messages"] as $k => $v ){
                                printf('<div class="alert alert-%s" >%s</div>' , $k , implode("<br>" , $v ) );
                            }
                            unset( $_SESSION[ constant("cAppKey") ]["messages"] ) ;
                        }
                        ?>
                        <form action="<?php print( $GLOBALS["password_url"] ) ?>" method="POST" class="container">
                        <div class="form-group py-3">Digite seu nome de usuário ou endereço de e-mail. Você receberá um link para criar uma nova senha via e-mail.</div>  
                            <div class="form-group py-3">
                                <div class="d-flex flex-column input-group-prepend">
                                    <input name="text" required type="text" class="form-control " placeholder="Informe seu cpf ou e-mail" aria-label="Informe seu cpf ou e-mail" aria-describedby="login">
                                </div>
                            </div>
                            <div class="form-group py-3 text-center">
                                <button name="btn_save" class="btn btn-block" style="color: #fff;background-color: #f26724;">Obter nova senha</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login_footer">
                    <img class="mt-4 mx-auto img-fluid" src="<?php printf( "%simg/univers.png" , constant("cFurniture") ) ?>">
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="<?php printf("%s%s",constant("cFurniture"),"css/login.css")?>">