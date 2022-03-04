<div class="container-fluid my-5 lms-content treinamento1">
    <div class="container">
        <h1 class="border-bottom p-0 mb-4">Treinamentos</h1>
        <div class="d-flex justify-content-baseline align-items-center py-3">
            <img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/treinamentos/icon-wikipet.png") ?>" class="flex-shrink-0 me-3">
            <div>
                <h3><?php printf($data["trail_title"]) ?></h3>
            </div>
        </div>
        <div class="row">
            <?php foreach($data["courses_attach"] as $k=>$v){ ?>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="newsCard news-Slide-up">
                                <a aria-labelledby="person1" href="<?php printf( $GLOBALS["curso_url"] , $v["slug"]) ?>">
                                    <img class="img-fluid" src="<?php printf("%s%s", constant("cFrontend"), $v["course_img_url"]) ?>" class="flex-shrink-0 me-3">
                                    <div class="newsCaption">
                                        <h6><?php printf($v["course_public_title"]) ?></h6>
                                        <div class="newsCaption-content">
                                            <p><?php printf($v["course_img_text"]) ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="progress my-2">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">66%</div>
                            </div>
                            <div class="card p-3">
                                <p><?php printf($v["course_resume"]) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>