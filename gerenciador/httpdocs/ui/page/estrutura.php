<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Estrutura ". $data["name"] : "Cadastrar Estrutura" ) ?></span>
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
                                
                                <div class="large-12 columns padding-top-20 padding-bottom-20">
                                    <div class="large-2 columns padding-top-20">
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
                                    <div class="large-2 columns padding-top-20">
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
                                    <div class="large-2 columns padding-top-20">
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
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Imagem Estrutura 4                                            
                                        </label>
                                        <div class="uploader">
                                            <input type="file" id="file-upload_imagem_estrutura_4" name="imagem_estrutura_4" value="<?php print( isset( $data["imagem_estrutura_4"] ) ? $data["imagem_estrutura_4"] : "" ) ?>">
                                            <label for="file-upload_imagem_estrutura_4" id="file-drag_imagem_estrutura_4">
                                                <img id="file-image_imagem_estrutura_4" src="<?php echo constant("cFrontend") . (isset( $data["imagem_estrutura_4"] ) ? $data["imagem_estrutura_4"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_estrutura_4"] ) ? "" : "hidden" ?>">
                                                <div id="start_imagem_estrutura_4">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div>Selecione o arquivo de Imagem</div>
                                                <div id="notimage_imagem_estrutura_4" class="hidden">Selecione a imagem</div>
                                                <span id="file-upload-btn_imagem_estrutura_4" class="btn btn-primary">Selecione a imagem</span>
                                                </div>
                                                <div id="response_imagem_estrutura_4" class="hidden">
                                                <div id="messages_imagem_estrutura_4"></div>                                       
                                                </div>
                                            </label>
                                        </div>
                                        <script>                                            
                                                ekUploadCustom("imagem_estrutura_4");                                                                                    
                                        </script>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Imagem Estrutura 5                                          
                                        </label>
                                        <div class="uploader">
                                            <input type="file" id="file-upload_imagem_estrutura_5" name="imagem_estrutura_5" value="<?php print( isset( $data["imagem_estrutura_5"] ) ? $data["imagem_estrutura_5"] : "" ) ?>">
                                            <label for="file-upload_imagem_estrutura_5" id="file-drag_imagem_estrutura_5">
                                                <img id="file-image_imagem_estrutura_5" src="<?php echo constant("cFrontend") . (isset( $data["imagem_estrutura_5"] ) ? $data["imagem_estrutura_5"] : ""); ?>" alt="Preview" class="<?php isset( $data["imagem_estrutura_5"] ) ? "" : "hidden" ?>">
                                                <div id="start_imagem_estrutura_5">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div>Selecione o arquivo de Imagem</div>
                                                <div id="notimage_imagem_estrutura_5" class="hidden">Selecione a imagem</div>
                                                <span id="file-upload-btn_imagem_estrutura_5" class="btn btn-primary">Selecione a imagem</span>
                                                </div>
                                                <div id="response_imagem_estrutura_5" class="hidden">
                                                <div id="messages_imagem_estrutura_5"></div>                                       
                                                </div>
                                            </label>
                                        </div>
                                        <script>                                            
                                                ekUploadCustom("imagem_estrutura_5");                                                                                    
                                        </script>
                                    </div>
                                    <div class="large-2 columns padding-top-20"></div>
                                </div>
                                
                                <div class="large-12 columns padding-top-20 padding-bottom-20">
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Estrutura 1
                                            <textarea rows="10" cols="10"  name="estrutura_1" class="editor"><?php print( isset( $data["estrutura_1"] ) ? $data["estrutura_1"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Estrutura 2
                                            <textarea rows="10" cols="10"  name="estrutura_2" class="editor"><?php print( isset( $data["estrutura_2"] ) ? $data["estrutura_2"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Estrutura 3
                                            <textarea rows="10" cols="10"  name="estrutura_3" class="editor"><?php print( isset( $data["estrutura_3"] ) ? $data["estrutura_3"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Estrutura 4
                                            <textarea rows="10" cols="10"  name="estrutura_4" class="editor"><?php print( isset( $data["estrutura_4"] ) ? $data["estrutura_4"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20">
                                        <label>
                                            Estrutura 5
                                            <textarea rows="10" cols="10"  name="estrutura_5" class="editor"><?php print( isset( $data["estrutura_5"] ) ? $data["estrutura_5"] : "" ) ?></textarea>
                                        </label>
                                    </div>
                                    <div class="large-2 columns padding-top-20"></div>
                                </div>

                                <div class="large-12 columns padding-top-20 padding-left-20">
                                    <label>
                                        Galeria de fotos
                                       
                                        <p>
                                            <label for="imagens_galery" class="button hollow">Selecionar Imagens +</label>
                                            <input class="show-for-sr" type="file" id="imagens_galery" name="imagens_galery[]" multiple/>
                                        </p>
                                        <div class="quote-imgs-thumbs <?php echo count($data["imagens_infra"]) > 0 ? "" : "quote-imgs-thumbs--hidden" ?>" id="img_preview" aria-live="polite">
                                            <p style="font-weight: bold;"><?php ?> Imagens selcionadas</p>
                                            <?php if($data["imagens_infra"] != null && count($data["imagens_infra"]) > 0 ){
                                                $cont = 0;
                                                foreach($data["imagens_infra"] as $image_infra){?>
                                                    <div style="float:left;width: 150px;height: 190px;">
                                                        <button onclick="deleteGalery(<?php echo $cont ?>)" class="galery_image<?php echo $cont ?> exluir-image-galery"><i class="icon-trash"></i></button>
                                                        <input class="show-for-sr galery_image<?php echo $cont ?>" type="hidden" id="imagens_galery<?php echo $cont ?>" name="imagens_galery_edit[]" value="<?php echo $image_infra; ?>"/>
                                                        <img src="<?php echo constant("cFrontend") . $image_infra; ?>" class="img-preview-thumb galery_image<?php echo $cont ?>">
                                                    </div>
                                                <?php $cont ++; } ?>
                                            <?php } ?>
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