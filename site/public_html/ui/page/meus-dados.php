<section class="banner-page margin-top-50" style="background-image:url(../../furniture/images/banner_aproveiteV10.jpg)">
      
      </section>
      
      <section class="formulario-cadastro margin-bottom-140 xs-margin-bottom-40">
          <div class="container-fluid">
              <div class="container limit-1500">
      
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Meu Perfil</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-8 coluna-formulario">

                      <div class="row padding-top-35 padding-bottom-15">
                        <div class="col-lg-12  padding-left-65 padding-right-65 xs-padding-left-25 xs-padding-right-25  xs-text-center">
                            <h2>Complete seus dados para ter acesso ao programa.</h2>
                        </div>
                    </div>

                        <div class="row padding-left-65 padding-right-65 xs-padding-left-25 xs-padding-right-25">
                            <div class="col-lg-12">
                                <form action="<?php print( $GLOBALS["meusdados_url"] ) ?>" method="POST" class="needs-validation">
                                    <input type="hidden" name="documento" class="campo-form form-control" value="<?php print( isset( $data["documento"] ) ? $data["documento"] : "" ) ?>" />
                                    <input type="hidden" name="email" class="campo-form form-control" value="<?php print( isset( $data["email"] ) ? $data["email"] : "" ) ?>" />
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-documento documento">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["documento"] ) ? $data["documento"] : "" ) ?>"  placeholder="CPF ou CNPJ"  disabled/>
                                        </div>
                                    </div>    
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-nome">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["nome"] ) ? $data["nome"] : "" ) ?>" name="nome" placeholder="NOME COMPLETO" required/>
                                        </div>
                                    </div>        
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-datanasc data-nasc">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["data_nascimento"] ) ? $data["data_nascimento"] : "" ) ?>" name="data_nascimento"  placeholder="DATA DE NASCIMENTO"/>
                                        </div>
                                    </div>     
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-nome">                    
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["sexo"] ) ? $data["sexo"] : "" ) ?>" name="sexo"  placeholder="GÊNERO"/>                    
                                        </div>
                                    </div>                                                         
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-email">                       
                                            <input type="email" class="campo-form form-control" value="<?php print( isset( $data["email"] ) ? $data["email"] : "" ) ?>" placeholder="EMAIL" disabled/>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-6 icon icon-celular telefone">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["celular"] ) ? $data["celular"] : "" ) ?>" name="celular"  placeholder="CELULAR" required/>
                                        </div>
                                        <div class="col-lg-6 icon icon-celular telefone">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["telefone"] ) ? $data["telefone"] : "" ) ?>" name="telefone"  placeholder="TELEFONE" required/>
                                        </div>
                                    </div>
                                                                       
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-4 icon icon-cidade xs-margin-bottom-15 cep">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["cep"] ) ? $data["cep"] : "" ) ?>" name="cep"  placeholder="CEP" required/>
                                        </div>
                                        <div class="col-lg-8 padding-left-10 xs-padding-left-0 xs-margin-bottom-15 icon icon-cidade logradouro">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["logradouro"] ) ? $data["logradouro"] : "" ) ?>" name="logradouro"  placeholder="ENDEREÇO" required/>
                                        </div>                                    
                                    </div>
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-6 icon icon-cidade cidade">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["cidade"] ) ? $data["cidade"] : "" ) ?>" name="cidade"  placeholder="CIDADE" required/>
                                        </div>
                                        <div class="col-lg-6 icon icon-cidade cidade">   
                                            <select class="campo-form form-control" name="uf">
                                                <option value="">ESTADO </option>
                                                <?php 
                                                foreach( $GLOBALS["ufbr_lists"] as $k => $v ){
                                                    printf('<option value="%s" %s>%s</option>' , $k , isset( $data["uf"] ) && $k == $data["uf"] ? ' selected' : '' , $v  ) ;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-15 margin-top-15">
                                        <div class="col-lg-12 icon icon-nome">                       
                                            <select class="campo-form form-control" name="perfil">
                                                <option value="">Perfil</option>
                                                <option value="Arquiteto" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Arquiteto' ? 'selected="selected"' : "" ); ?>>Arquiteto</option>
                                                <option value="Light Designer" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Light Designer' ? 'selected="selected"' : "" ); ?>>Light Designer</option>
                                                <option value="Designer de Interiores" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Designer de Interiores' ? 'selected="selected"' : "" ); ?>>Designer de Interiores</option>
                                                <option value="Dpto de projetos Luminotécnicos" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Dpto de projetos Luminotécnicos' ? 'selected="selected"' : "" ); ?>>Dpto de projetos Luminotécnicos</option>
                                            </select>
                                        </div>
                                    </div>
                                     
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-interesses">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["tempo_profissao"] ) ? $data["tempo_profissao"] : "" ) ?>" name="tempo_profissao"  placeholder="Tempo de Profissão"/>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-nome">                       
                                            <select class="campo-form form-control" name="formacao_academica">
                                                <option value="">Formação acadêmica </option>
                                                <option value="Bacharel" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Bacharel' ? 'selected="selected"' : "" ); ?>>Bacharel</option>
                                                <option value="Doutorado" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Doutorado' ? 'selected="selected"' : "" ); ?>>Doutorado</option>
                                                <option value="Mestrado" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Mestrado' ? 'selected="selected"' : "" ); ?>>Mestrado</option>
                                                <option value="Pós Graduação / MBA" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Pós Graduação / MBA' ? 'selected="selected"' : "" ); ?>>Pós Graduação / MBA</option>
                                                <option value="Tecnólogo" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Tecnólogo' ? 'selected="selected"' : "" ); ?>>Tecnólogo</option>
                                                <option value="Técnico" <?php print( isset( $data["perfil"] ) && $data["perfil"] == 'Técnico' ? 'selected="selected"' : "" ); ?>>Técnico</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-autonomo">                                           
                                                <div class="styled-file-select">
                                                    <input class="no-bg no-border" type="text" disabled placeholder="Envio de carteria da conselho, diploma ,certificado , etc ..." />                                              
                                                    <input  type="file" class="campo-form form-control" name="documentos_funcao" id="documentos_funcao" placeholder="Envio de carteria da conselho, diploma ,certificado , etc ... " />
                                                </div>                                                                           
                                        </div>
                                     </div>

                                     <div class="row margin-bottom-15">
                                        <div class="col-lg-12 padding-top-10 padding-bottom-10">    
                                            <label class="padding-left-20 margin-bottom-10 bold">INTERESSES:</label>
                                            <?php 
                                                if(isset( $data["interesses"] )){
                                                    $interesses = unserialize($data["interesses"]);    
                                                                                                
                                                }
                                            ?>
                                                
                                            <ul class="list-interesses padding-left-20">
                                            

                                            <li><input type="checkbox" name="interesses[artes_plasticas]" class="" value="true" <?php print( isset( $interesses["artes_plasticas"] ) ? "checked" : "" ) ?>/> Artes Plásticas</li>

                                            <li><input type="checkbox" name="interesses[automacao]" class="" value="true"  <?php print( isset( $interesses["automacao"] ) ? "checked" : "" ) ?>/> Automação</li>

                                            <li><input type="checkbox" name="interesses[design]" class="" value="true" <?php print( isset( $interesses["design"] ) ? "checked" : "" ) ?>/> Design</li>

                                            <li><input type="checkbox" name="interesses[energia_sustentavel]" class="" value="true" <?php print( isset( $interesses["energia_sustentavel"] ) ? "checked" : "" ) ?>/> Energia Sustentável</li>

                                            <li><input type="checkbox" name="interesses[gastronomia]" class="" value="true" <?php print( isset( $interesses["gastronomia"] ) ? "checked" : "" ) ?>/> Gastronomia</li>

                                            <li><input type="checkbox" name="interesses[iluminacao]" class="" value="true" <?php print( isset( $interesses["iluminacao"] ) ? "checked" : "" ) ?>/> Iluminação</li>
                                            
                                            <li><input type="checkbox" name="interesses[moda]" class="" value="true" <?php print( isset( $interesses["moda"] ) ? "checked" : "" ) ?>/> Moda</li>
                                            <li><input type="checkbox" name="interesses[musica]" class="" value="true" <?php print( isset( $interesses["musica"] ) ? "checked" : "" ) ?>/> Música</li>
                                                                                                                                    
                                            <li><input type="checkbox" name="interesses[tecnologias_inteligentes]" class="" value="true" <?php print( isset( $interesses["tecnologias_inteligentes"] ) ? "checked" : "" ) ?>/> Tecnologias Inteligentes</li>
                                         
                                            <li><input type="checkbox" name="interesses[outros]" class="interesses_open" value="true" 
                                            <?php if( isset( $interesses["outros"] ) &&  $interesses["outros"][0] != ""){ print("checked"); }else{  } ?>/> Outros</li>                                           
                                            </ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        </div>
                                    </div>   
                                                
                                    <div class="row margin-bottom-15 icon icon-interesses interesses_wrapper <?php if( isset( $interesses["outros"] ) &&  $interesses["outros"][0] != ""){  }else{ print("hidden");  } ?>">
                                        <div class="col-lg-12 padding-top-10 padding-bottom-10">  
                                        <input type="text" class="campo-form form-control margin-top-10 outros-interesses" value="<?php print( isset( $interesses["outros"] ) ?  $interesses["outros"][0] : "" ) ?>" name="interesses[outros][]"  placeholder="DEFINA OS OUTROS INTERESSES" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-alimentar">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["preferencia_alimentar"] ) ? $data["preferencia_alimentar"] : "" ) ?>" name="preferencia_alimentar"  placeholder="RESTRIÇÃO  ALIMENTAR"/>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-interesses">                       
                                            <input type="text" class="campo-form form-control" value="<?php print( isset( $data["hobby"] ) ? $data["hobby"] : "" ) ?>" name="hobby"  placeholder="HOBBY"/>
                                        </div>
                                    </div>

                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-whatss">                       
                                            <select class="campo-form form-control" value="<?php print( isset( $data["contato_whatsapp"] ) ? $data["contato_whatsapp"] : "" ) ?>" name="contato_whatsapp">
                                                <option value="">Gostaria de ser contactado whatsapp</option>
                                                <option value="sim" <?php print( isset( $data["contato_whatsapp"] ) && $data["contato_whatsapp"] == 'sim' ? 'selected="selected"' : "" ); ?>>Sim</option>
                                                <option value="nao" <?php print( isset( $data["contato_whatsapp"] ) && $data["contato_whatsapp"] == 'nao' ? 'selected="selected"' : "" ); ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12 icon icon-nome">                       
                                            <select class="campo-form form-control" value="<?php print( isset( $data["contato_email"] ) ? $data["contato_email"] : "" ) ?>" name="contato_whatsapp">
                                                <option value="">Aceita receber comunicação por EMAIL?</option>
                                                <option value="sim" <?php print( isset( $data["contato_email"] ) && $data["contato_email"] == 'sim' ? 'selected="selected"' : "" ); ?>>Sim</option>
                                                <option value="nao" <?php print( isset( $data["contato_email"] ) && $data["contato_email"] == 'nao' ? 'selected="selected"' : "" ); ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-15">
                                        <div class="col-lg-12  text-right xs-text-center"> 
                                            <button type="submit">enviar</button>
                                        </div>                             
                                    </div>
                                                       

                                </form>                                  
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
