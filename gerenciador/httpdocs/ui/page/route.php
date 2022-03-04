<div class="row">
    <div class="container">
        <div class="col-lg-12">
            <h3><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $data["name"] : "Cadastrar Rota" ) ?></h3> 
        </div>
        <form method="POST" action="<?php print( $form["url"] ) ?>" class="row col-lg-12">
            <input type="hidden" name="done" value="<?php print( $form["done"] ) ?>">
            <div class="col-lg-3 form-group">
                <label for="name">Nome da Rota</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" name="name" id="name" aria-describedby="Nome da Rota" placeholder="Nome da Rota">
            </div>
            <div class="col-lg-3 form-group">
                <label for="method">Metodo</label>
                <select class="form-control"  id="method" name="method">
                    <?php 
                    foreach( $GLOBALS["method_lists"] as $k => $v ){
                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["method"] ) && $data["method"] == $k ? ' selected="selected"' : ''  , $v);
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-3 form-group">
                <label for="btncheck">Check</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["btncheck"] ) ? $data["btncheck"] : "" ) ?>" name="btncheck" id="btncheck" aria-describedby="Check" placeholder="Check">
            </div>
            <div class="col-lg-3 form-group">
                <label for="params">Parametros</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["params"] ) ? $data["params"] : "" ) ?>" name="params" id="params" aria-describedby="Parametros" placeholder="Parametros">
            </div>
            <div class="col-lg-6 form-group">
                <label for="pattern">URL</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["pattern"] ) ? $data["pattern"] : "" ) ?>" name="pattern" id="pattern" aria-describedby="URL" placeholder="URL">
            </div>
            <div class="col-lg-6 form-group">
                <label for="controller">Comando</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["controller"] ) ? $data["controller"] : "" ) ?>" name="controller" id="controller" aria-describedby="Comando" placeholder="Comando">
            </div>
            <div class="col-lg-12">
                <label for="controller">Perfis Disponiveis</label>
                <?php foreach( profiles_controller::data4select("idx",array(" idx > 0 and active = 'yes' " ) , "name") as $k => $v ){ ?>
                <div class="form-check">
                    <input <?php print( isset( $data["profiles_attach"][0] ) && in_array( $k , array_column( $data["profiles_attach"] , "idx" ) ) ? 'checked' : '' ) ?> class="form-check-input" type="checkbox" value="<?php print( $k ) ?>" name="profiles_id[]" id="profiles_id<?php print( $k ) ?>">
                    <label class="form-check-label" for="profiles_id<?php print( $k ) ?>"> <?php print( $v ) ?> </label>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-6 form-group">
                <button class="btn btn-warning" type="button" name="btn_back">Voltar</button>
            </div>
            <div class="col-lg-6 form-group text-right">
                <button class="btn btn-warning" type="submit" name="btn_save">Salvar</button>
            </div>
        </form>
    </div>      
</div>