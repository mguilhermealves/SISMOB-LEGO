<div class="container-fluid my-5 lms-content">
    <div class="container treinamentos">
        <h1 class="border-bottom p-0 mb-4">Treinamentos</h1>
        <div class="row">

            <?php foreach($trails as $trail){
            ?>
                <div class="col-lg-4 px-2">    
                    <a href="<?php printf( $GLOBALS["treinamento_url" ] ,$trail["slug"]) ?>">
                        <div class="d-flex justify-content-baseline align-items-center p-3 card-treinamento">
                            <img class="img-fluid m-4" src="<?php printf("%s%s", constant("cFurniture"), "images/treinamentos/icon-wikipet.png") ?>" class="flex-shrink-0 me-3">
                            <div class="d-flex align-items-center w-75">
                                <h3><?php printf( $trail["trail_title"] ) ?></h3>
                            </div>
                        </div>
                    </a>
                </div>          
            <?php } ?>

        </div>
    </div>
</div>