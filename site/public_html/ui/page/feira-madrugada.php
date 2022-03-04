<div class="row padding-bottom-20 barra-banner-home"></div>

<section class="title-page">
        <div class="container-fluid">
            <div class="row padding-top-35 padding-bottom-35">        
                <div class="col-lg-6 center-block">
                    <div class="layer-banner">
                        <div class="row  text-center  padding-left-30 padding-right-25 padding-top-60">
                            <h2><?php echo $feira_madrugada->data[0]["titulo_inicio"]; ?></h2>
                        </div>
                        <div class="row padding-left-100 padding-right-80 padding-top-10">
                            <p><?php echo $feira_madrugada->data[0]["subtitulo_inicio"]; ?></p>
                        </div>                                
                    </div>         
                </div> 
            </div>
        </div>
</section>

<section class="conteudo">
    <div class="container-fluid">
        <div class="row padding-top-100 padding-bottom-35 xs-padding-top-30"> 
            <div class="col-lg-6 imagem-conteudo text-right padding-right-50 xs-text-center xs-padding-right-0">
                <img src="<?php echo $feira_madrugada->data[0]["imagem"]; ?>" />
            </div> 
            <div class="col-lg-6 padding-left-50 xs-padding-left-20 xs-padding-right-20 xs-padding-top-20">
                <?php echo $feira_madrugada->data[0]["conteudo"]; ?>
            </div>      
        </div>
    </div>
</section>

<section class="politica margin-top-80 margin-bottom-80">
    <div class="container-fluid">
        <div class="row padding-top-35 padding-bottom-35 xs-padding-left-20 xs-padding-right-20 xs-padding-top-20"> 
            <div class="col-lg-4 center-block">
                <?php echo $feira_madrugada->data[0]["politica"]; ?>
            </div>           
        </div>
    </div>
</section>