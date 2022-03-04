<!-- Link do Curso -->
<div class="card mt-5 d-none" id="course_link">
    <div class="card-header label_div">
        Link / Página
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-sm-12">
             <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_link" name="post[error][courseLink]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
             </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>URL:</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[courseLink][link]" id="courseLink" value="<?php print( isset( $data["post"]["CourseLinkAddress"]["linkURL"] ) ? $data["post"]["CourseLinkAddress"]["linkURL"] : "" ) ?>" placeholder="Insira aqui o link">
                </div>
            </div>
            <?php if(!isset($data['edit']) || !$data['edit']){ ?>
            <div class="col-sm-12 mt-5 text-center">
                <button type="button" id="save_link" onClick="display_labels(<?php print($show_course_link); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
            </div>
            <?php } ?>

            <div class="col-sm-12 mt-2 text-center d-none" id="msn_error_link">
                <p>
                    *É obrigatório o preenchimento do Link.
                </p>
            </div>

            <div class="modal fade" id="modal_cep" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Informação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>O Link preenchido não foi encontrado...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($data['edit']){ ?>
<div class="row row-no-padding <?php print((isset($data['edit'] ) ? ($data['edit'] ) ? '' : 'd-none': 'd-none')); ?>" id="course_link_correct">
   <div class="col-md-1"></div>
   <div class="col-md-10">
      <div class="card mt-5">
         <div class="card-header label_div">
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-sm-12">
                  <label>Informações estão corretas?</label>
                  <br>
                  <div class="middle">
                     <span style="font-size: 1rem;" class="recurring-course-switch">Não</span>
                     <div class="switch-gender">
                        <input type="radio" class="switch-input" name="post[CourseLink][correct]" value="Não" id="course_link_correct_no">
                        <label for="course_link_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[CourseLink][correct]" value="Sim" id="course_link_correct_yes">
                        <label for="course_link_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
                        <span class="switch-selection"></span>
                     </div>
                     <span style="font-size: 1rem;" class="single-course-switch">Sim</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-1"></div>
</div>
<?php } ?>
<div id="message_error_couse_link"></div>