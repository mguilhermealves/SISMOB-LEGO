<?php $lumens_total = site_controller::total_lumens(); ?>


<div class="row">
    <div class="col-lg-12 padding-left-15 padding-right-15">
        <div class="title-trapezio trapezio-center center-block text-center"><h3>Categoria</h3></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 padding-left-15 padding-right-15 padding-top-15  text-center">
        <?php if( isset( $_SESSION[ constant("cAppKey") ]["credential"]["categorias_attach"][0] ) ){ ?>
        <img src="/<?php print_r($_SESSION[ constant("cAppKey") ]["credential"]["categorias_attach"][0]["icone"]) ?>" style="width:90%;"/> 
        <?php } ?>
    </div>
</div>

<div class="row pontuacao">
    <div class="col-lg-12 padding-left-15 padding-right-15 text-center">
            <h3>MEUS <strong>LUMENS</strong></h3>
            <h4><?php print( (int)$lumens_total) ?></h4>
    </div>
</div>

<!-- <a href="/agenda">
    <img src="../../furniture/images/categoria_lumens.png" style="width:100%;"/> 
</a> -->