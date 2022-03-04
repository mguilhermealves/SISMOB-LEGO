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
                        <form action="<?php printf( $GLOBALS["tkpwd_url"] , $info["key"] ) ?>" method="POST" class="container">
                            
                                
                            <div class="form-group py-3">Informe sua nova senha</div>  
                            <div class="form-group py-3">
                                <div class="d-flex flex-column input-group-prepend">
                                    <label>Senha:</label>
                                    <input name="password" required type="password" class="form-control " placeholder="Informe sua nova senha" aria-label="Informe sua nova senha" aria-describedby="password">
                                </div>
                            <div class="form-group py-3">
                            </div>
                                <div class="d-flex flex-column input-group-prependd q     ">
                                    <label>Confirmar Senha:</label>
                                    <input required name="password" type="password" class="form-control rounded" placeholder="Senha" aria-label="Senha" aria-describedby="senha">
                                </div>
                            </div>
                            <div class="form-group text-center">
                            <button name="btn_save" class="btn btn-block " style="color: #fff;background-color: #f26724;">Atualizar</button>
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