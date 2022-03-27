<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["title"] ) ? "Editar Categoria ". $data["title"] : "Cadastrar Categoria" ) ?></span>
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
                                    <input type="text"  name="title" value="<?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?>">
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