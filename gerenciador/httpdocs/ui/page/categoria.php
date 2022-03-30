<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["title"] ) ? "Editar Faixa ". $data["title"] : "Cadastrar Faixa" ) ?></span>
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
                                    Nome
                                    <input type="text"  name="title" value="<?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?>">
                                </label>
                            </div>   
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Acelerador
                                    <input type="text"  name="acelerador" value="<?php print( isset( $data["acelerador"] ) ? $data["acelerador"] : "" ) ?>">
                                </label>
                            </div>                                                     
                        </div>
                    </div>

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                                <label>
                                    Icone
                                </label>
                                
                                <div class="uploader">
                                     <input type="file" id="file-upload" name="icone" value="<?php print( isset( $data["icone"] ) ? $data["icone"] : "" ) ?>">
                              
                                    <label for="file-upload" id="file-drag">
                                        <img id="file-image" src="<?php echo constant("cFrontend") . (isset( $data["icone"] ) ? $data["icone"] : ""); ?>" alt="Preview" class="<?php isset( $data["icone"] ) ? "" : "hidden" ?>">
                                        <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Selecione o arquivo de Imagem ou Arraste uma imagem dentro da área</div>
                                        <div id="notimage" class="hidden">Selecione a imagem</div>
                                        <span id="file-upload-btn" class="btn btn-primary">Selecione a imagem</span>
                                        </div>
                                        <div id="response" class="hidden">
                                        <div id="messages"></div>                                       
                                        </div>
                                    </label>
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