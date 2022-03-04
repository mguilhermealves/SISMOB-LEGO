<?php
if(isset($idxedit) && $idxedit > 0 ){ 
    $dataeditsurveyalternative = surveyalternatives_controller::form_modal($idxedit);       
 } ?>

<form action="<?php if(isset($idxedit) && $idxedit > 0){ 
    printf($GLOBALS["surveyalternative_url"], $idxedit); }else{
         printf( $GLOBALS["newsurveyalternativesave_url"], $v["idx"] ); } ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
<input type="hidden" id="sections_id" name="sections_id" value="<?php print($info["idx"]) ?>">
<input type="hidden" id="tests_id" name="tests_id" value="<?php print( $tests[0]["idx"] ) ?>">
<input type="hidden" id="surveyquestions_id" name="surveyquestions_id" value="<?php print( $surveyquestions[0]["idx"] ) ?>">

    <div class="modal-body">                            
        <div class="row">
            <div class="col-lg-6">
                <label>
                    Id Externo </label>
                    <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $dataeditsurveyalternative["external_id"] ) ? $dataeditsurveyalternative["external_id"] : "" ) ?>">                                   
            </div> 
            <div class="col-lg-6">
                <label>
                    Posição  </label>
                    <input type="text" class="form-control" name="display_position" value="<?php print( isset( $dataeditsurveyalternative["display_position"] ) ? $dataeditsurveyalternative["display_position"] : "" ) ?>">
                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                    <label>
                        Titulo </label>
                        <textarea name="title" class="form-control editor"><?php print( isset( $dataeditsurveyalternative["title"] ) ? $dataeditsurveyalternative["title"] : "" ) ?></textarea>  
                </div>                                   
        </div>


    </div>



<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>
</form>

<?php $idxedit = 0; ?>