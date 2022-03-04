<div class="container-fluid">
    <div class="nav-tab">
        <ul class="nav nav-tabs minha-tab" id="myTab" role="tablist">
            <?php
            $x = 0 ;
            foreach( $librariesCategories as $key => $value ){
            ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link botao-nav<?php print( $x == 0 ? ' active' : '' )?>" id="<?php print( $key ) ?>-tab" data-toggle="tab" href="#<?php print( $key ) ?>" role="tab" aria-controls="<?php print( $key ) ?>" aria-selected="true"><?php print( $value ) ?></a>
            </li>
            <?php 
                $x++;
            }
            ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php
            $x = 0 ;
            foreach( $libraries->data as $key => $value ){
            ?>
            <div class="tab-pane fade px-0 row tabela-tab<?php print( $x == 0 ? ' active show' : '' )?>" id="<?php print( $value["external_id"] ) ?>" role="tabpanel" aria-labelledby="<?php print( $value["external_id"] ) ?>-tab" style="background-position:bottom center">
                <?php
                foreach( $value["category_attach"] as $k => $v ){
                ?>
                <a href="<?php printf( $GLOBALS["biblioteca_secao_url"], $v["external_id"] ) ?>"><img class="img-fluid" src="<?php printf( $GLOBALS["staticimg_url"] , $v["ico"] ) ?>" alt="<?php print( $value["name"] ) ?>"></a> 
                <?php
                }
                ?>
            </div>
            <?php
                $x++;
            }
            ?>
        </div>
    </div>
</div>