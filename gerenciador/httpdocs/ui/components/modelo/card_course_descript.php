<!-- Descritivo de Atividade -->
<div class="card" id="course_descript">
    <div class="card-header label_div">
        Descritivo de Atividade
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <label class="custom-checkbox" style="display: block; width:100%;">
                    <input id="check_error_activity_description" name="post[error][ActivityDetails]" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Nome da Atividade</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> type="text" class="form-control" name="post[ActivityDetails][activityName]" value="<?php print( isset( $data["post"]["ActivityDetails"]["activityName"] ) ? $data["post"]["ActivityDetails"]["activityName"] : "" ) ?>" placeholder="Nome da Atividade">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Carga Horária</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> type="text" class="form-control" name="post[ActivityDetails][workLoad]" id="" value="<?php print( isset( $data["post"]["ActivityDetails"]["workLoad"] ) ? $data["post"]["ActivityDetails"]["workLoad"] : "" ) ?>" placeholder="Carga Horária">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Valor</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> type="text" class="form-control" name="post[ActivityDetails][value]" value="<?php print( isset( $data["post"]["ActivityDetails"]["value"] ) ? $data["post"]["ActivityDetails"]["value"] : "" ) ?>" id="" placeholder="Valor">
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  checked class="form-check-input" name="post[ActivityDetails][not_apply_date]" <?php print( isset( $data["post"]["ActivityDetails"]["not_apply_date"] ) ? ($data["post"]["ActivityDetails"]["not_apply_date"] ) ? "checked" : "" : "" ) ?> id="not_apply_date">
                        Não aplicar data e hora
                    </label>
                </div>
            </div>

            <div class="col-sm-12">
                <hr>
            </div>

            <div class="col-sm-12" id="curso_presencial_data">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Início</label>
                            <input type="date" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityDetails][startDate] id=" placeholder=""  value="<?php print( isset( $data["post"]["ActivityDetails"]["startDate"] ) ? date('d/m/Y', strtotime($data["post"]["ActivityDetails"]["startDate"])) : "" ) ?>">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Horário de início</label>
                            <input type="time" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityDetails][startHour]" id="" placeholder="" value="<?php print( isset( $data["post"]["ActivityDetails"]["startHour"] ) ? $data["post"]["ActivityDetails"]["startHour"] : "" ) ?>">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Término</label>
                            <input type="date" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityDetails][finishDate]" value="<?php print( isset( $data["post"]["ActivityDetails"]["finishDate"] ) ? $data["post"]["ActivityDetails"]["finishDate"] : "" ) ?>" id="" placeholder="">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Horário de Término</label>
                            <input type="time" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityDetails][finishHour]" value="<?php print( isset( $data["post"]["ActivityDetails"]["finishHour"] ) ? $data["post"]["ActivityDetails"]["finishHour"] : "" ) ?>" id="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <label>Atividade aplicada</label>
                <br>
                <div class="middle">
                    <span style="font-size: 1rem;" class="in-company-switch">In Company</span>
                    <div class="switch-gender">
                        <input type="radio" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="switch-input" name="post[ActivityDetails][appliedActivity]" <?php print( isset($data['post']['ActivityDetails']['appliedActivity']) ? ($data['post']['ActivityDetails']['appliedActivity'] == 'In Company') ? 'checked' : '' : '' ); ?> value="In Company" id="in_company" checked>
                        <label for="in_company" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="switch-input" name="post[ActivityDetails][appliedActivity]"  <?php print( isset($data['post']['ActivityDetails']['appliedActivity']) ? ($data['post']['ActivityDetails']['appliedActivity'] == 'Aberto ao público') ? 'checked' : '' : '' ); ?> value="Aberto ao público" id="open_to_the_public">
                        <label for="open_to_the_public" class="switch-label switch-label-on">&nbsp;</label>
                        <span class="switch-selection"></span>
                    </div>
                    <span style="font-size: 1rem;" class="open-public-switch">Aberto ao público</span>
                </div>
            </div>

            <div class="col-sm-4">
                <label>Público Alvo</label>
                <br>
                <div class="form-check form-check-inline">

                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" <?php print( isset($data['post']['ActivityDetails']['target']['associateCFP']) ? ($data['post']['ActivityDetails']['target']['associateCFP']) ? 'checked' : '' : '' ); ?> type="checkbox" name="post[ActivityDetails][associateCFP]" id="inlineCheckbox1" value="associateCFP">
                    <label class="form-check-label" for="inlineCheckbox1">Associado CFP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox" <?php print( isset($data['post']['ActivityDetails']['target']['associateNotCFP']) ? ($data['post']['ActivityDetails']['target']['associateNotCFP']) ? 'checked' : '' : '' ); ?>  name="post[ActivityDetails][associateNotCFP]" id="inlineCheckbox2" value="associateNotCFP">
                    <label class="form-check-label" for="inlineCheckbox2">Associado</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="checkbox"  <?php print( isset($data['post']['ActivityDetails']['target']['notAssociate']) ? ($data['post']['ActivityDetails']['target']['notAssociate']) ? 'checked' : '' : '' ); ?>  name="post[ActivityDetails][notAssociate]" id="inlineCheckbox3" value="notAssociate">
                    <label <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-label" for="inlineCheckbox3">Não Associado</label>
                </div>
            </div>
            <div class="col-sm-4">
                <label>Periodicidade</label>
                <br>
                <div class="middle">
                    <span style="font-size: 1rem;" class="recurring-course-switch">Curso recorrente</span>
                    <div class="switch-gender">
                        <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[ActivityDetails][periodicity]" value="Curso recorrente" id="recurring_course" <?php print( isset($data['post']['ActivityDetails']['periodicity']) ? ($data['post']['ActivityDetails']['periodicity'] == 'Curso recorrente') ? 'checked' : '' : '' ); ?>>
                        <label for="recurring_course" class="switch-label switch-label-off">&nbsp;</label>
                        <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="radio" class="switch-input" name="post[ActivityDetails][periodicity]" value="Curso único" id="single_course" <?php print( isset($data['post']['ActivityDetails']['periodicity']) ? ($data['post']['ActivityDetails']['periodicity'] == 'Curso único') ? 'checked' : '' : '' ); ?>>
                        <label for="single_course" class="switch-label switch-label-on">&nbsp;</label>
                        <span class="switch-selection"></span>
                    </div>
                    <span style="font-size: 1rem;" class="single-course-switch">Curso único</span>
                </div>
            </div>
            <?php if(!isset($data['edit']) || !$data['edit']){ ?>
                <div class="col-sm-12 mt-5 text-center">
                    <button type="button" onClick="display_labels(<?php print($show_descript); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
                </div>
            <?php } ?>
 
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="text-center" id="error-descript"></span>
            </div>
        </div>
    </div>
</div>
<?php if($data['edit']){ ?>
<div class="row row-no-padding <?php print((isset($data['edit'] ) ? ($data['edit'] ) ? '' : 'd-none': 'd-none')); ?>" id="course_descript_correct">
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
                        <input type="radio" class="switch-input" name="post[ActivityDetails][correct]" value="Não" id="ativity_details_correct_no">
                        <label for="ativity_details_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[ActivityDetails][correct]" value="Sim" id="ativity_details_correct_yes" checked>
                        <label for="ativity_details_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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
<div id="message_error_course_descript"></div>

