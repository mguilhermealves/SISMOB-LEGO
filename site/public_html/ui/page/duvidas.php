<section class="padding-top-200 xs-padding-top-150 bg-image-full">
          <div class="container-fluid">
              <div class="container padding-top-100 padding-bottom-100 xs-padding-top-50 limit-1500">
      
                  <div class="row">
                      <div class="col-lg-2">                          
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-8 centro-full">

                            <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Dúvidas Frequentes</h3>
                              </div>
                            </div>

                            <div class="row padding-left-100 xs-padding-left-0">
                                <div class="col-lg-12 conteudo-telafull">

                                    <div class="row">
                                        <div class="col-lg-12 padding-35 xs-padding-20 lista-faq">

                                            <form action="" method="post">
                                                <div class="row margin-bottom-15 busca-duvidas">
                                                    <div class="col-lg-11 col-10">
                                                        <input type="search" class="form-control" placeholder="Buscar" name="busca_duvida" />
                                                    </div>
                                                    <div class="col-lg-1 col-2 text-center">
                                                        <button type="submit"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="accordion" id="perguntasFrequentes">
                                                <?php $cont = 0; foreach($perguntas_frequentes["data"] as $perguntas){ ?>
                                                    <div class="card">
                                                        <div class="card-header" id="pergunta_<?php echo $cont; ?>">
                                                            <h3 class="mb-0">
                                                                <button class="btn btn-link btn-block text-left xs-text-center" type="button" data-toggle="collapse" data-target="#toresposta_<?php echo $cont;?>" aria-expanded="<?php echo $cont == 0 ? "true" : ""; ?>" aria-controls="toresposta_<?php echo $cont;?>">
                                                                    <?php echo $perguntas["pergunta"] ?>
                                                                </button>
                                                            </h3>
                                                        </div>

                                                        <div id="toresposta_<?php echo $cont;?>" class="collapse <?php echo $cont == 0 ? "show" : ""; ?>" aria-labelledby="pergunta_<?php echo $cont; ?>" data-parent="#perguntasFrequentes">
                                                            <div class="card-body xs-text-center">
                                                                <?php echo $perguntas["resposta"] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php $cont++; } ?>                            
                                            </div>

                                            <?php if(isset($search)){ ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button class="btn-voltar" onclick="history.go(-1)">VOLTAR</button>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                
                                        
                                    <div class="row margin-top-10">
                                        <div class="col-lg-12 padding-top-20 padding-bottom-20 barra-baixo">                                 
                                        </div>                             
                                    </div>

                                </div>
                            </div>
                            
                      </div>
                      <div class="col-lg-2">
                            
                      </div>
                  </div>
                     
      
      
              </div>
          </div>
</section>