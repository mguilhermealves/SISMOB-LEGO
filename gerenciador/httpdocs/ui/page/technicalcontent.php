                <div class="row" style="margin-top:-20px">
                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <h3 class="box-title"><i class="fontello-th-list"></i>
                                    <span>Conteúdo Técnico</span>
                                </h3>
                            </div>
                            <div class="box-body pad-forty" style="display: block;">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data">
                                            <?php
                                            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                                            ?>
                                            <input type="hidden" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                                            <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="small-4 large-4 columns">
                                                    <label>
                                                        Name
                                                        <input name="name" type="text" value="<?php print( !empty( $data["name"] ) ? $data["name"] :  '' ) ?>">
                                                    </label>
                                                </div>
                                                <div class="small-4 large-4 columns">
                                                    <label>
                                                        Categoria
                                                        <select id="category" name="category">
                                                            <?php
                                                                foreach( $GLOBALS["context_tecnincal_lists"] as $key => $value ){
                                                            ?>
                                                            <option value="<?php print( $key ) ?>" <?php print( isset( $data["category"] ) && $data["category"] == $key ? "selected" : "" ) ; ?>> <?php print( $value ) ?> </option>
                                                            <?php
                                                                }
                                                            ?>  
                                                        </select>
                                                    </label>
                                                </div>
                                                <?php
                                                if( isset( $data["files_attach"] ) ){
                                                ?>
                                                <div class="small-4 large-4 columns">
                                                    <label>
                                                        Arquivo
                                                        <input type="file" name="file_upload[]" multiple>
                                                    </label>
                                                </div>
                                                <div class="small-12 large-12 columns">Listagem de Arquivos</div>                                                
                                                <?php
                                                    foreach( (array)$data["files_attach"] as $key => $value ){
                                                        printf('<div class="small-12 large-12 columns"><button name="btn_remove" type="button" class="tiny alert" >Remover</button> <input type="hidden" name="files_id[]" value="%d"><a href="/%s" target="_blank">%s</a></div>'."\n" , $value["idx"] , $value["url"] , $value["name"] );
                                                    }
						                        }
                                                ?>
                                            </div>
                                            <button type="button" class="tiny warning" name="btn_back">Voltar</button>
                                            <button type="submit" class="tiny pull-right" name="btn_save">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
