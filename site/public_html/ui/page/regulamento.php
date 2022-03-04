<section class="banner-page margin-top-50" style="background-image:url(../../furniture/images/Lo_banner_regulamento.jpg)">
      
      </section>
      
      <section class="margin-bottom-140 xs-margin-bottom-40">
          <div class="container-fluid">
              <div class="container limit-1500">
      
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Regulamento</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-8 coluna-formulario">

                            <div id="listaTotal" class="row text-interna">
                                <div class="col-lg-12 padding-top-25 padding-bottom-25 padding-left-30 padding-right-30">
                                       <?php print_r($regulamento->data[0]["context"]) ?>
                                       <div class="row">
                                           <div class="col-lg-12 padding-bottom-20 text-right formulario-cadastro">
                                               <form action="/regulamento" method="post">
                                                   <label>
                                                        <input type="checkbox" name="aceite_termo" required/>
                                                        Aceito os termos do regulamento
                                                   </label><br/>
                                                    <button class="margin-top-20" type="submit">Aceitar e Enviar</button>
                                               </form>
                                           </div>
                                       </div>
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