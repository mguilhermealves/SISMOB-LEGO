<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? "Editar Edição ". $data["name"] : "Cadastrar Edição" ) ?></span>
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
                    <div style="display: flex;justify-content: space-evenly;">
                        <div class="large-6 columns bxs_user">
                            <div class="header">Informações</div>
                            <div class="large-12 columns">
                                <label>
                                    Nome do Edição
                                    <input type="text"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Chamada
                                    <textarea name="headline"><?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?></textarea>
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Tipo
                                    <select id="type" name="type">
                                        <option value="text" <?php print( !isset( $data["type"] ) || $data["type"] == "text" ? 'selected' : "" ) ?>>Texto</option>
                                        <option value="link" <?php print( isset( $data["type"] ) && $data["type"] == "link" ? 'selected' : "" ) ?>>Link</option>
                                        <option value="zip" <?php print( isset( $data["type"] ) && $data["type"] == "zip" ? 'selected' : "" ) ?>>Zip</option>
                                    </select>
                                </label>
                            </div>
                            <div class="large-12 columns" id="text_container">
                                <label>
                                    Descrição
                                    <textarea cols="80" id="editor1" name="text" rows="10" style="margin: 0px 0px 16px; height: 359px;"><?php print( isset( $data["text"] ) ? $data["text"] : "&nbsp;" ) ?></textarea>
                                </label>
                            </div>     
                            <div class="large-12 columns" id="zip_container">
                                <label>
                                    Zip HTML5
                                    <input type="file" name="html">
                                </label>
                            </div>  
                            <div class="large-12 columns" id="link_container">
                                <label>
                                    Link
                                    <input type="text" name="link" value="<?php print( isset( $data["link"] ) ? $data["link"] : "&nbsp;" ) ?>">
                                </label>
                            </div>                        
                        </div>
                        <div class="large-4 columns bxs_user">
                            <div class="header">Configurações</div>
                            <div class="large-12 columns">
                                <strong style="border-bottom: 1px solid #707070; margin-bottom: 15px; display: block;">Perfis Disponíveis</strong>
                            </div>
                            <div class="large-12 columns">
                                <input type="hidden" name="profiles_id[1]" id="profiles_id[1]" value="1">
                                <input type="hidden" name="profiles_id[2]" id="profiles_id[2]" value="2">
                                <?php foreach( profiles_controller::data4select("idx",array( " idx > 2 " ) ) as $k => $v ){ ?>
                                <label>
                                    <input name="profiles_id[<?php print( $k ) ?>]" id="profiles_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" <?php print( isset( $data["profiles_attach"][0] ) && in_array( $k , array_column( $data["profiles_attach"] , "idx" ) ) ? "checked" : "" ) ?>>
                                    <?php print( $v ) ?>
                                </label>
                                <?php } ?>
                            </div> 
                            <div class="large-12 columns">
                                <strong style="border-bottom: 1px solid #707070; margin-bottom: 15px; display: block;">Mídia</strong>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Imagem
                                    <input type="file" name="thumbnail">
                                </label>
                                <?php if( !empty( $data["image"] ) && file_exists( constant("cRootServer") . $data["image"] ) ){
                                ?><img src="/<?php print( $data["image"] ) ?>"/>
                                <?php
                                } ?>
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