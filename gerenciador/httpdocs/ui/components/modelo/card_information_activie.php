<!-- Informações da Atividade -->
<div class="card mt-5 d-none" id="information_activitie">
    <div class="card-header label_div">
        Informações da Atividade
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label class="custom-checkbox" style="display: block; width:100%;">
                Resumo
                    <input id="check_error_activity_information_resume" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
                   <!-- <label style="display: block; width:100%;">Resumo: <i style="float: right;" id="post[error][ActivityInformation][resume]" class="fa fa-exclamation-triangle"></i></label> -->
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityInformation][resume]" id="" rows="3" placeholder="Resumo da Atividade" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["resume"] ) ? $data["post"]["ActivityInformation"]["resume"] : "" ) ?></textarea>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="custom-checkbox" style="display: block; width:100%;">
                    Objetivo da Atividade:
                    <input id="check_error_activity_information_activity_goal" type="checkbox" <?php print(isset($data['edit']) ? ($data['edit']) ? '' : 'disabled' : 'disabled'); ?>  />
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle unchecked <?php print(isset($data['edit']) ? ($data['edit']) ? 'icon-show' : 'icon-hide' : 'icon-hide'); ?> "></i>
                    <i style="float: right;" class="fa fa-fw fa fa fa-exclamation-triangle checked"></i>
                </label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityInformation][activityGoal]" id=""  rows="3" placeholder="Objetivo da Atividade" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["activityGoal"] ) ? $data["post"]["ActivityInformation"]["activityGoal"] : "" ) ?></textarea>
                </div>
            </div>

            <div class="col-sm-6 mt-5 mb-5">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Tópicos do programa detalhado (1 crédito/hora)
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>Planejar</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" value="<?php print( isset( $data["post"]["ActivityInformation"]["businessTopic"]["Planejar"] ) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejar"] : "" ) ?>" name="post[ActivityInformation][businessTopic][Planejar]" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>Gestão</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>   type="text" class="form-control" value="<?php print( isset( $data["post"]["ActivityInformation"]["businessTopic"]["Gestao"] ) ? $data["post"]["ActivityInformation"]["businessTopic"]["Gestao"] : "" ) ?>" name="post[ActivityInformation][businessTopic][Gestao]" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>Planejamento</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" value="<?php print( isset( $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento"] ) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento"] : "" ) ?>" name="post[ActivityInformation][businessTopic][Planejamento]" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>Gestão de Risco e Planejamento de seguros</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" value="<?php print( isset( $data["post"]["ActivityInformation"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"] ) ? $data["post"]["ActivityInformation"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"] : "" ) ?>" name="post[ActivityInformation][businessTopic][Gestao de Risco e Planejamento de seguros]" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>Planejamento Fiscal</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" value="<?php print( isset( $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento Fiscal"] ) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento Fiscal"] : "" ) ?>" name="post[ActivityInformation][businessTopic][Planejamento Fiscal]" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-12">

            </div>

            <div class="col-sm-6">
                <form name="toDoList">
                    <div class="input-group">
                        <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="" id="ListItem" placeholder="Digite o pré-requisito">
                        <div class="input-group-btn ml-5">
                            <button  <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="button" class="btn btn-outline-primary" id="add_list">Adicionar</button>
                        </div>
                    </div>
                </form>

                <div class="col-sm-12 mt-2">
                    <ol></ol>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="file" class="form-control" name="post[ActivityInformation][files][]" id="" multiple>
                </div>
            </div>

            <div class="col-sm-6 mt-5">
                <label>Atividade aplicada</label>
                <br>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[ActivityInformation][course_level]"  <?php print( isset($data['post']['ActivityInformation']['course_level']) ? ($data['post']['ActivityInformation']['course_level'] == 'Basico') ? 'checked' : '' : '' ); ?>  id="course_level_basic" value="Basico">
                    <label class="form-check-label" for="course_level_basic">Basico</label>
                </div>
                <div class="form-check form-check-inline">
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-check-input" type="radio" name="post[ActivityInformation][course_level]" <?php print( isset($data['post']['ActivityInformation']['course_level']) ? ($data['post']['ActivityInformation']['course_level'] == 'Intermediário') ? 'checked' : '' : '' ); ?> id="course_level_intermediary" value="Intermediário">
                    <label class="form-check-label" for="course_level_intermediary">Intermediário</label>
                </div>

                <div class="form-check form-check-inline">
                    <input  <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?> class="form-check-input" type="radio" name="post[ActivityInformation][course_level]" <?php print( isset($data['post']['ActivityInformation']['course_level']) ? ($data['post']['ActivityInformation']['course_level'] == 'Avançado') ? 'checked' : '' : '' ); ?> id="course_level_advanced" value="Avançado">
                    <label class="form-check-label" for="course_level_advanced">Avançado</label>
                </div>
            </div>

            <div class="col-sm-6 mt-5">
                <div class="form-group">
                    <label>Forma de avaliação:</label>
                    <input <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  type="text" class="form-control" name="post[ActivityInformation][test]" id="" value="<?php print( isset( $data["post"]["ActivityInformation"]["test"] ) ? $data["post"]["ActivityInformation"]["test"] : "" ) ?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Metodologia:</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityInformation][methodology]" id="" rows="5" placeholder="Metodologia" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["methodology"] ) ? $data["post"]["ActivityInformation"]["methodology"] : "" ) ?></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Expectativa de conhecimento que o CFP deve ter ao concluir a atividade:</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityInformation][learningExpactation]" id="" rows="5" placeholder="Expectativa de conhecimento que o CFP deve ter ao concluir a atividade" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["learningExpactation"] ) ? $data["post"]["ActivityInformation"]["learningExpactation"] : "" ) ?></textarea>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Recursos Utilizados:</label>
                    <textarea <?php print(isset($data['edit']) ? ($data['edit']) ? 'disabled' : '' : ''); ?>  class="form-control" name="post[ActivityInformation][resources]" id="" rows="5" placeholder="Recursos Utilizados" style="resize: none;"><?php print( isset( $data["post"]["ActivityInformation"]["resources"] ) ? $data["post"]["ActivityInformation"]["resources"] : "" ) ?></textarea>
                </div>
            </div>
            <?php if(!isset($data['edit']) || !$data['edit']){ ?>
            <div class="col-sm-12 mt-5 text-center">
                <button type="button" onClick="display_labels(<?php print($show_information_activie); ?>)" class="btn btn-outline-primary btn-primary btn-sm">Salvar e continuar</button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php if($data['edit']){ ?>
<div class="row row-no-padding d-none" id="information_activitie_correct">
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
                        <input type="radio" class="switch-input" name="post[ActivityInformation][correct]" value="Não" id="ativity_information_correct_no">
                        <label for="ativity_information_correct_no" class="switch-label switch-label-off">&nbsp;</label>
                        <input type="radio" class="switch-input" name="post[ActivityInformation][correct]" value="Sim" id="ativity_information_correct_yes">
                        <label for="ativity_information_correct_yes" class="switch-label switch-label-on">&nbsp;</label>
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
<div id="message_error_information_activie"></div>