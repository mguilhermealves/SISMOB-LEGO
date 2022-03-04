<div class="container-fluid">
    <header class="main-header mb-0">
        <div class="container-fluid">
            <div class="container">
                <div class="row padding-top-20 padding-bottom-20">
                     <div class="col-8 xs-gone"> </div>
                     <div class="col-10">
                         <div class="row infos-user">
                            <div class="col-lg-10 text-right xs-padding-top-20 xs-text-left">
                                 Olá, <?php echo strlen($_SESSION[ constant("cAppKey") ]["credential"]["first_name"]) > 10 ? substr($_SESSION[ constant("cAppKey") ]["credential"]["first_name"],0,10)."..." : $_SESSION[ constant("cAppKey") ]["credential"]["first_name"]; ?>
                            </div>
                            <div class="col-lg-2 text-right xs-gone">
                                <a href="<?php sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") ) ?>/sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </div>
                         </div>                        
                     </div>
                     <div class="col-2 xs-only"> 
                        <div class="menu-mobile">
                                <button class="icon btnMobile" onclick="menu()">
                                    <i class="fa fa-bars"></i>
                                </button>

                                <div class="menu-toogle">

                                    <button class="icon icon-close btnMobile" onclick="menu()">
                                        <i class="fa fa-close"></i>
                                    </button>

                                    <figure>
                                        <a href="/">
                                            <img src="<?php printf("%s%s",constant("cFurniture"),"images/logo-biolab-genericos-top.png")?>" />
                                        </a>
                                    </figure>

                                        <ul>
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/regulamento">Regulamento</a></li>
                                            <?php if(isset($user_externo)){ ?>
                                                <li><a href="<?php print( set_url( $response["campaigns"][0]["cliente_campanha_portal_configuracao"]["Url_InternaPersonalizada"]  , array( "access_token" =>  $response["oAuth"]["token_id"] , "user_id" => $response["oAuth"]["user_id"]  ) ) )  ?>">Loja de prêmios</a></li>
                                            <?php } ?>                    
                                            <li><a href="/contato">Contatos</a></li>
                                            <li><a href="<?php sprintf( "%s%s" , $_SERVER["DOCUMENT_ROOT"] , constant("cAppRoot") ) ?>/sair"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                                        </ul>    
                                </div>
                            </div>
                     </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid padding-top-20 padding-bottom-20 xs-padding-0 topo-logo-menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"> 
                    <figure>
                        <a href="/">
                            <img src="<?php printf("%s%s",constant("cFurniture"),"images/logo-biolab-genericos-top.png")?>" class="xs-gone" />
                            <img src="<?php printf("%s%s",constant("cFurniture"),"images/logo-mobile.png")?>" class="xs-only" />                            
                        </a>
                    </figure>
                </div>   
                <div class="col-lg-10 menu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/regulamento">Regulamento</a></li>
                        <?php if(isset($user_externo)){ ?>
                            <li><a href="<?php print( set_url( $response["campaigns"][0]["cliente_campanha_portal_configuracao"]["Url_InternaPersonalizada"]  , array( "access_token" =>  $response["oAuth"]["token_id"] , "user_id" => $response["oAuth"]["user_id"]  ) ) )  ?>">Loja de prêmios</a></li>
                        <?php } ?>                    
                        <li><a href="/contato">Contatos</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </div>