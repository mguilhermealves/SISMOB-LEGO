<?php 
if( isset($idxedit) && $idxedit > 0 ){ 
    $dataedit = tests_controller::form_modal($idxedit);        
 } 
 ?>

<form action="<?php if(isset($idxedit) && $idxedit > 0){ printf($GLOBALS["test_url"], $idxedit); }else{ printf( $GLOBALS["newtest_url"] ); } ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"], $data["idx"] ) ?>">
<input type="hidden" id="sections_id" name="sections_id" value="<?php print( $data["idx"] ) ?>">
<textarea name="action_js[0]" style="display:none"><?php print( base64_encode('$("#tests-tab").click();') )?></textarea>

<div class="modal-body">                            
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="label-modal-body" for="title<?php print( $key_form ) ?>">Título</label>
                <input type="text" class="form-control" id="title<?php print( $key_form ) ?>" name="title" value="<?php print( isset( $dataedit["title"] ) ? $dataedit["title"] : "" ) ?>">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label class="label-modal-body" for="status<?php print( $key_form ) ?>">Status</label>
                <select name="status" id="status<?php print( $key_form ) ?>" class="form-control">
                    <option value="Rascunho" <?php print( isset( $dataedit["status"] ) && $dataedit["status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                    <option value="Publicado" <?php print( isset( $dataedit["status"] ) && $dataedit["status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                    <option value="Arquivado" <?php print( isset( $dataedit["status"] ) && $dataedit["status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                </select>  
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label class="label-modal-body" for="qtd_attempts<?php print( $key_form ) ?>">Tentativas</label>
                <input type="number" class="form-control" id="qtd_attempts<?php print( $key_form ) ?>" name="qtd_attempts" value="<?php print( isset( $dataedit["qtd_attempts"] ) ? $dataedit["qtd_attempts"] : "" ) ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="label-modal-body" for="parent<?php print( $key_form ) ?>">Pre-requisito</label>
                <input type="text" class="form-control" id="parent<?php print( $key_form ) ?>" name="parent" value="<?php print( isset( $dataedit["parent"] ) ? $dataedit["parent"] : "" ) ?>">
            </div>                                
        </div> 


        <div class="col-lg-8">
            <div class="form-group">
                <label class="label-modal-body" for="description<?php print( $key_form ) ?>">
                Descrição </label>
                <textarea name="description" id="description<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataedit["description"] ) ? $dataedit["description"] : "" ) ?></textarea>
            </div>
        </div>     
        <div class="col-lg-4">  
            <div class="form-group">
                <label class="label-modal-body" for="score_value<?php print( $key_form ) ?>"> Nota de Corte</label>
                <input type="text" class="form-control" id="score_value<?php print( $key_form ) ?>" name="score_value" value="<?php print( isset( $dataedit["score_value"] ) ? $dataedit["score_value"] : "" ) ?>">
            </div> 
            <div class="form-group">
                <label class="label-modal-body" for="score_type<?php print( $key_form ) ?>">Calculo da Nota de Corte </label>
                <select name="score_type" for="score_type<?php print( $key_form ) ?>" class="form-control">
                    <option value="percent" <?php print( isset( $dataedit["score_type"] ) && $dataedit["score_type"] == "percent" ? "selected='selected'" : "" ) ?>>Porcentagem</option>
                    <option value="amount" <?php print( isset( $dataedit["score_type"] ) && $dataedit["score_type"] == "amount" ? "selected='selected'" : "" ) ?>>Montante</option>                           
                </select>
            </div>   
        </div> 
        
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-lg-12 px-0 label-modal-body" >Mostrar Correta no final?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="show_correct_answers_end" id="show_correct_answers_end<?php print( $key_form ) ?>_yes" value="yes" <?php print( isset( $dataedit["show_correct_answers_end"] ) && $dataedit["show_correct_answers_end"] == "yes" ? "checked='checked'" : "" ) ?>>
                    <label class="form-check-label" for="show_correct_answers_end<?php print( $key_form ) ?>_yes">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="show_correct_answers_end" id="show_correct_answers_end<?php print( $key_form ) ?>_no" value="no" <?php print( isset( $dataedit["show_correct_answers_end"] ) && $dataedit["show_correct_answers_end"] == "no" ? "checked='checked'" : "" ) ?>>
                    <label class="form-check-label" for="show_correct_answers_end<?php print( $key_form ) ?>_no">Não</label>
                </div>
            </div>
        </div> 
        <div class="col-lg-4">
           <div class="form-group">
                <label class="col-lg-12 px-0 label-modal-body" >Mostrar Resultado no final?</label>
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
        <div class="col-lg-4">
            <div class="form-group">
                <label class="col-lg-12 px-0 label-modal-body" > Questões em ordem randomica?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questions_random_order" id="questions_random_order<?php print( $key_form ) ?>_yes" value="yes" <?php print( isset( $dataedit["questions_random_order"] ) && $dataedit["questions_random_order"] == "yes" ? "checked='checked'" : "" ) ?>>
                    <label class="form-check-label" for="questions_random_order<?php print( $key_form ) ?>_yes">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="questions_random_order" id="questions_random_order<?php print( $key_form ) ?>_no" value="no" <?php print( isset( $dataedit["questions_random_order"] ) && $dataedit["questions_random_order"] == "no" ? "checked='checked'" : "" ) ?>>
                    <label class="form-check-label" for="questions_random_order<?php print( $key_form ) ?>_no">Não</label>
                </div>
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