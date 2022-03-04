<?php 
if( isset($idxedit) && $idxedit > 0 ){ 
    $dataediteditsurvey = surveys_controller::form_modal($idxedit);        
    $url = sprintf($GLOBALS["survey_url"], $idxedit);       
}
else{ 
    $url = $GLOBALS["newsurvey_url"] ;
} 
$key_form = generate_key(15);
 ?>
 <form action="<?php print( $url ) ?>" method="post" enctype="multipart/form-data" >
    <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"], $info["idx"] ) ?>">
    <input type="hidden" id="sections_id" name="sections_id" value="<?php print( $info["idx"] ) ?>">
    <textarea name="action_js[0]" style="display:none"><?php print( base64_encode('$("#surveys-tab").click();') )?></textarea>
    <div class="modal-body">               
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="title<?php print( $key_form ) ?>">Título </label>
                    <input type="text" name="title" id="title<?php print( $key_form ) ?>" class="form-control" value="<?php print( isset( $dataeditquestion["title"] ) ? $dataeditquestion["title"] : "" ) ?>">
                </div>
                <div class="form-group">
                    <label class="label-modal-body" for="status<?php print( $key_form ) ?>">Status </label>
                    <select name="status" id="status<?php print( $key_form ) ?>" class="form-control">
                        <option value="Rascunho" <?php print( isset( $dataediteditsurvey["status"] ) && $dataediteditsurvey["status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                        <option value="Publicado" <?php print( isset( $dataediteditsurvey["status"] ) && $dataediteditsurvey["status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                        <option value="Arquivado" <?php print( isset( $dataediteditsurvey["status"] ) && $dataediteditsurvey["status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                    </select>          
                </div>
                <label class="label-modal-body" for="description<?php print( $key_form ) ?>">Questões em ordem randomica? </label>  
                <div class="form-group"> 
                    <label> <input type="radio" class="form-control" name="surveyquestions_random_order" value="yes" <?php print( isset( $dataediteditsurvey["surveyquestions_random_order"] ) && $dataediteditsurvey["surveyquestions_random_order"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" class="form-control" name="surveyquestions_random_order" value="no" <?php print( isset( $dataediteditsurvey["surveyquestions_random_order"] ) && $dataediteditsurvey["surveyquestions_random_order"] == "no" ? "checked='checked'" : "" ) ?>> Não </label>  
                </div>
                <div class="form-group">
                    <label class="label-modal-body" for="qtd_attempts<?php print( $key_form ) ?>">Quantidade de Tentativas </label>
                    <input type="text" class="form-control" idate="qtd_attempts<?php print( $key_form ) ?>"  name="qtd_attempts" value="<?php print( isset( $dataediteditsurvey["qtd_attempts"] ) ? $dataediteditsurvey["qtd_attempts"] : "" ) ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="description<?php print( $key_form ) ?>">Descrição </label>
                    <textarea name="description" id="description<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataediteditsurvey["description"] ) ? $dataediteditsurvey["description"] : "" ) ?></textarea>     
                </div>
            </div>
        </div> 
    </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="btn_save" class="btn btn-primary">Salvar</button>
    </div>
</form>

<?php $idxedit = 0; ?>