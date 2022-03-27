<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Tipo de Atividade ". $data["name"] : "Cadastrar Tipo de Atividade" ) ?></span>
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
                            <div class="large-6 columns">
                                <label>
                                    Nome
                                    <input type="text"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                </label>
                            </div>
                                               
                        </div>
                        <div class="large-4 columns bxs_user">
                            <div class="header">Configurações</div>
                            <div class="large-12 columns">
                                <strong style="border-bottom: 1px solid #707070; margin-bottom: 15px; display: block;"> Tipo Associado</strong>
                            </div>
                            <div class="large-12 columns">
                                <?php foreach( typeactivities_controller::data4select("idx",array(" idx > 0 ")) as $k => $v ){ ?>
                                <label>
                                    <input name="typeactivities_id[<?php print( $k ) ?>]" id="typeactivities_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" <?php print( isset( $data["typeactivities_attach"][0] ) && in_array( $k , array_column( $data["typeactivities_attach"] , "idx" ) ) ? "checked" : "" ) ?>>
                                    <?php print( $v ) ?>
                                </label>
                                <?php } ?>
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