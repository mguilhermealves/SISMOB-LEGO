<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Quiz ". $data["name"] : "Cadastrar Quiz" ) ?></span>
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
                        <div class="large-4 columns bxs_user">
                            <div class="header">Informações</div>
                            <div class="large-12 columns">
                                <label>
                                    Catalogo
                                </label>
                                <?php 
                                if( isset( $data["catalogo"] ) && !empty( $data["catalogo"] ) ){
                                    print("<a href='/" . $data["catalogo"] . "'>[link atual]</a>");
                                    print('<input type="file"  name="catalogo_file" value="">');
                                }
                                else{
                                    print('<input type="file"  name="catalogo_file" value="">');
                                }
                                ?>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Titulo
                                    <input type="text"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Grupo
                                    <input type="text"  name="level" value="<?php print( isset( $data["level"] ) ? $data["level"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Pontos
                                    <input type="number"  name="points" value="<?php print( isset( $data["points"] ) ? $data["points"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-12 columns">
                                <label>
                                    Publicar em
                                    <input type="date"  name="published_at" value="<?php print( isset( $data["published_at"] ) ? $data["published_at"] : "" ) ?>">
                                </label>
                            </div>
                        </div>
                        <div class="large-7 columns bxs_user">
                            <div class="header" style="display:flex;flex-direction: row;justify-content: space-between;align-items: flex-start;">
                                Perguntas
                                <button class="btn button round success" type="button" id="btn_add_pergunta">Adicionar Pergunta</button>
                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample"></div>
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
