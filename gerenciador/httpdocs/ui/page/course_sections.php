<h3 class="box-title">
    <?php print( $form["title"] ) ?>
</h3>


<form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
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
       <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="course_title">Título</label>
                        <input id="course_title" type="text" class="form-control"  name="course_title" value="<?php print( isset( $data["course_title"] ) ? $data["course_title"] : "" ) ?>">
                    </div>                    
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="course_sub_title">Sub-Título  </label>
                        <input type="text" id="course_sub_title" class="form-control" name="course_sub_title" value="<?php print( isset( $data["course_sub_title"] ) ? $data["course_sub_title"] : "" ) ?>">
                    </div>              
                </div>  
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="course_status">Status </label>
                        <select name="course_status" id="course_status" class="form-control">
                            <option value="Rascunho" <?php print( isset( $data["course_status"] ) && $data["course_status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                            <option value="Publicado" <?php print( isset( $data["course_status"] ) && $data["course_status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                            <option value="Arquivado" <?php print( isset( $data["course_status"] ) && $data["course_status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                        </select>     
                    </div>                             
                </div>    
                <div class="col-lg-6">                    
                    <div class="form-group">
                        <label for="course_resume">Resumo </label>
                        <textarea  id="course_resume" name="course_resume" class="form-control" value="<?php print( isset( $data["course_resume"] ) ? $data["course_resume"] : "" ) ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="display_position"> Posição </label>
                        <input id="display_position" type="text" class="form-control"  name="display_position" value="<?php print( isset( $data["display_position"] ) ? $data["display_position"] : "" ) ?>">
                    </div>
                    <div class="form-group">
                        <label for="course_duration"> Duração </label>
                        <input id="course_duration" type="text" class="form-control"  name="course_duration" value="<?php print( isset( $data["course_duration"] ) ? $data["course_duration"] : "" ) ?>">
                    </div>
                    <div class="form-group">
                        <label for="credits_value">Créditos Valor </label>
                        <input id="credits_value" type="text" class="form-control"  name="credits_value" value="<?php print( isset( $data["credits_value"] ) ? $data["credits_value"] : "" ) ?>">   
                    </div> 
                    <div class="form-group">
                        <label for="credits_text">Créditos Texto </label>  
                        <input id="credits_text" type="text" class="form-control"  name="credits_text" value="<?php print( isset( $data["credits_text"] ) ? $data["credits_text"] : "" ) ?>">
                    </div>  
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="course_description"> Curso Descrição </label>
                        <textarea id="course_description" name="course_description" class="form-control editor" value="<?php print( isset( $data["course_description"] ) ? $data["course_description"] : "" ) ?>"></textarea>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>
                        Texto da Imagem </label>
                        <input type="text" class="form-control"  name="course_img_text" value="<?php print( isset( $data["course_img_text"] ) ? $data["course_img_text"] : "" ) ?>">                                   
                </div>
                <div class="col-lg-3">
                    <label>
                        Instrutor </label>
                        
                    <select class="form-control" name="course_instructor" name="course_instructor">
                        <option value=""<?php print( !isset( $data["course_instructor"] ) ? ' selected': '' )?>>-- Selecione --</option>
                        <?php
                            foreach( $users_lists as $k => $v ){
                                printf('<option value="%s"%s>%s</option>', $k , isset( $data["course_instructor"] ) && $data["course_instructor"] == $k ? ' selected' : '' , $v );
                            }
                        ?>
                    </select>                                                                                          
                </div>          
                <div class="col-lg-3">
                    <label>
                        Id Externo </label>
                        <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $data["external_id"] ) ? $data["external_id"] : "" ) ?>">                                   
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="thumbnail">Imagem </label>
                        <input type="file" id="thumbnail" name="thumbnail"  />                        
                    </div>
                </div>
            </div>
           </div>
       </div>
    </div>

    <div class="modal-content">
       <div class="modal-header label">
          <h5 class="modal-title ">Trilhas Vinculadas</h5>
       </div>
       <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <?php 
                    foreach( $trilhas as $k => $v ){                                                  
                        print( strtr( '<div class="form-check form-check-inline"><input class="form-check-input" id="trails_id_#ID#" name="trails_id[]" type="checkbox" value="#ID#"#OPTION#><label class="form-check-label" for="trails_id_#ID#">#TEXT#</label></div>', array("#ID#" => $k, "#OPTION#" => isset( $data["trails_attach"][0] ) && in_array( $k , array_column( $data["trails_attach"] , "idx" ) ) ? ' checked' : '' , "#TEXT#" => $v ) ) );                                                  
                    }
                ?>     
            </div>
          </div>
       </div>
    </div>
    <div class="modal-content">
       <div class="modal-header label">
          <h5 class="modal-title ">Dados Publicaos</h5>
       </div>
       <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="course_public_title"> Título </label>
                        <input id="course_public_title" type="text" class="form-control"  name="course_public_title" value="<?php print( isset( $data["course_public_title"] ) ? $data["course_public_title"] : "" ) ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="course_public_description">  Descrição </label>
                        <textarea id="course_public_description"  class="form-control editor" name="course_public_description" value="<?php print( isset( $data["course_public_description"] ) ? $data["course_public_description"] : "" ) ?>"></textarea>
                    </div>
                </div>
            </div>
          </div>
       </div>
    </div>
    <div class="row">

        <div class="col-sm-6">
            <a href="<?php print( $info["get"]["done"] ) ?>" class="round hollow button secondary" >Voltar</a>
        </div>
        <div class="col-sm-6 text-right">
            <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data[0]["idx"] ) ? "Editar" : "Salvar" ) ?></button>
        </div>
    </div>
</form>



<?php if(isset($data["idx"])){ ?>

<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Seções</span>
                </h3>
            </div>

            <!-- <a class="btn button bg-gray round" title="Incluir" href="<?php printf( $GLOBALS["newsection_url"], $data["idx"] ) ?>"><i class="fontello-plus"></i>Nova Seção</a> -->


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoCadastroSection">
                 Nova Seção
            </button>
                        
            <!-- Modal -->
            <div class="modal fade" id="novoCadastroSection" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="novoCadastroLabel">Cadastrar Seção</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        <?php include(constant("cFrontComponents") . "sections-tab/modal-section.php");  ?>

                    </div>
                </div>
            </div>
                        
            <!-- Modal -->
            
            <!--<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#novoCadastrolesson">
               Gerenciar Seções
            </button>
             <div class="modal fade" id="novoCadastrolesson" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <?php include(constant("cFrontComponents") . "courses-tab/modal-select-sections.php");  ?>
                        

                    </div>
                </div>
            </div> -->

        </div>



         <?php if(isset($data["sections_attach"])){

               $sections = isset($data["sections_attach"]) ? $data["sections_attach"] : []; ?>
               

                <div class="box solaris-head">
                    <div class="box-body">
                        <div id="solaris-head-data">
                            <table class="table large-12 columns">
                                <thead>
                                    <tr>
                                        <th>Título da Seção</th>
                                    
                                        <th width="20%">Ação</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach( $sections as $v){ ?>
                                    <tr>
                                        <td><?php print( $v["section_title"] ) ?></td>                               
                                        <td><a class="btn button btn-info" href="<?php printf( $GLOBALS["section_url"] , $v["idx"] ) ?>">[ editar ]</a> 
                                        <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $GLOBALS["section_url"] , $v["idx"] ) ?>">[ excluir ]</a>                                        
                                    </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            <table>
                        </div>
                    </div>
                </div>

        <?php } ?>


     </div>
</div>

<?php } ?>




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