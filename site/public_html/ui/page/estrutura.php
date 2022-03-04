<div class="row padding-bottom-20 barra-banner-home"></div>

<section class="conteudo lojista">
    <div class="container-fluid">
        <div class="row padding-top-100 xs-padding-top-45 padding-bottom-35"> 
            <div class="col-lg-6 padding-right-25 xs-padding-left-25">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8">
                        <?php echo $estrutura->data[0]["conteudo"]; ?>
                    </div>
                </div>                
            </div>  
            <div class="col-lg-6 imagem-conteudo padding-left-50 xs-padding-left-0 xs-text-center">
                <img src="<?php echo $estrutura->data[0]["imagem"]; ?>" />
            </div>                
        </div>
    </div>
</section>



<section class="politica estrutura-lojista margin-top-80 xs-margin-top-40">
    <div class="container-fluid">
        <div class="row padding-top-35 padding-bottom-35 padding-left-80 padding-right-80 xs-padding-bottom-10 xs-text-center"> 
            <div class="col-lg-12">
                <h2>Nossa Estrutura</h2>
            </div>           
        </div>
        <div class="row padding-top-35 padding-bottom-35 xs-padding-top-10"> 
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2 xs-margin-bottom-20 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $estrutura->data[0]["imagem_estrutura_1"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25 xs-text-center">
                            <div class="col-lg-12">
                                <?php echo $estrutura->data[0]["estrutura_1"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-2 xs-margin-bottom-20 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $estrutura->data[0]["imagem_estrutura_2"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25 xs-text-center">
                            <div class="col-lg-12">
                                <?php echo $estrutura->data[0]["estrutura_2"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-2 xs-margin-bottom-20 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $estrutura->data[0]["imagem_estrutura_3"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25 xs-text-center">
                            <div class="col-lg-12">
                                <?php echo $estrutura->data[0]["estrutura_3"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-2 xs-margin-bottom-20 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $estrutura->data[0]["imagem_estrutura_4"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25 xs-text-center">
                            <div class="col-lg-12">
                                <?php echo $estrutura->data[0]["estrutura_4"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-2">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $estrutura->data[0]["imagem_estrutura_5"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25 xs-text-center">
                            <div class="col-lg-12">
                                <?php echo $estrutura->data[0]["estrutura_5"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>           
        </div>
    </div>
</section>


<section class="galeria-imagens">

    <div class="container-fluid">
        <div class="container padding-bottom-75">

            <div class="row padding-top-75 padding-bottom-45 xs-padding-top-45">
                <div class="col-lg-12 xs-text-center">
                    <h2>VEJA NOSSA INFRA ESTRUTURA</h2>
                </div>
            </div>

            <div class="row galeria">
                <?php foreach($imagens_infra as $img){ ?>
                        <div class="col-lg-12 slide-img">
                            <img src="<?php echo $img; ?>" data-fancybox="gallery"  data-src="<?php echo $img; ?>" />
                        </div>
                <?php } ?>
            </div> 

        </div>
    </div>

</section>
