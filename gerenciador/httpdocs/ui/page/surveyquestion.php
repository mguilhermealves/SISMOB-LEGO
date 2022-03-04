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
                    <?php
                    if( isset( $surveys_id ) ){
                    ?>
                    <input type="hidden" id="surveys_id" name="surveys_id" value="<?php print( $surveys_id  ) ?>">
                    <?php
                    }
                    ?>

                    <div class="container-fluid bxs_user">
                        <div class="header" style="margin-bottom:30px">Dados</div>

                            <div class="row">
                                <div class="col-lg-4">
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
                                <div class="col-lg-4">
                                    <label>
                                        Id Externo </label>
                                        <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $data["external_id"] ) ? $data["external_id"] : "" ) ?>">                                   
                                </div> 
                                <div class="col-lg-4">
                                    <label>
                                        Posição  </label>
                                        <input type="text" class="form-control" name="display_position" value="<?php print( isset( $data["display_position"] ) ? $data["display_position"] : "" ) ?>">
                                  
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                        <label>
                                            Titulo </label>
                                            <textarea name="title" class="form-control editor"><?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?></textarea>  
                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                            Justificativa </label>
                                            <textarea name="justification" class="form-control editor"><?php print( isset( $data["justification"] ) ? $data["justification"] : "" ) ?></textarea>   
                                    </div>
                                </div>

                                <div class="row">                               
                                    <div class="col-lg-6">
                                        <label>
                                        Tipo </label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="alternativa" <?php print( isset( $data["type"] ) && $data["type"] == "alternativa" ? "selected='selected'" : "" ) ?>>Alternativa</option>
                                                <option value="dicotomia" <?php print( isset( $data["type"] ) && $data["type"] == "dicotomia" ? "selected='selected'" : "" ) ?>>Dicotomia</option>                                            
                                                <option value="verdeiro_falso" <?php print( isset( $data["type"] ) && $data["type"] == "verdeiro_falso" ?"selected='selected'" : "" ) ?>>Verdadeiro/Falso</option>                                           
                                                <option value="texto" <?php print( isset( $data["type"] ) && $data["type"] == "texto" ?"selected='selected'" : "" ) ?>>Texto</option>                                           
                                            </select> 
                                    </div>
                                    <div class="col-lg-6">
                                        <label>
                                            Alternativas em ordem randomica? </label><br/>
                                            <label> <input type="radio" class="form-control" name="show_random_alternatives" value="yes" <?php print( isset( $data["show_random_alternatives"] ) && $data["show_random_alternatives"] == "yes" ? "checked='checked'" : "" ) ?>> Sim  </label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> <input type="radio" class="form-control" name="show_random_alternatives" value="no" <?php print( isset( $data["show_random_alternatives"] ) && $data["show_random_alternatives"] == "no" ? "checked='checked'" : "" ) ?>> Não </label>
                                    </div>
                                </div>

                            </div>

                                
                        </div>                            
                        

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php printf($GLOBALS["survey_url"] , $surveys_id) ?>" class="round hollow button secondary" >Voltar</a>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
</div>


<?php if(isset($data["idx"])){ ?>

<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Alternativas</span>
                </h3>
            </div>

            <a class="btn button bg-gray round" title="Incluir" href="<?php printf( $GLOBALS["newsurveyalternative_url"], $data["idx"] ) ?>"><i class="fontello-plus"></i>Nova Alternativa</a>

        </div>

        <?php if(isset($data["surveyalternatives_attach"])){

               $surveyalternatives = isset($data["surveyalternatives_attach"]) ? $data["surveyalternatives_attach"] : []; ?>

                <div class="box solaris-head">
                    <div class="box-body">
                        <div id="solaris-head-data">
                            <table class="table large-12 columns">
                                <thead>
                                    <tr>
                                        <th>Título da Alternativa</th>
                                    
                                        <th width="20%">Ação</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach( $surveyalternatives as $v){ ?>
                                    <tr>
                                        <td><?php print( $v["title"] ) ?></td>                               
                                        <td><a class="btn button btn-info" href="<?php printf( $GLOBALS["surveyalternative_url"] , $v["idx"] ) ?>">[ editar ]</a> 
                                        <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $GLOBALS["surveyalternative_url"] , $v["idx"] ) ?>">[ excluir ]</a></td>
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