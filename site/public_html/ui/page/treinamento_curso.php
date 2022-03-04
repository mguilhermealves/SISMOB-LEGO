<div class="container-fluid wiki-content">
    <div class="container">
        <div class="card text-white">
            <img class="img-fluid card-img-top" src="
            <?php isset($data["course_img_url"]) ? printf("%s%s", constant("cFrontend"), $data["course_img_url"]) : printf("%s%s", constant("cFurniture"), "images/treinamentos/imagem_curso.png")  ?>" class="flex-shrink-0 me-3">
            <div class="card-img-overlay">
                <h2 class="card-title"><?php printf($data["course_public_title"]) ?></h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xs-12 col-md-12 col-lg-9">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-md-12 col-lg-9 d-flex justify-content-between align-items-center">
                        <div class="p-2">
                            <h1><span>Conteúdo</span></h1>
                        </div>
                        <div class="p-2"><a class="btn lms-button-danger" href="/conteudo-treinamento/<?php printf($data["slug"]) ?>/iniciar">COMEÇAR</a></div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-9 my-5">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-3">
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <?php foreach($data["sections_attach"] as $section){ 
                                    $content_section = course_controller::contents_section($section);                                   
                                    ?>
                                    <div class="list-group-item lms-bg-color" aria-current="true"><?php print($section["section_title"]) ?></div>
                                    <ul class="list-group list-unstyled">
                                        <?php foreach($content_section as $content){ 
                                            $complete = course_controller::verifyprogress($content["type"],$content["idx"]);	                                           	
                                            ?>
                                            <li>
                                                <a class="list-group-item <?php print($complete?'completo':'') ?>" href="<?php printf( $GLOBALS["cursoconteudo_url"] , $data["slug"] , $content["type"] , $content["idx"] ) ?>">
                                                    <?php print($content["title"]) ?> 
                                                    <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="fill: <?php print( $complete ? "#028101;" : "rgb(204, 204, 204);" ) ?> width:25px; float:right">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                                    </svg>                    
                                                </a>
                                            </li>
                                        <?php } ?>                                        
                                    </ul>
                                <?php } ?>
                            </div>                                                   
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-3">
                <div class="my-5 instructor">
                    <h2>Instrutor</h2>
                    <div class="d-flex justify-content-baseline align-items-center">
                        <div><img src="<?php printf("%s%s", constant("cFurniture"), "images/treinamentos/imagem_curso.png") ?>" width="60" height="60" alt="..." class="flex-shrink-0 me-3 rounded-circle"></div>
                        <div>
                            <span><b><?php printf(isset($data["instrutor_attach"][0]) ? $data["instrutor_attach"][0]["first_name"] : "") ?></b></span>
                        <br>
                        <span><small>Capacitação Técnico-Científica</small></span></div>
                    </div>
                </div>
                <h1>Progresso</h1>
                <?php $progress = course_controller::verifyAllprogress($data["idx"]); ?>
                <?php include( constant("cRootServer") . "ui/page/course/parts/progress.php"); ?>
            </div>
        </div>
    </div>
</div>