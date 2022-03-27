<!-- Container Begin -->
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <blockquote class="blockquote">
                <p class="mb-0">Instituição PJ</p>
            </blockquote>
            <hr>
            
        </div>

        <!-- Button trigger modal -->
        <div class="col-sm-12 text-left" style="padding: 0; border-bottom: 10px solid rgb(7, 113, 17)">
            <button type="button" class="bt btn-primar btn-sm" data-toggle="modal" data-target="#modal_add_store">Adicionar</button>
        </div>

        <div class="col-sm-12 mb-3">
            <!-- Modal -->
            <div class="modal fade" id="modal_add_store" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="form_opportunity_board" action="<?php print($GLOBALS["newcompany_url"]) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                        <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                        <?php
                            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                            ?>
                            <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                            <?php
                            }
                        ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Empresa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label>Instituição PJ:</label>
                                                    <input class="form-control" type="text" name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" placeholder="Escreva aqui o nome da empresa">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3">
                                                <label for="inputState">Categoria:</label>
                                                <select name="category" id="inputState" class="form-control">
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
                        <th>Empresa</th>
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td><?php print( $value["name"] ) ?></td>
                            <td><?php print( preg_replace("/^(....).(..).(..).(.....).+$/","$3/$2/$1 $4",$value["created_at"])  ) ?></td>
                            <td><?php print( !empty( $value["modified_at"] ) ? preg_replace("/^(....).(..).(..).(.....).+$/","$3/$2/$1 $4",$value["modified_at"] ) : "" ) ?></td>
                            <td><?php print( $GLOBALS["categories_lists"][$value["category"]]  ) ?></td>
                            <td>
                                <a href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar">Edit<i class="fontello-edit"></i></a>
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

</style>
