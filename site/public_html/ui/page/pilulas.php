<div class="pilulas-de-conteudo">
    <div class="container-fluid">
        <?php 
        if( file_exists( constant("cRootServer") . "ui/includes/pilula_header.php") ){
            include( constant("cRootServer") . "ui/includes/pilula_header.php");
        }
        ?>
        <?php
        if( $execute ){
        ?>
        <form action="<?php printf( $GLOBALS["pilula_url"], $info["slug"] ) ?>" method="POST" class="pilula-central" style="background:url('<?php printf("https://static-premier.hsollearn.com.br/pill/%s",  $GLOBALS["background_pill_list"][ $data["pill_background_url"] ] ) ?>') bottom right no-repeat #f7f7f8;min-height: 400px;">
        <?php
        }
        else{
        ?>
        <div class="pilula-central" style="background:url('<?php printf("https://static-premier.hsollearn.com.br/pill/%s",  $GLOBALS["background_pill_list"][ $data["pill_background_url"] ] ) ?>') bottom right no-repeat #f7f7f8;min-height: 400px;">
        <?php
        }
        ?>
            <div class="row">
                <div class="col-12 pilula-titulo">
                    <p class="titulo1">Olá, <?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"] ); ?></p>
                    <?php
                    if( !$execute ){
                    ?>
                    <p class="subTitulo1"><?php print( $execute_text ) ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="teste-pilula">
                <div class="row">
                    <div class="col-12 pilula-titulo-teste">
                        <p class="titulo-teste"><?php print( $data["pill_title"] ) ?></p>
                    </div>
                    <div class="col-12 pilula-opcao">
                        <?php
                        foreach( $data["pillquestions_attach"] as $k => $v ){
                        ?>
                        <div class="opcao">
                            <?php
                            if( $execute ){
                            ?>
                            <input required name="pillquestions_id" id="pillquestions_id<?php print( $v["idx"] )?>" type="radio" value="<?php print( $v["idx"] )?>">
                            <?php
                            }
                            ?>
                            <label for="pillquestions_id<?php print( $v["idx"] )?>" class="op1"><?php print( $v["text"] )?></label>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div style="padding: 0px 18px 10px;"></div>

            <?php
            if( $execute ){
            ?>
            <div class="pilula-fechar">
                <button name="btn_save" class="botao-fechar" type="submit">Enviar</button>
            </div>
            <?php
            }
            ?>
        <?php
        if( $execute ){
        ?>
        </form>
        <?php
        }
        else{
        ?>
        </div>
        <?php
        }
        ?>
    </div>
</div>