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
                        <form action="<?php print( $GLOBALS["logar_url"] ) ?>" method="POST" class="container">
                            
                                
                            <div class="form-group py-3">
                                <div class="d-flex flex-column input-group-prepend">
                                    <label>Login:</label>
                                    <input name="login" required type="text" class="form-control " placeholder="Informe seu login" aria-label="Informe seu login" aria-describedby="login">
                                </div>
                                <div class="py-2 text-secondary">
                                    <span style="font-size: 0.75rem;">Nós nunca compartilhamos seu email com ninguém.</span>
                                </div>
                                <div class="d-flex flex-column input-group-prepend">
                                    <label>Senha:</label>
                                    <input required name="password" type="password" class="form-control rounded" placeholder="Senha" aria-label="Senha" aria-describedby="senha">
                                </div>
                                <div class="d-flex align-itens-center justify-content-between input-group-prepend pt-3">
                                    <div>
                                        <input type="checkbox" label="Lembrar-me" class="mr-2" >
                                        <label class="mb-0">Lembrar-me</label>
                                    </div>
                                    <div>
                                        <a href="<?php print( $GLOBALS["password_url"] ) ?>" class="text-secondary" style="font-size: 0.75rem;">Esqueceu a Senha?</a>
                                    </div>                                  
                                    
                                </div>
                            </div>
                            <button name="btn_save" class="btn btn-block form-control " style="color: #fff;background-color: #f26724;">Acessar</button>
                        </form>
                    </div>
                </div>
                <div class="login_footer">
                    <img class="mt-4 mx-auto img-fluid" src="<?php printf( "%simg/univers.png" , constant("cFurniture") ) ?>">
                    
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="<?php printf("%s%s",constant("cFurniture"),"css/login.css")?>">