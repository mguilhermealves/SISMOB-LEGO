<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["libraries_url"] ) ?>">Bibliotecas</a> / <?php print( isset($data[0]["name"]) ? 'Categoria ' . $data[0]["name"] : "Cadastrar Categoria" ) ?></p>
    <div class="container-fluid box solaris-head">
        <form action="<?php print($form["url"]) ?>" method="POST" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Título:</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php print(isset($data[0]["name"]) ? $data[0]["name"] : "") ?>" aria-describedby="helpTitle" placeholder="Informe o nome da Categoria">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="custom-select" name="status" id="status">
                                    <?php 
                                    foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                        printf('<option %s value="%s">%s</option>' , isset( $data[0]["status"] ) && $k == $data[0]["status"] ? ' selected' : '' , $v , $v ) ;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="display_position">Posição</label>
                                <input type="number" class="form-control" name="display_position" id="display_position" value="<?php print(isset($data[0]["display_position"]) ? $data[0]["display_position"] : "1") ?>" aria-describedby="helpTitle" placeholder="Posição">
                            </div>
                        </div>
                        <?php
                        if( isset( $info["sub"] ) ){
                        ?>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="thumb">tumbne</label>
                                <input type="file" class="form-control" name="thumb" id="thumb" aria-describedby="helpIco" placeholder="">
                                <?php if( !empty( $data["ico"] ) && file_exists( constant("cRootServer") . $data["ico"] ) ){
                                    ?><img class="img-fluid my-4" src="/furniture/upload/<?php print( $data["ico"] ) ?>"/>
                                <?php } ?>   
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="parent">Categoria</label>
                                <select class="custom-select" name="parent" id="parent">
                                    <?php
                                    foreach( libraries_controller::data4select("idx",array(" active = 'yes' " , " parent = 0 " ) , "name" ) as $k => $v ){
                                        printf('<option %s value="%s">%s</option>' , isset( $data[0]["parent"] ) && $k == $data[0]["parent"] ? ' selected' : '' , $k , $v ) ;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
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