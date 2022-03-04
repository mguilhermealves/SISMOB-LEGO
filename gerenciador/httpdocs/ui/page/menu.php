<div class="row">
    <div class="container" >
        <div class="col-lg-12">
            <h3><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $data["name"] : "Cadastrar Menu" ) ?></h3> 
        </div>
        <form method="POST" action="<?php print( $form["url"] ) ?>" class="row col-lg-12" enctype="multipart/form-data" >
            <input type="hidden" name="done" value="<?php print( $form["done"] ) ?>">
            <div class="col-lg-4 form-group">
                <label for="name">Nome do Menu</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" name="name" id="name" aria-describedby="Nome do Menu" placeholder="Nome do Menu">
            </div>
            <!-- <div class="large-12 columns">
                <label>
                    Imagem
                    <input type="file" class="form-control" name="thumbnail">
                </label>
                <?php if( !empty( $data["image"] ) && file_exists( constant("cRootServer") . $data["image"] ) ){
                ?><img src="/<?php print( $data["image"] ) ?>"/>
                <?php
                } ?>
            </div> -->
            <div class="col-lg-3 form-group">
                <label for="urls_id">Link</label>
                <select class="form-control"  id="urls_id" name="urls_id">
                    <option value="-1" <?php print( ! isset( $data["urls_attach"][0] ) || $data["urls_attach"][0]["idx"] == "-1" ? " selected='selected' ":"")?>>--- NENHUMA ---</option>
                    <?php 
                    foreach( urls_controller::data4select("idx",array(" idx > 0 "),"name") as $k => $v ){
                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $data["urls_attach"][0] ) && $data["urls_attach"][0]["idx"] == $k ? ' selected="selected"' : ''  , $v);
                    }
                    ?>
                </select>
            </div>
            
            <div class="col-lg-4 form-group">
                <label for="position">Posição no Menu</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["position"] ) ? $data["position"] : "" ) ?>" name="position" id="position" aria-describedby="Posição do Menu" placeholder="Posição do Menu">
            </div>
            <!-- <div class="col-lg-4 form-group">
                <label for="color">Cor</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["color"] ) ? $data["color"] : "#000" ) ?>" name="color" id="color" aria-describedby="Posição do Menu" placeholder="Cor do Menu">
            </div> -->
            
            <div class="col-lg-12">
                <label for="controller">Perfis Disponiveis</label>
                <?php foreach( profiles_controller::data4select("idx",array(" idx > 0 and active = 'yes'" ) , "name") as $k => $v ){ ?>
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