<div class="row">
    <p class="mb-0 col-lg-12">
        <a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["profiles_url"] ) ?>">Perfis</a> / <?php print( $form["title"] ) ?></p>
    <div class="container-fluid box solaris-head">
        <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
            <?php
            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
            ?>
            <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
            <?php
            }
            ?>

            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Dados</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input placeholder="Nome do Perfil" id="name" type="text" class="form-control"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                </div>                    
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="adm"> Logar no ADM </label>
                                    <select name="adm" name="adm" class="form-control">
                                    <?php
                                        foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                            printf('<option value="%s"%s>%s</option>', $k , $data["adm"] == $k  ? ' selected="selected"' : '' , $v);
                                        }
                                    ?>
                                    </select>
                                </div>       
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="parent">Perfil Pai </label>
                                    <select name="parent" id="parent" class="form-control">
                                        <option value="-1" <?php print( !isset( $data["parent"] ) || $data["parent"] == "-1" ? "selected='selected'" : "" ) ?>>Nenhum</option>
                                        <?php foreach(profiles_controller::data4select("idx", array( " parent = 0 " , " idx > 2 " ) ) as $k => $v ){?>
                                        <option value="<?php print( $k ) ?>" <?php print( isset( $data["parent"] ) && $data["parent"] == $k ? "selected='selected'" : "" ) ?>><?php print( $v ) ?></option>                                            
                                        <?php } ?>
                                    </select>     
                                </div>                             
                            </div>    
                        </div>
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
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>