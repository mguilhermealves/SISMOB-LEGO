<!-- Container Begin -->
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <blockquote class="blockquote">
                <p class="mb-0">Kit do Associado </p>
            </blockquote>
            <hr>            
        </div>

        <!-- Button trigger modal -->
        
            <form id="form_opportunity_board" action="<?php print( $GLOBALS["kitassociatetext_url"] ) ?>" method="post" enctype="multipart/form-data">
                <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                ?>               
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea cols="80" id="editor1" class="editor" name="text" rows="10" style="margin: 0px 0px 16px; height: 359px;"><?php print( isset( $data_text["text"] ) ? $data_text["text"] : "&nbsp;" ) ?></textarea>
                        
                        </div>
                    </div>
                </div>
                <button type="submit" name="btn_save" class="bottom-green-reverse"  data-target="#modal_add_store">Savar texto</button>
            </form>                                   
            
            <div class="col-sm-12 mb-3">
            <!-- Modal -->
            <div class="modal fade" id="modal_add_store" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
             
                    <form id="form_opportunity_board" action="<?php print( $form["pattern"]["new"] ) ?>" method="post" enctype="multipart/form-data">
                        <?php
                            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                            ?>
                            <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                            <?php
                            }
                        ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Kit</h5>
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
                                                    <input class="form-control" type="text" name="title"  placeholder="Escreva aqui o título">
                                                </div>
                                            </div>                                                                                   
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Arquivo</label>
                                                    <input type="file" class="form-control" name="link_file" id="link">
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="btn_save" class="btn btn-primary btn-sm" style="color: #FFFFFF;border: none;cursor: pointer;padding: 5px 30px;font-size: 16px;background: #f26724;transition: all 400ms ease-in-out;font-weight: 600;border-radius: 5px 5px 0px 0px;">Salvar e Continuar</button><a href="<?php print( $GLOBALS["kitassociates_url"] ) ?>" class="bottom-green-reverse return" >Voltar</a>
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
                         
        <div class="col-sm-12" style="overflow: auto;">
            <div class="col-sm-12 text-left" style="padding: 0; ">
                <button type="button" class="bt btn-primar btn-sm" data-toggle="modal" data-target="#modal_add_store">Adicionar file</button>
            </div>
            <table class="table">                
                <thead >
                    <tr >                        
                        <th style="width:5%;">Titulo</th>
                        <th style="width:10%;">Data de criação</th>
                        <th style="width:20%;">Link</th>
                        <th style="width:15%;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td><?php print( $value["title"] ) ?></td>
                            <td><?php print( preg_replace("/^(....).(..).(..).(.....).+/","$3/$2/$1 $4",$value["created_at"] ) ) ?></td>
                            <td><?php print( '<a href="'.$value["link"].'" target="_blank">[ver arquivo]</a>' ) ?></td>
                            <td>
                                <a class="btn btn-primary mx-2" href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar">Editar<i class="fontello-edit"></i></a>
                                <a class="btn btn-danger mx-2" href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" id="btn_remove"<?php print( $value["idx"] ) ?> class="button tiny bg-red round" title="Remover">Remover<i class="fontello-trash"></i></a>
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
    .jss38 {
    display: inline-block;
    color: #999;
    cursor: pointer;
    border: 1px solid #999;
    padding: 3px 30px;
    text-align: center;
    background-color: #FFFFFF;
    align-items: center;
   }
   
   .bottom-green-reverse {
        display: inline-block;
        color: #999;
        cursor: pointer;
        border: 1px solid #999;
        padding: 5px 30px;
        text-align: center;
        background-color: #FFFFFF;
        align-items: center;
        font-weight: 600;
        border-radius: 5px 5px 5px 5px;
   }
   a:visited .return {
    color: #999;
    }
    a:link {
        text-decoration: none;
    } 
    table, thead {
   background: rgb(210, 210, 210);
   color: #707070;
   cursor: pointer;
   padding: 14px 0px 14px 0px;
   font-size: 14px;
   font-weight: bold;
   border-top: 10px solid rgb(242, 103, 36);  
}
}
.table td {
   color: #707070;
   width: 15%;
   padding: 12px 20px 12px 0px;
   font-size: 14px;
   background: transparent;
   font-weight: 500;
   border-width: 3px;
   border-spacing: 3px;
}
table tbody tr:hover {
   background: #70707041;
}
</style>