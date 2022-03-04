<?php 
$info["survey_id"] = $v["idx"]; 
$surveys = surveyquestions_controller::display_in_surveys_tab($info); 
?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table">
            <thead>
                <tr>
                    <th>Enunciado da Questão</th>
                    <th width="50%">

                        <button type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastrosurveyquestions_<?php print($v["idx"]) ?>">
                            Nova Questão
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastrosurveyquestions_<?php print($v["idx"]) ?>" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Questão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-surveyquestion.php");  ?>

                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if(isset($surveys[0]["surveyquestions_attach"])){
                    $surveyquestions = isset($surveys[0]["surveyquestions_attach"]) ? $surveys[0]["surveyquestions_attach"] : []; 
                    $idxedit = 0; 
                    foreach( $surveyquestions as $v){ 
                        $idxedit = $v["idx"]; 
            ?>
                <tr>
                    <td colspan="2"><i class="bi bi-arrow-return-right"></i> <?php print( $v["title"] ) ?>
                        <div class="row" style="justify-content:flex-end">
                            <button style="border-radius: 15px;" type="button" class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#editarCadastroQuestion_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button> 
                            <button style="border-radius: 15px;" type="button" class="btn button btn-outline-secondary btn-sm" data-toggle="collapse" href="#collapseAlternatives_<?php print( $v["idx"] ) ?>" role="button" aria-expanded="false" ><i class="fa fa-cog" aria-hidden="true"></i> Alternativas</button>
                            <a style="border-radius: 15px;" id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["surveyquestion_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>                                                   
                        </div>                                                                                           
                
                        <!-- Modal -->
                        <div class="modal fade" id="editarCadastroQuestion_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroAlternativesLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarCadastroLabel">Editar Questão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-surveyquestion.php");  ?>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="no-border" colspan="2">
                        <div class="collapse " id="collapseAlternatives_<?php print( $v["idx"] ) ?>">
                            <div class="card card-body">
                                <?php include(constant("cFrontComponents") . "sections-tab/tab-surveyalternatives.php");  ?>                                                      
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
