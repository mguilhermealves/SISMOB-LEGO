                <div class="row" style="margin-top:-20px">
                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <h3 class="box-title"><i class="fontello-th-list"></i>
                                    <span>Listagem de Cerimonias</span>
                                </h3>
                            </div>
                            <div class="box-body " style="display: block;">
                                <table id="responsive-example-table" class="table large-only">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-right">
                                                <form style="border:1px solid #000000;padding:1rem" class="large-5 columns" action="/cerimonia/participantes" method="post" enctype="multipart/form-data">
                                                    <label class="large-10 text-left columns">
                                                        Lista de Participantes [ <a href="/furniture/upload/planejar_cerimonia/Planilha_depoimentos_planejar_modelo_padrao.xlsx" target="_blank">MODELO PLANILHA</a> ]
                                                        <input type="file" name="file_participantes" >
                                                    </label>
                                                    <button class="large-2 columns" name="btn_save" type="submit">Enviar</button>
                                                </form>
                                                <form style="border:1px solid #000000;padding:1rem"class="large-5 columns" action="/cerimonia/imagens" method="post" enctype="multipart/form-data">
                                                    <label class="large-8 text-left columns">
                                                        Imagem dos Participantes (max. 400x600)
                                                        <input type="file" multiple name="file_images[]" >
                                                    </label>
                                                    <button lass="large-2 columns" name="btn_save" type="submit">Enviar</button>
                                                </form>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right"><a href="<?php printf( $GLOBALS["cerimony_url"] , 0 ) ?>" class="button tiny bg-gray round"><i class="fontello-plus"></i> Nova Cerimonia</a></th>
                                        </tr>
                                        <tr class="text-right">
                                            <th style="width:45%;">Nome</th>
                                            <th style="width:20%;">Participantes</th>
                                            <th style="width:20%;">Publicado</th>
                                            <th style="width:15%;">Ação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right"><a href="<?php printf( $GLOBALS["cerimony_url"] , 0 ) ?>" class="button tiny bg-gray round"><i class="fontello-plus"></i> Nova Cerimonia</a></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($data as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php print( $value["name"] ) ?></td>
                                            <td><?php print( isset( $value["cerimoniesparticipants_attach"][0] ) ? count( $value["cerimoniesparticipants_attach"] ) : 0 ) ?></td>
                                            <td><?php print( $GLOBALS["yes_no_lists"][ $value["status_published"] ] ) ?></td>
                                            <td>
                                                <a href="<?php printf( $GLOBALS["cerimony_url"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar"><i class="fontello-edit"></i></a>
                                                <a href="<?php printf( $GLOBALS["cerimony_url"] , $value["idx"] ) ?>" id="btn_remove_<?php print( $value["idx"] ) ?>" class="button tiny bg-red round" title="Remover"><i class="fontello-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
