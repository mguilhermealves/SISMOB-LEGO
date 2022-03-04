<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["name"] ) ? "Editar Participante ". $data["name"] : "Cadastrar Participante" ) ?></span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Informações Pessoais</div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Documento
                                    <textarea style="display:none" name="documento"><?php print( isset( $data["documento"] ) ? preg_replace("/\D+?/im","",$data["documento"]) : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["documento"] ) ? $data["documento"] : "" ) ?></strong>
                                </label>
                            </div>      
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Nome
                                    <textarea style="display:none" name="nome"><?php print( isset( $data["nome"] ) ? $data["nome"] : "" ) ?></textarea>
                                    <br><strong  class="input-hsol-disabled"><?php print( isset( $data["nome"] ) ? $data["nome"] : "" ) ?></strong>
                                </label>
                            </div>   
                            <?php
                            if( !empty($data["socios"]) ){
                            ?>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                Documento comprovação de escritório 
                                    <br><strong class="input-hsol-disabled">&nbsp;<?php print( file_exists( $data["documentos_funcao"] ) ? '<a target="_blank" href="/'.$data["documentos_funcao"]  . '">[ link ]</a>': "" ) ?></strong>
                                </label>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Data nascimento
                                    <textarea style="display:none" name="data_nascimento"><?php print( isset( $data["data_nascimento"] ) ? $data["data_nascimento"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["data_nascimento"] ) ? preg_replace("/^(..)(..)/","$1/$2", preg_replace("/\D+?/im","",$data["data_nascimento"])) : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Gênero
                                    <input type="text"  name="sexo" value="<?php print( isset( $data["sexo"] ) ? $data["sexo"] : "" ) ?>">
                                </label>
                            </div>
                            <?php
                            }
                            ?>

                            <div class="large-4 columns padding-top-20">
                                <label>
                                    E-mail
                                    <input type="text"  name="email" value="<?php print( isset( $data["email"] ) ? $data["email"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Celular
                                    <input type="text"  name="celular" value="<?php print( isset( $data["celular"] ) ? $data["celular"] : "" ) ?>">
                                </label>
                            </div>    
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Telefone
                                    <input type="text"  name="telefone" value="<?php print( isset( $data["telefone"] ) ? $data["telefone"] : "" ) ?>">
                                </label>
                            </div>   
                        </div>
                    </div>

                    <?php
                    if( !empty($data["socios"]) ){
                        $socios = unserialize( $data["socios"] );
                    ?>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Sócios</div>
                            <?php
                            foreach( $socios["nome"] as $k => $v){
                            ?>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Nome 
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["nome"][ $k ] ) ? $socios["nome"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Perfil
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["perfil"][ $k ] ) ? $socios["perfil"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                         
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Data de Nascimento
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["data_nascimento"][ $k ] ) ? $socios["data_nascimento"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Gênero
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["sexo"][ $k ] ) ? $socios["sexo"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Ano de início da função 
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["ano_inicio_funcao"][ $k ] ) ? $socios["ano_inicio_funcao"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Formação Acadêmica
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $socios["formacao_academica"][ $k ] ) ? $socios["formacao_academica"][ $k ] : "" ) ?></strong>
                                </label>
                            </div>
                            <hr/>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                    ?>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Informações Profissionais</div>

                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Perfil
                                    <select name="perfil">
                                        <option value="Arquiteto" <?php print( !isset( $data["perfil"] ) || $data["perfil"] == "Arquiteto" ? "selected='selected'" : "" ) ?>>Arquiteto</option>
                                        <option value="Arquiteto" <?php print( isset( $data["perfil"] ) && $data["perfil"] == "Arquiteto" ? "selected='selected'" : "" ) ?>>Arquiteto</option>
                                       <option value="Light Designer" <?php print( isset( $data["perfil"] ) && $data["perfil"] == "Light Designer" ? "selected='selected'" : "" ) ?>>Light Designer</option>
                                       <option value="Designer de Interiores" <?php print( isset( $data["perfil"] ) && $data["perfil"] == "Designer de Interiores" ? "selected='selected'" : "" ) ?>>Designer de Interiores</option>
                                       <option value="Dpto de projetos Luminotécnicos" <?php print( isset( $data["perfil"] ) && $data["perfil"] == "Dpto de projetos Luminotécnicos" ? "selected='selected'" : "" ) ?>>Dpto de projetos Luminotécnicos</option>
                                   </select>
                                </label>
                            </div>
                         
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Ano de início da função 
                                    <textarea style="display:none" name="ano_inicio_funcao"><?php print( isset( $data["ano_inicio_funcao"] ) ? $data["ano_inicio_funcao"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["ano_inicio_funcao"] ) ? $data["ano_inicio_funcao"] : "" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Formação Acadêmica
                                    <select name="formacao_academica">
                                        <option <?php print( !isset( $data["formacao_academica"] ) || $data["formacao_academica"] == "" ? "selected='selected'" : "" ) ?> value="">Formação acadêmica </option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "bacharel" ? "selected='selected'" : "" ) ?> value="bacharel">Bacharel</option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "doutorado" ? "selected='selected'" : "" ) ?> value="doutorado">Doutorado</option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "mestrado" ? "selected='selected'" : "" ) ?> value="mestrado">Mestrado</option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "pos_ma" ? "selected='selected'" : "" ) ?> value="pos_ma">Pós Graduação / MBA</option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "tecnologo" ? "selected='selected'" : "" ) ?> value="tecnologo">Tecnólogo</option>
                                        <option <?php print( isset( $data["formacao_academica"] ) && $data["formacao_academica"] == "tecnico" ? "selected='selected'" : "" ) ?> value="tecnico">Técnico</option>
                                   </select>
                                </label>
                            </div>
                            <div class="large-6 columns padding-top-20">
                                <label>
                                    Carteria da conselho, diploma ,certificado , etc ... 
                                    <br><strong class="input-hsol-disabled"><?php print( file_exists( $data["documentos_funcao"] ) ? '<a target="_blank" href="/'.$data["documentos_funcao"]  . '">[ link ]</a>': "" ) ?></strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Endereço</div>

                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Cep
                                    <textarea style="display:none" name="cep"><?php print( isset( $data["cep"] ) ? $data["cep"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["cep"] ) ? $data["cep"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-7 columns padding-top-20">
                                <label>
                                    Endereço
                                    <textarea style="display:none" name="logradouro"><?php print( isset( $data["logradouro"] ) ? $data["logradouro"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["logradouro"] ) ? $data["logradouro"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div>   
                            <div class="large-2 columns padding-top-20">
                                <label>
                                    Número
                                    <textarea style="display:none" name="numero"><?php print( isset( $data["numero"] ) ? $data["numero"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["numero"] ) ? $data["numero"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div>    
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Bairro
                                    <textarea style="display:none" name="bairro"><?php print( isset( $data["bairro"] ) ? $data["bairro"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["bairro"] ) ? $data["bairro"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div>
                            
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Cidade
                                    <textarea style="display:none" name="cidade"><?php print( isset( $data["cidade"] ) ? $data["cidade"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["cidade"] ) ? $data["cidade"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    UF
                                    <textarea style="display:none" name="uf"><?php print( isset( $data["uf"] ) ? $data["uf"] : "" ) ?></textarea>
                                    <br><strong class="input-hsol-disabled"><?php print( isset( $data["uf"] ) ? $data["uf"] : "&nbsp;" ) ?></strong>
                                </label>
                            </div> 
                        </div>   
                    </div> 


                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Aprovar</div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Aprovar Cadastro?
                                    <select required name="aprovado" name="aprovado">
                                        <option value=""></option>
                                        <option value="não">Não</option>
                                        <option value="sim">Sim</option>
                                    </select>
                                </label>
                            </div>
                            <div class="large-4 columns padding-top-20">
                                <label>
                                    Categoria
                                    <select name="categorias_id" name="categorias_id">
                                    <option value=""<?php print( !isset( $data["categorias_attach"][0] ) ? ' selected': '' )?>>-- Selecione --</option>
                                    <?php
                                        foreach( $categorias_lists as $k => $v ){
                                            printf('<option value="%s"%s>%s</option>', $k , isset( $data["categorias_attach"][0] ) && (int)$data["categorias_attach"][0]["idx"] == (int)$k ? ' selected' : '' , $v );
                                        }
                                    ?>
                                    </select>
                                </label>
                            </div>

                        </div>
                    </div>

                           


                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <button type="button" class="round hollow button secondary" name="btn_back">Voltar</button>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
    .input-hsol-disabled{ -webkit-appearance: none;
    -webkit-border-radius: 0px;
    background-color: #f0f0f0;
    font-family: inherit;
    border-style: solid;
    border-width: 1px;
    border-color: #cccccc;
    box-shadow: none;
    color: rgba(0, 0, 0, 0.75);
    display: block;
    font-size: 0.875em;
    margin: 0 0 1rem 0;
    padding: 0.5em;
    height: 2.3125rem;
    width: 100%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    transition: box-shadow 0.45s, border-color 0.45s ease-in-out; }
</style>
