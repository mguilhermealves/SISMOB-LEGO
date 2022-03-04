<!-- Container Begin -->
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <blockquote class="blockquote">
                <p class="mb-0">CFP Magazines</p>
            </blockquote>           
        </div>

        <!-- Button trigger modal -->
        <div class="col-sm-12">
            <a type="button" class="bt btn-primar btn-sm" title="Incluir" href="<?php print( $form["pattern"]["new"] ) ?>">Adicionar</a>                
        </div>

        <div class="col-sm-12" style="overflow: auto;">
            <table class="table">
                <thead >                    
                    <tr class="text-left">
                        <th style="width:5%;">Posição</th>
                        <th style="width:40%;">Nome</th>
                        <th style="width:15%;">Data</th>
                        <th style="width:15%;">Perfil</th>
                        <th style="width:25%;">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td><?php print( isset( $value["position"] ) ? [ $value["position"] ] : "" ) ?></td>
                            <td><?php print( isset( $value["name"] ) ? $value["name"] : "-" ) ?></td>
                            <td><?php print( preg_replace("/^(....).(..).(..).(.....).+/","$3/$2/$1 $4",$value["created_at"] ) ) ?></td>
                            <td><?php print( isset( $value["profiles_attach"][0] ) ? $value["profiles_attach"][0]["name"] : "-")?></td>
                            <td>
                                <a class="btn btn-primary mx-2" href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar">Editar<i class="fontello-edit"></i></a>
                                <a class="btn btn-danger mx-2" href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" id="btn_remove"<?php print( $value["idx"] ) ?> class="button tiny bg-red round" title="Remover">Remover<i class="fontello-trash"></i></a></td>
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
    table, thead {
   background: rgb(210, 210, 210);
   color: #707070;
   cursor: pointer;
   padding: 14px 0px 14px 0px;
   font-size: 14px;
   font-weight: bold;
   border-top: 10px solid rgb(242, 103, 36);  
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
