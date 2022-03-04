<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="container">
        <div class="forum">
            <div class="row">
                <div class="col-sm-12 py-3">
                    <div class="title-forum">
                        <h1>Fórum</h1>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <div class="foruns">
                        <div class="row">
                            <div class="col-sm-12 py-3">
                                <div class="text-seta">
                                    <span>
                                        <p>| Fóruns <i class="bi bi-chevron-right seta"></i></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="title2">
                                    <p>Universidade PremieRpet® WikiPet - Fórum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="categ-pricipal">
                        <div class="categoria-title">
                            <p>Categoria Principal</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="tabela-status">
                        <div class="tab-conteudo">
                            <div class="row">
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>Tópicos</th>
                                            <th>Respostas</th>
                                            <th>Visualizações</th>
                                            <th>Última Resposta</th>
                                            <th class="text-right">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ($forums as $f) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php print('forum/' . $f["slug"]); ?>"><?php print($f["title"]); ?></a>
                                                </td>
                                                <td>5</td>
                                                <td>15</td>
                                                <td>Marcos Alves</td>
                                                <td class="text-right"><?php print(date( 'd/M', strtotime( $f["created_at"] ) ) ) ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-sm-12">
                    <div class="estatisticas">
                        <p><i class="far fa-chart-bar"></i>
                            &nbsp; <span>Estatísticas do Fórum</span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="estatistica-numeros">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="qtd-estatistica text-center mx-5">
                                    <div class="row">
                                        <div class="col-sm-12 qtd-simbolo">
                                            <i class="fas fa-file-alt"></i>
                                            <span class="wpf-stat-value"><?php print($total_foruns); ?></span>
                                        </div>
                                    </div>

                                    <hr size="1" style="width:100%; border:1px dashed gray;">

                                    <div class="row">
                                        <div class="col-sm-12 ">
                                        <span class="wpf-stat-label">
                                                <?php if($total_foruns > 1) {

                                                    ?>
                                                    Tópicos
                                                    <?php
                                                } else {
                                                    ?>
                                                    Tópico
                                                <?php
                                                } 
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-sm-4">
                                <div class="qtd-estatistica text-center mx-5">
                                    <div class="row">
                                        <div class="col-sm-12 qtd-simbolo">
                                            <i class="fas fa-reply fa-rotate-180"></i>
                                            <span class="wpf-stat-value">7</span>
                                        </div>
                                    </div>

                                    <hr size="1" style="width:100%; border:1px dashed gray;">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="wpf-stat-label">Posts</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-sm-4">
                                <div class="qtd-estatistica text-center mx-5">
                                    <div class="row">
                                        <div class="col-sm-12 qtd-simbolo">
                                            <i class="fas fa-user"></i>
                                            <span class="wpf-stat-value">1,554</span>
                                        </div>
                                    </div>

                                    <hr size="1" style="width:100%; border:1px dashed gray;">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="wpf-stat-label">Membros</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="outras-estatisticas">
                                <p>
                                    <span><i class="fas fa-pencil-alt"></i> Post Recente: <a href="" style="color: #AA4F12;">PremieR Seleção Natural - Frango Korin</a>
                                    <span><i class="fas fa-list-ul"></i> <a href="" style="color: #AA4F12;">Posts Recentes</a></span>
                                    <span><i class="fas fa-layer-group"></i> <a href="" style="color: #AA4F12;">Posts não lidos</a></span>
                                    <span class="wpf-stat-tags"><i class="fas fa-tag"></i> <a href="" style="color: #AA4F12;">Tags</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>