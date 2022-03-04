<?php  if( isset($data["idx"]) && $data["idx"] > 0 ){ 
    $sections_list = sections_controller::select_sections();    
 } ?>

<div class="modal-header">
    <h5 class="modal-title" id="novoCadastroLabel">Escolha a Seção</h5>
    <div class="search">
		<input type="text" placeholder="Buscar Seção" data-search />
	</div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="<?php  printf( $GLOBALS["section_course_url"] );  ?>" method="post" enctype="multipart/form-data" >

<input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["course_url"], $info["idx"] ) ?>">
<input type="hidden" id="courses_id" name="courses_id" value="<?php print( $info["idx"] ) ?>">

<div class="modal-body">                            
    <div class="row">            
     
        <?php  foreach(sections_controller::data4select("idx",array(" idx > 0 " ) , "section_title") as  $k => $v){ ?>
            <div class="col-lg-3 check-select" data-filter-item data-filter-name="<?php print($v) ?>">
                <div class="input-container">
                    <input id="<?php print($k) ?>" <?php print( isset( $data["sections_attach"][0] ) && in_array( $k , array_column( $data["sections_attach"] , "idx" ) ) ? 'checked' : '' ) ?> type="checkbox" name="sections_id[]"  value="<?php print($k) ?>">
                    <label for="<?php print($k) ?>"><span class="align-middle"><?php print($v) ?></span></label>
                </div>                        
            </div>
        <?php } ?>
    </div>                            
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>
</form>

<?php $idxedit = 0; ?>

