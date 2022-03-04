<?php
if(isset($idxedit) && $idxedit > 0 ){ 
    $dataeditsurveyquestion = surveyquestions_controller::form_modal($idxedit);       
 } ?>

<form action="<?php if(isset($idxedit) && $idxedit > 0){ 
    printf($GLOBALS["surveyquestion_url"], $idxedit); }else{
         printf( $GLOBALS["newsurveyquestionsave_url"], $v["idx"] ); } ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
<input type="hidden" id="sections_id" name="sections_id" value="<?php print($info["idx"]) ?>">
<input type="hidden" id="surveys_id" name="surveys_id" value="<?php print( $surveys[0]["idx"] ) ?>">


<div class="modal-body">                            
    <div class="row">
        <div class="col-lg-4">
                <label>
                Status </label>
                <select name="status" id="status" class="form-control">
                    <option value="Rascunho" <?php print( isset( $dataeditsurveyquestion["status"] ) && $dataeditsurveyquestion["status"] == "Rascunho" ? "selected='selected'" : "" ) ?>>Rascunho</option>
                    <option value="Publicado" <?php print( isset( $dataeditsurveyquestion["status"] ) && $dataeditsurveyquestion["status"] == "Publicado" ? "selected='selected'" : "" ) ?>>Publicado</option>                                            
                    <option value="Arquivado" <?php print( isset( $dataeditsurveyquestion["status"] ) && $dataeditsurveyquestion["status"] == "Arquivado" ?"selected='selected'" : "" ) ?>>Arquivado</option>                                           
                </select>       
        </div>
        <div class="col-lg-4">
            <label>
                Id Externo </label>
                <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $dataeditsurveyquestion["external_id"] ) ? $dataeditsurveyquestion["external_id"] : "" ) ?>">                                   
        </div> 
        <div class="col-lg-4">
            <label>
                Posição  </label>
                <input type="text" class="form-control" name="display_position" value="<?php print( isset( $dataeditsurveyquestion["display_position"] ) ? $dataeditsurveyquestion["display_position"] : "" ) ?>">
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
                <label>
                    Titulo </label>
                    <textarea name="title" class="form-control editor"><?php print( isset( $dataeditsurveyquestion["title"] ) ? $dataeditsurveyquestion["title"] : "" ) ?></textarea>  
            </div>
            <div class="col-lg-6">
                <label>
                    Justificativa </label>
                    <textarea name="justification" class="form-control editor"><?php print( isset( $dataeditsurveyquestion["justification"] ) ? $dataeditsurveyquestion["justification"] : "" ) ?></textarea>   
            </div>
    </div>

    <div class="row">                               
            <div class="col-lg-6">
                <label>
                Tipo </label>
                    <select name="type" id="type" class="form-control">
                        <option value="alternativa" <?php print( isset( $dataeditsurveyquestion["type"] ) && $dataeditsurveyquestion["type"] == "alternativa" ? "selected='selected'" : "" ) ?>>Alternativa</option>
                        <option value="dicotomia" <?php print( isset( $dataeditsurveyquestion["type"] ) && $dataeditsurveyquestion["type"] == "dicotomia" ? "selected='selected'" : "" ) ?>>Dicotomia</option>                                            
                        <option value="verdeiro_falso" <?php print( isset( $dataeditsurveyquestion["type"] ) && $dataeditsurveyquestion["type"] == "verdeiro_falso" ?"selected='selected'" : "" ) ?>>Verdadeiro/Falso</option>                                           
                        <option value="texto" <?php print( isset( $dataeditsurveyquestion["type"] ) && $dataeditsurveyquestion["type"] == "texto" ?"selected='selected'" : "" ) ?>>Texto</option>                                           
                    </select> 
            </div>
            <div class="col-lg-6">
                <label>
                    Alternativas em ordem randomica? </label><br/>
                    <label> <input type="radio" class="form-control" name="show_random_alternatives" value="yes" <?php print( isset( $dataeditsurveyquestion["show_random_alternatives"] ) && $dataeditsurveyquestion["show_random_alternatives"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label> <input type="radio" class="form-control" name="show_random_alternatives" value="no" <?php print( isset( $dataeditsurveyquestion["show_random_alternatives"] ) && $dataeditsurveyquestion["show_random_alternatives"] == "no" ? "checked='checked'" : "" ) ?>> Não </label>
            </div>
    </div>

</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>
</form>

<?php $idxedit = 0; ?>