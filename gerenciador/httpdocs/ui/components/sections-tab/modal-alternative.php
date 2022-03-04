<?php
if(isset($idxedit) && $idxedit > 0 ){ 
    $dataeditalternative = alternatives_controller::form_modal($idxedit);       
 }else{ $dataeditalternative = []; } ?>

<form action="<?php if(isset($idxedit) && $idxedit > 0){ 
    printf($GLOBALS["alternative_url"], $idxedit); }else{
         printf( $GLOBALS["newalternativesave_url"], $v["idx"] ); } ?>" method="post" enctype="multipart/form-data" >

        <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
        <input type="hidden" id="sections_id" name="sections_id" value="<?php print($info["idx"]) ?>">
        <input type="hidden" id="tests_id" name="tests_id" value="<?php print( $tests[0]["idx"] ) ?>">
        <input type="hidden" id="questions_id" name="questions_id" value="<?php print( $questions[0]["idx"] ) ?>">
        <textarea name="action_js[0]" style="display:none"><?php print( base64_encode('$("#tests-tab").click();') )?></textarea>
        <textarea name="action_js[1]" style="display:none"><?php print( base64_encode('$("button[href=\'#collapseQuestions_' . $tests[0]["idx"] . '\']").click();') )?></textarea>
        <textarea name="action_js[2]" style="display:none"><?php print( base64_encode('$("button[href=\'#collapseAlternatives_' . $questions[0]["idx"] . '\']").click();') )?></textarea>
        <?php if(!isset($idxedit) || $idxedit == 0 ){ ?> 
        <textarea name="action_js[3]" style="display:none"><?php print( base64_encode('$("button[data-target=\'#novoCadastroalternatives_' . $questions[0]["idx"] . '\']").click();') )?></textarea>
        <?php } ?> 
    <div class="modal-body">                            
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="display_position<?php print( $key_form ) ?>"> Posição:</label>
                    <input required type="number" id="display_position<?php print( $key_form ) ?>" class="form-control" id="display_position<?php print( $key_form ) ?>" name="display_position" value="<?php print( isset( $dataeditalternative["display_position"] ) ? $dataeditalternative["display_position"] : ( isset($questions[0]["alternatives_attach"]) ? count( $questions[0]["alternatives_attach"] ) + 1 : "1" ) ) ?>">           
                </div> 
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="label-modal-body" for="display_position<?php print( $key_form ) ?>"> Alternativa correta?:</label>
                    
                    <br/>
                    <label> <input type="radio" class="form-control" name="is_correct" value="yes" <?php print( isset( $dataeditalternative["is_correct"] ) && $dataeditalternative["is_correct"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" class="form-control" name="is_correct" value="no" <?php print( isset( $dataeditalternative["is_correct"] ) && $dataeditalternative["is_correct"] == "no" ? "checked='checked'" : "" ) ?>> Não </label> 
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="label-modal-body" for="title<?php print( $key_form ) ?>"> Texto da Alternativa:</label>
                    <textarea name="title" id="title<?php print( $key_form ) ?>" class="form-control editor"><?php print( isset( $dataeditalternative["title"] ) ? $dataeditalternative["title"] : "" ) ?></textarea>  
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