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
            <h5 class="modal-title">Programa de Relacionamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label>Título:</label>
                                <input class="form-control" type="text" name="title" value="<?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?>" placeholder="Escreva aqui o título">
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="inputState">Status:</label>
                            <div class="form-control disabled" ><?php print( isset( $data["status"] ) ? $GLOBALS["activities_status_list"][ $data["status"] ] : "Rascunho" ) ?></div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Resumo:</label>
                                <textarea class="form-control" type="text" name="resume"  placeholder="Resumo da atividade" style="resize: none;"><?php print( isset( $data["resume"] ) ? $data["resume"] : "" ) ?></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Adicione uma imagem</label>
                                <input type="file" class="form-control" aria-describedby="helpId" name="thumbnail">

                                <small id="helpId" class="form-text text-muted">
                                    <ul>
                                        <li>Dimensões da capa: 650 x 380 px</li>
                                        <li>Formatos aceitos: JPG e PNG</li>
                                        <li>Tamanho Máximo: 1MB</li>
                                    </ul>
                                </small>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Link de acesso</label>
                                <input type="text" class="form-control" name="link" id="link" placeholder="http://">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Descrição completa:</label>
                                <textarea class="form-control" type="text" name="description" placeholder="Descrição completa da atividade" style="resize: none;"><?php print( isset( $data["description"] ) ? $data["description"] : "" ) ?></textarea>
                            </div>
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
