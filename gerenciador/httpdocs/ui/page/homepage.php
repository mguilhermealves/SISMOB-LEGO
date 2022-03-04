<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Homepage ". $data["name"] : "Cadastrar Homepage" ) ?></span>
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
                                    <input type="text"  name="titulo_inicio" value="<?php print( isset( $data["titulo_inicio"] ) ? $data["titulo_inicio"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Subtitulo
                                    <input type="text"  name="subtitulo_inicio" value="<?php print( isset( $data["subtitulo_inicio"] ) ? $data["subtitulo_inicio"] : "" ) ?>">
                                </label>
                            </div>                            
                            <div class="large-12 columns padding-top-20">

                                <label>
                                    Imagem Banner
                                </label>
                                
                                <div class="uploader">
                                     <input type="file" id="file-upload" name="banner_baixo" value="<?php print( isset( $data["banner_baixo"] ) ? $data["banner_baixo"] : "" ) ?>">
                              
                                    <label for="file-upload" id="file-drag">
                                        <img id="file-image" src="<?php echo constant("cFrontend") . (isset( $data["banner_baixo"] ) ? $data["banner_baixo"] : ""); ?>" alt="Preview" class="<?php isset( $data["banner_baixo"] ) ? "" : "hidden" ?>">
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
                            <div class="large-12 padding-bottom-20 columns">
                                
                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Infos Contato
                                        <textarea rows="10" cols="10"  name="info_contato" class="editor"><?php print( isset( $data["info_contato"] ) ? $data["info_contato"] : "" ) ?></textarea>
                                    </label>
                                </div>

                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Rodapé 1
                                        <textarea rows="10" cols="10"  name="info_rodape_1" class="editor"><?php print( isset( $data["info_rodape_1"] ) ? $data["info_rodape_1"] : "" ) ?></textarea>
                                    </label>
                                </div>

                                <div class="large-4 columns padding-top-20">
                                    <label>
                                        Rodapé 2
                                        <textarea rows="10" cols="10"  name="info_rodape_2" class="editor"><?php print( isset( $data["info_rodape_2"] ) ? $data["info_rodape_2"] : "" ) ?></textarea>
                                    </label>
                                </div>                                   
                            </div>    
                                <div class="large-12 columns padding-top-20">
                                    <div class="large-3 columns padding-top-20">
                                        <label>
                                            Instagram
                                            <input type="text"  name="instagram" value="<?php print( isset( $data["instagram"] ) ? $data["instagram"] : "" ) ?>">
                                        </label>
                                    </div>

                                    <div class="large-3 columns padding-top-20">
                                        <label>
                                            Facebook
                                            <input type="text"  name="facebook" value="<?php print( isset( $data["facebook"] ) ? $data["facebook"] : "" ) ?>">
                                        </label>
                                    </div>

                                    <div class="large-3 columns padding-top-20">
                                        <label>
                                            Twitter
                                            <input type="text"  name="twitter" value="<?php print( isset( $data["twitter"] ) ? $data["twitter"] : "" ) ?>">
                                        </label>
                                    </div>

                                    <div class="large-3 columns padding-top-20">
                                        <label>
                                            Whatsapp
                                            <input type="text"  name="whatsapp" value="<?php print( isset( $data["whatsapp"] ) ? $data["whatsapp"] : "" ) ?>">
                                        </label>
                                    </div>

                                    <div class="large-12 columns padding-top-20">
                                        <label>
                                            Mapa
                                            <input type="text"  name="localizacao" value='<?php print( isset( $data["localizacao"] ) ? $data["localizacao"] : "" ) ?>'>
                                        </label>
                                    </div>

                                </div>   

                                <div class="large-12 columns padding-top-20 padding-left-20 bxs_user">
                                    <label>
                                        Perguntas e Respostas
                                        <button class="btn button round success" type="button" id="btn_add_pergunta">Adicionar Pergunta</button>
                                    </label>
                                    <div class="accordion accordion-flush" id="accordionFlushExample"></div>
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