<input type="hidden" value="fisica" name="tipo" />

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-documento documento cpf">                       
        <input type="text" class="campo-form form-control" name="documento" value="<?php print( isset($_SESSION["CADASTRO"]["documento"]) ? $_SESSION["CADASTRO"]["documento"] : '' ) ; ?>" placeholder="CPF"  data-validation="required"/>
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-nome">                       
        <input type="text" class="campo-form form-control" name="nome"  value="<?php print( isset($_SESSION["CADASTRO"]["nome"]) ? $_SESSION["CADASTRO"]["nome"] : '' ) ; ?>"placeholder="Nome completo "  data-validation="required"/>
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-6 icon icon-nome data-nasc">                       
        <input type="text" class="campo-form form-control" name="data_nascimento" value="<?php print( isset($_SESSION["CADASTRO"]["data_nascimento"]) ? $_SESSION["CADASTRO"]["data_nascimento"] : '' ) ; ?>" placeholder="Data de nascimento" data-validation="required"/>
    </div>
    <div class="col-lg-6 icon icon-nome">                     
        <input type="text" class="campo-form form-control" value="<?php print( isset($_SESSION["CADASTRO"]["sexo"]) ? $_SESSION["CADASTRO"]["sexo"] : '' ) ; ?>" name="sexo"  placeholder="GÊNERO" data-validation="required"/>        
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-email">                       
        <input type="email" class="campo-form form-control" name="email"  value="<?php print( isset($_SESSION["CADASTRO"]["email"]) ? $_SESSION["CADASTRO"]["email"] : '' ) ; ?>" placeholder="EMAIL" data-validation="required"/>
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-4 icon icon-celular telefone">                       
        <input type="text" class="campo-form form-control padding-right-10" name="celular" value="<?php print( isset($_SESSION["CADASTRO"]["celular"]) ? $_SESSION["CADASTRO"]["celular"] : '' ) ; ?>" placeholder="CELULAR" data-validation="required"/>
    </div>
    <div class="col-lg-4 icon icon-celular telefone">                       
        <input type="text" class="campo-form form-control padding-right-10" name="telefone" value="<?php print( isset($_SESSION["CADASTRO"]["telefone"]) ? $_SESSION["CADASTRO"]["telefone"] : '' ) ; ?>" placeholder="TELEFONE" data-validation="required"/>
    </div>
    <div class="col-lg-4 icon icon-cidade xs-margin-bottom-15 cep">                       
        <input type="text" class="campo-form form-control padding-right-10" name="cep" value="<?php print( isset($_SESSION["CADASTRO"]["cep"]) ? $_SESSION["CADASTRO"]["cep"] : '' ) ; ?>" placeholder="CEP" data-validation="required"/>
    </div>
</div>
<div class="row margin-bottom-15">
    <div class="col-lg-9 xs-padding-left-0 xs-margin-bottom-15 icon icon-cidade logradouro">                       
        <input type="text" class="campo-form form-control" name="logradouro" value="<?php print( isset($_SESSION["CADASTRO"]["logradouro"]) ? $_SESSION["CADASTRO"]["logradouro"] : '' ) ; ?>" placeholder="ENDEREÇO" data-validation="required"/>
    </div>   
    <div class="col-lg-3 icon icon-cidade">                       
        <input type="text" class="campo-form form-control padding-right-10" name="numero" value="<?php print( isset($_SESSION["CADASTRO"]["numero"]) ? $_SESSION["CADASTRO"]["numero"] : '' ) ; ?>" placeholder="NUMERO" data-validation="required"/>
    </div>                                  
