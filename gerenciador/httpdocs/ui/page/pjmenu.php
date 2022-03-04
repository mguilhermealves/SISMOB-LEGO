<div class="row">
    <div class="container">
        <div class="col-lg-12">
            <h3><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $data["name"] : "Cadastrar Menu" ) ?></h3> 
        </div>
        <form method="POST" action="<?php print( $form["url"] ) ?>" class="row col-lg-12">
            <input type="hidden" name="done" value="<?php print( $form["done"] ) ?>">
            <div class="col-lg-4 form-group">
                <label for="name">Nome do Menu</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" name="name" id="name" aria-describedby="Nome do Menu" placeholder="Nome do Menu">
            </div>
            <div class="col-lg-4 form-group">
                <label for="image_file">Imagem</label>
                <input type="file" class="form-control" name="image_file" id="image_file" aria-describedby="Imagem" placeholder="Imagem">
            </div>
            <div class="col-lg-3 form-group">
                <label for="pjurls_id">Link</label>
                <select class="form-control"  id="pjurls_id" name="pjurls_id">
                    <option value="-1" <?php print( ! isset( $data["pjurls_attach"][0] ) || $data["pjurls_attach"][0]["idx"] == "-1" ? " selected='selected' ":"")?>>--- NENHUMA ---</option>
                    <?php 
                    foreach( pjurls_controller::data4select("idx",array(" idx > 0 "),"name") as $k => $v ){
                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["pjurls_attach"][0] ) && $data["pjurls_attach"][0]["idx"] == $k ? ' selected="selected"' : ''  , $v);
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-12">
                <label for="controller">Perfis Disponiveis</label>
                <?php foreach( profiles_controller::data4select("idx",array(" idx > 0 " ) , "name") as $k => $v ){ ?>
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