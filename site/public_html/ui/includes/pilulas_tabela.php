
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs tabela-pilula" id="nav-tab" role="tablist">
                        <a class="nav-link botao-tabela active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Extrato</a>
                        <a class="nav-link botao-tabela" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ranking</a>
                    </div>
                </nav>

                <div class="tabela-conteudo" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        
                        <div class="row header-tab">
                            <div class="col-6">
                                <div class="titulo-p">
                                    <p>Pílula de Conteúdo</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="titulo-p">
                                    <p>Data</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="titulo-p">
                                    <p>Tempo de Resposta</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="titulo-p">
                                    <p>Resultado</p>
                                </div>
                            </div>
                        </div>

                        <?php foreach( $data as $k => $v ){ ?>
                        <div class="row linha-pilula">
                            <div class="col-6">
                                <div class="titulo-p">
                                    <a href="<?php printf( $GLOBALS["pilula_url"] , $v["slug"] ) ?>"><?php print( $v["pill_title"] );?></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="titulo-p">
                                    <a href="<?php printf( $GLOBALS["pilula_url"] , $v["slug"] ) ?>"><?php print( preg_replace("/^(....).(..).(..).(.....).+/","$3/$2/$1 $4",$v["pill_start_date"] ) );?></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="titulo-p text-center">
                                    <a href="<?php printf( $GLOBALS["pilula_url"] , $v["slug"] ) ?>"><?php print( isset( $v["pillattempts_attach"][0] ) ? gmdate("H:i:s", $v["pillattempts_attach"][0]["duration"] ) : "-" ) ?></a>
                                </div> 
                            </div>
                            <div class="col-2">
                                <div class="titulo-p text-center">
                                    <a href="<?php printf( $GLOBALS["pilula_url"] , $v["slug"] ) ?>"><?php print( isset( $v["pillattempts_attach"][0] ) ? $v["pillattempts_attach"][0]["execute_points"] : "-" ) ?></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                </div>
            </div>
        </div>