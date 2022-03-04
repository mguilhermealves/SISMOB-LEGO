<div class="row padding-bottom-20 barra-banner-home"></div>

<section class="title-page">
        <div class="container-fluid">
            <div class="row padding-top-35 padding-bottom-35">        
                <div class="col-lg-6">
                    <div class="layer-banner title-nosub">
                        <div class="row  text-center  padding-left-30 padding-right-25 padding-top-60">
                            <h2>Sorteio e Promoções</h2>
                        </div>                                              
                    </div>         
                </div> 
                <div class="col-lg-6 padding-top-25 vertical-middle subtitulo-roxo xs-padding-top-100  xs-padding-bottom-50 xs-text-center">
                    <h2><?php print( $sorteioprincipal["titulo"] ) ?></h2>
                </div> 
            </div>
        </div>
</section>

<section class="conteudo">
    <div class="container-fluid">
        <div class="row padding-top-100 padding-bottom-35 padding-left-100 padding-right-100 xs-padding-top-10 xs-padding-left-20 xs-padding-right-20 regulamentos"> 

            <div class="col-lg-4 padding-right-10 padding-left-10 xs-margin-bottom-35">
                <div class="row padding-top-25 padding-bottom-25 padding-left-25 padding-right-25 xs-text-center caixa-borda cima">
                    <div class="col-lg-12 ">
                        <div class="row">
                            <div class="col-lg-1">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <div class="col-lg-11 vertical-middle">
                                <h3><?php print( $sorteioprincipal["title_regulamento"] ) ?></h3>
                            </div>           
                        </div>              
                    </div>
                </div>
                <div class="row margin-top-15 padding-top-10 padding-bottom-10 padding-left-25 padding-right-25 xs-text-center caixa-borda">
                    <a href="<?php print( constant("cFrontend") . $sorteioprincipal["arquivo_regulamento"] ) ?>" target="_blank">
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

            <div class="col-lg-4 padding-right-10 padding-left-10 xs-margin-bottom-35">
                <div class="row padding-top-25 padding-bottom-25 padding-left-25 padding-right-25 xs-text-center caixa-borda cima">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-1">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <div class="col-lg-11">
                                <h3><?php print( $sorteioprincipal["title_permissionarios"] ) ?></h3>
                            </div>           
                        </div>              
                    </div>
                </div>
                <div class="row margin-top-15 padding-top-10 padding-bottom-10 padding-left-25 padding-right-25 xs-text-center caixa-borda">
                    <a href="<?php print( constant("cFrontend") . $sorteioprincipal["arquivo_permissionarios"] ) ?>" target="_blank">
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

            <div class="col-lg-4 padding-right-10 padding-left-10">
                <div class="row padding-top-25 padding-bottom-25 padding-left-25 padding-right-25 caixa-borda xs-text-center cima">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-1">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <div class="col-lg-11">
                                <h3><?php print( $sorteioprincipal["title_naopermissionarios"] ) ?></h3>
                            </div>           
                        </div>              
                    </div>
                </div>
                <div class="row margin-top-15 padding-top-10 padding-bottom-10 padding-left-25 padding-right-25 xs-text-center caixa-borda">
                    <a href="<?php print( constant("cFrontend") . $sorteioprincipal["arquivo_naopermissionarios"] ) ?>" target="_blank">
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

        </div>
    </div>
</section>

<section class="conteudo">
    <div class="container-fluid historico">
        <div class="row padding-top-100 padding-bottom-35 padding-left-100 padding-right-100 xs-padding-top-40 xs-padding-left-40 xs-padding-right-40 xs-text-center">
            <div class="col-lg-12">
                <h2>Histórico | Sorteio e Promoção</h2>
            </div>
        </div>
        <div class="row padding-left-100 padding-right-100 padding-bottom-100 xs-padding-left-40 xs-padding-right-40 xs-padding-bottom-40 xs-text-center">
            <?php foreach($sorteio->data as $sort){ ?>
                <div class="col-lg-3 padding-bottom-35">
                     <div class="row">
                         <div class="col-lg-12">
                             Sorteio
                         </div>
                     </div> 
                     <div class="row">
                         <div class="col-lg-12">
                           <a href="/sorteio-e-promocoes?s=<?php print( $sort["idx"] )  ?>"> <?php print( $sort["data_extenso"] ) ?> </a>
                         </div>
                     </div>       
                </div>
            <?php } ?> 
        </div>
    </div>
</div>
</section>