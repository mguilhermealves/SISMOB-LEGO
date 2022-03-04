<?php $tests = tests_controller::display_in_section($info); ?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título da Avaliação</th>
                    <th>Status</th>
                    <th width="30%">
                        <button style="border-radius: 15px; float: right;" type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastrotests">
                            Nova Avaliação
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastrotests" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Nova Avaliação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-test.php");  ?>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $idxedit = 0; 
                    if(isset($data["tests_attach"])){
                        $tests = isset($data["tests_attach"]) ? $data["tests_attach"] : [];
                        foreach( $tests as $v){ 
                            $idxedit = $v["idx"]; 
                ?>
                <tr>
                    <td><?php print( $v["title"] ) ?></td>    
                    <td><?php print( $v["status"] ) ?></td>                               
                    <td>
                        <div class="row">
                            <button style="border-radius: 15px;" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastroTest_<?php print( $v["idx"] ) ?>" title="Editar" ><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button> 
                            <button style="border-radius: 15px;" type="button" class="btn button btn-outline-warning btn-sm" data-toggle="collapse" href="#collapseQuestions_<?php print( $v["idx"] ) ?>" role="button" aria-expanded="false" title="Questões" ><i class="fa fa-question" aria-hidden="true"></i> Questões</button>
                            <!-- a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $GLOBALS["test_url"] , $v["idx"] ) ?>">[ excluir ]</a-->                                                   
                        </div>                
                        <!-- Modal -->
                        <div class="modal fade" id="editarCadastroTest_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroTestLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarCadastroTestLabel">Editar Avaliação</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-test.php");  ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="no-border p-0" colspan="3">
                        <div class="collapse " id="collapseQuestions_<?php print( $v["idx"] ) ?>">
                            <div class="card card-body">
                                <?php include(constant("cFrontComponents") . "sections-tab/tab-questions.php");  ?>                                                      
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
</style>