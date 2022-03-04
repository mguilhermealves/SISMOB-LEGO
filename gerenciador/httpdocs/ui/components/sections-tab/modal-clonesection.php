
<form action="<?php print( $GLOBALS["section_clone_url"]) ?>" method="post" enctype="multipart/form-data" >

        <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
        <input type="hidden" name="section_id" value="<?php print($info["idx"]) ?>" />

    <div class="modal-body">                            
        <div class="row">            
            <div class="col-lg-12">
                <label>
                    Selecione o curso de destino </label>

                    <select class="form-control" name="course_id">
                        <option value="">Selecione</option>
                        <?php  foreach(courses_controller::data4select("idx",array(" idx > 0 ", "active = 'yes'" ) , "course_title") as  $k => $v){ 
                            printf('<option value="%s"%s>%s</option>', $k , isset( $v["course_title"] ) && $v["idx"] == $k ? ' selected' : '' , $v );
                        }?>                                           
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