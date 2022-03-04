<form action="<?php print( $GLOBALS["newsectionsave_url"] ); ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["sections_by_course_url"], $data["idx"] ) ?>">
<input type="hidden" id="courses_id" name="courses_id" value="<?php print( $data["idx"]  ) ?>">
<div class="modal-body">                            
    <div class="row">
        <div class="col-lg-4">
            <label>
            Título</label>
                <input required type="text" class="form-control"  name="section_title" value="">
            
        </div>

        <div class="col-lg-4">
            <label>
                Posição </label>
                <input required type="int" class="form-control"  name="display_position" value="1">
            
        </div>
        <div class="col-lg-4">
            <label>
                Status </label>
                <select required name="section_status" id="section_status" class="form-control">
                    <option value="Rascunho">Rascunho</option>
                    <option value="Publicado">Publicado</option>                                           
                    <option value="Arquivado">Arquivado</option>                                           
                </select>                                  
        </div>
        
    </div>                                                                    
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>
</form>

<?php $idxedit = 0; ?>