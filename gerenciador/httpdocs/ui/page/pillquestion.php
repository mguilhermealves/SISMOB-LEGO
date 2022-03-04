<div class="row">
    <p class="mb-0 col-lg-12">
        <a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> 
        / <a href="<?php print( $GLOBALS["pills_url"] ) ?>">Pilulas</a> 
        <?php print( isset( $pills_id ) ? ' / <a href="' . sprintf( $GLOBALS["pill_url"] , $pills_id ) . '">Pilula</a>' : '' ) ?> 
        / <?php print( isset( $data[0]["pill_title"] ) ? "Alternativa " . $data[0]["pill_title"] : "Cadastrar Alternativa" ) ?></p>
    <div class="container-fluid box solaris-head">
        <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($pills_id)) {
            ?>
                <input type="hidden" id="pills_id" name="pills_id" value="<?php print($pills_id) ?>">
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
                                    <label for="is_correct">Questão Correta?: <span style="color: red;">*</span></label>
                                    <label> <input type="radio" class="form-control" name="is_correct" value="yes" <?php print( isset( $data["is_correct"] ) && $data["is_correct"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label> <input type="radio" class="form-control" name="is_correct" value="no" <?php print( isset( $data["is_correct"] ) && $data["is_correct"] == "no" ? "checked='checked'" : "" ) ?>> Não </label>  
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">  
                                    <label for="text">Alternativa: <span style="color: red;">*</span></label>
                                    <textarea name="text" class="form-control editor"><?php print( isset( $data["text"] ) ? $data["text"] : "" ) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         <div class="row">

            <div class="col-sm-6">
                  <button type="button" name="btn_back" class="btn btn-outline-secondary btn-sm">Voltar</button>
            </div>
            <div class="col-sm-6 text-right">
                  <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data[0]["idx"] ) ? "Editar" : "Salvar" ) ?></button>
            </div>
         </div>
            </div>
        </form>
    </div>
</div>
<style>
   .blockquote p {
      color: rgb(85, 85, 85);
      font-size: 25px;
      font-weight: 600;
      font-family: Montserrat;
   }

   #atividades-tab {
      color: #FFFFFF;
      padding: 8px 16px;
      font-size: 16px;
      background: #077111;
      margin-top: 10px;
      font-weight: 600;
      border-radius: 5px 5px 0px 0px;
   }

   #myTabContent {
      box-shadow: rgb(85 85 85) 0px 0px 3px;
      border-top: 10px solid rgb(7, 113, 17);
   }

   #helpId ul {
      position: relative;
      right: 35px;
   }

   #helpId li {
      list-style: none;
   }

   .bt.btn-primar.btn-sm {
      color: #FFFFFF;
      border: none;
      cursor: pointer;
      padding: 5px 30px;
      font-size: 16px;
      background: #077111;
      transition: all 400ms ease-in-out;
      font-weight: 600;
      border-radius: 5px 5px 0px 0px;
   }

   .label {
      padding: 4px 20px;
      position: relative;
      background: #999;
      box-shadow: #3d3d3f 0px -4px 3px -2px;
      transition: all 200ms ease-in-out;
      border-radius: 10px 10px 0px 0px;
      margin-bottom: 0px;
      color: #e8e8e8;
      font-size: 18px;
      font-weight: 600;
   }

   .modal-content {
      margin-bottom: 12px;
   }
   .modal-body {
    border: 1px solid #999;
    margin-bottom: 16px;
   }

   .bottom-green-reverse {
      display: inline-block;
      color: #999;
      cursor: pointer;
      border: 1px solid #999;
      padding: 5px 30px;
      text-align: center;
      background-color: #FFFFFF;
      align-items: center;
      font-weight: 600;
      border-radius: 5px 5px 5px 5px;
   }

   a:link {
      text-decoration: none;
   }
</style>