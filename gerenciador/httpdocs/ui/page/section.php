<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["courses_url"] ) ?>">Cursos</a> / <?php print( ( isset( $data["courses_attach"][0] ) ? '<a href="' . set_url( $GLOBALS["courses_url"], array( "filter_name" => $data["courses_attach"][0]["course_title"] ) ) . '">' . $data["courses_attach"][0]["course_title"] . '</a> / ' : "" ) . '<a href="' . sprintf( $GLOBALS["sections_by_course_url"], $data["courses_attach"][0]["idx"] ) . '">Listagem de Seções</a> / ' . $form["title"] ) ?></p>
    <?php
    if( false ){
    ?>
        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#cloneSection"><i class="bi bi-stack"></i>  Clonar Sessão</button>
        <!-- Modal -->
        <div class="modal fade" id="cloneSection" tabindex="-1" role="dialog" aria-labelledby="cloneSectionLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cloneSectionLabel">Clonar Sessão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <?php include(constant("cFrontComponents") . "sections-tab/modal-clonesection.php");  ?>

                </div>
            </div>
        </div>
    <?php
    }
    ?>
        <div class="container-fluid box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>
                     <?php
                    if( isset( $courses_id ) ){
                    ?>
                    <input type="hidden" id="courses_id" name="courses_id" value="<?php print( $courses_id  ) ?>">
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
                                            <label for="section_title">Título</label>
                                            <input id="section_title" type="text" class="form-control"  name="section_title" value="<?php print( isset( $data["section_title"] ) ? $data["section_title"] : "" ) ?>">
                                        </div>                    
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="display_position"> Posição </label>
                                            <input id="display_position" type="text" class="form-control"  name="display_position" value="<?php print( isset( $data["display_position"] ) ? $data["display_position"] : "" ) ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="section_status">Status </label>
                                            <select name="section_status" id="section_status" class="form-control">
                                                <?php 
                                                foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                                    printf('<option %s value="%s">%s</option>' , isset( $data["section_status"] ) && $k == $data["section_status"] ? ' selected' : '' , $v , $v ) ;
                                                }
                                                ?>                                        
                                            </select>     
                                        </div>                             
                                    </div>      
                                    <div class="col-sm-6">
                                        <?php if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){ ?>
                                        <a href="<?php print($info["get"]["done"]); ?>" class="btn btn-outline-secondary btn-sm" >Voltar</a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data["idx"] ) ? "Editar" : "Salvar" ) ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="row">
                    <div class="col-lg-3">
                        <?php include(constant("cFrontComponents") . "sections-tab/tab-positions.php");  ?>
                    </div>
                    <div class="col-lg-9">

                        <div class="modal-content">
                            <div class="modal-header label">
                                <h5 class="modal-title ">Conteúdos</h5>
                            </div>
                            <div class="modal-body" style="padding-left: 0px;padding-right: 0px;">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="lessons-tab" data-toggle="tab" href="#lessons" role="tab" aria-controls="lessons" aria-selected="true">Aulas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tests-tab" data-toggle="tab" href="#tests" role="tab" aria-controls="tests" aria-selected="false">Avaliações</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="surveys-tab" data-toggle="tab" href="#surveys" role="tab" aria-controls="surveys" aria-selected="false">Pesquisa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="forum-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">Fórum</a>
                                    </li>                            
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content"  style="padding-left:20px">
                                    <div class="tab-pane active" id="lessons" role="tabpanel" aria-labelledby="lessons-tab">
                                        <?php include(constant("cFrontComponents") . "sections-tab/tab-lessons.php");  ?>
                                    </div>
                                    <div class="tab-pane" id="tests" role="tabpanel" aria-labelledby="tests-tab">
                                        <?php include(constant("cFrontComponents") . "sections-tab/tab-tests.php");  ?>
                                    </div>
                                    <div class="tab-pane" id="surveys" role="tabpanel" aria-labelledby="surveys-tab">
                                        <?php include(constant("cFrontComponents") . "sections-tab/tab-surveys.php");  ?>
                                    </div>
                                    <div class="tab-pane" id="forum" role="tabpanel" aria-labelledby="forum-tab">
                                        <?php include(constant("cFrontComponents") . "sections-tab/tab-foruns.php");  ?>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                   


            </div>
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
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
    .modal-lg {
        max-width: 80%;
    }
    .jqte_editor, .jqte_source{ min-height: 100px !important;}
</style>