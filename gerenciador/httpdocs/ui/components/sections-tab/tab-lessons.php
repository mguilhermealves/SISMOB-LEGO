<?php $lessons = lessons_controller::display_in_section($info); ?>

<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table table-striped table-inverse table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>Título da Aula</th>
                    <th>Status</th>
                    <th width="20%">
                        <button style="border-radius: 15px; float: right;" type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastrolesson">
                            Nova Aula
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastrolesson" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="novoCadastroLabel">Cadastrar Nova Aula</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-lesson.php");  ?>
                                </div>
                            </div>
                        </div></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $idxedit = 0; 
                    if(isset($data["lessons_attach"])){
                        $lessons = isset($data["lessons_attach"]) ? $data["lessons_attach"] : []; 
                        foreach( $lessons as $v){ 
                            $idxedit = $v["idx"]; 
                ?>
                    <tr>
                        <td><?php print( $v["lessons_title"] ) ?></td>      
                        <td><?php print( $v["lessons_status"] ) ?></td>                               
                        <td>
                            <button style="border-radius: 15px; float: right;"  type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastro_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button> 
                            <!-- a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $GLOBALS["lesson_url"] , $v["idx"] ) ?>">[ excluir ]</a-->                                             
                            <!-- Modal -->
                            <div class="modal fade" id="editarCadastro_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarCadastroLabel">Editar Aula</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <?php include(constant("cFrontComponents") . "sections-tab/modal-lesson.php");  ?>

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
    .label-modal-body{ 
        font-family: "Montserrat", "Roboto", "Helvetica", "Arial", sans-serif; 
        color: #707070;
        font-weight: 600;
    }
</style>