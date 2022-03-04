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
                    if( isset( $surveyquestions_id ) ){
                    ?>
                    <input type="hidden" id="surveyquestions_id" name="surveyquestions_id" value="<?php print( $surveyquestions_id  ) ?>">
                    <?php
                    }
                    ?>

                    <div class="container-fluid bxs_user">
                        <div class="header" style="margin-bottom:30px">Dados</div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        Id Externo </label>
                                        <input type="text" class="form-control"  name="external_id" value="<?php print( isset( $data["external_id"] ) ? $data["external_id"] : "" ) ?>">                                   
                                </div> 
                                <div class="col-lg-6">
                                    <label>
                                        Posição  </label>
                                        <input type="text" class="form-control" name="display_position" value="<?php print( isset( $data["display_position"] ) ? $data["display_position"] : "" ) ?>">
                                  
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                        <label>
                                            Titulo </label>
                                            <textarea name="title" class="form-control editor"><?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?></textarea>  
                                    </div>                                   
                                </div>


                            </div>

                            

                      

                                
                        </div>                            
                        

                    <div style="display: flex;justify-content: space-evenly; padding-top:15px">
                        <div class="large-4 columns">
                            <a href="<?php printf($GLOBALS["surveyquestion_url"] , $surveyquestions_id) ?>" class="round hollow button secondary" >Voltar</a>
                        </div>
                        <div class="large-7 columns">
                            <button type="submit" class="pull-right round hollow button secondary" name="btn_save">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
</div>





<style>
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
</style>