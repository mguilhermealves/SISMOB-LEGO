<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["classes_url"] ) ?>">Turmas</a> / <?php print( $form["title"] ) ?></p>
    <div class="container-fluid box solaris-head">
        <form class="form-group" action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
            <?php
            if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
            ?>
            <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
            <?php
            }
            ?>
            <div class="modal-content">
                <div class="modal-header label">
                    <h5 class="modal-title ">Dados</h5>
                </div>
                <div class="modal-body container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="name">Nome: <span style="color: red;">*</span></label>
                                <input required type="input" name="name" id="name" class="form-control" value="<?php print(isset($data["name"]) ? $data["name"] : "") ?>" placeholder="Escreva o nome">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="start_at">Data Início: </label>
                                <input class="form-control datepicker"  name="start_at" id="start_at" value="<?php print(isset($data["start_at"]) ? preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$data["start_at"] ) : "") ?>" placeholder="Data Inicial">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="end_at">Data Término: </label>
                                <input class="form-control datepicker"  name="end_at" id="end_at" value="<?php print(isset($data["end_at"]) ? preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$data["end_at"]) : "") ?>" placeholder="Data Inicial">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="classes_status">Status: </label>
                                <select name="classes_status" id="classes_status" class="form-control">
                                    <?php 
                                    foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                        printf('<option %s value="%s">%s</option>' , isset( $data["classes_status"] ) && $k == $data["classes_status"] ? ' selected' : '' , $v , $v ) ;
                                    }
                                    ?>                                          
                                </select>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                <div class="large-4 columns">
                    <a href="<?php print( $info["get"]["done"] ) ?>" class="round hollow button secondary" >Voltar</a>
                </div>
                <div class="large-7 columns">
                    <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
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