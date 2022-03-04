<input type="hidden" value="juridica" name="tipo" />

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-documento documento cnpj">                       
        <input value="<?php print( isset($_SESSION["CADASTRO"]["documento"]) ? $_SESSION["CADASTRO"]["documento"] : "" )?>" type="text" class="campo-form form-control" name="documento"  placeholder="CNPJ"  data-validation="required"/>
    </div>
</div>


<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-nome">                       
        <input type="text" value="<?php print( isset($_SESSION["CADASTRO"]["razao_social"]) ? $_SESSION["CADASTRO"]["razao_social"] : '' ) ; ?>" class="campo-form form-control" name="razao_social" placeholder="Razão Social"  data-validation="required"/>
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
<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-autonomo">                       
        <input type="file" class="campo-form form-control" name="cartao_cnpj" placeholder="Cópia do Cartão do CNPJ " />
    </div>
</div>

<div class="row margin-bottom-15">
    <div class="col-lg-12 icon icon-autonomo">                                           
            <div class="styled-file-select">
                <input class="no-bg no-border" type="text" disabled placeholder="Documento comprovação de escritório" />                                              
                <input  type="file" class="campo-form form-control" name="documentos_escritorio" id="documentos_funcao" placeholder="Documento comprovação de escritório" />
            </div>                                                                           
    </div>
</div>

<div class="row margin-bottom-15 margin-top-0">
    <div class="col-lg-12 icon icon-nome">                       
        <input type="number" class="campo-form form-control" id="qtde_responsaveis" name="qtde_responsaveis" min="0" placeholder="Qtde de responsaveis / socios"  data-validation="required"/>
    </div>
</div>

<div id="linhaInsertSocios" class="row padding-top-25 padding-bottom-25">
</div>
<div class="row margin-bottom-15">
    <div class="col-lg-12  text-right xs-text-center"> 
        <button type="submit">enviar</button>
    </div>                             
</div>