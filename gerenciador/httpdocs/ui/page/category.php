                <div class="row" style="margin-top:-20px">
                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <h3 class="box-title"><i class="fontello-th-list"></i>
                                    <span>Categoria</span>
                                </h3>
                            </div>
                            <div class="box-body pad-forty" style="display: block;">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <form action="<?php printf( $GLOBALS["category_url"] , $info["idx"] ) ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <label>
                                                        Nome
                                                        <input type="text"  name="name" value="<?php print( $data["name"] ) ?>">
                                                    </label>
                                                </div>
                                                <div class="large-6 columns">
                                                    <label>
                                                        Categoria Pai
                                                        <select id="parent" name="parent">
                                                            <?php
                                                                foreach( $parents_id as $key => $value ){
                                                            ?>
                                                            <option value="<?php print( $key ) ?>" <?php print( $data["parent"] == $key ? "selected" : "" ) ; ?>> <?php print( $value ) ?> </option>
                                                            <?php
                                                                }
                                                            ?>  
                                                        </select>
                                                    </label>
                                                </div>
                                                <fieldset>
                                                    <legend>SEO</legend>
                                                    <div class="large-12 columns">
                                                        <label>
                                                            Title
                                                            <input type="text"  name="title" value="<?php print( $data["title"] ) ?>">
                                                        </label>
                                                    </div>
                                                    <div class="large-12 columns">
                                                        <label>
                                                            Description
                                                            <input type="text"  name="description" value="<?php print( $data["description"] ) ?>">
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <button type="submit" class="tiny" name="btn_save">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
