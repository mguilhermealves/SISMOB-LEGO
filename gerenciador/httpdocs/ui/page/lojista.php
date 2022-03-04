<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Lojista ". $data["name"] : "Cadastrar Lojista" ) ?></span>
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
                                        Imagem
                                    </label>

                                    <div class="uploader">
                                        <input type="file" id="file-upload" name="imagem" value="<?php print( isset( $data["imagem"] ) ? $data["imagem"] : "" ) ?>">

                                        <label for="file-upload" id="file-drag">
                                            <img id="file-image" src="<?php echo constant("cFrontend") . (isset( $data["imagem"] ) ? $data["imagem"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem"] ) ? "" : "hidden" ?>">
                                            <div id="start">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Selecione o arquivo de Imagem</div>
                                            <div id="notimage" class="hidden">Selecione a imagem</div>
                                            <span id="file-upload-btn" class="btn btn-primary">Selecione a imagem</span>
                                            </div>
                                            <div id="response" class="hidden">
                                            <div id="messages"></div>                                       
                                            </div>
                                        </label>
                                    </div>                               
                                </div>
                                <div class="large-6 columns padding-top-20">
                                    <label>
                                        Conteudo
                                        <textarea rows="10" cols="10"  name="conteudo" class="editor"><?php print( isset( $data["conteudo"] ) ? $data["conteudo"] : "" ) ?></textarea>
                                    </label>
                                </div>    

                                <div class="large-12 columns padding-top-20">
                                    <label>
                                        Conteudo Estrutura
                                        <textarea rows="10" cols="10"  name="conteudo_estrutura" class="editor"><?php print( isset( $data["conteudo_estrutura"] ) ? $data["conteudo_estrutura"] : "" ) ?></textarea>
                                    </label>
                                </div>   
                                
                                <div class="large-12 columns padding-top-20 padding-bottom-20">
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Imagem Estrutura 1                                            
                                        </label>
                                        <div class="uploader">
                                            <input type="file" id="file-upload_imagem_estrutura_1" name="imagem_estrutura_1" value="<?php print( isset( $data["imagem_estrutura_1"] ) ? $data["imagem_estrutura_1"] : "" ) ?>">
                                            <label for="file-upload_imagem_estrutura_1" id="file-drag_imagem_estrutura_1">
                                                <img id="file-image_imagem_estrutura_1" src="<?php echo constant("cFrontend") . (isset( $data["imagem_estrutura_1"] ) ? $data["imagem_estrutura_1"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_estrutura_1"] ) ? "" : "hidden" ?>">
                                                <div id="start_imagem_estrutura_1">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div>Selecione o arquivo de Imagem</div>
                                                <div id="notimage_imagem_estrutura_1" class="hidden">Selecione a imagem</div>
                                                <span id="file-upload-btn_imagem_estrutura_1" class="btn btn-primary">Selecione a imagem</span>
                                                </div>
                                                <div id="response_imagem_estrutura_1" class="hidden">
                                                <div id="messages_imagem_estrutura_1"></div>                                       
                                                </div>
                                            </label>
                                        </div>
                                        <script>                                            
                                                ekUploadCustom("imagem_estrutura_1");                                                                                    
                                        </script>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Imagem Estrutura 2                                        
                                        </label>
                                        <div class="uploader">
                                            <input type="file" id="file-upload_imagem_estrutura_2" name="imagem_estrutura_2" value="<?php print( isset( $data["imagem_estrutura_2"] ) ? $data["imagem_estrutura_2"] : "" ) ?>">
                                            <label for="file-upload_imagem_estrutura_2" id="file-drag_imagem_estrutura_2">
                                                <img id="file-image_imagem_estrutura_2" src="<?php echo constant("cFrontend") . (isset( $data["imagem_estrutura_2"] ) ? $data["imagem_estrutura_2"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_estrutura_2"] ) ? "" : "hidden" ?>">
                                                <div id="start_imagem_estrutura_2">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div>Selecione o arquivo de Imagem</div>
                                                <div id="notimage_imagem_estrutura_2" class="hidden">Selecione a imagem</div>
                                                <span id="file-upload-btn_imagem_estrutura_2" class="btn btn-primary">Selecione a imagem</span>
                                                </div>
                                                <div id="response_imagem_estrutura_2" class="hidden">
                                                <div id="messages_imagem_estrutura_2"></div>                                       
                                                </div>
                                            </label>
                                        </div>
                                        <script>                                            
                                                ekUploadCustom("imagem_estrutura_2");                                                                                    
                                        </script>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Imagem Estrutura 3                                            
                                        </label>
                                        <div class="uploader">
                                            <input type="file" id="file-upload_imagem_estrutura_3" name="imagem_estrutura_3" value="<?php print( isset( $data["imagem_estrutura_3"] ) ? $data["imagem_estrutura_3"] : "" ) ?>">
                                            <label for="file-upload_imagem_estrutura_3" id="file-drag_imagem_estrutura_3">
                                                <img id="file-image_imagem_estrutura_3" src="<?php echo constant("cFrontend") . (isset( $data["imagem_estrutura_3"] ) ? $data["imagem_estrutura_3"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_estrutura_3"] ) ? "" : "hidden" ?>">
                                                <div id="start_imagem_estrutura_3">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div>Selecione o arquivo de Imagem</div>
                                                <div id="notimage_imagem_estrutura_3" class="hidden">Selecione a imagem</div>
                                                <span id="file-upload-btn_imagem_estrutura_3" class="btn btn-primary">Selecione a imagem</span>
                                                </div>
                                                <div id="response_imagem_estrutura_3" class="hidden">
                                                <div id="messages_imagem_estrutura_3"></div>                                       
                                                </div>
                                            </label>
                                        </div>
                                        <script>                                            
                                                ekUploadCustom("imagem_estrutura_3");                                                                                    
                                        </script>
                                    </div>
                                </div>
                                
                                <div class="large-12 columns padding-top-20 padding-bottom-20">
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Estrutura 1
                                            <textarea rows="10" cols="10"  name="estrutura_1" class="editor"><?php print( isset( $data["estrutura_1"] ) ? $data["estrutura_1"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Estrutura 2
                                            <textarea rows="10" cols="10"  name="estrutura_2" class="editor"><?php print( isset( $data["estrutura_2"] ) ? $data["estrutura_2"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-4 columns padding-top-20">
                                        <label>
                                            Estrutura 3
                                            <textarea rows="10" cols="10"  name="estrutura_3" class="editor"><?php print( isset( $data["estrutura_3"] ) ? $data["estrutura_3"] : "" ) ?></textarea>
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
                                
                                <div class="large-6 columns padding-top-20">
                                    <label>
                                        Imagem Benefícios                                     
                                    </label>
                                    <div class="uploader">
                                        <input type="file" id="file-upload_imagem_beneficios" name="imagem_beneficios" value="<?php print( isset( $data["imagem_beneficios"] ) ? $data["imagem_beneficios"] : "" ) ?>">
                                        <label for="file-upload_imagem_beneficios" id="file-drag_imagem_beneficios">
                                            <img id="file-image_imagem_beneficios" src="<?php echo constant("cFrontend") . (isset( $data["imagem_beneficios"] ) ? $data["imagem_beneficios"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_beneficios"] ) ? "" : "hidden" ?>">
                                            <div id="start_imagem_beneficios">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Selecione o arquivo de Imagem</div>
                                            <div id="notimage_imagem_beneficios" class="hidden">Selecione a imagem</div>
                                            <span id="file-upload-btn_imagem_beneficios" class="btn btn-primary">Selecione a imagem</span>
                                            </div>
                                            <div id="response_imagem_beneficios" class="hidden">
                                            <div id="messages_imagem_beneficios"></div>                                       
                                            </div>
                                        </label>
                                    </div>
                                    <script>                                            
                                            ekUploadCustom("imagem_beneficios");                                                                                    
                                    </script>                               
                                </div>
                                <div class="large-6 columns padding-top-20 padding-bottom-20">
                                    <label>
                                        Conteudo Benefícios
                                        <textarea rows="10" cols="10"  name="conteudo_beneficios" class="editor"><?php print( isset( $data["conteudo_beneficios"] ) ? $data["conteudo_beneficios"] : "" ) ?></textarea>
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