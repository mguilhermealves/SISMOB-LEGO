<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( isset( $data["first_name"] ) ? "Detalhe Pré-Cadastro ". $data["first_name"] : " Pré-Cadastro" ) ?></span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                    <div style="display: flex;justify-content: space-evenly;">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Informações Pessoais</div>
                            <div class="large-4 columns">
                                <label>
                                    Primeiro Nome
                                    <input type="text" disabled value="<?php print( isset( $data["first_name"] ) ? $data["first_name"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns">
                                <label>
                                    Último Nome
                                    <input type="text" disabled value="<?php print( isset( $data["last_name"] ) ? $data["last_name"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns">
                                <label>
                                    CPF
                                    <input type="text" disabled value="<?php print( preg_replace("/(.+)(...)(...)(..)$/","$1.$2.$3-$4", preg_replace("/\D+?/","",$data["cpf"] ) ) ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns">
                                <label>
                                    E-mail
                                    <input type="text" disabled value="<?php print( isset( $data["mail"] ) ? $data["mail"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Telefone
                                    <input type="text" disabled value="<?php print( isset( $data["phone"] ) ? $data["phone"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Celular
                                    <input type="text" disabled value="<?php print( isset( $data["celphone"] ) ? $data["celphone"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Sexo
                                    <input type="text" disabled value="<?php print( isset( $data["genre"] ) && isset( $GLOBALS["genre_lists"][ $data["genre"] ] ) ? $GLOBALS["genre_lists"][ $data["genre"] ]: "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Nascimento
                                    <input type="date" disabled value="<?php print( isset( $data["birthdate"] ) ? $data["birthdate"] : "" ) ?>">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;justify-content: space-evenly;margin-top:1rem">
                        <div class="large-12 columns bxs_user">
                            <div class="header">Endereço</div>
                            <div class="large-6 columns">
                                <label>
                                    Endereço:
                                    <input type="text" disabled value="<?php print( isset( $data["address"] ) ? $data["address"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-2 columns">
                                <label>
                                    Numero:
                                    <input type="text" disabled value="<?php print( isset( $data["address_number"] ) ? $data["address_number"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-4 columns">
                                <label>
                                    Complemento:
                                    <input type="text" disabled value="<?php print( isset( $data["address_complement"] ) ? $data["address_complement"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <label>
                                    Bairro:
                                    <input type="text" disabled value="<?php print( isset( $data["address_neighborhood"] ) ? $data["address_neighborhood"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <label>
                                    *Estado:
                                    <input type="text" disabled value="<?php print( isset( $GLOBALS["ufbr_lists"][ $data["address_distrit"] ] ) ? $GLOBALS["ufbr_lists"][ $data["address_distrit"] ] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <label>
                                    Cidade:
                                    <input type="text" disabled value="<?php print( isset( $data["address_city"] ) ? $data["address_city"] : "" ) ?>">
                                </label>
                            </div>
                            <div class="large-3 columns">
                                <label>
                                    CEP: 
                                    <input type="text" disabled value="<?php print( isset( $data["address_zipcode"] ) ? $data["address_zipcode"] : "" ) ?>">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php print( $form["pattern"]["search"] ) ?>" class="round hollow button secondary">Voltar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>