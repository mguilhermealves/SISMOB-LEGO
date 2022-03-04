<!-- Container Begin -->
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <blockquote class="blockquote">
                <p class="mb-0">Tipo de Atividades</p>
            </blockquote>
            <hr>
        </div>

        <!-- Button trigger modal -->
        <div class="MuiPaper-root jss35 MuiPaper-elevation1 MuiPaper-rounded">
                
                    <form id="frm_filter" action="<?php print( $GLOBALS["typeactivities_url"] ) ?>" method="GET" class="MuiInputBase-root jss37">
                        <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                        <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                            <div class="jss36" >
                                <i class="fas fa-search border"></i>
                            </div>
                            <div class="MuiInputBase-root jss47">
                                <label for="search" class="sr-only">Digite o nome da Modalidade</label>
                                <input name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>" type="text" class="MuiInputBase-input" placeholder="Digite o nome da Atividade">
                            </div>
                            <button type="submit" class="jss38">Buscar</button>
                    </form>
                
            </div>

        <div class="col-sm-12 mb-3">
            <!-- Modal -->
            <div class="modal fade" id="modal_add_store" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="form_opportunity_board" action="<?php print($GLOBALS["newcategories_url"]) ?>" method="post" enctype="multipart/form-data">
                        <?php
                            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                            ?>
                            <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                            <?php
                            }
                        ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Criar Oportunidades</h5>
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
                                                <select id="inputState" class="form-control">
                                                    <option selected>Rascunho</option>
                                                    <option>Publicado</option>
                                                    <option>Arquivado</option>
                                                    <option>Oculto</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Resumo:</label>
                                                    <textarea class="form-control" type="text" name="resume" value="<?php print( isset( $data["resume"] ) ? $data["resume"] : "" ) ?>" placeholder="Resumo da atividade" style="resize: none;"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Adicione uma imagem</label>
                                                    <input type="file" class="form-control" aria-describedby="helpId" name="file_url" value="<?php print( isset( $data["file_url"] ) ? $data["file_url"] : "" ) ?>">

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
                                                    <input type="text" class="form-control" name="" id="" placeholder="http://">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição completa:</label>
                                                    <textarea class="form-control" type="text" name="description" value="<?php print( isset( $data["description"] ) ? $data["description"] : "" ) ?>" placeholder="Descrição completa da atividade" style="resize: none;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"  >
                                    <button type="submit" name="btn_save" class="btn btn-primary btn-sm" style="color: #FFFFFF;border: none;cursor: pointer;padding: 5px 30px;font-size: 16px;background: #077111;transition: all 400ms ease-in-out;font-weight: 600;border-radius: 5px 5px 0px 0px;">Salvar e Continuar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            <script>
                $('#exampleModal').on('show.bs.modal', event => {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    // Use above variables to manipulate the DOM

                });
            </script>
        </div>

        <div class="col-sm-12">
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>Nome</th>
                        <th>Data de Atualização</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td><?php print( $value["name"] ) ?></td>
                            <td><?php print( $value["modified_at"]  ) ?></td>
                            <td><?php print( $value["category"]  ) ?></td>
                            <td>
                                <a href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar">Edit<i class="fontello-edit"></i></a>
                            </td>
                            <td>
                                <a href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" id="btn_remove"<?php print( $value["idx"] ) ?> class="button tiny bg-red round" title="Remover">Remove<i class="fontello-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <form class="" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>" style="display: none;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                                 <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                                 <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                            </form>
                            <div class="row col-lg-12">
                                <div class="col-lg-3 form-group">
                                    <select class="form-control" id="select_paginage" class="col-lg-3 ">
                                        <option <?php print( $paginate == 20 ? 'selected="selected"' : '' ) ?> value="20">20</option>
                                        <option <?php print( $paginate == 50 ? 'selected="selected"' : '' ) ?> value="50">50</option>
                                        <option <?php print( $paginate == 100 ? 'selected="selected"' : '' ) ?> value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center form-group text-center">
                                    <button type="button" id="btn_sr_first" class=" btn ">|<</button>
                                    <button type="button" id="btn_sr_previus" class=" btn "><</button>
                                    <button type="button" id="btn_sr_next" class=" btn ">></button>
                                    <button type="button" id="btn_sr_last" class=" btn ">>|</button>
                                </div>
                                <p class="col-lg-3 text-right"><?php print( ( $info["sr"] + 1 ) . " de " . $total )?></p>
                            </div>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>
<script>
    window.setTimeout( function(){
        jQuery("a[id^='btn_remove']").on("click",function(){
            var target = jQuery(this);
            if( confirm('Confirma a exclusão do item ?') ){
                jQuery.ajax({
                    type: "POST",
                    url:jQuery(target).attr("href")
                    , data: { 'btn_remove': 'yes' } 
                    ,success: function(){
                        jQuery(jQuery(target).closest("tr")).remove()
                    }
                })
            }
            return false;
        })
    },1000);
</script>
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
    <style>
    .jss34 {
    color: #555555;
    font-size: 25px;
    font-family: Montserrat;
    font-weight: 600;
    }
    .jss39 {
    color: #555555;
    }
    .MuiTypography-body1 {
    font-size: 1rem;
    font-family: Montserrat;
    font-weight: 400;
    line-height: 1.5;
    }

    .jss35 {
    gap: 10px;
    height: 40px;
    display: flex;
    padding: 15px;
    align-items: center;
    }
    .jss36 {
        display: inline-block;
        align-items: center;
    }

    .MuiSvgIcon-root {
    fill: currentColor;
    width: 1em;
    height: 1em;
    display: inline-block;
    font-size: 1.5rem;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    flex-shrink: 0;
    user-select: none;
    }

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

    .border {
        color: #FFFFFF;
        padding: 12px;
        font-size: 16px;
        background: #077111;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 10px;
    }
    
    .MuiPaper-rounded {
        
    border-radius: 4px;
    }
    .MuiPaper-root {
        
        color: rgba(0, 0, 0, 0.87);
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        background-color: #fff;
    }
    .fas .fa-search .border {
        color: #FFFFFF;
        display: flex;
        padding: 8px;
        align-items: center;
        border-radius: 10px;
        justify-content: center;
        background-color: #999;
    }
    .jss47 {
        display: inline-block;
        width:450px;
        padding: 0px 5px;
        border-radius: 5px;
        background-color: #DDDDDD;
        align-items: center;
    }
    .MuiInputBase-input{
        font: inherit;
        color: currentColor;
        width: 100%;
        border: 0;
        height: 1.1876em;
        margin: 0;
        display: inline-block;
        padding: 6px 0 7px;
        min-width: 0;
        background: none;
        box-sizing: content-box;
        animation-name: mui-auto-fill-cancel;
        letter-spacing: inherit;
        animation-duration: 10ms;
        -webkit-tap-highlight-color: transparent;
        align-items: center;
    }
    .jss38 {
        display: inline-block;
        color: #999;
        border: 1px solid #999;
        padding: 3px 30px;
        text-align: center;
        border-radius: 5px;
        background-color: #FFFFFF;
        align-items: center;
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


