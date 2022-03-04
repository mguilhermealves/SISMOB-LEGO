<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["trails_url"] ) ?>">Trilhas</a> / <?php print( isset( $data[0]["trail_title"] ) ? "Trilha " . $data[0]["trail_title"] : "Cadastrar Trilha" ) ?></p>
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
                     <div class="col-lg-6">
                        <div class="form-group">
                              <label for="trail_title">Título da Trilha: <span style="color: red;">*</span></label>
                              <input required type="input" name="trail_title" id="trail_title" class="form-control" value="<?php print(isset($data[0]["trail_title"]) ? $data[0]["trail_title"] : "") ?>" placeholder="Escreva o nome da trilha">
                              <small id="trail_title" class="form-text text-muted">Utilizado como título da trilha</small>
                        </div>
                     </div>
                     
                     <div class="col-lg-3">
                        <div class="form-group">
                           
                              <label for="trail_status">Status</label>
                              <select class="custom-select" name="trail_status" id="trail_status">
                                 <?php 
                                 foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                    printf('<option %s value="%s">%s</option>' , isset( $data[0]["trail_status"] ) && $k == $data[0]["trail_status"] ? ' selected' : '' , $v , $v ) ;
                                 }
                                 ?>
                              </select>
                              <small id="trail_status" class="form-text text-muted">Status da publicação</small>
                        </div>
                     </div>
                     
                     <div class="col-lg-3">
                        <div class="form-group">
                              <label for="display_position">Posicionamento: <span style="color: red;">*</span></label>
                              <input required type="number" min="1" name="display_position" id="display_position" class="form-control" value="<?php print(isset($data[0]["display_position"]) ? $data[0]["display_position"] : "1") ?>" placeholder="Posição da trilha">
                        </div>
                     </div>


                     <div class="col-lg-6">
                        <div class="form-group">
                           
                              <label for="display_number">Apresentar Numeração</label>
                              <select class="custom-select" name="display_number" id="display_number">
                                 <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                    printf('<option %s value="%s">%s</option>' , isset( $data[0]["display_number"] ) && $k == $data[0]["display_number"] ? ' selected' : '' , $k , $v ) ;
                                 }
                                 ?>
                              </select>
                              <small id="display_number" class="form-text text-muted">Utilizado para apresentar o numero em cada curso</small>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           
                              <label for="after_destak">Apresentar Depois do Banner Destaque</label>
                              <select class="custom-select" name="after_destak" id="after_destak">
                                 <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                    printf('<option %s value="%s">%s</option>' , isset( $data[0]["after_destak"] ) && $k == $data[0]["after_destak"] ? ' selected' : '' , $k , $v ) ;
                                 }
                                 ?>
                              </select>
                              <small id="after_destak" class="form-text text-muted">Trilha após o banner destaue</small>
                        </div>
                     </div>
                     
                  </div>
            </div>
         </div>


         <!--div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title">Destaque</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                              <label>Título da Seção para Destaque:</label>
                              <input type="text" name="trail_sub_title" id="" class="form-control" aria-describedby="helpDestaque" value="<?php print(isset($data[0]["trail_sub_title"]) ? $data[0]["trail_sub_title"] : "") ?>">
                              <small id="helpDestaque" class="form-text text-muted">Utilizado como agrupamento de destaque</small>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                              <label>Descrição de Destaque:</label>
                              <textarea class="form-control" name="trail_description" id="" rows="10" cols="5" style="resize: none;" placeholder="Descrição de Destaque"><?php print(isset($data[0]["trail_description"]) ? $data[0]["trail_description"] : "") ?></textarea>
                        </div>
                     </div>
                  </div>
            </div>
         </div-->

         <?php include( constant("cRootServer") . "ui/components/profiles_available.php"); ?>

         <div class="row">

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