<section>
    <?php include( constant("cRootServer") . "ui/includes/banner.php"); ?>
    <?php 
    foreach ($trails as $trail) { 
        $cont = 1;
    ?>
        <div class="container-fluid treinamento">
            <div class="row">
                <div class="col-12">
                    <h1><?php printf(isset($trail) ? $trail["trail_title"] : ""); ?></h1>
                </div>
            </div>

            <?php if (isset($trail["courses_attach"])) { ?>
                <div class="card-treinamentos">
                    <?php 
                    foreach ($trail["courses_attach"] as $course) { 
                        $progress = course_controller::verifyAllprogress($course["idx"]);
                    ?>
                        <div class="card1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <?php 
                                        if( $trail["display_number"] == "yes") { 
                                        ?>
                                            <svg width="200" height="100%">
                                                <text fill="#e8e8e8" fill-opacity="0.7" font-size="200" x="50" y="150" text-anchor="middle" stroke="#707070" stroke-width="4">
                                                    <?php echo $cont; ?>
                                                </text>
                                            </svg>
                                        <?php 
                                            $cont++;
                                        } 
                                        ?>
                                        <img class="card-img-top img-treinamento" src="<?php printf("%s%s", constant("cFrontend"), $course["course_img_url"]) ?>" alt="">
                                        <div class="card-body p-0">
                                            <h2 class="card-title"><?php echo $course["course_public_title"] ?></h2>
                                            <p class="card-text" style="font-size: 0.75rem; text-align: justify; overflow: hidden; text-overflow: ellipsis; padding: 8px;">
                                                <?php echo $course["course_resume"] ?>
                                            </p>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row center">
                                                        <div class="col-sm-6 border-progress">
                                                            <div class="progress">
                                                                <div class="progress-bar" style="width: <?php print( $progress ) ?>%;"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-right py-1">
                                                                <a style="width: 115px;overflow: hidden;display:block;float: right; text-align:center;" href="/curso/<?php print($course["slug"]) ?>" class="btn btn-primary btn-sm btn-access botao-acessar px-0"><?php print( $progress == 0 ? 'Iniciar' : ( $progress >= 100 ? 'Rever' : 'Continuar' ) ) ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php 
    } 
    ?>
    <?php 
    $libraries_controller = new libraries_controller();
    $libraries_controller->biblioteca(array("format" => ".partial")) ; 
    ?>

</section>