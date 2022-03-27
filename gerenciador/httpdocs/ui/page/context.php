<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["contexts_url"] ) ?>">Conteúdo</a> / <?php print( isset( $data[0]["name"] ) ? $data[0]["name"] : "Cadastrar Conteúdo" ) ?></p>
    <div class="container-fluid box solaris-head">

      <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
         <?php
         if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
         ?>
            <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
         <?php
         }
         ?>
         <div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title ">Dados</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group">
                              <label for="name">Nome do Conteúdo: <span style="color: red;">*</span></label>
                              <input required type="input" name="name" id="name" class="form-control" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>" placeholder="Escreva o nome do conteudo">
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                              <label for="text">Texto: <span style="color: red;">*</span></label>
                            <textarea id="editor1" name="text" class="form-control editor"><?php print( isset( $data["text"] ) ? $data["text"] : "&nbsp;" ) ?></textarea>


                        </div>
                     </div>
                     <div class="col-lg-12">

                        <div class="col-sm-6">
                            <button type="button" name="btn_back" class="btn btn-outline-secondary btn-sm">Voltar</button>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data[0]["idx"] ) ? "Editar" : "Salvar" ) ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
    .jqte_editor p,.jqte_editor i, .jqte_editor strong{ font-family: 'Roboto' !important; }
    .jqte_editor h1{ font-family: 'Roboto' !important; font-size: 2.5rem; color: #53290f !important; }
</style>