<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Sorteio ". $data["name"] : "Cadastrar Sorteio" ) ?></span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Informações</div>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Titulo
                                    <input type="text"  name="titulo" value="<?php print( isset( $data["titulo"] ) ? $data["titulo"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Data do sorteio
                                    <input type="text"  name="data_extenso" value="<?php print( isset( $data["data_extenso"] ) ? $data["data_extenso"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                   Título Regulamento
                                    <input type="text"  name="title_regulamento" value="<?php print( isset( $data["title_regulamento"] ) ? $data["title_regulamento"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Título Permissionários
                                    <input type="text"  name="title_permissionarios" value="<?php print( isset( $data["title_permissionarios"] ) ? $data["title_permissionarios"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Título não Permissionários
                                    <input type="text"  name="title_naopermissionarios" value="<?php print( isset( $data["title_naopermissionarios"] ) ? $data["title_naopermissionarios"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                    <label>
                                        Arquivo Regulamento                                  
                                    </label>
                                    <div class="uploader">
                                        <input type="file" id="file-upload_arquivo_regulamento" name="arquivo_regulamento" value="<?php print( isset( $data["arquivo_regulamento"] ) ? $data["arquivo_regulamento"] : "" ) ?>">
                                        <label for="file-upload_arquivo_regulamento" id="file-drag_arquivo_regulamento">
                                            <img id="file-image_arquivo_regulamento" src="<?php echo constant("cFrontend") . (isset( $data["arquivo_regulamento"] ) ? $data["arquivo_regulamento"] : ""); ?>" alt="<?php isset( $data["arquivo_regulamento"] ) ? $data["arquivo_regulamento"] : "Preview" ?>" class="<?php isset( $data["arquivo_regulamento"] ) ? "" : "hidden" ?>">
                                            <div id="start_arquivo_regulamento">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Selecione o Arquivo</div>
                                            <div id="notimage_arquivo_regulamento" class="hidden">Selecione o arquivo</div>
                                            <span id="file-upload-btn_arquivo_regulamento" class="btn btn-primary">Selecione o arquivo</span>
                                            </div>
                                            <div id="response_arquivo_regulamento" class="hidden">
                                            <div id="messages_arquivo_regulamento"></div>                                       
                                            </div>
                                        </label>
                                    </div>
                                    <script>                                            
                                            ekUploadCustom("arquivo_regulamento");                                                                                    
                                    </script>                               
                                </div>
                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Arquivo Permissionários                                  
                                    </label>
                                    <div class="uploader">
                                        <input type="file" id="file-upload_arquivo_permissionarios" name="arquivo_permissionarios" value="<?php print( isset( $data["arquivo_permissionarios"] ) ? $data["arquivo_permissionarios"] : "" ) ?>">
                                        <label for="file-upload_arquivo_permissionarios" id="file-drag_arquivo_permissionarios">
                                            <img id="file-image_arquivo_permissionarios" src="<?php echo constant("cFrontend") . (isset( $data["arquivo_permissionarios"] ) ? $data["arquivo_permissionarios"] : ""); ?>" alt="<?php isset( $data["arquivo_permissionarios"] ) ? $data["arquivo_permissionarios"] : "Preview" ?>" class="<?php isset( $data["arquivo_permissionarios"] ) ? "" : "hidden" ?>">
                                            <div id="start_arquivo_permissionarios">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Selecione o Arquivo</div>
                                            <div id="notimage_arquivo_permissionarios" class="hidden">Selecione o arquivo</div>
                                            <span id="file-upload-btn_arquivo_permissionarios" class="btn btn-primary">Selecione o arquivo</span>
                                            </div>
                                            <div id="response_arquivo_permissionarios" class="hidden">
                                            <div id="messages_arquivo_permissionarios"></div>                                       
                                            </div>
                                        </label>
                                    </div>
                                    <script>                                            
                                            ekUploadCustom("arquivo_permissionarios");                                                                                    
                                    </script>                               
                                </div>
                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Arquivo Não Permissionários                                  
                                    </label>
                                    <div class="uploader">
                                        <input type="file" id="file-upload_arquivo_naopermissionarios" name="arquivo_naopermissionarios" value="<?php print( isset( $data["arquivo_naopermissionarios"] ) ? $data["arquivo_naopermissionarios"] : "" ) ?>">
                                        <label for="file-upload_arquivo_naopermissionarios" id="file-drag_arquivo_naopermissionarios">
                                            <img id="file-image_arquivo_naopermissionarios" src="<?php echo constant("cFrontend") . (isset( $data["arquivo_naopermissionarios"] ) ? $data["arquivo_naopermissionarios"] : ""); ?>" alt="<?php isset( $data["arquivo_naopermissionarios"] ) ? $data["arquivo_naopermissionarios"] : "Preview" ?>" class="<?php isset( $data["arquivo_naopermissionarios"] ) ? "" : "hidden" ?>">
                                            <div id="start_arquivo_naopermissionarios">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Selecione o Arquivo</div>
                                            <div id="notimage_arquivo_naopermissionarios" class="hidden">Selecione o arquivo</div>
                                            <span id="file-upload-btn_arquivo_naopermissionarios" class="btn btn-primary">Selecione o arquivo</span>
                                            </div>
                                            <div id="response_arquivo_naopermissionarios" class="hidden">
                                            <div id="messages_arquivo_naopermissionarios"></div>                                       
                                            </div>
                                        </label>
                                    </div>
                                    <script>                                            
                                            ekUploadCustom("arquivo_naopermissionarios");                                                                                    
                                    </script>                               
                                </div>
                            <div class="large-6 columns padding-top-20">
                            </div>
                                                      
                        </div>
                    </div>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <button type="button" class="round hollow button secondary" name="btn_back">Voltar</button>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>