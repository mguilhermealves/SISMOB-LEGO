<!-- Dados do professor/palestrante -->
<div class="card mt-5 d-none" id="information_panelist">
    <div class="card-header label_div">
        Dados do professor/palestrante
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_information_panelist" name="post[error][ProfessorData]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Nome:</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[ProfessorData][professorName]" id="paneListName" value="<?php print( isset( $data["post"]["ProfessorData"]["professorName"] ) ? $data["post"]["ProfessorData"]["professorName"] : "" ) ?>" placeholder="Nome do instrutor/palestrante">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>CPF</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[ProfessorData][professorCPF]" id="paneListCpf"  value="<?php print( isset( $data["post"]["ProfessorData"]["professorCPF"] ) ? $data["post"]["ProfessorData"]["professorCPF"] : "" ) ?>" placeholder="CPF do instrutor/palestrante">
                </div>
            </div>

            <div class="col-sm-6">
            <label>Atividade aplicada</label>
                <br>
                <div class="middle">
                    <span style="font-size: 1rem;" class="in-company-switch">Não</span>
                    <div class="switch-gender">
                        <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[ProfessorData][appliedActivity]" <?php print( isset($data['post']['ProfessorData']['appliedActivity']) ? ($data['post']['ProfessorData']['appliedActivity'] == 'Não') ? 'checked' : '' : 'checked' ); ?> value="Não" id="professor_applied_activity_no">
                        <label for="professor_applied_activity_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input  <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[ProfessorData][appliedActivity]" <?php print( isset($data['post']['ProfessorData']['appliedActivity']) ? ($data['post']['ProfessorData']['appliedActivity'] == 'Sim') ? 'checked' : '' : '' ); ?> value="Sim" id="professor_applied_activity_yes">
                        <label for="professor_applied_activity_yes" class="switch-label switch-label-on">&nbsp;</label>
                        <span class="switch-selection"></span>
                    </div>
                    <span style="font-size: 1rem;" class="open-public-switch">Sim</span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Linkedin</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[ProfessorData][professorLinkedin]" id="paneListLinkedin" value="<?php print( isset( $data["post"]["ProfessorData"]["professorLinkedin"] ) ? $data["post"]["ProfessorData"]["professorLinkedin"] : "" ) ?>" placeholder="https://www.linkedin.com/...">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Currículo Lattes</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[ProfessorData][professorCV]" id="paneCurriculoLattes" value="<?php print( isset( $data["post"]["ProfessorData"]["professorCV"] ) ? $data["post"]["ProfessorData"]["professorCV"] : "" ) ?>" placeholder="Currículo Lattes">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Formação:</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ProfessorData][professorFormation]" id="paneListFormacao" value="<?php print( isset( $data["post"]["ProfessorData"]["professorFormation"] ) ? $data["post"]["ProfessorData"]["professorFormation"] : "" ) ?>" rows="5" placeholder="Formação" style="resize: none;"></textarea>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Area de atuação:</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ProfessorData][professorOccupationArea]" id="paneListActing" rows="5" value="<?php print( isset( $data["post"]["ProfessorData"]["professorOccupationArea"] ) ? $data["post"]["ProfessorData"]["professorOccupationArea"] : "" ) ?>" placeholder="Area de atuação" style="resize: none;"></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Conhecimento ou especialista em quais áreas do PD.</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ProfessorData][professorSpecialities]" value="<?php print( isset( $data["post"]["ProfessorData"]["professorSpecialities"] ) ? $data["post"]["ProfessorData"]["professorSpecialities"] : "" ) ?>" id="paneListSpecialty" rows="5" placeholder="Conhecimento ou especialista em quais áreas do PD." style="resize: none;"></textarea>
                </div>
            </div>
            <?php if(!isset($data['edit']) || !$data['edit']){ ?>
            <div class="col-sm-12 mt-5 text-center">
                <button type="button" id="save_information_panelist" onClick="display_labels(<?php print($show_information_panelist); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
            </div>

            <?php } ?>
        </div>
    </div>
</div>


<?php if($data['edit']){ ?>
<div class="row row-no-padding d-none" id="information_panelist_correct">
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
                        <input type="radio" class="switch-input" name="post[ProfessorData][correct]" value="Não" id="professor_correct_no">
                        <label for="professor_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[ProfessorData][correct]" value="Sim" id="professor_correct_yes">
                        <label for="professor_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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


<div id="message_error_information_panelist"></div>