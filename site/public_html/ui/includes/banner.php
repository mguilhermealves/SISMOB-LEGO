
    <?php 
    if( isset( $banners ) && count( $banners ) ){
    ?>
    <div class="container-fluid">
        <div id="mainSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                    foreach( $banners as $k => $b){
                ?>
                <div class="carousel-item<?php print( $k == 0 ? ' active' : '' ) ?>">
                    <img class="w-100" src="<?php printf("%s%s", constant("cFrontend"), $b["img"] ) ?>" alt="<?php print( $b["name"] ) ?>" />
                </div>
                <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-ridden='true'></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-ridden='true'></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <?php
    }
    ?>