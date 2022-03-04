<!-- Container Begin -->
<div class="row">

        <div class="container-fluid box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( $form["title"] ) ?></span>
                </h3>
            </div>
        </div>

        <div class="container-fluid box solaris-head">
            <div class="box-body">
                <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                    <?php
                    if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                    ?>
                    <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                    <?php
                    }
                    ?>

                    <div class="container-fluid bxs_user">
                        <div class="header" style="margin-bottom:30px">Dados</div>
                        
                          
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                    Título</label>
                                        <input type="text" class="form-control"  name="title" value="<?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?>">
                                    
                                </div>
                                <div class="col-lg-3">
                                    <label>
                                        Id Externo  </label>
                                        <input type="text" class="form-control" name="external_id" value="<?php print( isset( $data["external_id"] ) ? $data["external_id"] : "" ) ?>">                                  
                                </div>
                                <div class="col-lg-3">
                                    <label>
                                        Posição  </label>
                                        <input type="text" class="form-control" name="display_position" value="<?php print( isset( $data["display_position"] ) ? $data["display_position"] : "" ) ?>">                                  
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        Descrição </label>
                                        <textarea name="description" class="form-control editor"><?php print( isset( $data["description"] ) ? $data["description"] : "" ) ?></textarea>
                                   
                                </div>

                                <div class="col-lg-6">
                                    <label>
                                        Status </label>
                                        <select name="status" id="status" class="form-control">
                                            <?php 
                                                foreach( $GLOBALS["display_status_list"] as $k => $v ){
                                                    printf('<option %s value="%s">%s</option>' , isset(  $data["status"] ) && $k ==  $data["status"] ? ' selected' : '' , $v , $v ) ;
                                                }
                                            ?>
                                        </select> 

                                </div>                            
                            </div>



                            <div class="row">
                                <div class="col-lg-3">
                                    <label>
                                        Questões em ordem randomica? </label><br/>
                                        <label> <input type="radio" class="form-control" name="surveyquestions_random_order" value="yes" <?php print( isset( $data["surveyquestions_random_order"] ) && $data["surveyquestions_random_order"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label> <input type="radio" class="form-control" name="surveyquestions_random_order" value="no" <?php print( isset( $data["surveyquestions_random_order"] ) && $data["surveyquestions_random_order"] == "no" ? "checked='checked'" : "" ) ?>> Não </label>  
                                </div>  
                                <div class="col-lg-3">
                                    <label>
                                        Data Início </label>
                                        <input type="text" class="form-control datepicker"  name="start_at" value="<?php print( isset( $data["start_at"] ) ? $data["start_at"] : "" ) ?>">
                                   
                                </div>   
                                <div class="col-lg-3">
                                    <label>
                                        Data Fim </label>
                                        <input type="text" class="form-control datepicker"  name="end_at" value="<?php print( isset( $data["end_at"] ) ? $data["end_at"] : "" ) ?>">
                                   
                                </div>  
                                <div class="col-lg-3">
                                    <label>
                                        Quantidade de Tentativas </label>
                                        <input type="text" class="form-control"  name="qtd_attempts" value="<?php print( isset( $data["qtd_attempts"] ) ? $data["qtd_attempts"] : "" ) ?>">
                                   
                                </div>  
                            </div>


                                                                                                             
                        
                    </div>

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php print( $info["get"]["done"] ) ?>" class="round hollow button secondary" >Voltar</a>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>    
</div>


<?php if(isset($data["idx"])){ ?>

<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Questões</span>
                </h3>
            </div>

            <a class="btn button bg-gray round" title="Incluir" href="<?php printf( $GLOBALS["newsurveyquestion_url"], $data["idx"] ) ?>"><i class="fontello-plus"></i>Nova Questão</a>

        </div>

        <?php if(isset($data["surveyquestions_attach"])){

               $surveyquestions = isset($data["surveyquestions_attach"]) ? $data["surveyquestions_attach"] : []; ?>

                <div class="box solaris-head">
                    <div class="box-body">
                        <div id="solaris-head-data">
                            <table class="table large-12 columns">
                                <thead>
                                    <tr>
                                        <th>Título da Pílula</th>
                                    
                                        <th width="20%">Ação</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach( $surveyquestions as $v){ ?>
                                    <tr>
                                        <td><?php print( $v["title"] ) ?></td>                               
                                        <td><a class="btn button btn-info" href="<?php printf( $GLOBALS["surveyquestion_url"] , $v["idx"] ) ?>">[ editar ]</a> 
                                        <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $GLOBALS["surveyquestion_url"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            <table>
                        </div>
                    </div>
                </div>

        <?php } ?>


     </div>
</div>

<?php } ?>

<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>