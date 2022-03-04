                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <h3>Listagem de Rotas</h3>                            
                        </div>
                        <div class="col-lg-12">

                <form class="row" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>" >
                    <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                    <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                    <div class="col-lg-2 form-group">
                        <label for="filter_name">
                            Nome
                        </label>
                        <input class="form-control" type="text" id="filter_name"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                    <label for="filter_pattern">
                        Url
                    </label>
                        <input class="form-control" type="text"  id="filter_pattern" name="filter_pattern" value="<?php print( isset( $info["get"]["filter_pattern"] ) ? $info["get"]["filter_pattern"] : "" ) ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                    <label for="filter_controller">
                        Comando
                    </label>
                        <input class="form-control" type="text" id="filter_controller"  name="filter_controller" value="<?php print( isset( $info["get"]["filter_controller"] ) ? $info["get"]["filter_controller"] : "" ) ?>">
                    </div>
                    <div class="col-lg-2 form-group">
                    <label for="filter_profile">
                        Perfil
                    </label>
                        <select class="form-control" id="filter_profile" name="filter_profile">
                            <option value="" <?php print( !isset( $info["get"]["filter_profile"] ) || (int)$info["get"]["filter_profile"] == 0 ? ' selected="selected"' : '' ) ?>></option>
                            <?php foreach( profiles_controller::data4select( "idx" , array( " idx > 0" ) , "name" ) as $k => $v ){ ?>
                            <option value="<?php print( $k ) ?>" <?php print( isset( $info["get"]["filter_profile"] ) && (int)$info["get"]["filter_profile"] == $k ? ' selected="selected"' : '' ) ?>><?php print( $v ) ?></option>
                            <?php } ?>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label></label>
                        <a class="btn btn-primary"  href="<?php print( $form["pattern"]["new"] ) ?>">[ incluir ]</a>
                        <button type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
                    </div>
                </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Metodo</th>
                                <th>URL</th>
                                <th>Comando</th>
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
                                        <td><?php print( $v["method"] ) ; ?></td>
                                        <td><?php print( $v["pattern"] ) ; ?></td>
                                        <td><?php print( $v["controller"] ) ; ?></td>
                                        <td><a class="btn btn-primary mx-2" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ editar ]</a><a  class="btn btn-danger mx-2" id="btn_remove_<?php print( $v["idx"] ) ?>" href="<?php printf( $form["pattern"]["action"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
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
