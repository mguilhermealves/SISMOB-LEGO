<?php  if( isset($idxedit) && $idxedit > 0 ){ 
    $dataeditforum = forum_controller::form_modal($idxedit);     
    
 } ?>

<form action="<?php if(isset($idxedit) && $idxedit > 0 ){ printf($GLOBALS["new_forum_url"], $idxedit); }else{ printf( $GLOBALS["newforum_url"] ); } ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"], $info["idx"] ) ?>">
<input type="hidden" id="sections_id" name="sections_id" value="<?php print( $info["idx"] ) ?>">

<div class="modal-body">                            
    <div class="row">
               
        <div class="col-sm-12">
            <div class="form-group">
                <label><i class="fa fa-pencil" aria-hidden="true"></i> Título do Tópico <span style="color: red;">*</span></label>
                <input type="text" name="title" id="" class="form-control" value="<?php print(isset($dataeditforum["title"]) ? $dataeditforum["title"] : "") ?>">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label><i class="fa fa-comments-o" aria-hidden="true"></i> Resumo</label>
                <textarea class="form-control" name="resume" id="mytextarea" rows="10" cols="10"><?php print(isset($dataeditforum["resume"]) ? $dataeditforum["resume"] : "") ?></textarea>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label><i class="fa fa-picture-o" aria-hidden="true"></i> Imagem</label>
                <input type="file" class="form-control" name="image" id="" value="<?php print(isset($dataeditforum["image"]) ? $dataeditforum["image"] : "") ?>">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="isFixed" id="" value="yes" <?php print(isset($dataeditforum["isFixed"]) && $dataeditforum["isFixed"] == "yes" ? "checked" : "") ?>>
                    <i class="fa fa-exclamation" aria-hidden="true"></i> Definir tópico como Fixo
                </label>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="isPrivate" id="" value="yes" <?php print(isset($dataeditforum["isPrivate"]) && $dataeditforum["isPrivate"] == "yes" ? "checked" : "") ?>>
                    <i class="fa fa-eye-slash" aria-hidden="true"></i> Tópico privado
                </label>
            </div>
        </div>
    </div>                            
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>
</form>

<?php $idxedit = 0; ?>