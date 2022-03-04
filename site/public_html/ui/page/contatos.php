<section class="padding-top-150 bg-image-full">
          <div class="container-fluid">
              <div class="container padding-top-35 padding-bottom-100 limit-1500">

                <div class="row margin-bottom-65 xs-margin-bottom-35">
                    <div class="col-lg-2">

                    </div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-12 padding-left-100 xs-padding-0">

                                <div class="row infos-contato">
                                    <div class="col-lg-12  xs-padding-right-25   xs-padding-left-25 text-center">
                                    <p><?php echo $homepage->data[0]["info_contato"]; ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                  <div class="row">
                      <div class="col-lg-2">                          
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-10 centro-full">
                            <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Fale Conosco</h3>
                              </div>
                            </div>

                            <div class="row  padding-left-100 xs-padding-0">
                                <div class="col-lg-12 conteudo-telafull">

                                    <div class="row">
                                        <div class="col-lg-6 padding-35 padding-right-5 xs-padding-25 xs-padding-right-25">

                                            <form data-action="contato" id="formSend" class="needs-validation">

                                                    <div class="row margin-bottom-15">
                                                        <div class="col-lg-12 xs-margin-bottom-15 icon icon-nome">                       
                                                            <input type="text" class="campo-form form-control" name="nome" placeholder="NOME"  required/>
                                                        </div>                                                       
                                                    </div>

                                                    <div class="row margin-bottom-15 xs-margin-bottom-5">
                                                        <div class="col-lg-6 icon icon-celular telefone">                       
                                                            <input type="text" class="campo-form form-control" name="celular"  placeholder="CELULAR" required/>
                                                        </div>
                                                        <div class="col-lg-6 text-center xs-text-left padding-top-10 icon padding-left-10">                       
                                                            <label class="text-10-pt"><input type="checkbox" name="whatsapp" value="1" class="margin-bottom-15 margin-top-5 margin-right-10" />
                                                            O número é Whatsapp?</label>  
                                                        </div>
                                                    </div>

                                                    <div class="row margin-bottom-15">
                                                        <div class="col-lg-12 xs-padding-left-0 icon icon-email">                       
                                                            <input type="email" class="campo-form form-control" name="email"  placeholder="EMAIL" required/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row margin-bottom-15 xs-margin-top-0">
                                                        <div class="col-lg-12 textarea">                                                                                 
                                                            <textarea class="campo-form form-control" placeholder="MENSAGEM" name="mensagem"></textarea>
                                                        </div>                   
                                                    </div>
                                                    
                                                    <div class="row margin-bottom-15">
                                                        <div class="col-lg-12"> 
                                                            <button type="submit">Enviar</button>
                                                        </div>                             
                                                    </div>

                                            </form>

                                        </div>   

                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-12 padding-35">
                                                    <?php echo $homepage->data[0]["localizacao"]; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>


                                    
                                
                                        
                                    <div class="row margin-top-10">
                                        <div class="col-lg-12 padding-top-20 padding-bottom-20 barra-baixo">                                 
                                        </div>                             
                                    </div>

                                </div>
                            </div>
                            
                      </div>
                      <!-- <div class="col-lg-2">
                            
                      </div> -->
                  </div>
                     
      
      
              </div>
          </div>
</section>