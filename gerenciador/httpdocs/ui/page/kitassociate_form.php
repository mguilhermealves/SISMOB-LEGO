<form id="relationships_form" action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
    <?php
        if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
        ?>
        <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
        <?php
        }
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar Empresa</h5>
        </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-grou col-sm-6">
                            <label>Instituição PJ:</label>
                            <input class="form-control" type="text" name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" placeholder="Escreva aqui o nome da empresa">
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="inputState">Categoria:</label>
                            <select name= "category" id="inputState" class="form-control">
                                <?php 
                                    foreach( $GLOBALS["categories_lists"] as $k => $v ){
                                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["category"] ) && $data["category"] == $k ? ' selected="selected"' : ''  , $v);
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="inputState">Habilitado:</label>
                            <select name="enabled" id="inputState" class="form-control">
                                <?php 
                                    foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["enabled"] ) && $data["enabled"] == $k ? ' selected="selected"' : ''  , $v);
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"  >
                <button type="submit" name="btn_save" class="btn btn-primary btn-sm" style="color: #FFFFFF;border: none;cursor: pointer;padding: 5px 30px;font-size: 16px;background: #f26724;transition: all 400ms ease-in-out;font-weight: 600;border-radius: 5px 5px 0px 0px;">Confirmar Edição</button>
            </div>
        </div>
    </div>
</form>
            
<style>
    .blockquote p {
        color: rgb(85, 85, 85);
        font-size: 25px;
        font-weight: 600;
        font-family: Montserrat;
    }

    #atividades-tab {
        color: #FFFFFF;
        padding: 8px 16px;
        font-size: 16px;
        background: #f26724;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 5px 5px 0px 0px;
    }

    #myTabContent {
        box-shadow: rgb(85 85 85) 0px 0px 3px;
        border-top: 10px solid rgb(242, 103, 36);
    }

    #helpId ul {
        position: relative;
        right: 35px;
    }

    #helpId li {
        list-style: none;
    }
    .bt.btn-primar.btn-sm{
    color: #FFFFFF;
    border: none;
    cursor: pointer;
    padding: 5px 30px;
    font-size: 16px;
    background: #f26724;
    transition: all 400ms ease-in-out;
    font-weight: 600;
    border-radius: 5px 5px 0px 0px;
    }

</style>
