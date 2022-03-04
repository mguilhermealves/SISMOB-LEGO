<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["pills_url"] ) ?>">Pilulas</a> / <?php print( isset( $data["pill_title"] ) ? "Pílula " . $data["pill_title"] : "Cadastrar Pílula" ) ?></p>
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
                     <div class="col-lg-4">
                        <div class="form-group">
                              <label for="trail_title">Título da Pilula: <span style="color: red;">*</span></label>
                              <input required type="input" name="pill_title" id="pill_title" class="form-control" value="<?php print(isset($data["pill_title"]) ? $data["pill_title"] : "") ?>" placeholder="Escreva o nome da Pilula">
                              <small id="pill_title" class="form-text text-muted">Utilizado como título da Pilula</small>
                        </div>
                     </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_status">Status</label>
                            <select class="custom-select" name="pill_status" id="pill_status">
                                <?php 
                                foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                printf('<option %s value="%s">%s</option>' , isset( $data["pill_status"] ) && $k == $data["pill_status"] ? ' selected' : '' , $v , $v ) ;
                                }
                                ?>
                            </select>
                            <small id="pill_status" class="form-text text-muted">Status da publicação</small>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="pill_points">Pontuação: <span style="color: red;">*</span></label>
                            <input required type="number" min="1" name="pill_points" id="pill_points" class="form-control" value="<?php print(isset($data["pill_points"]) ? $data["pill_points"] : "1") ?>" placeholder="Posição da trilha">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_show_random_alternatives">Randomizar Alternativa</label>
                            <select class="custom-select" name="pill_show_random_alternatives" id="pill_show_random_alternatives">
                                <?php 
                                foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                printf('<option %s value="%s">%s</option>' , isset( $data["pill_show_random_alternatives"] ) && $k == $data["pill_show_random_alternatives"] ? ' selected' : '' , $k , $v ) ;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_start_date">Data Inicial: <span style="color: red;">*</span></label>
                            <input required type="date" min="1" name="pill_start_date" id="pill_start_date" class="form-control" value="<?php print(isset($data["pill_start_date"]) ? preg_replace("/^(..........).+/","$1", $data["pill_start_date"] ) : date("Y-m-h")) ?>" placeholder="Data Iniial">
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_start_hour">Horário Inicial: <span style="color: red;">*</span></label>
                            <input required type="time" min="1" name="pill_start_hour" id="pill_start_hour" class="form-control" value="<?php print(isset($data["pill_start_date"]) ? preg_replace("/^(..........).(.....).+/","$2", $data["pill_start_date"] ) : date("H:i") ) ?>" placeholder="Horário da Pilula">
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_end_date">Data Final: <span style="color: red;">*</span></label>
                            <input required type="date" min="1" name="pill_end_date" id="pill_end_date" class="form-control" value="<?php print(isset($data["pill_end_date"]) ? preg_replace("/^(..........).(.....).+/","$1", $data["pill_end_date"] ) : date("Y-m-d")) ?>" placeholder="Data Final">
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <label for="pill_end_hour">Horário Final: <span style="color: red;">*</span></label>
                            <input required type="time" min="1" name="pill_end_hour" id="pill_end_hour" class="form-control" value="<?php print(isset($data["pill_end_date"]) ? preg_replace("/^(..........).(.....).+/","$2", $data["pill_end_date"] ) : date("H:i")) ?>" placeholder="Horário Final">
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pill_question_text">Enunciado</label>
                            <textarea id="pill_question_text" name="pill_question_text" class="form-control editor"><?php print( isset( $data["pill_question_text"] ) ? $data["pill_question_text"] : "" ) ?></textarea>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pill_justification">Justificativa</label>
                            <textarea id="pill_justification" name="pill_justification" class="form-control editor"><?php print( isset( $data["pill_justification"] ) ? $data["pill_justification"] : "" ) ?></textarea>
                        </div>
                     </div>
                     <label for="pill_background_url">Template Background</label>
                     <div class="row">
                        <?php
                        foreach( $GLOBALS["background_pill_list"] as $k => $v ){
                            print( 
                                strtr(
                                    '<div style="display: flex; flex-direction: column;align-items: center;" class="form-check col-lg-3">
                                        <input class="form-check-input" id="pill_background_url_#ID#" name="pill_background_url" type="radio" value="#ID#" #CHECKED#>
                                        <label class="form-check-label mt-4" for="pill_background_url_#ID#">
                                            <img src="https://static-premier.hsollearn.com.br/pill/#VALUE#" class="img-fluid"/>
                                        </label>
                                    </div>'
                                , array( "#ID#" => $k , "#VALUE#" => $v , "#CHECKED#" => isset( $data["pill_background_url"] ) && $k == $data["pill_background_url"] ? "checked" : "" )
                                )
                            ) ;
                        }
                        ?>
                     </div>
                  </div>
                </div>
            </div>
        </div>    

        <?php 
            if( isset( $data["profiles_attach"][0] ) ){
                $data[0]["profiles_attach"] = $data["profiles_attach"];
            }
            include( constant("cRootServer") . "ui/components/profiles_available.php"); 
        ?>

        <div class="row">

            <div class="col-sm-6">
                <button type="button" name="btn_back" class="btn btn-outline-secondary btn-sm">Voltar</button>
            </div>
            <div class="col-sm-6 text-right">
                <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data["idx"] ) ? "Editar" : "Salvar" ) ?></button>
            </div>
        </div>
    </form>
</div>


<?php 

if(isset($data["pillquestions_attach"])){


?>

    <div class="container-fluid ">
<!-- Container Begin -->
    <h5>Alternativas</h5>
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Nome</th>
                    <th>Resposta Correta? </th>
                    <th style="width:30%"><a class="btn button btn-outline-primary round" title="Incluir" href="<?php printf( $GLOBALS["newpillquestion_url"], $data["idx"] ) ?>"><i class="fontello-plus"></i>Nova Alternativa</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $data["pillquestions_attach"] as $v){ ?>
                    <tr>
                        <td><?php print( $v["text"] ) ?></td>   
                        <td><?php print( $GLOBALS["yes_no_lists"][ $v["is_correct"] ] ) ?></td>                               
                        <td><a class="btn btn-outline-primary btn-sm" href="<?php printf( $GLOBALS["pillquestion_url"] , $v["idx"] ) ?>">[ editar ]</a> 
                        <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["pillquestion_url"] , $v["idx"] )  ?>">[ excluir ]</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>


<?php } ?>

<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }

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