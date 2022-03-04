<div class="container-fluid biblioteca-categ">
    <h3>Biblioteca</h3>
    <h2 id="title_libary"><?php print( $libraries->data[0]["name"] ); ?></h2>

    <div class="nav-tab">
        <ul class="nav nav-tabs minha-tab" id="myTab" role="tablist">
            <?php
            foreach( $libraries->data as $key => $value ){
            ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link botao-nav<?php print( $value["external_id"] == $info["slug"] ? ' active' : '' )?>" id="<?php print( $value["external_id"] ) ?>-tab" data-toggle="tab" href="#<?php print( $value["external_id"] ) ?>" role="tab" aria-controls="<?php print( $value["external_id"] ) ?>" aria-selected="true" style="height:50px; width:143px;background-image:url('<?php printf( $GLOBALS["staticimg_url"] , $value["ico"] ) ?>');background-repeat: no-repeat;background-position: center center;background-size:cover">&nbsp;</a>
            </li>
            <?php 
            }
            ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php
            foreach( $libraries->data as $key => $value ){
            ?>
            <div class="tab-pane fade px-0  tabela-tab<?php print( $value["external_id"] == $info["slug"] ? ' active show' : '' )?>" id="<?php print( $value["external_id"] ) ?>" role="tabpanel" aria-labelledby="<?php print( $value["external_id"] ) ?>-tab" style="background-position:bottom center">
                    <?php
                    $is_destak = false ;
                    foreach( $value["libarycontexts_attach"] as $k => $v ){
                        if( $v["is_destak"] != $is_destak ){
                            if( $is_destak != false ){
                                print('</div>' );
                            }
                            print('<div class="talinkBiblioteca">' );
                            $is_destak = $v["is_destak"] ;
                        }
                    ?>
                    <a class="linkBiblioteca" href="<?php printf( $GLOBALS["biblioteca_secao_url"], $value["external_id"] . "/" . $v["external_id"] ) ?>">
                        <img class="img-fluid" src="<?php printf( $GLOBALS["staticimg_url"] , $v["image"] ) ?>" alt="<?php print( $value["name"] ) ?>"><?php print( $value["name"] ) ?>
                    </a> 
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<style>
    .linkBiblioteca{  margin: 1rem;
    display: flex;
    font-size: 1rem;
    max-width: 282px;
    text-align: center;
    align-items: center;
    font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    flex-direction: column;
    justify-content: center;
    color: #d4d4c5!important;
}
.talinkBiblioteca{
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
}
</style>