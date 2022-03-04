<?php
if(isset($idxedit) && $idxedit > 0 ){ 
    $dataeditquestion = questions_controller::form_modal($idxedit);       
    $url = sprintf($GLOBALS["question_url"], $idxedit);
}
else{ 
    $dataeditquestion = []; 
    $url = sprintf( $GLOBALS["newquestionsave_url"], $v["idx"] );
} 
$key_form = generate_key(15);
?>
<form action="<?php print( $url ) ?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
    <input type="hidden" id="sections_id" name="sections_id" value="<?php print($info["idx"]) ?>">
    <input type="hidden" id="tests_id" name="tests_id" value="<?php print( $tests[0]["idx"] ) ?>">
    <textarea name="action_js[0]" style="display:none"><?php print( base64_encode('$("#tests-tab").click();') )?></textarea>
    <textarea name="action_js[1]" style="display:none"><?php print( base64_encode('$("button[href=\'#collapseQuestions_' . $tests[0]["idx"] . '\']").click();') )?></textarea>
      
    <div class="modal-body">               
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="title<?php print( $key_form ) ?>">Enunciado </label>
                    <textarea name="title" id="title<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataeditquestion["title"] ) ? $dataeditquestion["title"] : "" ) ?></textarea>  
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="justification<?php print( $key_form ) ?>">Justificativa </label>
                    <textarea name="justification" id="justification<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataeditquestion["justification"] ) ? $dataeditquestion["justification"] : "" ) ?></textarea>  
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="label-modal-body" for="status<?php print( $key_form ) ?>"> Status:</label>   
                    <select name="status" id="status<?php print( $key_form ) ?>" class="form-control">
                        <option value="Rascunho" <?php print( isset( $dataeditquestion["status"] ) && $dataeditquestion["status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                        <option value="Publicado" <?php print( isset( $dataeditquestion["status"] ) && $dataeditquestion["status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                        <option value="Arquivado" <?php print( isset( $dataeditquestion["status"] ) && $dataeditquestion["status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="label-modal-body" for="display_position<?php print( $key_form ) ?>"> Posição  </label>
                    <input type="number" step="1" class="form-control" id="display_position<?php print( $key_form ) ?>" name="display_position" value="<?php print( isset( $dataeditquestion["display_position"] ) ? $dataeditquestion["display_position"] : ( isset($tests[0]["questions_attach"]) ? count( $tests[0]["questions_attach"] ) + 1 : "1" ) ) ?>">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="label-modal-body" for="type<?php print( $key_form ) ?>">Tipo </label>
                    <select <?php print( isset( $dataeditquestion["type"] )?'disabled':'')?> name="type" id="type<?php print( $key_form ) ?>" class="form-control">
                        <option value="alternativa"<?php print( isset( $dataeditquestion["type"] ) && $dataeditquestion["type"] == 'alternativa' ? ' selected="selected"' : ""  ) ?>>Alternativa</option>
                        <option value="dicotomia"<?php print( isset( $dataeditquestion["type"] ) && $dataeditquestion["type"] == 'dicotomia' ? ' selected="selected"' : ""  ) ?>>Dicotomica</option>
                        <option value="dissertativa"<?php print( isset( $dataeditquestion["type"] ) && $dataeditquestion["type"] == 'dissertativa' ? ' selected="selected"' : ""  ) ?>>Dissertativa</option>                                        
                    </select> 
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label class="label-modal-body" for="points<?php print( $key_form ) ?>">Pontos</label>
                    <input type="number" class="form-control" id="points<?php print( $key_form ) ?>" name="points" value="<?php print( isset( $dataeditquestion["points"] ) ? $dataeditquestion["points"] : "" ) ?>">                                    
                </div>                                  
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="col-lg-12 px-0 label-modal-body" >Randomizar as Alternativas?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="show_result_end" id="show_result_end<?php print( $key_form ) ?>_yes" value="yes" <?php print( isset( $dataedit["show_result_end"] ) && $dataedit["show_result_end"] == "yes" ? "checked='checked'" : "" ) ?>>
                        <label class="form-check-label" for="show_result_end<?php print( $key_form ) ?>_yes">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="show_result_end" id="show_result_end<?php print( $key_form ) ?>_no" value="no" <?php print( isset( $dataedit["show_result_end"] ) && $dataedit["show_result_end"] == "no" ? "checked='checked'" : "" ) ?>>
                        <label class="form-check-label" for="show_result_end<?php print( $key_form ) ?>_no">Não</label>
                    </div>
                </div>
            </div> 
        </div>                     
    </div>
    <div class="modal-footer">
        <div class="col-lg-12">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit"  name="btn_save" class="btn btn-primary">Salvar changes</button>
        </div>                   
    </div>
</form>
<?php $idxedit = 0; ?>