</div>
<div class="row margin-bottom-15">
    <div class="col-lg-5 icon icon-cidade bairro">                       
        <input type="text" class="campo-form padding-0 form-control" name="bairro" value="<?php print( isset($_SESSION["CADASTRO"]["bairro"]) ? $_SESSION["CADASTRO"]["bairro"] : '' ) ; ?>" placeholder="bairro" data-validation="required"/>
    </div> 
    <div class="col-lg-4 icon icon-cidade cidade">                       
        <input type="text" class="campo-form form-control" name="cidade" value="<?php print( isset($_SESSION["CADASTRO"]["cidade"]) ? $_SESSION["CADASTRO"]["cidade"] : '' ) ; ?>" placeholder="CIDADE" data-validation="required"/>
    </div> 
    <div class="col-lg-3 icon icon-cidade uf">        
        <select class="campo-form form-control" name="uf" data-validation="required">
            <option value="" <?php print( !isset($_SESSION["CADASTRO"]["uf"]) || $_SESSION["CADASTRO"]["uf"] == "" ? 'selected="selected"' : '' ) ; ?>>UF </option>
            <?php 
            foreach( $GLOBALS["ufbr_lists"] as $k => $v ){
                printf('<option value="%s" %s>%s</option>' , $k, isset($_SESSION["CADASTRO"]["uf"]) && $_SESSION["CADASTRO"]["uf"] == $k ? 'selected="selected"' : '' , $v  ) ;
            }
            ?>
        </select>               
    </div>                  
</div>
<div class="row margin-bottom-15 margin-top-15">
    <div class="col-lg-6 icon icon-nome">                       
        <select class="campo-form form-control" name="perfil" data-validation="required">
            <option <?php print( !isset($_SESSION["CADASTRO"]["perfil"]) || $_SESSION["CADASTRO"]["perfil"] == "" ? 'selected="selected"' : '' ) ; ?> value="">Perfil</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["perfil"]) && $_SESSION["CADASTRO"]["perfil"] == "Arquiteto" ? 'selected="selected"' : '' ) ; ?> value="Arquiteto">Arquiteto</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["perfil"]) && $_SESSION["CADASTRO"]["perfil"] == "Light Designer" ? 'selected="selected"' : '' ) ; ?>  value="Light Designer">Light Designer</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["perfil"]) && $_SESSION["CADASTRO"]["perfil"] == "Designer de Interiores" ? 'selected="selected"' : '' ) ; ?>  value="Designer de Interiores">Designer de Interiores</option>
        </select>
    </div>
    <div class="col-lg-6 icon icon-nome">                       
        <input type="text"  value="<?php print( isset($_SESSION["CADASTRO"]["ano_inicio_funcao"]) ? $_SESSION["CADASTRO"]["ano_inicio_funcao"] : '' ) ; ?>" class="campo-form form-control" name="ano_inicio_funcao"  placeholder="Ano de início da função " data-validation="required"/>
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-nome">                       
        <select class="campo-form form-control" name="formacao_academica" data-validation="required">
            <option <?php print( !isset($_SESSION["CADASTRO"]["formacao_academica"]) || $_SESSION["CADASTRO"]["formacao_academica"] == "" ? 'selected="selected"' : '' ) ; ?>  value="">Formação acadêmica </option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "bacharel" ? 'selected="selected"' : '' ) ; ?> value="bacharel">Bacharel</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "doutorado" ? 'selected="selected"' : '' ) ; ?> value="doutorado">Doutorado</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "mestrado" ? 'selected="selected"' : '' ) ; ?> value="mestrado">Mestrado</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "pos_ma" ? 'selected="selected"' : '' ) ; ?> value="pos_ma">Pós Graduação / MBA</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "tecnologo" ? 'selected="selected"' : '' ) ; ?> value="tecnologo">Tecnólogo</option>
            <option <?php print( isset($_SESSION["CADASTRO"]["formacao_academica"]) && $_SESSION["CADASTRO"]["formacao_academica"] == "tecnico" ? 'selected="selected"' : '' ) ; ?> value="tecnico">Técnico</option>
        </select>
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-autonomo">   
        

            <div class="styled-file-select">
                <input class="no-bg no-border" type="text" disabled placeholder="Envio de carteria da conselho, diploma ,certificado , etc ..." />                                              
                <input  type="file" class="campo-form form-control" name="documentos_funcao" id="documentos_funcao" placeholder="Envio de carteria da conselho, diploma ,certificado , etc ... " />
            </div>

                                            
    </div>
</div>
<div class="row margin-bottom-15">
    <div class="col-lg-12  text-right xs-text-center"> 
        <button type="submit">enviar</button>
    </div>                             
</div>