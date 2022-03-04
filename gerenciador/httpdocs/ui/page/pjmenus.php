                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <h3>Listagem de Menus</h3>                            
                        </div>
                        <div class="col-lg-12">
                <form id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                    <label>
                        Nome
                        <input type="text"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                    </label>
                    <label>
                        Menu Pai
                        <select name="filter_parent">
                            <option value="" <?php print( !isset( $info["get"]["filter_parent"] ) || (int)$info["get"]["filter_parent"] == 0 ? ' selected="selected"' : '' ) ?>></option>
                            <option value="-1" <?php print( isset( $info["get"]["filter_parent"] ) && (int)$info["get"]["filter_parent"] == -1 ? ' selected="selected"' : '' ) ?>>--- RAIZ ---</option>
                            <?php foreach( menus_controller::data4select( "idx" , array( " parent = -1 " ) , "name" ) as $k => $v ){ ?>
                            <option value="<?php print( $k ) ?>" <?php print( isset( $info["get"]["filter_parent"] ) && (int)$info["get"]["filter_parent"] == $k ? ' selected="selected"' : '' ) ?>><?php print( $v ) ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label>
                        Perfil
                        <select name="filter_profile">
                            <option value="" <?php print( !isset( $info["get"]["filter_profile"] ) || (int)$info["get"]["filter_profile"] == 0 ? ' selected="selected"' : '' ) ?>></option>
                            <?php foreach( profiles_controller::data4select( "idx" , array( " idx > 0" ) , "name" ) as $k => $v ){ ?>
                            <option value="<?php print( $k ) ?>" <?php print( isset( $info["get"]["filter_profile"] ) && (int)$info["get"]["filter_profile"] == $k ? ' selected="selected"' : '' ) ?>><?php print( $v ) ?></option>
                            <?php } ?>
                        </select>
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
                                        <th>Imagem</th>
                                        <th>Perfil Disponivel</th>
                                        <th>Link</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5">
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
                                <tbody>
                                    <?php foreach( $data as $k => $v ){?>
                                    <tr>
                                        <td><?php print( $v["name"] ) ; ?></td>
                                        <td><?php print( $v["image"] ) ; ?></td>
                                        <td><?php print( isset( $v["profiles_attach"][0] ) ? implode(", " , array_column( $v["profiles_attach"] , "name" ) ) : "" ) ; ?></td>
                                        <td><?php print( $v["pjurls_attach"][0]["name"] ) ; ?></td>
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
