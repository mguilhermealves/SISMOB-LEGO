 <!-- Endereço do Curso -->
 <div class="card mt-5 d-none" id="course_address">
     <div class="card-header label_div">
         Endereço do Curso
     </div>

     <div class="card-body">
         <div class="row">
             <div class="col-md-12">
             <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_course_address" name="post[error][CourseAddress]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
             </div>
             <div class="col-sm-6">
                 <div class="form-group">
                     <label>Local</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseLocal]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseLocal"] ) ? $data["post"]["CourseAddress"]["courseLocal"] : "" ) ?>" id="courseLocal" placeholder="Exemplo: Hotel Hilton Morumbi">
                 </div>
             </div>

             <div class="col-sm-2">
                 <div class="form-group">
                     <label>CEP</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control cep-mask" name="post[CourseAddress][courseCEP]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseCEP"] ) ? $data["post"]["CourseAddress"]["courseCEP"] : "" ) ?>" id="courseCEP" placeholder="00000-000">
                 </div>
             </div>

             <div class="col-sm-4">
                 <div class="form-group">
                     <label>Endereço</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseAddress]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseAddress"] ) ? $data["post"]["CourseAddress"]["courseAddress"] : "" ) ?>" id="courseAddress" placeholder="Rua, Avenida, Estrada...">
                 </div>
             </div>

             <div class="col-sm-2">
                 <div class="form-group">
                     <label>Número</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseAddressNumber]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseAddressNumber"] ) ? $data["post"]["CourseAddress"]["courseAddressNumber"] : "" ) ?>" id="courseAddressNumber" placeholder="303">
                 </div>
             </div>

             <div class="col-sm-3">
                 <div class="form-group">
                     <label>Complemento</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseComplement]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseComplement"] ) ? $data["post"]["CourseAddress"]["courseComplement"] : "" ) ?>" id="courseComplement" placeholder="Casa, Apto...">
                 </div>
             </div>

             <div class="col-sm-3">
                 <div class="form-group">
                     <label>Bairro</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseDistrict]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseDistrict"] ) ? $data["post"]["CourseAddress"]["courseDistrict"] : "" ) ?>" id="courseDistrict" placeholder="Casa Verde">
                 </div>
             </div>

             <div class="col-sm-3">
                 <div class="form-group">
                     <label>Cidade</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseCity]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseCity"] ) ? $data["post"]["CourseAddress"]["courseCity"] : "" ) ?>" id="courseCity" placeholder="São Paulo">
                 </div>
             </div>

             <div class="col-sm-1">
                 <div class="form-group">
                     <label>Estado</label>
                     <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[CourseAddress][courseState]" value="<?php print( isset( $data["post"]["CourseAddress"]["courseState"] ) ? $data["post"]["CourseAddress"]["courseState"] : "" ) ?>" id="courseState" placeholder="SP">
                 </div>
             </div>
             <?php if(!isset($data['edit']) || !$data['edit']){ ?>
             <div class="col-sm-12 mt-5 text-center">
                <button type="button" id="save_courses_address" onClick="display_labels(<?php print($show_address); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
            </div>
            <?php } ?>

             <div class="col-sm-12 mt-2 text-center d-none" id="msn_error">
                 <p>
                     *Todos os campos devem ser preenchidos.
                 </p>
             </div>

             <!-- Modal erro -->
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
                             <p>O CEP preenchido não foi encontrado...</p>
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
<div class="row row-no-padding d-none" id="course_address_correct">
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
                        <input type="radio" class="switch-input" name="post[CourseAddress][correct]" value="Não" id="address_correct_no">
                        <label for="address_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[CourseAddress][correct]" value="Sim" id="address_correct_yes">
                        <label for="address_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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
 <div id="message_error_course_address"></div>