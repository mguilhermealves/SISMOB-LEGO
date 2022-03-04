<div class="container-fluid iniciar-curso">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Aula</h1> 
                <div class="d-flex flex-column"><a href="/curso/<?php printf($course_data["slug"]) ?>">Voltar para: <?php printf($course_data["course_title"]) ?></a></div>
                <div class="row my-5">
                    <div class="col-md-12 justify-content-center text-center mb-5">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-3">
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <?php
                                switch( $data["lessons_type"] ){
                                    case "text":
                                        print( $data["lessons_description"] );
                                    break;
                                    default:
                                        ?><iframe data-idcurso="<?php print($data["idx"]) ?>" id="videoSingle" style="height: 480px; width: 100%;" src="/<?php print($data["lessons_content_url"]) ?>?localkey=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-ready="true"></iframe><?php
                                    break;
                                }
                                ?>
                                <input type="hidden" value="<?php print($_SESSION[ constant("cAppKey") ]["credential"]["idx"]); ?>" class="user_id" />
                                <input type="hidden" value="<?php print($data["idx"]) ?>" class="object_id" />
                                <input type="hidden" value="lesson" class="type" /> 
                                <input type="hidden" value="<?php print($objeto_completo) ?>" class="complete" />     
                                                           
                            </div>
                        </div>
                    </div>
                                        
                </div>
                <?php include( constant("cRootServer") . "ui/page/course/parts/nav.php"); ?>

            </div>
            <div class="col-md-3 p-3">
                <?php include( constant("cRootServer") . "ui/page/course/parts/sidebar.php"); ?>
            </div>
        </div>
    </div>
</div>