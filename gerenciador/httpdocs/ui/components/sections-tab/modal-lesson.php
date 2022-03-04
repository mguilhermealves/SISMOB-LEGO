<?php 
if( isset($idxedit) && $idxedit > 0 ){ 
    $dataedit = lessons_controller::form_modal($idxedit);        
}
$key_form = generate_key(15); 
?>
<form action="<?php if(isset($idxedit) && $idxedit > 0 ){ printf($GLOBALS["lesson_url"], $idxedit); }else{ printf( $GLOBALS["newlesson_url"] ); } ?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"], $data["idx"] ) ?>">
    <input type="hidden" id="sections_id" name="sections_id" value="<?php print( $data["idx"] ) ?>">
    <div class="modal-body">                            
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_title<?php print( $key_form ) ?>"> Título da aula:</label>
                    <input required type="text" class="form-control" id="lessons_title<?php print( $key_form ) ?>" name="lessons_title" value="<?php print( isset( $dataedit["lessons_title"] ) ? $dataedit["lessons_title"] : "" ) ?>">           
                </div>         
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_status<?php print( $key_form ) ?>">Status da aula:</label>
                    <select required name="lessons_status" id="lessons_status<?php print( $key_form ) ?>" class="form-control">
                        <option value="" <?php print(!isset($dataedit["lessons_status"]) || $dataedit["lessons_status"] == "" ? " selected" : "") ?> placeholder="Selecione o Status do material">Selecione o Status do material</option>
                        <?php 
                        foreach( $GLOBALS["display_status_list"] as $k => $v ){
                            printf('<option %s value="%s">%s</option>' , isset($dataedit["lessons_status"]) && $k == $dataedit["lessons_status"] ? ' selected' : '' , $k , $v ) ;
                        }
                        ?>                                         
                    </select>                                  
                </div>                              
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_type<?php print( $key_form ) ?>">Tipo do material:  </label>
                    <select required class="form-control " id="lessons_type<?php print( $key_form ) ?>" name="lessons_type">
                        <option value="" <?php print(!isset($dataedit["lessons_type"]) || $dataedit["lessons_type"] == "" ? " selected" : "") ?> placeholder="Selecione o Tipo do material">Selecione o Tipo do material</option>
                        <?php 
                        foreach( $GLOBALS["type_materials_list"] as $k => $v ){
                            printf('<option %s value="%s">%s</option>' , isset($dataedit["lessons_type"]) && $k == $dataedit["lessons_type"] ? ' selected' : '' , $k , $v ) ;
                        }
                        ?>
                    </select>                           
                </div>                              
            </div> 
            <div class="col-lg-3">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_type<?php print( $key_form ) ?>">Pre-requisito:  </label>
                    <input type="text" id="lessons_prerequisite<?php print( $key_form ) ?>" class="form-control" name="lessons_prerequisite" value="<?php print( isset( $dataedit["lessons_prerequisite"] ) ? $dataedit["lessons_prerequisite"] : "" ) ?>">                       
                </div>                              
            </div>      
            <div class="col-lg-12" id="container_lessons_description<?php print( $key_form ) ?>">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_description<?php print( $key_form ) ?>">Conteúdo da Aula: </label>
                    <textarea name="lessons_description" id="lessons_description<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataedit["lessons_description"] ) ? $dataedit["lessons_description"] : "" ) ?></textarea>                           
                </div>                              
            </div>
            <div class="col-lg-12" id="container_lessons_content_url<?php print( $key_form ) ?>">
                <div class="form-group">
                    <label class="label-modal-body" for="lessons_content_file<?php print( $key_form ) ?>">Conteúdo URL  </label>
                    <input type="file" id="lessons_content_file<?php print( $key_form ) ?>" class="form-control" name="lessons_content_file">
                </div> 
                <div class="form-group">
                    <?php 
                    if( !empty( $dataedit["lessons_content_url"] ) && file_exists( constant("cRootServer") . $dataedit["lessons_content_url"] ) ){ 
                        print('<a href="/' . $dataedit["lessons_content_url"] . '" target="_blank">[ LINK DO ARQUIVO ]</a>') ;
                    }
                    ?>
                </div>                              
            </div>  
        </div>             
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit"  name="btn_save" class="btn btn-primary">Salvar</button>
    </div>
</form>

<?php $idxedit = 0; ?>