<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-6"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / Bibliotecas</p>
    <hr class="col-lg-11 mx-auto" />
    
    <div class="col-sm-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="categoria-tab" <?php print( !isset( $info["get"]["filter_parent"] ) ? 'data-toggle="tab" href="#categoria"' : 'href="' . $form["categorias"]["pattern"]["search"] . '"' ) ?> role="tab" aria-controls="categoria" aria-selected="true">Categorias</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="subcategoria-tab" data-toggle="tab" href="#subcategoria" role="tab" aria-controls="subcategoria" aria-selected="false">Subcategorias</a>
            </li>
        </ul>
    </div>

    <div class="col-sm-12">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="categoria" role="tabpanel" aria-labelledby="categoria-tab">
                <table class="table table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th colspan="5">
                                <form class="row container" id="frm_filter" method="GET" action="<?php  print($form["categorias"]["pattern"]["search"]) ?>">
                                    <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
                                    <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
                                    <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="filter_name">Nome:</label>
                                                <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="filter_status">Status:</label>
                                                <select class="form-control " id="filter_status" name="filter_status">
                                                    <option value="" <?php print(!isset($info["get"]["filter_status"]) || $info["get"]["filter_status"] == "" ? " selected" : "") ?> placeholder="Selecione o Status">Selecione o Status</option>
                                                    <?php 
                                                    foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                                        printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_status"]) && $k == $info["get"]["filter_status"] ? ' selected' : '' , $v , $v ) ;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                            if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) || in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
                                                $array = array( " idx > 2 ", " not slug in ('adm-premier','gestor-hsol') " ) ;
                                            }
                                            else{
                                                $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
                                                $array = array( " idx > 2 ", " idx in ( '" . implode("','", $profiles_id ) . "' ) " ) ;
                                            }
                                        ?>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="filter_profiles">Perfil:</label>
                                                <select class="form-control " id="filter_profiles" name="filter_profiles">
                                                    <option value="" <?php print(!isset($info["get"]["filter_profiles"]) || $info["get"]["filter_profiles"] == "" ? " selected" : "") ?> placeholder="Selecione o Perfil">Selecione o Perfil</option>
                                                    <?php 
                                                    foreach( profiles_controller::data4select("idx", $array ) as $k => $v ){
                                                        printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_profiles"]) && $k == $info["get"]["filter_profiles"] ? ' selected' : '' , $k , $v ) ;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    
                                        <div class="col-lg-2">
                                            <label for="btn_search">&nbsp;</label>
                                            <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </th>
                        </tr>
                        <tr>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["categorias"]["pattern"]["search"], array("ordenation" => $ordenation_display_position))) ?>">Posição <i class="<?php print($ordenation_display_position_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["categorias"]["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Categoria <i class="<?php print($ordenation_name_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["categorias"]["pattern"]["search"], array("ordenation" => $ordenation_modifiedat))) ?>">Última Atualização <i class="<?php print($ordenation_modifiedat_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["categorias"]["pattern"]["search"], array("ordenation" => $ordenation_status))) ?>">Status <i class="<?php print($ordenation_status_ordenation) ?>"></i></a></th>
                            <th> <a class="btn btn-outline-success btn-sm" title="Adicionar" href="<?php print($form["categorias"]["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Nova Categoria</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total > 0) {
                            foreach ($data as $v) {
                                if ($v["parent"] < 1 ) { 
                                    switch($v["status"]){
                                        case 'Publicado':
                                            $color = "green" ;
                                            $text = '<i class="fa fa-check-circle" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                        case 'Rascunho': 
                                            $color = "orange" ;
                                            $text = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                        case 'Arquivado': 
                                            $color = "blue" ;
                                            $text = '<i class="fa fa-archive" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                    }
                        ?>
                                    <tr>
                                        <td scope="row"><?php print($v["display_position"]); ?></td>
                                        <td><?php print($v["name"]); ?></td>
                                        <td><?php print(date( 'd/m/Y', strtotime( empty( $v["modified_at"] ) ?  $v["created_at"] : $v["modified_at"] ) ) ) ?></td>    
                                        <td style="color: <?php print($color) ?>;"><?php print($text) ?></td>
                                        <td>
                                            <a type="button" class="btn btn-outline-primary btn-sm" href="<?php printf( $form["categorias"]["pattern"]["action"] , $v["idx"]); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="5">
                                    <p class="alert alert-warning text-center">Nenhuma categoria criada até o momento...</p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="subcategoria" role="tabpanel" aria-labelledby="subcategoria-tab">
                <table class="table table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th colspan="5">
                                <form class="row container" id="frm_filter" method="GET" action="<?php  print($form["categorias"]["pattern"]["search"]) ?>">
                                    <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
                                    <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
                                    <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="filter_name">Nome:</label>
                                                <input type="text" id="filter_name" class="form-control" name="filter_name" value="<?php print(isset($info["get"]["filter_name"]) ? $info["get"]["filter_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Nome">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="filter_status">Status:</label>
                                                <select class="form-control " id="filter_status" name="filter_status">
                                                    <option value="" <?php print(!isset($info["get"]["filter_status"]) || $info["get"]["filter_status"] == "" ? " selected" : "") ?> placeholder="Selecione o Status">Selecione o Status</option>
                                                    <?php 
                                                    foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                                        printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_status"]) && $k == $info["get"]["filter_status"] ? ' selected' : '' , $v , $v ) ;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                            if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] , array(1,2) ) || in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array('adm-premier','gestor-hsol') ) ){
                                                $array = array( " idx > 2 ", " not slug in ('adm-premier','gestor-hsol') " ) ;
                                            }
                                            else{
                                                $profiles_id = array_keys( profiles_controller::data4select("idx",array($_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["idx"] . " in ( idx, parent ) " ) ) ) ; 
                                                $array = array( " idx > 2 ", " idx in ( '" . implode("','", $profiles_id ) . "' ) " ) ;
                                            }
                                        ?>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="filter_profiles">Perfil:</label>
                                                <select class="form-control " id="filter_profiles" name="filter_profiles">
                                                    <option value="" <?php print(!isset($info["get"]["filter_profiles"]) || $info["get"]["filter_profiles"] == "" ? " selected" : "") ?> placeholder="Selecione o Perfil">Selecione o Perfil</option>
                                                    <?php 
                                                    foreach( profiles_controller::data4select("idx", $array ) as $k => $v ){
                                                        printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_profiles"]) && $k == $info["get"]["filter_profiles"] ? ' selected' : '' , $k , $v ) ;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="filter_parent">Categoria:</label>
                                                <select class="form-control " id="filter_parent" name="filter_parent">
                                                    <option value="" <?php print(!isset($info["get"]["filter_parent"]) || $info["get"]["filter_parent"] == "" ? " selected" : "") ?> placeholder="Selecione o Perfil">Selecione o Perfil</option>
                                                    <?php 
                                                    foreach( libraries_controller::data4select("idx", array( " active = 'yes' " , " parent = 0 " ) ) as $k => $v ){
                                                        printf('<option %s value="%s">%s</option>' , isset($info["get"]["filter_parent"]) && $k == $info["get"]["filter_parent"] ? ' selected' : '' , $k , $v ) ;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    
                                        <div class="col-lg-2">
                                            <label for="btn_search">&nbsp;</label>
                                            <button id="btn_search" type="submit" class="btn btn-outline-primary jss38 btn-block btn-sm">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </th>
                        </tr>
                        <tr>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["subcategorias"]["pattern"]["search"], array("ordenation" => $ordenation_display_position , "filter_parent" => isset( $info["get"]["filter_parent"] ) ? $info["get"]["filter_parent"] : 0 ))) ?>">Posição <i class="<?php print($ordenation_display_position_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["subcategorias"]["pattern"]["search"], array("ordenation" => $ordenation_name, "filter_parent" => isset( $info["get"]["filter_parent"] ) ? $info["get"]["filter_parent"] : 0))) ?>">Sub-Categoria <i class="<?php print($ordenation_name_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["subcategorias"]["pattern"]["search"], array("ordenation" => $ordenation_modifiedat, "filter_parent" => isset( $info["get"]["filter_parent"] ) ? $info["get"]["filter_parent"] : 0))) ?>">Última Atualização <i class="<?php print($ordenation_modifiedat_ordenation) ?>"></i></a></th>
                            <th><a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["subcategorias"]["pattern"]["search"], array("ordenation" => $ordenation_status, "filter_parent" => isset( $info["get"]["filter_parent"] ) ? $info["get"]["filter_parent"] : 0))) ?>">Status <i class="<?php print($ordenation_status_ordenation) ?>"></i></a></th>
                            <th><a class="btn btn-outline-success btn-sm" title="Adicionar" href="<?php print($form["subcategorias"]["pattern"]["new"]) ?>"><i class="fa fa-plus" aria-hidden="true"></i> Nova Sub Categoria</a></th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total > 0) {
                            foreach ($data as $v) {
                                if ($v["parent"] > 0) { 
                                    switch($v["status"]){
                                        case 'Publicado':
                                            $color = "green" ;
                                            $text = '<i class="fa fa-check-circle" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                        case 'Rascunho': 
                                            $color = "orange" ;
                                            $text = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                        case 'Arquivado': 
                                            $color = "blue" ;
                                            $text = '<i class="fa fa-archive" aria-hidden="true"></i>' . $v["status"] ;
                                        break;
                                    }?>
                                    <tr>
                                        <td scope="row"><?php print($v["display_position"]); ?></td>
                                        <td><?php print($v["name"]); ?></td>
                                        <td><?php print(date( 'd/m/Y', strtotime( empty( $v["modified_at"] ) ? $v["created_at"] : $v["modified_at"] ) ) ) ?></td>
                                        <td style="color: <?php print($color) ?>;"><?php print($text) ?></td>
                                        <td><a type="button" class="btn btn-outline-primary btn-sm" href="<?php print('subcategoria/' . $v["idx"]); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>