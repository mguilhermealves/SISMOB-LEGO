<div class="row padding-bottom-20 barra-banner-home"></div>

<section class="title-page">
        <div class="container-fluid">
            <div class="row padding-top-35 padding-bottom-35">        
                <div class="col-lg-6">
                    <div class="layer-banner title-nosub">
                        <div class="row  text-center  padding-left-30 padding-right-25 padding-top-60">
                            <h2>Portal de Transparência</h2>
                        </div>                                              
                    </div>         
                </div> 
                <div class="col-lg-6 padding-top-25 vertical-middle subtitulo-roxo xs-padding-top-100  xs-padding-bottom-50 xs-text-center">
                    <h2>PARA ACESSAR E BAIXAR O CONTEÚDO ACESSE O LINK ABAIXO.</h2>
                </div> 
            </div>
        </div>
</section>

<section class="conteudo">
    <div class="container-fluid">
        <div class="row padding-top-100 padding-bottom-35 padding-left-100 padding-right-100  xs-padding-top-10 xs-padding-left-20 xs-padding-right-20 regulamentos"> 

            <?php foreach($transparencia->data as $transp) {?>
                <div class="col-lg-3 padding-right-10 padding-left-10 margin-bottom-20">
                    <div class="row">
                        <div class="col-lg-12 ano">
                            <h4><?php print( $transp["ano"] ) ?></h4>
                        </div>
                    </div>
                    <div class="row padding-top-25 padding-bottom-25 padding-left-25 padding-right-25 xs-text-center caixa-borda cima">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-1">
                                    <i class="far fa-file-alt"></i>
                                </div>
                                <div class="col-lg-11 padding-left-15 vertical-middle">
                                    <h3><?php print( $transp["titulo"] ) ?></h3>
                                </div>           
                            </div>              
                        </div>
                    </div>
                    <div class="row margin-top-15 padding-top-10 padding-bottom-10 padding-left-25 padding-right-25 xs-text-center caixa-borda">
                        <a href="<?php print( constant("cFrontend") . $sorteioprincipal["arquivo"] ) ?>" target="_blank">
                        <div class="col-lg-12">
                            <div class="row">                                                       
                                <div class="col-lg-11 vertical-middle">
                                    Fazer download
                                </div>       
                                <div class="col-lg-1">
                                    <i class="fas fa-download"></i>
                                </div>    
                            </div>              
                        </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        
        </div>
    </div>
</section>