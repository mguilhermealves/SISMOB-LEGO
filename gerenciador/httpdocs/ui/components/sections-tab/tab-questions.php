<?php 
$info["test_id"] = $v["idx"]; 
$tests = questions_controller::display_in_tests_tab($info);
?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table">
            <thead>
                <tr>
                    <th>Enunciado da Questão</th>
                    <th width="50%" >
                        <button style="border-radius: 15px; float: right;" type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastroquestions_<?php print($v["idx"]) ?>">
                            Nova Questão
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastroquestions_<?php print($v["idx"]) ?>" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Questão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-question.php");  ?>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(isset($tests[0]["questions_attach"])){
                    $questions = isset($tests[0]["questions_attach"]) ? $tests[0]["questions_attach"] : []; 
                    $idxedit = 0; 
                    foreach( $questions as $k => $v){ 
                        $idxedit = $v["idx"]; 
                ?>
                <tr>
                    <td colspan="2">
                         
                        <?php printf( '%02d ) Questão<br><i class="bi bi-arrow-return-right"></i> (%s / %s )' ,  ( $k + 1 ),  $v["status"] , $v["type"] ); ?>
                    
                        <div class="row" style="justify-content:flex-end">
                            <button style="border-radius: 15px;" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastroQuestion_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button> 
                            <?php
                            if( $v["type"] != "dissertativa" ){
                            ?>
                            <button style="border-radius: 15px;" type="button" class="btn button btn-outline-secondary btn-sm" data-toggle="collapse" href="#collapseAlternatives_<?php print( $v["idx"] ) ?>" role="button" aria-expanded="false" ><i class="fa fa-cog" aria-hidden="true"></i> Alternativas</button>
                            <?php }?>
                            <a style="border-radius: 15px;"  id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["question_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
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
                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-question.php");  ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="no-border" colspan="2">
                        <div class="collapse " id="collapseAlternatives_<?php print( $v["idx"] ) ?>">
                            <div class="card card-body">
                                <?php include(constant("cFrontComponents") . "sections-tab/tab-alternatives.php");  ?>                                                      
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
<style>
.modal-lg {
    max-width: 80%;
}
.button{
    margin:0 5px;
}
td.no-border{
    border:0 !important;
}
    .label-modal-body{ 
        font-family: "Montserrat", "Roboto", "Helvetica", "Arial", sans-serif; 
        color: #707070;
        font-weight: 600;
    }
</style>