<!-- Container Begin -->
<div class="row">

        <div class="container-fluid box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( $form["title"] ) ?></span>
                </h3>
            </div>
        </div>

        <div class="container-fluid box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>

                    <div class="container-fluid bxs_user">
                        <div class="header" style="margin-bottom:30px">Dados</div>
                        
                          
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                    Título</label>
                                        <input type="text" class="form-control"  name="lessons_title" value="<?php print( isset( $data["lessons_title"] ) ? $data["lessons_title"] : "" ) ?>">
                                    
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        Tipo  </label>
                                        <input type="text" class="form-control" name="lessons_type" value="<?php print( isset( $data["lessons_type"] ) ? $data["lessons_type"] : "" ) ?>">
                                  
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        Aula Descrição </label>
                                        <textarea name="lessons_description" class="form-control editor"><?php print( isset( $data["lessons_description"] ) ? $data["lessons_description"] : "" ) ?></textarea>
                                   
                                </div>

                                <div class="col-lg-6">
                                    <label>
                                        Conteúdo URL  </label>
                                        <input type="text" class="form-control" name="lessons_content_url" value="<?php print( isset( $data["lessons_content_url"] ) ? $data["lessons_content_url"] : "" ) ?>">                                   
                                </div>
                            
                            </div>

                           

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                            Texto da Imagem </label>
                                            <input type="text" class="form-control"  name="lessons_img_text" value="<?php print( isset( $data["lessons_img_text"] ) ? $data["lessons_img_text"] : "" ) ?>">                                      
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                    Duração </label>
                                        <input type="text" class="form-control"  name="lessons_duration" value="<?php print( isset( $data["lessons_duration"] ) ? $data["lessons_duration"] : "" ) ?>">                                   
                                </div>
                            </div>

                           
                            <div class="row">
                                <div class="col-lg-3">
                                    <label>
                                        Id Externo </label>
                                        <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $data["external_id"] ) ? $data["external_id"] : "" ) ?>">                                   
                                </div>
                                <div class="col-lg-3">
                                    <label>
                                        Status </label>
                                        <select name="lessons_status" id="lessons_status" class="form-control">
                                            <option value="Rascunho" <?php print( isset( $data["lessons_status"] ) && $data["lessons_status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                                            <option value="Publicado" <?php print( isset( $data["lessons_status"] ) && $data["lessons_status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                                            <option value="Arquivado" <?php print( isset( $data["lessons_status"] ) && $data["lessons_status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                                        </select>                                  
                                </div>
                            </div>
                                                                                                             
                        
                    </div>

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php print( $info["get"]["done"] ) ?>" class="round hollow button secondary" >Voltar</a>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>