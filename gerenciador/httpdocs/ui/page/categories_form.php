<form id="form_opportunity_board" action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
    <?php
        if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
        ?>
        <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
        <?php
        }
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar tipo de Atividade <?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label>Nome:</label>
                                <input class="form-control" type="text" name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" placeholder="Escreva aqui o tipo de atividade">
                            </div>
                        </div>

                         <div class="form-group col-sm-3">
                            <label for="inputState">Tipos:</label><br>

                            <?php foreach( type_activities_controller::data4select("idx",array(" active = 'yes' ")) as $k => $v ){ ?>
                                <label>
                                    <input name="typeactivities_id[<?php print( $k ) ?>]" id="typeactivities_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" <?php print( isset( $data["typeactivities_attach"][0] ) && in_array( $k , array_column( $data["typeactivities_attach"] , "idx" ) ) ? "checked" : "" ) ?>>
                                    <?php print( $v ) ?>
                                </label><br>
                            <?php } ?>

                        </div>


                    

                   </div>
                </div>
            </div>
            <div class="modal-footer"  >
                <button type="submit" name="btn_save" class="btn btn-primary btn-sm" style="color: #FFFFFF;border: none;cursor: pointer;padding: 5px 30px;font-size: 16px;background: #077111;transition: all 400ms ease-in-out;font-weight: 600;border-radius: 5px 5px 0px 0px;">Confirmar Edição</button>
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
        background: #077111;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 5px 5px 0px 0px;
    }

    #myTabContent {
        box-shadow: rgb(85 85 85) 0px 0px 3px;
        border-top: 10px solid rgb(7, 113, 17);
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
    background: #077111;
    transition: all 400ms ease-in-out;
    font-weight: 600;
    border-radius: 5px 5px 0px 0px;
    }

</style>
