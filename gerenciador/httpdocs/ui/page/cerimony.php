                <div class="row" style="margin-top:-20px">
                    <div class="large-12 columns">
                        <div class="box">
                            <div class="box-header bg-transparent">
                                <h3 class="box-title"><i class="fontello-th-list"></i>
                                    <span>Cerimonia</span>
                                </h3>
                            </div>
                            <div class="box-body pad-forty" style="display: block;">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <form action="<?php printf( $GLOBALS["cerimony_url"] , $info["idx"] ) ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <fieldset>
                                                    <legend>Identificação</legend>
                                                    <div class="large-4 columns">
                                                        <label>
                                                            Nome
                                                            <input type="text"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                                        </label>
                                                    </div>
                                                    <div class="large-2 columns">
                                                        <label>
                                                            Publicado
                                                            <select id="status_published" name="status_published">
                                                                <?php
                                                                    foreach( $GLOBALS["yes_no_lists"] as $key => $value ){
                                                                ?>
                                                                <option value="<?php print( $key ) ?>" <?php print( isset( $data["status_published"] ) && $data["status_published"] == $key ? "selected" : "" ) ; ?>> <?php print( $value ) ?> </option>
                                                                <?php
                                                                    }
                                                                ?>  
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <div class="large-6 columns">
                                                        <label>
                                                            Banner Home (max 1280 x 143)
                                                            <input type="file" id="file_page" name="file_page" >
                                                        </label>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Conteúdo</legend>
                                                    <div class="large-6 columns">
                                                        <label>
                                                            Texto
                                    <textarea cols="80" id="editor1" name="text" rows="10" style="margin: 0px 0px 16px; height: 359px;"><?php print( isset( $data["text"] ) ? $data["text"] : "&nbsp;" ) ?></textarea>
                                                        </label>
                                                    </div>
                                                    <div class="large-6 columns">
                                                        <div class="large-12 columns">
                                                            <label>
                                                                Vídeo
                                                                <input type="text"  name="video" value="<?php print( isset( $data["video"] ) ? $data["video"] : "" ) ?>">
                                                            </label>
                                                        </div>
                                                        <div class="large-12 columns">
                                                            <label>
                                                                Banner do Conteúdo (max 1280 x 143)
                                                                <input type="file" id="file_banner" name="file_banner" >
                                                            </label>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Participantes</legend>
                                                    <div class="large-12 columns">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Imagem</th>
                                                                <th>Nome</th>
                                                                <th>CPF</th>
                                                                <th>Depoimento</th>
                                                                <th>Cadastrado Plataforma</th>
                                                                <th style="width:15%">Ação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach( $data["cerimoniesparticipants_attach"] as $k => $v ){
                                                            ?>
                                                            <tr id="tr_participante_<?php print( $v["idx"] ) ?>">
                                                                <td><img src="/<?php print( $v["image"] ) ?>" style="height: 75px;"></td>
                                                                <td><?php print( $v["name"] ) ?></td>
                                                                <td><?php print( $v["cpf"] ) ?></td>
                                                                <td><?php print( $v["text"] ) ?></td>
                                                                <td><?php print( $GLOBALS["yes_no_lists"][ isset( $data["users_attach"][ $v["cpf"] ] ) ? "yes" : "no" ] ) ?></td>
                                                                <td>
                                                                    <button type="button" id="btnrmv_<?php print( $v["idx"] ) ?>" class="button tiny bg-red round" title="Remover"><i class="fontello-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div style="display: flex;justify-content: space-between; padding-top:15px">
                                                    <button type="button" class="round hollow button secondary" name="btn_back">Voltar</button>
                                                    <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
