                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <h3>Listagem de Urls</h3>                            
                        </div>
                        <div class="col-lg-12">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                    <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                    <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                    <label>
                        Nome
                        <input type="text"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                    </label>
                    <label>
                        Slug
                        <input type="text"  name="filter_slug" value="<?php print( isset( $info["get"]["filter_slug"] ) ? $info["get"]["filter_slug"] : "" ) ?>">
                    </label>
                    <label>
                        Url
                        <input type="text"  name="filter_pattern" value="<?php print( isset( $info["get"]["filter_pattern"] ) ? $info["get"]["filter_pattern"] : "" ) ?>">
                    </label>
                    <div>
                        <button type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
                        <a class="btn btn-primary" style="float:right" href="<?php print( $form["pattern"]["new"] ) ?>">[ incluir ]</a>
                    </div>
                </form>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Slug</th>
                                        <th>URL</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                        <tfoot>
                            <tr>
                                <th colspan="4">
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
                                    </div></th>
                            </tr>
                        </tfoot>
                                <tbody>
                                    <?php foreach( $data as $k => $v ){?>
                                    <tr>
                                        <td><?php print( $v["name"] ) ; ?></td>
                                        <td><?php print( $v["slug"] ) ; ?></td>
                                        <td><?php print( $v["pattern"] ) ; ?></td>
                                        <td><a class="btn btn-primary mx-2" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ editar ]</a><a  class="btn btn-danger mx-2" id="btn_remove_<?php print( $v["idx"] ) ?>" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <a class="btn btn-primary" style="float:right" href="<?php print( $form["pattern"]["new"] ) ?>">[ incluir ]</a>
                        </div>
                    </div>
                </div>
                <script>
                    window.setTimeout( function(){
                        jQuery("a[id^='btn_remove_']").on("click",function(){
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
