                <div class="row" style="margin-top:-20px">
                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <h3 class="box-title"><i class="fontello-th-list"></i>
                                    <span>Listagem de Conteúdo Técnico</span>
                                </h3>
                            </div>
                            <div class="box-body " style="display: block;">
                                <form action="<?php print( $form["pattern"]["search"] ) ?>" method="get" style="text-align:right">
                                <a href="<?php printf( $GLOBALS["technicalcontent_url"] , 0 ) ?>" class="button tiny bg-gray round"><i class="fontello-plus"></i> Novo Conteúdo Técnico</a>
                                <table id="responsive-example-table" class="table large-only">
                                    <thead>
                                        <tr class="text-right">
                                            <th style="width:12%;">Categoria</th>
                                            <th style="width:35%;">Nome</th>
                                            <th style="width:15%;">Qtd Arquivos</th>
                                            <th style="width:15%;">Ação</th>
                                        </tr>
                                        <tr class="text-right">
                                            <th>
                                                <select id="filter_category" name="filter_category">
                                                    <option value="" <?php print( !isset( $info["get"]["filter_category"] ) || $info["get"]["filter_category"] == "" ? "selected" : "" ) ; ?>></option>
                                                    <?php
                                                        foreach( $GLOBALS["context_tecnincal_lists"] as $key => $value ){
                                                    ?>
                                                    <option value="<?php print( $key ) ?>" <?php print( isset( $info["get"]["filter_category"] ) && $info["get"]["filter_category"] == $key ? "selected" : "" ) ; ?>> <?php print( $value ) ?> </option>
                                                    <?php
                                                        }
                                                    ?>  
                                                </select>
                                            </th>
                                             <th><input type="text" name="filter_search_name" value="<?php print( isset( $info["get"]["filter_search_name"] ) ? $info["get"]["filter_search_name"] : '' ) ?>"></th>
                                            <th>&nbsp;</th>
                                            <th><button type="submit" class="button tiny bg-black round" name="search"><i class="fontello-search"></i>Buscar</button></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">
                                                <ul style="float:left">
                                                <li style='display:inline-block;padding:10px;'>Página </li>
                                                <?php 
                                                for( $x = 1 ; $x <= ceil( $total / $paginate ) ; $x++ ){
                                                    print("<li style='display:inline-block;padding:10px; border:1px solid #c0c0c0'>") ;
                                                    if( $info["sr"] == ( ( $x * $paginate ) - $paginate ) ){
                                                        print( $x );
                                                    }
                                                    else{
                                                        $url = set_url( $GLOBALS["technicalcontents_url"] , array_merge( $info["get"] , array( "sr" => ( ( $x * $paginate ) - $paginate ) ) ) ) ;
                                                        printf("<a href='%s'>%d</a></li>" , $url ,  $x ) ;
                                                    }
                                                    print("</li>") ;
                                                }
                                                ?>
                                                </ul>
                                                <div style="display:inline-block;padding:10px; float:right">
                                                    <?php print( $total ) ?> de Registros Encontrados
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($data as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php print( $GLOBALS["context_tecnincal_lists"][ $value["category"] ] ) ?></td>
                                            <td><?php print( $value["name"] ) ?></td>
                                            <td><?php print( isset($value["files_attach"][0] ) ? count( $value["files_attach"] ) : 0 ) ?></td>
                                            <td>
                                                <a href="<?php print( set_url( sprintf( $form["pattern"]["action"] , $value["idx"] ) , array( "done" => $form["done"] ) ) ) ?>" class="button tiny bg-blue round" title="Editar"><i class="fontello-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table><br>
                                <a href="<?php printf( $GLOBALS["technicalcontent_url"] , 0 ) ?>" class="button tiny bg-gray round"><i class="fontello-plus"></i> Novo Conteúdo Técnico</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>