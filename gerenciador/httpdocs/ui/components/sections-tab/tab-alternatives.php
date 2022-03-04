<?php 
$info["question_id"] = $v["idx"]; 
$questions = alternatives_controller::display_in_questions_tab($info); 
?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Título da Alternativa</th>
                    <th>Correta?</th>
                    <th width="30%">
                        <?php if( in_array( $questions[0]["type"] , array( "alternativa" ) ) ){ ?>
                        <button style="border-radius: 15px; float: right;"  type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastroalternatives_<?php print($v["idx"]) ?>">
                            Nova Alternativa
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastroalternatives_<?php print($v["idx"]) ?>" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Alternativa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-alternative.php");  ?>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($questions[0]["alternatives_attach"])){
                    $alternatives = isset($questions[0]["alternatives_attach"]) ? $questions[0]["alternatives_attach"] : [];
                    $idxedit = 0; 
                    foreach( $alternatives as $k => $v){ 
                        $idxedit = $v["idx"]; 
                ?>
                    <tr>
                        <td>
                            <?php print( $GLOBALS["alphabetic_list"][ $k ] . ' ) ' . $v["title"] ) ?></td>  
                        <td><?php print( $GLOBALS["yes_no_lists"][ $v["is_correct"] ] ) ?></td>                              
                        <td>
                            <div class="row">
                                <button style="border-radius: 15px;"  type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastroAlternative_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> editar</button>                                                    
                                <?php if( in_array( $questions[0]["type"] , array( "alternativa" ) ) ){ ?>
                                <a  style="border-radius: 15px;" id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["alternative_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
                                <?php } ?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="editarCadastroAlternative_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroAlternativeLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarCadastroLabel">Editar Alternativa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <?php include(constant("cFrontComponents") . "sections-tab/modal-alternative.php");  ?>

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