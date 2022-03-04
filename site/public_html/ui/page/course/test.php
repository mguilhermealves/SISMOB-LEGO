<div class="container-fluid iniciar-curso">
    <div class="container my-5">
        <div class="row">
            <div class="<?php print( !isset($info["post"]["init_test"]) && !isset($info["post"]["init_quest"]) ? "col-md-9" : "col-lg-12" ) ?>">
                <h1>Avaliação</h1> 
                <div class="d-flex flex-column"><a href="/curso/<?php printf($course_data["slug"]) ?>">Voltar para: <?php printf($course_data["course_title"]) ?></a></div>
                <div class="row my-5">
                    <div class="col-md-12 justify-content-center mb-5">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-3">
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <p class="MuiTypography-root MuiTypography-body1 text-center" style="font-size: 2rem; font-weight: 600; color: rgb(83, 41, 15);"><?php printf($data["title"]) ?></p>
                            </div>
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                             
                             
                                <input type="hidden" value="<?php print($_SESSION[ constant("cAppKey") ]["credential"]["idx"]); ?>" class="user_id" />
                                <input type="hidden" value="<?php print($data["idx"]) ?>" class="object_id" />
                                <input type="hidden" value="test" class="type" /> 
                                <input type="hidden" value="<?php print($objeto_completo) ?>" class="complete" /> 
                             
                                
                                <?php if(!isset($info["post"]["init_test"])){ ?>
                                    <div class="row">
                                        <div class="col-lg-12 wiki-content text-center">
                                            <form action="<?php printf( $GLOBALS["cursoconteudo_url"] , $course_data["slug"] , 'test' , $data["idx"] ) ?>" method="POST">                               
                                                <input type="hidden" value="true" name="init_test" />  
                                                <button type="submit" class="btn lms-button-danger">FAZER AVALIAÇÃO</button>   
                                            </form>     
                                        </div>
                                    </div>
                                                                              
                                <?php }else if(!isset($info["post"]["init_quest"])){ ?>

                                   
                                        <div class="row">
                                            <div class="col-lg-12 wiki-content text-center">
                                                <?php print($data["description"]); ?>
                                                <br/>
                                                <form action="<?php printf( $GLOBALS["cursoconteudo_url"] , $course_data["slug"] , 'test' , $data["idx"] ) ?>" method="POST">            
                                                    <input type="hidden" value="true" name="init_test" />                     
                                                    <input type="hidden" value="true" name="init_quest" />                                                   
                                                    <button type="submit" class="btn lms-button-danger">INICIAR QUESTIONÁRIO <i class="bi bi-chevron-double-right"></i></button>   
                                                </form>     
                                            </div>
                                        </div>
                                <?php }else{ ?>
                                    <?php include( constant("cRootServer") . "ui/page/course/parts/test_questions.php"); ?>
                                <?php } ?>
                               

                                                           
                            </div>
                        </div>
                    </div>                    
                </div>
                <?php include( constant("cRootServer") . "ui/page/course/parts/nav.php"); ?>
            </div>

            <?php if(!isset($info["post"]["init_test"]) && !isset($info["post"]["init_quest"])){ ?>
            <div class="col-md-3 p-3">                
                <?php include( constant("cRootServer") . "ui/page/course/parts/sidebar.php"); ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>