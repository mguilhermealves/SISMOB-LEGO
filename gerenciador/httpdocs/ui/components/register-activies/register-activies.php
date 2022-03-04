<div class="row mt-5 ml-2 mr-2">
    <div class="col-sm-12 header-register">
        <p>Registro de Atividades</p>
        <hr>
        <p style="
    font-size: 1rem;
    font-family: Montserrat;
    font-weight: 400;
    line-height: 1.5;
    color: rgb(85, 85, 85);">Escolha o tipo de atividade desejada</p>
    </div>
    <?php //print_pre($data); ?>
    <div class="col-sm-12 mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item <?php print(isset($data['modality']) ? $data['modality'] == 'Curso Presencial' ? 'tab-show' : 'tab-hide' : ''); ?>" role="presentation">
                <a class="nav-link active" id="curso-presencial-tab" data-toggle="tab" href="#curso-presencial" role="tab" aria-controls="curso-presencial" aria-selected="true">Curso Presencial</a>
            </li>
            <li class="nav-item <?php print(isset($data['modality']) ? $data['modality'] == 'Curso a distancia' ? 'tab-show' : 'tab-hide' : ''); ?>" role="presentation">
                <a class="nav-link" id="curso-a-distancia-tab" data-toggle="tab" href="#curso-a-distancia" role="tab" aria-controls="curso-a-distancia" aria-selected="false">Curso à Distância</a>
            </li>
            <li class="nav-item <?php print(isset($data['modality']) ? $data['modality'] == 'Curso Híbrido' ? 'tab-show' : 'tab-hide' : ''); ?>" role="presentation">
                <a class="nav-link" id="curso-hibrido-tab" data-toggle="tab" href="#curso-hibrido" role="tab" aria-controls="curso-hibrido" aria-selected="false">Curso à Híbrido</a>
            </li>
            <li class="nav-item <?php print(isset($data['modality']) ? $data['modality'] == 'Videos/Live' ? 'tab-show' : 'tab-hide' : ''); ?>" role="presentation">
                <a class="nav-link" id="videos-live-tab" data-toggle="tab" href="#videos-live" role="tab" aria-controls="videos-live" aria-selected="false">Videos/Live</a>
            </li>
            <li class="nav-item <?php print(isset($data['modality']) ? $data['modality'] == 'Palestra' ? 'tab-show' : 'tab-hide' : ''); ?>" role="presentation">
                <a class="nav-link" id="palestra-tab" data-toggle="tab" href="#palestra" role="tab" aria-controls="palestra" aria-selected="false">Palestra</a>
            </li>
        </ul>
    </div>

    <div class="col-sm-12">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="curso-presencial" role="tabpanel" aria-labelledby="curso-presencial-tab">
                <form id="form_curso_presencial" action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="modality" value="Curso Presencial">
                    <input type="hidden" name="identify" value="Registro de atividades">
                    <input type="hidden" name="status" value="wait">
                    <?php $show_descript = "$('#form_curso_presencial').find('#course_address')"; ?>
                    <?php $show_address = "$('#form_curso_presencial').find('#information_activitie')"; ?>
                    <?php $show_information_activie = "$('#form_curso_presencial').find('#information_panelist')"; ?>
                    <?php $show_information_panelist = "$('#form_curso_presencial').find('#accept_terms')"; ?>
                    <?php include(constant("cFrontComponents") . "register-activies/curso-presencial.php"); ?>
                </form>
            </div>

            <div class="tab-pane fade" id="curso-a-distancia" role="tabpanel" aria-labelledby="curso-a-distancia-tab" style=" border-top: solid #007111; border-top-left-radius: 7px; border-top-right-radius: 7px;">
                <div class="col-sm-12 mt-1">
                    <p class="h5" style="font-size: 21px; font-weight: 400; color: rgb(85, 85, 85); font-family: Montserrat;line-height: 1.5;margin:0px">Qual tipo de modalidade é o Curso a distância?</p>
                    <hr>
                </div>
                <div class="col-sm-12">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" id="disponibilizar-dentro-da-plataforma-tab" data-toggle="pill" href="#disponibilizar-dentro-da-plataforma" role="tab" aria-controls="disponibilizar-dentro-da-plataforma" aria-selected="false">Disponibilizar dentro da Plataforma <br> Planejar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" id="disponibilizado-na-plataforma-parceiro-integracao-tab" data-toggle="pill" href="#disponibilizado-na-plataforma-parceiro-integracao" role="tab" aria-controls="disponibilizado-na-plataforma-parceiro-integracao" aria-selected="false">Disponibilizado na plataforma do parceiro <br> (via integração)</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center" id="disponibilizado-na-plataforma-parceiro-voucher-tab" data-toggle="pill" href="#disponibilizado-na-plataforma-parceiro-voucher" role="tab" aria-controls="disponibilizado-na-plataforma-parceiro-voucher" aria-selected="false">Disponibilizar na plataforma do parceiro <br> (via voucher)</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade d-none" id="disponibilizar-dentro-da-plataforma" role="tabpanel" aria-labelledby="disponibilizar-dentro-da-plataforma-tab">
                           
                        <form id="form_curso_a_distancia_disponibilizar-dentro-da-plataforma" action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="modality" value="Curso à Distancia">
                            <input type="hidden" name="identify" value="Registro de atividades">
                            <input type="hidden" name="status" value="wait">
                            <input type="hidden" name="type" value="disponibilizar-dentro-da-plataforma">
                            <?php $show_descript = "$('#form_curso_a_distancia_disponibilizar-dentro-da-plataforma').find('#course_link')"; ?>
                            <?php $show_course_link = "$('#form_curso_a_distancia_disponibilizar-dentro-da-plataforma').find('#information_activitie')"; ?>
                            <?php $show_information_activie = "$('#form_curso_a_distancia_disponibilizar-dentro-da-plataforma').find('#information_panelist')"; ?>
                            <?php $show_information_panelist = "$('#form_curso_a_distancia_disponibilizar-dentro-da-plataforma').find('#accept_terms')"; ?>
                            <?php include(constant("cFrontComponents") . "register-activies/curso-distancia-disponibilizar-dentro-da-plataforma.php");  ?>
                            </form>
                        </div>

                        <div class="tab-pane fade d-none" id="disponibilizado-na-plataforma-parceiro-integracao" role="tabpanel" aria-labelledby="disponibilizado-na-plataforma-parceiro-integracao-tab">
                            <form   id="form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao"  action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="modality" value="Curso à Distancia">
                                <input type="hidden" name="identify" value="Registro de atividades">
                                <input type="hidden" name="status" value="wait">
                                <input type="hidden" name="type" value="disponibilizado-na-plataforma-parceiro-integracao">
                                <?php $show_descript = "$('#form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao').find('#course_link')"; ?>
                                <?php $show_course_link = "$('#form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao').find('#information_activitie')"; ?>
                                <?php $show_information_activie = "$('#form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao').find('#information_panelist')"; ?>
                                <?php $show_information_panelist = "$('#form_curso_a_distancia_disponibilizado-na-plataforma-parceiro-integracao').find('#accept_terms')"; ?>
                                <?php include(constant("cFrontComponents") . "register-activies/curso-distancia-disponibilizado-na-plataforma-parceiro-integracao.php");  ?>
                            </form>
                        </div>

                        <div class="tab-pane fade d-none" id="disponibilizado-na-plataforma-parceiro-voucher" role="tabpanel" aria-labelledby="disponibilizado-na-plataforma-parceiro-voucher-tab">
                            Disponibilizar na plataforma do parceiro (via voucher)
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="curso-hibrido" role="tabpanel" aria-labelledby="curso-hibrido-tab" style=" border-top: solid #077111; border-top-left-radius: 7px; border-top-right-radius: 7px;">
                <form id="form_curso_hibrido" action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="modality" value="Curso Hibrido">
                    <input type="hidden" name="identify" value="Registro de atividades">
                    <input type="hidden" name="status" value="wait">
                    <?php $show_descript = "$('#form_curso_hibrido').find('#course_address')"; ?>
                    <?php $show_address = "$('#form_curso_hibrido').find('#information_activitie')"; ?>
                    <?php $show_information_activie = "$('#form_curso_hibrido').find('#information_panelist')"; ?>
                    <?php $show_information_panelist = "$('#form_curso_hibrido').find('#coffee_brake')"; ?>
                    <?php $show_coffee_brake = "$('#form_curso_hibrido').find('#times_and_moviments')"; ?>
                    <?php $show_times_and_moviments = "$('#form_curso_hibrido').find('#infrastructure')"; ?>
                    <?php $show_infrastructure = "$('#form_curso_hibrido').find('#accept_terms')"; ?>
                    <?php include(constant("cFrontComponents") . "register-activies/curso-hibrido.php"); ?>
                </form>
            </div>
            <div class="tab-pane fade" id="videos-live" role="tabpanel" aria-labelledby="videos-live-tab" style=" border-top: solid #007111; border-top-left-radius: 7px; border-top-right-radius: 7px;">
                <form id="form_videos_live" action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="modality" value="Video/Live">
                    <input type="hidden" name="identify" value="Registro de atividades">
                    <input type="hidden" name="status" value="wait">
                    <?php $show_descript = "$('#form_videos_live').find('#course_link')"; ?>
                    <?php $show_course_link = "$('#form_videos_live').find('#information_activitie')"; ?>
                    <?php $show_information_activie = "$('#form_videos_live').find('#information_panelist')"; ?>
                    <?php $show_information_panelist = "$('#form_videos_live').find('#accept_terms')"; ?>
                    <?php include(constant("cFrontComponents") . "register-activies/curso-video-live.php");  ?>
                </form>
            </div>
            <div class="tab-pane fade" id="palestra" role="tabpanel" aria-labelledby="palestra-tab" style=" border-top: solid #007111; border-top-left-radius: 7px; border-top-right-radius: 7px;">
                <form id="form_curso_palestra" action="<?php print($GLOBALS["novoregistrodeatividade_url"]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="modality" value="Palestra">
                    <input type="hidden" name="identify" value="Registro de atividades">
                    <input type="hidden" name="status" value="wait">
                        <?php $show_descript = "$('#form_curso_palestra').find('#course_address')"; ?>
                        <?php $show_address = "$('#form_curso_palestra').find('#information_activitie')"; ?>
                        <?php $show_information_activie = "$('#form_curso_palestra').find('#information_panelist')"; ?>
                        <?php $show_information_panelist = "$('#form_curso_palestra').find('#accept_terms')"; ?>
                        <?php include(constant("cFrontComponents") . "register-activies/curso-palestra.php"); ?>
                    </form>
            </div>
        </div>
    </div>
</div>

<style>
    #pills-tab {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    #pills-tab li.nav-item a.nav-link{
        border: 1px solid #007111;
        cursor: pointer;
        padding: 20px 10px;
        font-size: 12px;
        transition: all 400ms ease-in-out;
        font-weight: 600;
        border-radius: 5px;
        color: #007111;
    }
    #pills-tab li.nav-item a.active,#pills-tab li.nav-item a:hover{
        color: #ffffff;
        background-color: #007111;
    }
    .tab-show{
        display: block;
    }
    .tab-hide{
        display: none;
    }

    .with-border{
        border: solid 1px red;
    }
    .icon-hide{
        display:none;
    }

    .custom-checkbox input[type="checkbox"],
            .custom-checkbox .checked {
        display: none;
    }

    .custom-checkbox input[type="checkbox"]:checked ~ .checked
    {
        display: inline-block;
        color: red;
    }

    .custom-checkbox input[type="checkbox"]:checked ~ .unchecked
    {
        display: none;
    }

    .card-orange{
        background-
    }
</style>