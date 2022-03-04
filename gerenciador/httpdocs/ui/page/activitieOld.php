<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Registro de Atividades</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>

                    <input type="hidden" id="idx" name="idx" value="<?php print( isset( $data["idx"] ) ? $data["idx"] : 0 ) ?>">

                    <div style="display: flex;justify-content: space-evenly;">
                      
                            <div class="large-12  columns">
                                <div id="accordion">
                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Presencial" , "Curso a distancia", "Videos/Live", "Palestra", "Curso Híbrido" ) ) ){
                                    ?>
                                    <h3 class="text-left">Descritivo de Atividade</h3>
                                    <div>
                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>
                                            <div class="large-1 columns text-right">  
                                                    <label class="switch" for="checkboxActivityDetails">
                                                    <input <?php print( isset( $data["post"]["ActivityDetails"]["__Error"] ) && $data["post"]["ActivityDetails"]["__Error"] ? 'checked="checked"' : '' ) ?> type="checkbox" id="checkboxActivityDetails" data-id="ActivityDetails" name='post[ActivityDetails][__Error]' value="true" class="switch-obs" />
                                                        <div class="slider round"></div>
                                                    </label>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6 columns activityName">
                                                <strong class="text-16-pt">Nome da atividade: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][activityName]" data-id="activityName" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["activityName"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["activityName"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityDetails"]["activityName"]) ? $data["post"]["ActivityDetails"]["activityName"] : '-') ?></p>
                                            </div>

                                            <div class="large-3 columns workLoad">
                                                <strong class="text-16-pt">Carga Horária: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][workLoad]" data-id="workLoad" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["workLoad"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["workLoad"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityDetails"]["workLoad"]) ? $data["post"]["ActivityDetails"]["workLoad"] : '-') ?></p>                                               
                                            </div>

                                            <div class="large-3 columns value">
                                                <strong class="text-16-pt">Valor: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][value]" data-id="value" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["value"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["value"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityDetails"]["value"]) ? $data["post"]["ActivityDetails"]["value"] : '-') ?></p>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-3 columns startDate">
                                                <strong class="text-16-pt">Início: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][startDate]" data-id="startDate" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["startDate"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["startDate"] ? 'checked="checked"' : '' ) ?> /></strong>
                                               <p>
                                                   <?php 
                                                    if( 
                                                        isset($data["post"]["ActivityDetails"]["startDate"])
                                                        && !empty(preg_match("/^(.+) (.+) (.+) (.+) (.+) (.+)$/", $data["post"]["ActivityDetails"]["startDate"]) )
                                                     ){
                                                        list( $date_week , $date_month , $date_day , $date_year , $date_time , $date_gmt ) = explode(" ", $data["post"]["ActivityDetails"]["startDate"] ) ;
                                                        print( date("d/m/Y", strtotime( $date_year . "-" . $GLOBALS["month_name_en"][ $date_month ] . "-" . $date_day . " " . $date_time ) ) );
                                                    }
                                                    else{
                                                        print("-");
                                                    }
                                                ?>
                                                </p>
                                            </div>
                                            <div class="large-3  columns startHour">
                                                <strong class="text-16-pt">Horário de início: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][startHour]" data-id="startHour" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["startHour"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["startHour"] ? 'checked="checked"' : '' ) ?> /></strong>
                                               <p>
                                                   <?php 
                                                    if( isset($data["post"]["ActivityDetails"]["startHour"])
                                                    && !empty(preg_match("/^(.+) (.+) (.+) (.+) (.+) (.+)$/", $data["post"]["ActivityDetails"]["startHour"]) ) ){
                                                        list( $date_week , $date_month , $date_day , $date_year , $date_time , $date_gmt ) = explode(" ", $data["post"]["ActivityDetails"]["startHour"] ) ;
                                                        print( date("H:i:s", strtotime( $date_year . "-" . $GLOBALS["month_name_en"][ $date_month ] . "-" . $date_day . " " . $date_time ) ) );
                                                    }
                                                    else{
                                                        print("-");
                                                    }
                                                ?>
                                                </p>
                                            </div>
                                            <div class="large-3  columns finishDate">
                                                <strong class="text-16-pt">Término: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][finishDate]" data-id="finishDate" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["finishDate"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["finishDate"] ? 'checked="checked"' : '' ) ?> /></strong>
                                               <p>
                                                   <?php 
                                                    if( isset($data["post"]["ActivityDetails"]["finishDate"])
                                                    && !empty(preg_match("/^(.+) (.+) (.+) (.+) (.+) (.+)$/", $data["post"]["ActivityDetails"]["finishDate"]) )  ){
                                                        list( $date_week , $date_month , $date_day , $date_year , $date_time , $date_gmt ) = explode(" ", $data["post"]["ActivityDetails"]["finishDate"] ) ;
                                                        print( date("d/m/Y", strtotime( $date_year . "-" . $GLOBALS["month_name_en"][ $date_month ] . "-" . $date_day . " " . $date_time ) ) );
                                                    }
                                                    else{
                                                        print("-");
                                                    }
                                                ?>
                                                </p>
                                            </div>
                                            <div class="large-3  columns finishHour">
                                                <strong class="text-16-pt">Horário de término: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][finishHour]" data-id="finishHour" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["finishHour"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["finishHour"] ? 'checked="checked"' : '' ) ?> /></strong>
                                               <p>
                                                   <?php 
                                                    if( isset($data["post"]["ActivityDetails"]["finishHour"])
                                                    && !empty(preg_match("/^(.+) (.+) (.+) (.+) (.+) (.+)$/", $data["post"]["ActivityDetails"]["finishHour"]) )  ){
                                                        list( $date_week , $date_month , $date_day , $date_year , $date_time , $date_gmt ) = explode(" ", $data["post"]["ActivityDetails"]["finishHour"] ) ;
                                                        print( date("H:i:s", strtotime( $date_year . "-" . $GLOBALS["month_name_en"][ $date_month ] . "-" . $date_day . " " . $date_time ) ) );
                                                    }
                                                    else{
                                                        print("-");
                                                    }
                                                ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-3 columns appliedActivity">
                                                <strong class="text-16-pt">Atividade aplicada: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][appliedActivity]" data-id="appliedActivity" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["appliedActivity"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["appliedActivity"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <div class="row margin-top-5">
                                                    <div class="large-12  columns">
                                                    <p><?php print(isset($data["post"]["ActivityDetails"]["appliedActivity"]) ? $data["post"]["ActivityDetails"]["appliedActivity"] : '-') ?></p>                               
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="large-6  columns">
                                                <strong class="text-16-pt">Público Alvo:</strong>
                                                <div class="row margin-top-5">
                                                    <div class="large-4 columns associateCFP">
                                                        <p><b>Associado CFP <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][target][associateCFP]" data-id="associateCFP" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["associateCFP"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["associateCFP"] ? 'checked="checked"' : '' ) ?> /></b>
                                                        <br/><?php print(isset($data["post"]["ActivityDetails"]["target"]["associateCFP"]) ? 'Sim' : 'Não' ) ?></p>
                                                    </div>
                                                    <div class="large-4  columns associateNotCFP">
                                                        <p><b>Associado não CFP <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][target][associateNotCFP]" data-id="associateNotCFP" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["associateNotCFP"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["associateNotCFP"] ? 'checked="checked"' : '' ) ?> /></b>
                                                        <br/><?php print( isset($data["post"]["ActivityDetails"]["target"]["associateNotCFP"]) ? 'Sim' : 'Não')  ?></p>
                                                    </div>
                                                    <div class="large-4  columns notAssociate">
                                                        <p><b>Não Associado <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][target][notAssociate]" data-id="notAssociate" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["notAssociate"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["target"]["notAssociate"] ? 'checked="checked"' : '' ) ?> /></b>
                                                        <br/><?php print( isset( $data["post"]["ActivityDetails"]["target"]["notAssociate"]) ? 'Sim' : 'Não' ) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="large-3  columns periodicity">
                                                <strong class="text-16-pt">Periodicidade: <input type="checkbox" name="post[ActivityDetails][__Error_FIELD][periodicity]" data-id="periodicity" class="checkerror" <?php print( isset( $data["post"]["ActivityDetails"]["__Error_FIELD"]["periodicity"] ) && $data["post"]["ActivityDetails"]["__Error_FIELD"]["periodicity"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <div class="row margin-top-5">
                                                    <div class="large-12  columns">
                                                    <p><?php print(isset($data["post"]["ActivityDetails"]["periodicity"]) ? $data["post"]["ActivityDetails"]["periodicity"] : '-') ?></p>
                                                    </div>                                                    
                                                </div>
                                            </div>                                        
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivActivityDetails_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name='post[ActivityDetails][__Error_OBS]' id="ActivityDetails_Obs" cols="10" ><?php print( isset( $data["post"]["ActivityDetails"]["__Error_OBS"] ) ? $data["post"]["ActivityDetails"]["__Error_OBS"] : "" ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>


                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso a distancia", "Videos/Live" ) ) ){
                                    ?>
                                    <h3 class="text-left">Link / Página</h3>
                                    <div>
                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxCourseLinkAddress">
                                                <input type="checkbox" id="checkboxCourseLinkAddress" data-id="CourseLinkAddress" class="switch-obs"  name='post[CourseLinkAddress][__Error]' <?php print( isset( $data["post"]["CourseLinkAddress"]["__Error"] ) && $data["post"]["CourseLinkAddress"]["__Error"] ? 'checked="checked"' : '' ) ?> />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns linkURL">
                                                <strong class="text-16-pt">URL: <input type="checkbox" name="post[CourseLinkAddress][__Error_FIELD][linkURL]" data-id="linkURL" class="checkerror" <?php print( isset( $data["post"]["CourseLinkAddress"]["__Error_FIELD"]["linkURL"] ) && $data["post"]["CourseLinkAddress"]["__Error_FIELD"]["linkURL"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseLinkAddress"]["linkURL"]) ? $data["post"]["CourseLinkAddress"]["linkURL"] : '-') ?></p>
                                            </div>                                  
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivCourseLinkAddress_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="CourseLinkAddress_Obs" id="CourseLinkAddress_Obs"  name="post[CourseLinkAddress][__Error_OBS]" cols="10" ><?php print( isset( $data["post"]["CourseLinkAddress"]["__Error_OBS"] ) ? $data["post"]["CourseLinkAddress"]["__Error_OBS"] : "" ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>


                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Presencial","Palestra","Curso Híbrido" ) ) ){
                                    ?>
                                    <h3 class="text-left">Endereço do Curso</h3>
                                    <div>
                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxCourseAddress">
                                                <input type="checkbox" id="checkboxCourseAddress" data-id="CourseAddress" class="switch-obs"  name='post[CourseAddress][__Error]' <?php print( isset( $data["post"]["CourseAddress"]["__Error"] ) && $data["post"]["CourseAddress"]["__Error"] ? 'checked="checked"' : '' ) ?> />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row margin-bottom-25">
                                            <div class="large-5  columns courseLocal">
                                                <strong class="text-16-pt">Local: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseLocal]" data-id="courseLocal" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseLocal"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseLocal"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseLocal"]) ? $data["post"]["CourseAddress"]["courseLocal"] : '-') ?></p>
                                            </div>
                                            <div class="large-2  columns courseCEP">
                                                <strong class="text-16-pt">CEP: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseCEP]" data-id="courseCEP" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseCEP"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseCEP"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseCEP"]) ? $data["post"]["CourseAddress"]["courseCEP"] : '-') ?></p>
                                            </div>
                                            <div class="large-5  columns courseAddress">
                                                <strong class="text-16-pt">Endereço: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseAddress]" data-id="courseAddress" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseAddress"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseAddress"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseAddress"]) ? $data["post"]["CourseAddress"]["courseAddress"] : '-') ?></p>
                                            </div>                                          
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-2  columns courseAddressNumber">
                                                <strong class="text-16-pt">Número: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseAddressNumber]" data-id="courseAddressNumber" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseAddressNumber"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseAddressNumber"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseAddressNumber"]) ? $data["post"]["CourseAddress"]["courseAddressNumber"] : '-') ?></p>
                                            </div>
                                            <div class="large-3  columns courseComplement">
                                                <strong class="text-16-pt">Complemento: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseComplement]" data-id="courseComplement" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseComplement"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseComplement"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseComplement"]) ? $data["post"]["CourseAddress"]["courseComplement"] : '-') ?></p>
                                            </div>
                                            <div class="large-2  columns courseDistrict">
                                                <strong class="text-16-pt">Bairro: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseDistrict]" data-id="courseDistrict" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseDistrict"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseDistrict"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseDistrict"]) ? $data["post"]["CourseAddress"]["courseDistrict"] : '-') ?></p>
                                            </div> 
                                            <div class="large-3  columns courseCity">
                                                <strong class="text-16-pt">Cidade: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseCity]" data-id="courseCity" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseCity"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseCity"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseCity"]) ? $data["post"]["CourseAddress"]["courseCity"] : '-') ?></p>
                                            </div>         
                                            <div class="large-2  columns courseState">
                                                <strong class="text-16-pt">Estado: <input type="checkbox" name="post[CourseAddress][__Error_FIELD][courseState]" data-id="courseState" class="checkerror" <?php print( isset( $data["post"]["CourseAddress"]["__Error_FIELD"]["courseState"] ) && $data["post"]["CourseAddress"]["__Error_FIELD"]["courseState"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["CourseAddress"]["courseState"]) ? $data["post"]["CourseAddress"]["courseState"] : '-') ?></p>
                                            </div>                                  
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivCourseAddress_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="CourseAddress_Obs" id="CourseAddress_Obs"  name="post[CourseAddress][__Error_OBS]" cols="10" ><?php print( isset( $data["post"]["CourseAddress"]["__Error_OBS"] ) ? $data["post"]["CourseAddress"]["__Error_OBS"] : "" ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Presencial" , "Curso a distancia", "Videos/Live","Palestra","Curso Híbrido" ) ) ){
                                    ?>
                                    <h3 class="text-left">Informações da Atividade</h3>
                                    <div>

                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxActivityInformation">
                                                <input type="checkbox" id="checkboxActivityInformation"  data-id="ActivityInformation" class="switch-obs" name='post[ActivityInformation][__Error]' <?php print( isset( $data["post"]["ActivityInformation"]["__Error"] ) && $data["post"]["ActivityInformation"]["__Error"] ? 'checked="checked"' : '' ) ?> />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns resume">
                                                <strong class="text-16-pt">Resumo: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][resume]" data-id="resume" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["resume"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["resume"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["resume"]) ? $data["post"]["ActivityInformation"]["resume"] : '-') ?></p>
                                            </div>
                                            <div class="large-6  columns activityGoal">
                                                <strong class="text-16-pt">Objetivo da Atividade: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][activityGoal]" data-id="activityGoal" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["activityGoal"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["activityGoal"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["activityGoal"]) ? $data["post"]["ActivityInformation"]["activityGoal"] : '-') ?></p>
                                            </div>                                               
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns">
                                                <strong class="text-16-pt">Tópicos do programa detalhado (1 crédito/hora):</strong>
                                                <div class="row margin-top-15 Planejar">
                                                    <div class="large-6  columns ">
                                                        Planejar <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][businessTopic][Planejar]" data-id="Planejar" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejar"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejar"] ? 'checked="checked"' : '' ) ?> />
                                                    </div>
                                                    <div class="large-6  columns">
                                                        <p><?php print(isset($data["post"]["ActivityInformation"]["businessTopic"]["Planejar"]) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejar"] : '-') ?></p>
                                                    </div>
                                                </div>
                                                <div class="row Gestão">
                                                    <div class="large-6  columns ">
                                                        Gestão <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][businessTopic][Gestão]" data-id="Gestão" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Gestão"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Gestão"] ? 'checked="checked"' : '' ) ?> />
                                                    </div>
                                                    <div class="large-6  columns">
                                                        <p><?php print(isset($data["post"]["ActivityInformation"]["businessTopic"]["Gestão"]) ? $data["post"]["ActivityInformation"]["businessTopic"]["Gestão"] : '-') ?></p>
                                                    </div>
                                                </div>
                                                <div class="row Planejamento">
                                                    <div class="large-6  columns">
                                                        Planejamento <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][businessTopic][Planejamento]" data-id="Planejamento" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejamento"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejamento"] ? 'checked="checked"' : '' ) ?> />
                                                    </div>
                                                    <div class="large-6  columns">
                                                        <p><?php print(isset($data["post"]["ActivityInformation"]["businessTopic"]["Planejamento"]) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento"] : '-') ?></p>
                                                    </div>
                                                </div>
                                                <div class="row Gestão_de_Risco_e_Planejamento_de_seguros">
                                                    <div class="large-6  columns">
                                                        Gestão de Risco e Planejamento de seguros <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][businessTopic][Gestão de Risco e Planejamento de seguros]" data-id="Gestão_de_Risco_e_Planejamento_de_seguros" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"] ? 'checked="checked"' : '' ) ?> />
                                                    </div>
                                                    <div class="large-6  columns">
                                                        <p><?php print(isset($data["post"]["ActivityInformation"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"]) ? $data["post"]["ActivityInformation"]["businessTopic"]["Gestão de Risco e Planejamento de seguros"] : '-') ?></p>
                                                    </div>
                                                </div>
                                                <div class="row Planejamento_Fiscal">
                                                    <div class="large-6  columns">
                                                        Planejamento Fiscal <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][businessTopic][Planejamento Fiscal]" data-id="Planejamento_Fiscal" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejamento Fiscal"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["businessTopic"]["Planejamento Fiscal"] ? 'checked="checked"' : '' ) ?> />
                                                    </div>
                                                    <div class="large-6  columns">
                                                        <p><?php print(isset($data["post"]["ActivityInformation"]["businessTopic"]["Planejamento Fiscal"]) ? $data["post"]["ActivityInformation"]["businessTopic"]["Planejamento Fiscal"]: '-') ?></p>
                                                    </div>
                                                </div>
                                            </div>           
                                            <div class="large-6  columns">
                                            </div>                                                                           
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns">
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns course_level">
                                                <strong class="text-16-pt">Nível do curso: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][course_level]" data-id="course_level" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["course_level"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["course_level"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["course_level"]) ? $data["post"]["ActivityInformation"]["course_level"] : '-') ?></p>
                                            </div>
                                            <div class="large-6  columns test">
                                                <strong class="text-16-pt">Forma de avaliação: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][test]" data-id="test" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["test"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["test"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["test"]) ? $data["post"]["ActivityInformation"]["test"] : '-') ?></p>
                                            </div>
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns methodology">
                                                <strong class="text-16-pt">Metodologia: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][methodology]" data-id="methodology" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["methodology"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["methodology"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["methodology"]) ? $data["post"]["ActivityInformation"]["methodology"] : '-') ?></p>
                                            </div>
                                            <div class="large-6  columns">                                              
                                            </div>
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns learningExpactation">
                                                <strong class="text-16-pt">Expectativa de conhecimento que o CFP deve ter ao concluir a atividade: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][learningExpactation]" data-id="learningExpactation" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["learningExpactation"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["learningExpactation"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["learningExpactation"]) ? $data["post"]["ActivityInformation"]["learningExpactation"] : '-') ?></p>
                                            </div>                                           
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns resources">
                                                <strong class="text-16-pt">Recursos Utilizados: <input type="checkbox" name="post[ActivityInformation][__Error_FIELD][resources]" data-id="resources" class="checkerror" <?php print( isset( $data["post"]["ActivityInformation"]["__Error_FIELD"]["resources"] ) && $data["post"]["ActivityInformation"]["__Error_FIELD"]["resources"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                <p><?php print(isset($data["post"]["ActivityInformation"]["resources"]) ? $data["post"]["ActivityInformation"]["resources"] : '-') ?></p>
                                            </div>                                           
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivActivityInformation_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="ActivityInformation_Obs" id="ActivityInformation_Obs" name="post[ActivityInformation][__Error_OBS]" cols="10" ><?php print( isset( $data["post"]["ActivityInformation"]["__Error_OBS"] ) ? $data["post"]["ActivityInformation"]["__Error_OBS"] : "" ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Presencial", "Curso a distancia", "Videos/Live" ,"Palestra", "Curso Híbrido") ) ){
                                    ?>
                                    <h3 class="text-left">Dados do professor/palestrante</h3>
                                    <div>

                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxProfessorData">
                                                <input type="checkbox" id="checkboxProfessorData" data-id="ProfessorData" class="switch-obs" name='post[ProfessorData][__Error]' <?php print( isset( $data["post"]["ProfessorData"]["__Error"] ) && $data["post"]["ProfessorData"]["__Error"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorName">
                                                <strong class="text-16-pt">Nome: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorName]" data-id="professorName" class="checkerror" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorName"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorName"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorName"]) ? $data["post"]["ProfessorData"]["professorName"] : '-') ?></p>
                                            </div>
                                            <div class="large-4  columns professorCPF">      
                                                <strong class="text-16-pt">CPF: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorCPF]" data-id="professorCPF" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorCPF"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorCPF"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorCPF"]) ? $data["post"]["ProfessorData"]["professorCPF"] : '-') ?></p>                                        
                                            </div>
                                            <div class="large-2  columns applyActivity">       
                                                <strong class="text-16-pt">Atividade aplicada: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][applyActivity]" data-id="applyActivity" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["applyActivity"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["applyActivity"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["applyActivity"]) ? $data["post"]["ProfessorData"]["applyActivity"] : '-') ?></p>                                   
                                            </div>
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorLinkedin">
                                                <strong class="text-16-pt">Linkedin: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorLinkedin]" data-id="professorLinkedin" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorLinkedin"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorLinkedin"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorLinkedin"]) ? $data["post"]["ProfessorData"]["professorLinkedin"] : '-') ?></p>
                                            </div>
                                            <div class="large-6  columns professorCV">      
                                                <strong class="text-16-pt">Currículo Lattes: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorCV]" data-id="professorCV" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorCV"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorCV"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorCV"]) ? $data["post"]["ProfessorData"]["professorCV"] : '-') ?></p>                                        
                                            </div>                                           
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorFormation">
                                                <strong class="text-16-pt">Formação: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorFormation]" data-id="professorFormation" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorFormation"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorFormation"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorFormation"]) ? $data["post"]["ProfessorData"]["professorFormation"] : '-') ?></p>
                                            </div>
                                            <div class="large-6  columns professorOccupationArea">      
                                                <strong class="text-16-pt">Area de atuação: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorOccupationArea]" data-id="professorOccupationArea" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorOccupationArea"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorOccupationArea"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorOccupationArea"]) ? $data["post"]["ProfessorData"]["professorOccupationArea"] : '-') ?></p>                                        
                                            </div>                                           
                                        </div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns professorSpecialities">
                                                <strong class="text-16-pt">Conhecimento ou especialista em quais áreas do PD. <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivProfessorData_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="ProfessorData_Obs" id="ProfessorData_Obs" name="post[ProfessorData][__Error_OBS]" cols="10" ><?php print(  isset( $data["post"]["ActivityInformation"]["__Error_OBS"] ) ? $data["post"]["ActivityInformation"]["__Error_OBS"] : ""  ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Híbrido" ) ) ){
                                    ?>
                                    <h3 class="text-left">Coffee Break</h3>
                                    <div>
                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxCoffeeBreak">
                                                <input type="checkbox" id="checkboxCoffeeBreak" data-id="CoffeeBreak" class="switch-obs" name='post[CoffeeBreak][__Error]' <?php print( isset( $data["post"]["CoffeeBreak"]["__Error"] ) && $data["post"]["CoffeeBreak"]["__Error"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Com coffee break? <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>    
                                            
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Tipo de coffee break <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>  
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Tipo de coffee break <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Participante com restrição alimentar? <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>  
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Restrições <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-12  columns professorSpecialities">
                                                <strong class="text-16-pt">Objetivo da Atividade: <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivCoffeeBreak_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="CoffeeBreak_Obs" id="CoffeeBreak_Obs" name="post[CoffeeBreak][__Error_OBS]" cols="10" ><?php print(  isset( $data["post"]["ActivityInformation"]["__Error_OBS"] ) ? $data["post"]["ActivityInformation"]["__Error_OBS"] : ""  ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if( isset( $data["modality"] ) && in_array( $data["modality"] , array( "Curso Híbrido" ) ) ){
                                    ?>
                                    <h3 class="text-left">Tempos e Movimentos</h3>
                                    <div>
                                        <div class="row">
                                            <div class="large-11 columns text-right"> 
                                                Incluir Observação:
                                            </div>

                                            <div class="large-1 columns text-right">                                               
                                                <label class="switch" for="checkboxMovimentos">
                                                <input type="checkbox" id="checkboxMovimentos" data-id="Movimentos" class="switch-obs" name='post[Movimentos][__Error]'  <?php print( isset( $data["post"]["Movimentos"]["__Error"] ) && $data["post"]["Movimentos"]["__Error"] ? 'checked="checked"' : '' ) ?>/>
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Refeições? <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>  
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Coffee full time <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Início <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>  
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Término <input type="checkbox" name="post[ProfessorData][__Error_FIELD][professorSpecialities]" data-id="professorSpecialities" class="checkerror" <?php print( isset( $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ) && $data["post"]["ProfessorData"]["__Error_FIELD"]["professorSpecialities"] ? 'checked="checked"' : '' ) ?> /></strong>
                                                 <p><?php print(isset($data["post"]["ProfessorData"]["professorSpecialities"]) ? $data["post"]["ProfessorData"]["professorSpecialities"] : '-') ?></p>
                                            </div>                                                                                
                                        </div>

                                        <div class="row margin-bottom-25 block-obs" id="DivMovimentos_Obs">
                                            <div class="large-12  columns">
                                                <strong>Observações</strong>
                                                <textarea name="Movimentos_Obs" id="Movimentos_Obs" name="post[Movimentos][__Error_OBS]" cols="10" ><?php print(  isset( $data["post"]["ActivityInformation"]["__Error_OBS"] ) ? $data["post"]["ActivityInformation"]["__Error_OBS"] : ""  ) ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <h3 class="text-left">Créditos</h3>
                                    <div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Selecione o Crédito </strong>

                                                <select name="credits" style="float:right">
                                                    <?php foreach( array("00.00" => "00.00" , "00.50" => "00.50" , "01.00" => "01.00" , "01.50" => "01.50" , "02.00" => "02.00" , "02.50" => "02.50" , "03.00" => "03.00" , "03.50" => "03.50" , "04.00" => "04.00" , "04.50" => "04.50" , "05.00" => "05.00" , "05.50" => "05.50" , "06.00" => "06.00" , "06.50" => "06.50" , "07.00" => "07.00" , "07.50" => "07.50" , "08.00" => "08.00" , "08.50" => "08.50" , "09.00" => "09.00" , "09.50" => "09.50" , "10.00" => "10.00" , "10.50" => "10.50" , "11.00" => "11.00" , "11.50" => "11.50" , "12.00" => "12.00" , "12.50" => "12.50" , "13.00" => "13.00" , "13.50" => "13.50" , "14.00" => "14.00" , "14.50" => "14.50" , "15.00" => "15.00" , "15.50" => "15.50" , "16.00" => "16.00" , "16.50" => "16.50" , "17.00" => "17.00" , "17.50" => "17.50" , "18.00" => "18.00" , "18.50" => "18.50" , "19.00" => "19.00" , "19.50" => "19.50" , "20.00" => "20.00" , "20.50" => "20.50" , "21.00" => "21.00" , "21.50" => "21.50" , "22.00" => "22.00" , "22.50" => "22.50" , "23.00" => "23.00" , "23.50" => "23.50" , "24.00" => "24.00" , "24.50" => "24.50" , "25.00" => "25.00" , "25.50" => "25.50" , "26.00" => "26.00" , "26.50" => "26.50" , "27.00" => "27.00" , "27.50" => "27.50" , "28.00" => "28.00" , "28.50" => "28.50" , "29.00" => "29.00" , "29.50" => "29.50" , "30.00" => "30.00" ) as $k => $v ){
                                                        printf('<option value="%s"%s>%s</option>'."\n" , $k , isset($data["credits"] ) && $data["credits"] == $k ? ' selected="selected"' : ''  , $v);
                                                   }
                                                   ?>
                                                </select>
                                            </div>                                                                               
                                        </div>
                                    </div>
                                    <h3 class="text-left">Dados finais sobre a atividade</h3>
                                    <div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Selecione a trilha em que será alocado a atividade<br> </strong>

                                                    <?php foreach( $data["trails_availabe"] as $k => $v ){
                                                        printf('<label class="text-16-pt"><input type="checkbox" id="post[finalData][trails][%s]" name="post[finalData][trails][]" data-id="trails_%s" %s /> %s</label>'."\n" , $k , $k , isset( $data["post"]["finalData"]["trails"] ) && in_array( $k , $data["post"]["finalData"]["trails"] ) ? 'checked="checked"' : '' , $v);
                                                   }
                                                   ?>

                                            </div>  
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Selecione a área de atuação<br></strong>
                                                    <?php foreach( users_controller::data4select("area_atuacao",array("area_atuacao!=''"),"area_atuacao") as $k => $v ){
                                                        printf('<label class="text-16-pt"><input type="checkbox" id="post[finalData][area][%s]" name="post[finalData][area][]" data-id="area_%s" %s /> %s</label>'."\n" , $k , $k , isset( $data["post"]["finalData"]["area"] ) && in_array( $k , $data["post"]["finalData"]["area"] ) ? 'checked="checked"' : '' , $v);
                                                   }
                                                   ?>
                                            </div>   
                                            <div class="large-12  columns professorSpecialities">
                                                <strong class="text-16-pt">Atenção: Selecione essa opção se esta atividade foi registrada para lançamento de créditos<br></strong>

                                                <div class="large-1 columns">                                               
                                                    <label class="switch" for="checkboxfinalDataLancar">
                                                    <input type="checkbox" id="checkboxfinalDataLancar" data-id="finalDataLancar" class="switch-obs" name='post[finalData][LANCAR]' <?php print( isset( $data["post"]["finalData"]["LANCAR"] ) && $data["post"]["finalData"]["LANCAR"] ? 'checked="checked"' : '' ) ?>  />
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>      
                                            </div>                                                                           
                                        </div>
                                    </div>

                                    <h3 class="text-left">Parecer do Curador</h3>
                                    <div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Parecer do Curador<br> </strong>

                                                <label class="text-16-pt"><input type="radio" id="post[Parecer][Parecer][Recomenda]" name="post[Parecer][Parecer]" data-id="Parecer_Recomenda" <?php print( isset( $data["post"]["Parecer"]["Parecer"] ) && $data["post"]["Parecer"]["Parecer"] == "Recomenda" ? 'checked' : '' ) ?> value="Recomenda" /> Recomendado para educação continuada</label>

                                                <label class="text-16-pt"><input type="radio" id="post[Parecer][Parecer][Ajuste]" name="post[Parecer][Parecer]" data-id="Parecer_Ajuste" <?php print( isset( $data["post"]["Parecer"]["Parecer"] ) && $data["post"]["Parecer"]["Parecer"] == "Ajuste" ? 'checked' : '' ) ?> value="Ajuste" /> Recomendado com ajustes</label>

                                                <label class="text-16-pt"><input type="radio" id="post[Parecer][Parecer][Nao_Recomenda]" name="post[Parecer][Parecer]" data-id="Parecer_Nao_Recomenda" <?php print( isset( $data["post"]["Parecer"]["Parecer"] ) && $data["post"]["Parecer"]["Parecer"] == "Nao_Recomenda" ? 'checked' : '' ) ?> value="Nao_Recomenda" /> Não Recomendado</label>
                                            </div>  
                                            <div class="large-6  columns professorSpecialities">
                                                <strong class="text-16-pt">Justificativa do curador por não recomendar<br></strong>
                                                <textarea name='post[Parecer][Justificativa]' id="Parecer_Justificativa" cols="10" ><?php print( isset( $data["post"]["Parecer"]["Justificativa"] ) ? $data["post"]["Parecer"]["Justificativa"] : "" ) ?></textarea>
                                            </div>   
                                            <div class="large-12  columns professorSpecialities">
                                                <strong class="text-16-pt">Cometários Gerais<br></strong>
                                                <textarea name='post[Parecer][Comentario]' id="Parecer_Comentario" cols="10" ><?php print( isset( $data["post"]["Parecer"]["Comentario"] ) ? $data["post"]["Parecer"]["Comentario"] : "" ) ?></textarea>
                                            </div>                                                                           
                                        </div>
                                    </div>




                                    <h3 class="text-left">Check list final sobre a atividade</h3>
                                    <div>
                                        <div class="row margin-bottom-25">
                                            <div class="large-4  columns professorSpecialities">
                                                <strong >Duração da atividade esta adequada<br> </strong>
                                                <label class="switch" for="checkboxChecklist">
                                                    <input type="checkbox" id="checkboxChecklist_duracao" data-id="Checklist_duracao" class="switch-obs" name='post[Checklist][Duracao_da_atividade]' <?php print( isset( $data["post"]["Checklist"]["Duracao_da_atividade"] ) && $data["post"]["Checklist"]["Duracao_da_atividade"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>

                                            <div class="large-4  columns professorSpecialities">
                                                <strong >Informações estão corretas?<br> </strong>
                                                <label class="switch" for="checkboxChecklist">
                                                    <input type="checkbox" id="checkboxChecklist_Informações" data-id="Checklist_Informações" class="switch-obs" name='post[Checklist][Informações]' <?php print( isset( $data["post"]["Checklist"]["Informações"] ) && $data["post"]["Checklist"]["Informações"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>

                                            <div class="large-4  columns professorSpecialities">
                                                <strong >Conteúdo tem avaliação da aprendizagem.<br> </strong>
                                                <label class="switch" for="checkboxChecklist">
                                                    <input type="checkbox" id="checkboxChecklist_avaliacao" data-id="Checklist_avaliacao" class="switch-obs" name='post[Checklist][avaliacao]' <?php print( isset( $data["post"]["Checklist"]["avaliacao"] ) && $data["post"]["Checklist"]["avaliacao"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                            <div class="large-4  columns professorSpecialities">

                                                <strong >Conteúdo esta apresentando em uma sequência lógica.<br> </strong>
                                                <label class="switch" for="checkboxChecklist">
                                                    <input type="checkbox" id="checkboxChecklist_sequencia" data-id="Checklist_sequencia" class="switch-obs" name='post[Checklist][sequencia]' <?php print( isset( $data["post"]["Checklist"]["sequencia"] ) && $data["post"]["Checklist"]["sequencia"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                            <div class="large-4  columns professorSpecialities">

                                                <strong >Conteúdo esta apresentando esta de forma objetivo e claro<br> </strong>
                                                <label class="switch" for="checkboxChecklist">
                                                    <input type="checkbox" id="checkboxChecklist_apresentacao" data-id="Checklist_apresentacao" class="switch-obs" name='post[Checklist][apresentacao]' <?php print( isset( $data["post"]["Checklist"]["apresentacao"] ) && $data["post"]["Checklist"]["apresentacao"] ? 'checked="checked"' : '' ) ?>  />
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                            <div class="large-4  columns professorSpecialities">
                                                <strong >Data limite para lançamento de créditos<br> </strong>
                                                <input type="date" name="post[Checklist][date]" id="dateChecklist_date" data-id="Checklist_date" value="<?php print( isset( $data["post"]["Checklist"]["date"] ) ?  $data["post"]["Checklist"]["date"] : '' ) ?>">
                                            </div>                    
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row margin-top-25">
                                    <div class="large-10 columns text-right">                                                                                          
                                        <strong class="text-18-pt margin-right-30">
                                                Status da Atividade
                                        </strong>                                    
                                    </div>
                                   
                                    <div class="large-2 columns text-right">   
                                        <select name="status" style="float:right">
                                            <option value=""<?php print( !isset( $data["status"] ) || $data["status"] == "" ? " selected" : "" ) ?>></option>
                                            <?php 
                                            foreach( $GLOBALS["activities_status_list"] as $k => $v ){
                                                printf('<option value="%s"%s>%s</option>'."\n" , $k , isset($data["status"] ) && $data["status"] == $k ? ' selected="selected"' : ''  , $v);
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>                                 
                    </div>
                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <button type="button" class="round hollow button secondary" name="btn_back">Voltar</button>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
    .switch {
        display: inline-block;
        height: 34px;
        position: relative;
        width: 60px;
    }

    .switch input {
        display:none;
    }

    .slider {
        background-color: #ccc;
        bottom: 0;
        cursor: pointer;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: .4s;
    }

    .slider:before {
        background-color: #fff;
        bottom: 4px;
        content: "";
        height: 26px;
        left: 4px;
        position: absolute;
        transition: .4s;
        width: 26px;
    }

    input:checked + .slider {
        background-color: #66bb6a;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .block-obs{
        display: none;
    }
    textarea{
        height: 125px;    
    }
    .this-error{
        border:1px solid red;
        border-radius: 5px;
    }
    .columns {
        padding: 5px !important;
    }
</style>
