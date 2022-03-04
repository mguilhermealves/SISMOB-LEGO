<div class="row">
    <div class="container">
        <div class="col-lg-12">
            <h3><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? $data["name"] : "Cadastrar Url" ) ?></h3> 
        </div>
        <form method="POST" action="<?php print( $form["url"] ) ?>" class="row col-lg-12">
            <input type="hidden" name="done" value="<?php print( $form["done"] ) ?>">
            <div class="col-lg-4 form-group">
                <label for="name">Nome da Url</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" name="name" id="name" aria-describedby="Nome da Url" placeholder="Nome da Url">
            </div>
            <div class="col-lg-4 form-group">
                <label for="slug">SLUG</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["slug"] ) ? $data["slug"] : "" ) ?>" name="slug" id="slug" aria-describedby="SLUG" placeholder="SLUG">
            </div>
            <div class="col-lg-4 form-group">
                <label for="pattern">URL</label>
                <input type="text" class="form-control" value="<?php print( isset( $data["pattern"] ) ? $data["pattern"] : "" ) ?>" name="pattern" id="pattern" aria-describedby="URL" placeholder="URL">
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