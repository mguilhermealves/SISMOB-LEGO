<div class="row padding-bottom-20 barra-banner-home"></div>

<section class="conteudo lojista">
    <div class="container-fluid">
        <div class="row padding-top-100 padding-bottom-35 xs-padding-top-30"> 
            <div class="col-lg-6 padding-right-25 xs-padding-right-20 xs-padding-left-20">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-8 xs-text-center">
                        <?php echo $lojista->data[0]["conteudo"]; ?>
                    </div>
                </div>                
            </div>  
            <div class="col-lg-6 imagem-conteudo padding-left-50 xs-padding-left-0">
                <img src="<?php echo $lojista->data[0]["imagem"]; ?>" />
            </div>                
        </div>
    </div>
</section>



<section class="politica estrutura-lojista margin-top-80 xs-margin-top-20">
    <div class="container-fluid">
        <div class="row padding-top-35 padding-bottom-35 xs-padding-right-20 xs-padding-left-20"> 
            <div class="col-lg-8 center-block xs-text-center">
                <?php echo $lojista->data[0]["conteudo_estrutura"]; ?>
            </div>           
        </div>
        <div class="row padding-top-35 padding-bottom-35"> 
            <div class="col-lg-8 center-block">
                <div class="row padding-left-40 padding-right-40 xs-text-center">
                    <div class="col-lg-4 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $lojista->data[0]["imagem_estrutura_1"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25">
                            <div class="col-lg-12">
                                <?php echo $lojista->data[0]["estrutura_1"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-4 card-border">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $lojista->data[0]["imagem_estrutura_2"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25">
                            <div class="col-lg-12">
                                <?php echo $lojista->data[0]["estrutura_2"]; ?>
                            </div>
                        </div>                                                
                    </div>
                    <div class="col-lg-4">                                                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="icon vertical-middle horizontal-center"><img src="<?php echo $lojista->data[0]["imagem_estrutura_3"]; ?>" /></div>
                            </div>
                        </div>
                        <div class="row margin-top-25">
                            <div class="col-lg-12">
                                <?php echo $lojista->data[0]["estrutura_3"]; ?>
                            </div>
                        </div>                                                
                    </div>
                </div>
            </div>           
        </div>
    </div>
</section>

<section class="perguntas-frequentes padding-top-60 padding-bottom-60">
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-lg-6 center-block">
                <div class="row">
                    <div class="col-lg-12 xs-text-center titulo">
                        <h2>Perguntas Frequentes</h2>
                    </div>
                </div>


                <div class="row xs-text-center margin-top-20">
                    <div class="col-lg-12">
                        <div class="accordion" id="perguntasFrequentes">
                            <?php $cont = 0; foreach($perguntas_frequentes["data"] as $perguntas){ ?>
                                <div class="card">
                                    <div class="card-header" id="pergunta_<?php echo $cont; ?>">
                                        <h3 class="mb-0">
                                            <button class="btn btn-link btn-block text-left xs-text-center" type="button" data-toggle="collapse" data-target="#toresposta_<?php echo $cont;?>" aria-expanded="<?php echo $cont == 0 ? "true" : ""; ?>" aria-controls="toresposta_<?php echo $cont;?>">
                                                <?php echo $perguntas["pergunta"] ?>
                                            </button>
                                        </h3>
                                    </div>

                                    <div id="toresposta_<?php echo $cont;?>" class="collapse <?php echo $cont == 0 ? "show" : ""; ?>" aria-labelledby="pergunta_<?php echo $cont; ?>" data-parent="#perguntasFrequentes">
                                        <div class="card-body xs-text-center">
                                            <?php echo $perguntas["resposta"] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $cont++; } ?>                            
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section class="conteudo lojista beneficios">
    <div class="container-fluid">
        <div class="row padding-bottom-100"> 
        <div class="col-lg-6 text-right imagem-conteudo padding-right-25">
                <img src="<?php echo $lojista->data[0]["imagem_beneficios"]; ?>" />
            </div>   
            <div class="col-lg-6 padding-left-50 xs-padding-left-20 xs-padding-right-20">    
                <div class="row">
                    <div class="col-lg-8"><?php echo $lojista->data[0]["conteudo_beneficios"]; ?> </div>
                    <div class="col-lg-4"></div>
                </div>                                             
            </div>                           
        </div>
    </div>
</section>