<?php 
$info["surveyquestion_id"] = $v["idx"]; 
$surveyquestions = surveyalternatives_controller::display_in_surveyquestions_tab($info); 
?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Título da Alternativa</th>
                    <th width="40%">Ação</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>&nbsp;</th>
                    <th>

                        <button type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastrosurveyalternatives_<?php print($v["idx"]) ?>">
                            Nova Alternativa
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastrosurveyalternatives_<?php print($v["idx"]) ?>" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Alternativa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-surveyalternative.php");  ?>

                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if(isset($surveyquestions[0]["surveyalternatives_attach"])){

                    $surveyalternatives = isset($surveyquestions[0]["surveyalternatives_attach"]) ? $surveyquestions[0]["surveyalternatives_attach"] : [];
                    $idxedit = 0; 
                    foreach( $surveyalternatives as $v){ 
                        $idxedit = $v["idx"]; 
                ?>
                <tr>
                    <td><i class="bi bi-check2-circle"></i> <?php print( $v["title"] ) ?></td>  
                                                 
                    <td>
                        <div class="row">
                            <button style="border-radius: 15px;"  type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastrosurveyAlternative_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> editar</button>                                                    
                            <a style="border-radius: 15px;" id="btn_remove_<?php print( $v["idx"] ) ?>"  class="btn button btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["surveyalternative_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="editarCadastrosurveyAlternative_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroAlternativeLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarCadastroLabel">Editar Alternativa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-surveyalternative.php");  ?>

                                </div>
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