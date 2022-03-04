<?php $surveys = surveys_controller::display_in_section($info); ?>


<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título da Pesquisa</th>
                    <th>Status</th>
                    <th width="40%">Ação</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="2">&nbsp;</th>
                    <th>
                        <button type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastrosurveys">
                            Nova Pesquisa
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastrosurveys" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Pesquisa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-survey.php");  ?>

                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                if(isset($data["surveys_attach"])){
                    $surveys = isset($data["surveys_attach"]) ? $data["surveys_attach"] : []; 
                    $idxedit = 0; 
                    foreach( $surveys as $v){ 
                        $idxedit = $v["idx"]; 
                ?>
                <tr>
                    <td><?php print( $v["title"] ) ?></td>     
                    <td><?php print( $v["status"] ) ?></td>                               
                    <td>
                        <div class="row">
                            <button style="border-radius: 15px;" type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#editarCadastrosurvey_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button> 
                            <button style="border-radius: 15px;" type="button" class="btn button btn-outline-warning btn-sm"data-toggle="collapse" href="#collapseQuestions_<?php print( $v["idx"] ) ?>" role="button" aria-expanded="false" ><i class="fa fa-question" aria-hidden="true"></i> Questões</button>
                            <a style="border-radius: 15px;" id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-outline-danger btn-sm"  href="<?php printf( $GLOBALS["survey_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>                                                   
                        </div> 
                        <!-- Modal -->
                        <div class="modal fade" id="editarCadastrosurvey_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastrosurveyLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarCadastrosurveyLabel">Editar Pesquisa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-survey.php");  ?>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="no-border" colspan="3">
                        <div class="collapse " id="collapseQuestions_<?php print( $v["idx"] ) ?>">
                            <div class="card card-body">
                                <?php include(constant("cFrontComponents") . "sections-tab/tab-surveyquestions.php");  ?>                                                      
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>