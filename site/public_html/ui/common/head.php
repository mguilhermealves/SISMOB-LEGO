</head>

<body>

   <div class="alert" id="alertaReturn"></div>

   <?php if (site_controller::check_login()) { ?>
      <div class="menu-mobile xs-only">
         <button class="icon bars btnMobile">
            <i class="fa fa-bars"></i>
         </button>

         <div class="menu-toogle">

            <button class="icon icon-close btnMobile">
               X
            </button>

            <figure class="logotipo">
               <a class="navbar-brand logo" href="/"><img src="<?php printf("%s%s", constant("cFurniture"), "images/logo-wikipet.png") ?>" alt="" /></a>
               </a>
            </figure>

            <nav>
               <ul>
                  <li class="<?php print(isset($page) && in_array($page, array("homepage"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["home_url"] ); ?>">Home</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("biblioteca"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["biblioteca_url"] ); ?>">Biblioteca</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("forum"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["forum_url"] ); ?>">Fórum</a></li>
                  <li class="<?php print(isset($page) && in_array($page, array("treinamentos"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["treinamentos_url"] ); ?>">Treinamentos</a></li>
                  
                  <li class="<?php print(isset($page) && in_array($page, array("meu_cadastro"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["meu_cadastro_url"] ); ?>">Meu Cadastro</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("minhas_notas"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["minhas_notas_url"] ); ?>">Minhas Notas</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("pilulas_conteudo"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["pilulas_url"] ); ?>">Pílulas de Conteúdo</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("homepage"), true) ? 'active"' : '') ?>"><a href="<?php print($GLOBALS["meus_certificados_url"]) ?>">Meus Certificados</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("notificacoes"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["notificacoes_url"] ); ?>">Notificações</a></li>
                  
                  <li class="<?php print(isset($page) && in_array($page, array("contato"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["contato_url"] ); ?>">Contato</a></li>

                  <li class="<?php print(isset($page) && in_array($page, array("login"), true) ? 'active"' : '') ?>"><a href="<?php print( $GLOBALS["logout_url"] ); ?>">Sair</a></li>

               </ul>
            </nav>



         </div>

      </div>
   <?php } ?>

   <section class="topo-site">
      <header>
         <div class="container-fluid ">

            <div class="row  ">
               <div class="col-md-12 nav-usuario p-3">


                  <nav class="row navbar navbar-expand-sm navbar-dark">

                     <div class="collapse navbar-collapse" id="collapsibleNavId">

                        <div class="col-md-2">

                           <a class="navbar-brand logo logo-top <?php printf(isset($page) && in_array($page, array("homepage"), true) ? 'active"' : '') ?>" href="<?php print($GLOBALS["homepage_url"]) ?>"><img src="<?php printf("%s%s", constant("cFurniture"), "images/logo-wikipet.png") ?>" alt="" /></a>


                        </div>

                        <div class="col-md-4">
                           <ul class="navbar-nav barra">
                              <li class="nav-item menu-principal <?php printf(isset($page) && in_array($page, array("homepage"), true) ? 'active"' : '') ?>">
                                 <a class="nav-link <?php printf(isset($page) && in_array($page, array("homepage"), true) ? 'active"' : '') ?>" href="<?php print($GLOBALS["homepage_url"]) ?>">Home</a>
                              </li>

                              <li class="nav-item menu-principal <?php printf(isset($page) && in_array($page, array("biblioteca"), true) ? 'active"' : '') ?>">
                                 <a class="nav-link <?php printf(isset($page) && in_array($page, array("biblioteca"), true) ? 'active"' : '') ?>" href="<?php print($GLOBALS["biblioteca_url"]) ?>">Biblioteca</a>
                              </li>

                              <li class="nav-item menu-principal <?php printf(isset($page) && in_array($page, array("Foruns", "Topico"), true) ? 'active"' : '') ?>">
                                 <a class="nav-link <?php printf(isset($page) && in_array($page, array("Foruns", "Topico"), true) ? 'active"' : '') ?>" href="<?php print($GLOBALS["forum_url"]) ?>">Fórum</a>
                              </li>

                              <li class="nav-item menu-principal <?php printf(isset($page) && in_array($page, array("treinamentos"), true) ? 'active"' : '') ?>">
                                 <a class="nav-link <?php printf(isset($page) && in_array($page, array("treinamentos"), true) ? 'active"' : '') ?>" href="<?php print($GLOBALS["treinamentos_url"]) ?>">Treinamentos</a>
                              </li>
                           </ul>
                        </div>

                        <div class="col-md-6">
                           <ul class="barra-direita">
                              <li class="pesquisa">
                                 <input placeholder="Pesquisar" type="text" class="MuiInputBase-input" value="">
                              </li>

                              <div>
                                 <a href="<?php print( $GLOBALS["pilulas_url"] ); ?>"> <svg class="MuiSvgIcon-root chat-home" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="width: 24px; height: 24px">
                                       <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z" fill="#FFF"></path>
                                    </svg></a>
                              </div>

                              <div>
                                 <li class="nav-item dropdown">
                                    <a class="nav-link " href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                       <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer; width: 100%;">
                                          <div class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault bord" style="margin-right: 10px;">

                                          <?php if(isset( $_SESSION[ constant("cAppKey") ]["credential"]["image"] )){
                                             print("<img src='".constant("cFrontend").$_SESSION[ constant("cAppKey") ]["credential"]["image"]."' />" );
                                          }else{
                                             print(substr($_SESSION[constant("cAppKey")]["credential"]["first_name"], 0, 1) . "" . substr($_SESSION[constant("cAppKey")]["credential"]["last_name"], 0, 1));
                                          } ?>
                                           


                                          </div>
                                          <div>
                                             <p style="color:rgb(232, 232, 232)">
                                                <?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"] . " " . $_SESSION[constant("cAppKey")]["credential"]["last_name"]); ?>
                                             </p>

                                             <p style="color:rgb(232, 232, 232)"><?php print($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["name"]) ?></p>
                                          </div>

                                          <div><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="height: 44px; width: 44px; color: rgb(232, 232, 232);">
                                                <path d="M7 10l5 5 5-5z" fill="#FFF"></path>
                                             </svg></div>

                                       </div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                       <?php if( $_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["adm"] == "yes" ){?>
                                          <a target="_blank" class="dropdown-item" href="<?php printf( $GLOBALS["ambientegestor_url"] , md5( $_SESSION[constant("cAppKey")]["credential"]["idx"] . $_SESSION[constant("cAppKey")]["credential"]["login"] ) ); ?>">Ambiente Gestor</a>
                                       <?php } ?> 
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["meu_cadastro_url"] ); ?>">Meu Cadastro</a>
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["minhas_notas_url"] ); ?>">Minhas Notas</a>
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["pilulas_url"] ); ?>">Pílulas de Conteúdo</a>
                                       <a class="dropdown-item" href="<?php print($GLOBALS["meus_certificados_url"]) ?>">Meus Certificados</a>
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["notificacoes_url"] ); ?>">Notificações</a>
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["contato_url"] ); ?>">Contato</a>
                                       <a class="dropdown-item" href="<?php print( $GLOBALS["logout_url"] ); ?>">Sair</a>
                                    </div>
                                 </li>
                              </div>
                           </ul>


                        </div>

                     </div>
                  </nav>
               </div>




               <?php if (site_controller::check_login()) { ?>


            </div>


            <!-- <div class="col-sm-9 padding-top-40 nav-usuario">
                   <nav>
                      <ul>                        
                         <li class="vertical-middle margin-left-15 margin-right-15 perfil"><a href="/meus-dados">Home</a></li>
                         <li class="vertical-middle margin-left-15 margin-right-15 perfil"><a href="/meus-dados">Biblioteca</a></li>
                         <li class="vertical-middle margin-left-15 margin-right-15 perfil"><a href="/meus-dados">Fórum</a></li>
                         <li class="vertical-middle margin-left-15 margin-right-15 perfil"><a href="/meus-dados">Treinamentos</a></li>
                         
                         <input placeholder="Pesquisar" type="text" class="MuiInputBase-input" value="">
                   
                         
                         <li class="vertical-middle margin-left-15 margin-right-15 nome"><a href=""><?php print_r($_SESSION[constant("cAppKey")]["credential"]["first_name"]) ?></a></li>
                         <li class="vertical-middle margin-left-15 margin-right-15 logout"><a href="/sair">Sair</a></li>
                         <li class="vertical-middle margin-left-15 margin-right-15 logout">
                            <a href="http://www.templuz.com/" target="_blank"><img src="<?php printf("%s%s", constant("cFurniture"), "images/icone.png") ?>" width="36" alt="" /></a></li>
                      </ul>
                   </nav>
                   
                </div> -->

         <?php } ?>
         </div>
         </div>
      </header>
   </section>

   <style>
      .MuiAvatar-root{ display: block;}
      .MuiAvatar-root img{
         position: relative;
         top: 50%;
         -ms-transform: translate(-50%, -50%);
         -webkit-transform: translate(-50%, -50%);
         transform: translate(-50%, -50%);
         left: 50%;
         width: auto;
         height: 40px;
      }
   </style>