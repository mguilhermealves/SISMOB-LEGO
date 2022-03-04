<?php 
$forum = forum_controller::display_in_section($info);
 ?>


<!-- Container Begin -->
<div class="row">
    <div class="col-lg-12" style="overflow: auto;padding-left: 0px;">
        <table class="table table-striped table-inverse table-hover">
            <thead>
                <tr>
                    <th>Tópico do Fórum</th>
                    <th width="40%">Ação</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>&nbsp;</th>
                    <th>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm mx-auto" data-toggle="modal" data-target="#novoCadastroforum">
                            Novo Tópico
                        </button>
                                    
                        <!-- Modal -->
                        <div class="modal fade" id="novoCadastroforum" tabindex="-1" role="dialog" aria-labelledby="novoCadastroLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="novoCadastroLabel">Novo Tópico</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                    <?php include(constant("cFrontComponents") . "sections-tab/modal-forum.php");  ?>

                                </div>
                            </div>
                        </div>

                    </th>
                </tr>
            </tfoot>
            <tbody>
            <?php 
            if(isset($data["forum_attach"])){
                $forum = isset($data["forum_attach"]) ? $data["forum_attach"] : [];
                $idxedit = 0; 
                foreach( $forum as $v){ 
                    $idxedit = $v["idx"];  
            ?>
            <tr>
                <td><?php print( $v["title"] ) ?></td>                               
                <td>
                    <button style="border-radius: 15px;" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#editarCadastroForum_<?php print( $v["idx"] ) ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> editar</button> 
                    <a style="border-radius: 15px;"  id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-outline-danger btn-sm" href="<?php printf( $GLOBALS["new_forum_url"] , $v["idx"] ) ?>"><i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
                    <!-- Modal -->
                    <div class="modal fade" id="editarCadastroForum_<?php print( $v["idx"] )?>" tabindex="-1" role="dialog" aria-labelledby="editarCadastroForumLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarCadastroForumLabel">Editar Fórum</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                            <?php include(constant("cFrontComponents") . "sections-tab/modal-forum.php");  ?>

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