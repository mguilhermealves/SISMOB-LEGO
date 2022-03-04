<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? "Editar Institução PJ ". $data["name"] : "Cadastrar Institução PJ" ) ?></span>
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
                        <div class="large-12 columns bxs_user">
                            <div class="header">Informações</div>
                            <div class="large-8 columns">
                                <label>
                                    Nome do Institução PJ
                                    <input type="text"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Categoria
                                    <select name="category">
                                        <?php 
                                        foreach( $GLOBALS["categories_lists"] as $k => $v ){
                                            printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["category"] ) && $data["category"] == $k ? ' selected="selected"' : ''  , $v);
                                        }
                                        ?>
                                    </select>
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Habilitado
                                    <select name="enabled">
                                        <?php 
                                        foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                            printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["enabled"] ) && $data["enabled"] == $k ? ' selected="selected"' : ''  , $v);
                                        }
                                        ?>
                                    </select>
                                </label>
                            </div>                           
                        </div>
                    </div>
                    <div style="display: flex;justify-content: space-evenly;margin-top:1rem">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Usuários</div>
                            <div id="row_add"  class="large-12 columns">
                                <input type="hidden" id="idx_user" value="0">
                                <div class="large-3 columns">
                                    <label>
                                        Nome
                                        <input type="text" id="name_user" value="">
                                    </label>
                                </div>
                                <div class="large-3 columns">
                                    <label>
                                        E-mail
                                        <input type="text" id="mail_user" value="">
                                    </label>
                                </div>
                                <div class="large-3 columns">
                                    <label>
                                        CPF
                                        <input type="text" id="cpf_user" value="">
                                    </label>
                                </div>
                                <div class="large-3 columns">
                                    <button id="btn_add_user" style="margin-top: 15px;" type="button" class="btn round hollow button secondary">Adicionar</button>
                                </div>
                            </div>

                            <?php
                            if( isset( $data["users_attach"] ) && count( $data["users_attach"] ) ){
                                foreach( $data["users_attach"] as $k => $v ){
                            ?>
                                <div id="row_<?php print( $v["idx"] ) ?>" class="large-12 columns">
                                    <input type="hidden" name="users_id[]" value="<?php print( $v["idx"] ) ?>" />
                                    <hr style="margin:0px;margin-bottom:1rem;"/>
                                    <div class="large-3 columns">
                                        <?php print( $v["first_name"] . " " . $v["last_name"] ) ?>
                                    </div>
                                    <div class="large-3 columns">
                                        <?php print( $v["mail"] ) ?>
                                    </div>
                                    <div class="large-3 columns">
                                        <?php print( preg_replace("/(.+)(...)(...)(..)$/","$1.$2.$3-$4",$v["cpf"]) ) ?>
                                    </div>
                                    <div class="large-3 columns">
                                        <button id="btn_remove_user_<?php print( $v["idx"] ) ?>" type="button" class="btn round hollow button secondary">Remover</button>
                                    </div> 
                                </div>
                            <?php
                                }
                            }
                            ?>
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