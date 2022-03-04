

<section class="banner-page margin-top-50" style="background-image:url(../../furniture/images/banner_aproveiteV10.jpg)">
      
</section>

<section class="formulario-cadastro margin-bottom-140 xs-margin-bottom-40">
    <div class="container-fluid">
        <div class="container">

            <div class="row">
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-lg-12 title-vertical">
                            <h3>Cadastre-se</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 coluna-formulario">
                   
                    <div class="row padding-top-35 padding-bottom-15">
                        <div class="col-lg-12 text-center padding-left-65 padding-right-65 xs-padding-left-25 xs-padding-right-25 xs-text-center">
                           
                        </div>
                    </div>
                    <div class="row padding-left-65 padding-right-65 xs-padding-left-25 xs-padding-right-25">
                        <div class="col-lg-12">
                            <?php
                            if( isset($info["get"]["sucess"]) ){
                            ?>
                            <div class="margin-top-150 margin-bottom-150 text-center">
				Cadastro realizado com sucesso!<br>Seus dados estão em análise e assim que for realizada a aprovação<br> enviaremos um e-mail para finalizar seus dados de acesso.
                            <?php
                            }
                            else{
                            ?>
                            <form id="frm_precadastro" action="<?php print( $GLOBALS["cadastrar_participante_url"] ) ?>" method="POST" enctype="multipart/form-data"  class="needs-validation">
                               
                                <div class="row">
                                    <div class="col-lg-12" id="corpoForm">

                                        <?php
                                            if(isset($_GET["pessoa"]) && $_GET["pessoa"]=="fisica" || (isset($_SESSION["CADASTRO"]["tipo"]) && $_SESSION["CADASTRO"]["tipo"] == "fisica")){
                                                    include( constant("cRootServer") . "ui/includes/pessoa_fisica.php");
                                            }else if(isset($_GET["pessoa"]) && $_GET["pessoa"]=="juridica"){
                                                include( constant("cRootServer") . "ui/includes/pessoa_juridica.php");
                                            }else{ 
                                        ?>

                                            <div class="row margin-top-150 margin-bottom-15">
                                                <div class="col-lg-12 text-center">
                                                    <label><b>Selecione o tipo de cadastro:</b></label>
                                                </div>
                                            </div>

                                            <div class="row margin-top-45 margin-bottom-150 selecao-pessoa">
                                                <div class="col-lg-6 xs-margin-bottom-20 text-center">
                                                    <a href="/cadastro?pessoa=fisica">Pessoa Física</a>
                                                </div>
                                                <div class="col-lg-6 xs-margin-bottom-20 text-center">
                                                    <a href="/cadastro?pessoa=juridica">Pessoa Jurídica</a>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>

                                
                            </form>
                            <?php
                            }
                            ?>                                  
                        </div>
                    </div>    

                    <div class="row margin-top-10">
                        <div class="col-lg-12 padding-top-20 padding-bottom-20 barra-baixo"> 
                            
                        </div>                             
                    </div>
                    
                </div>
                <div class="col-lg-2 xs-gone">

                </div>
            </div>
               


        </div>
    </div>
</section>



<div id="linhaSocios" class="row padding-top-25 padding-bottom-25">
    <div class="col-lg-12">
        <div class="row margin-bottom-15">
            <div class="col-lg-6 padding-right-5 icon icon-nome">                       
                <input type="text" class="campo-form form-control" name="socios[nome][]"  placeholder="Nome do Responsável "  data-validation="required"/>
            </div>
            <div class="col-lg-6 padding-left-5 icon icon-nome data-nasc">                       
                <input type="text" class="campo-form form-control" name="socios[data_nascimento][]"  placeholder="Data de nascimento" data-validation="required"/>
            </div>
        </div>
        

        <div class="row margin-bottom-15 margin-top-15">
            <div class="col-lg-6 padding-right-5 icon icon-nome">                       
                <select class="campo-form form-control" name="socios[perfil][]" data-validation="required">
                    <option value="">Perfil</option>
                    <option value="Arquiteto">Arquiteto</option>
                    <option value="Light Designer">Light Designer</option>
                    <option value="Designer de Interiores">Designer de Interiores</option>
                </select>
            </div>
            <div class="col-lg-6 padding-left-5 icon icon-nome">                       
                <input type="text" class="campo-form form-control" name="socios[sexo][]"  placeholder="GÊNERO" data-validation="required"/>
            </div>
        </div>
        
        <div class="row margin-bottom-15">
            <div class="col-lg-12 icon icon-nome data-nasc">                       
                <input type="text" class="campo-form form-control" name="socios[ano_inicio_funcao][]"  placeholder="Ano de início da função " data-validation="required"/>
            </div>
        </div>

        <div class="row margin-bottom-15">
            <div class="col-lg-12 icon icon-nome">                       
                <select class="campo-form form-control" name="socios[formacao_academica][]" data-validation="required">
		    <option value="">Formação acadêmica</option>
                    <option value="Bacharel">Bacharel</option>
                    <option value="Doutorado">Doutorado</option>
                    <option value="Mestrado">Mestrado</option>
                    <option value="Pós Graduação">Pós Graduação / MBA</option>
                    <option value="Tecnólogo">Tecnólogo</option>
                    <option value="Técnico">Técnico</option>
                </select>
            </div>
        </div>


    </div>
        
</div>
