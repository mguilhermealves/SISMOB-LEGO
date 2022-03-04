<section class="banner-page margin-top-50" style="background-image:url(../../furniture/images/Lo_banner_mural_de_notcias_02.jpg)">
</section>
      
      <section class="margin-bottom-140 xs-margin-bottom-40">
          <div class="container-fluid">
              <div class="container limit-1500">
      
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Mural de Notícias</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                        <div class="col-lg-8 coluna-formulario">
                            <div class="row">
                                <div id="listaTotal" class="col-lg-12 padding-top-25 padding-bottom-25 padding-left-30 padding-right-30">

                                    <?php foreach($noticias->data as $k => $v){ ?>
                                         <?php if($k%2 == 0){ ?>
                                            <div class="row padding-left-10 padding-right-10 margin-bottom-40 listagem-noticias">
                                                <div class="col-lg-6">
                                                    <div class="row vert-relative">
                                                        <div class="col-lg-12 title-categ-vertical left">
                                                            <h3><?php printf($v["categorianoticias_attach"][0]["title"]) ?></h3>
                                                        </div>
                                                    </div>
                                                    <a href="<?php printf( $GLOBALS["noticia_url"] , $v["slug"] ) ?>">
                                                        <div class="imagem-noticia">
                                                            <img src="<?php printf($v["image"]) ?>" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 padding-left-35 xs-padding-left-0 resumo">
                                                    <a href="<?php printf( $GLOBALS["noticia_url"] , $v["slug"] ) ?>">
                                                        <h2><?php printf($v["title"]) ?></h2>
                                                        <p><?php printf($v["resume"]) ?></p>
                                                    </a>
                                                </div>
                                            </div>
                                         <?php }else{ ?>
                                            <div class="row padding-left-10 padding-right-10 margin-bottom-40 listagem-noticias">
                                                <div class="col-lg-6 padding-right-35 resumo">                                            
                                                     <a href="<?php printf( $GLOBALS["noticia_url"] , $v["slug"] ) ?>">
                                                        <h2><?php printf($v["title"]) ?></h2>
                                                        <p><?php printf($v["resume"]) ?></p>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6">   
                                                    <div class="row vert-relative">
                                                        <div class="col-lg-12 title-categ-vertical right">
                                                            <h3><?php printf($v["categorianoticias_attach"][0]["title"]) ?></h3>
                                                        </div>
                                                    </div>                                      
                                                    <a href="<?php printf( $GLOBALS["noticia_url"] , $v["slug"] ) ?>">
                                                        <div class="imagem-noticia">
                                                            <img src="<?php printf($v["image"]) ?>" />
                                                        </div>
                                                    </a>                                        
                                                </div>
                                            </div>
                                         <?php } ?>
                                    <?php } ?>
                                                                        
                                </div>  
                            </div>

                            
                                                        
                            <div class="row margin-top-10">
                                <div class="col-lg-12 padding-top-20 padding-bottom-20 barra-baixo">                                 
                                </div>                             
                            </div>
                        </div>
                      <div class="col-lg-2 xs-gone">
                            <?php include( constant("cRootServer") . "ui/includes/lateral-agenda.php"); ?>                    
                      </div>
                  </div>
                     
      
      
              </div>
          </div>
      </section>