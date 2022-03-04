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
                                <div class="top-topico">
                                    <span>
                                        Fórum<i class="bi bi-chevron-right"></i>
                                    </span>

                                    <span>
                                        <?php print($data["title"]) ?><i class="bi bi-chevron-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="title2">
                                    <p> <?php print ($data["isFixed"]) == "yes" ? "[Fixar] " . $data["title"] : $data["title"] ?> </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="post-head">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-right">
                                                <a href="" class="wpfcl-2" title="Feed RSS de Tópico" target="_blank"><span>RSS</span> <i class="fas fa-rss wpfsx wpfcl-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="post-recente">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <div class="post-avatar"><a href="#"><img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/avatar.png") ?>" alt=""></a></div>

                                            <!-- <div class="post-star text-center" title="Emblema da classificação do membro">
                                                <i class="far fa-star-half"></i>
                                            </div>

                                            <div class="posts-qtd text-center">Posts: 3</div> -->
                                        </div>

                                        <div class="col-sm-11">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="nome-adm">
                                                        <a href="" style="color:#FF3333" title="creat_by"><?php print($data["users_attach"][0]["first_name"] . " " .  $data["users_attach"][0]["last_name"]) ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="autor text-left">
                                                                <div class="autor-nome"><?php print("@" . strtolower($data["users_attach"][0]["first_name"] . $data["users_attach"][0]["last_name"])) ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 mt-2">
                                                    <div class="content-forum">
                                                        <p>
                                                            <?php print($data["resume"]) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="post-meta">
                                                        <div class="post-edited"><i class="far fa-edit"></i>&nbsp; Este tópico foi modificado <?php print(date_format(new DateTime($data["modified_at"]), "m")) ?> meses atrás.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="like-buttons">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="like text-left">
                                                                    <span class="action-like" data-postid="1"><span class="like-icon" id="like_forum" tooltip="Curtir"><i class="far fa-thumbs-up wpforo-like-ico"></i></span><span class="like-count">4</span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 mb-5">
                                                    <div class="nomes-curtidas">
                                                        <!-- <a href="">Jamile Moraes Dos Santos</a>, <a href="">Joana Larissa Born</a>, <a href="">Livia Juvenal Dias Santos</a> e 1 curtiram -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="post-recente">
                                    <div class="row">
                                        <?php foreach ($data["forum_response_attach"] as $response) { ?>
                                            <div class="col-sm-1">
                                                <div class="post-avatar"><a href="#"><img class="img-fluid" src="<?php printf("%s%s", constant("cFurniture"), "images/avatar.png") ?>" alt=""></a></div>

                                                <!-- <div class="posts-qtd text-center">Posts: 1</div> -->
                                            </div>

                                            <div class="col-sm-11">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="nome-adm">
                                                            <a href="" style="color:#FF3333" title="<?php print($response["users_attach"][0]["first_name"] . " " .  $response["users_attach"][0]["last_name"]) ?>"><?php print($response["users_attach"][0]["first_name"] . " " .  $response["users_attach"][0]["last_name"]) ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-11">
                                                                <div class="autor text-left">
                                                                    <div class="autor-nome">(<?php print("@" . strtolower($response["users_attach"][0]["first_name"] . $response["users_attach"][0]["last_name"])) ?>)</div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <div class="btn-autor text-right">

                                                                    <!-- <span class="action-buttons"><span wpf-tooltip="Denunciar" class="action-report" data-postid="1"><i class="fas fa-exclamation-triangle"></i></span>

                                                                        <span class="action-buttons" title="Link do post"><i class="fas fa-link wpfsx"></i></span></span> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="content-forum">
                                                            <p><?php print($response["response"]); ?></p>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="post-meta">
                                                            <!-- <div class="post-edited"><i class="far fa-edit"></i>&nbsp; Este tópico foi modificado 7 meses atrás 2 vezes by <a href=""><i>ANDRESSA CAPELASSO</i></a></div> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="like-buttons">
                                                            <div class="row">
                                                                <div class="col-sm-1">
                                                                    <div class="like text-left">
                                                                        <span class="action_like_response">
                                                                            <span class="like-icon" id="like_forum_response" tooltip="Curtir" data-objectid="<?php print($response["idx"]) ?>" data-userid="<?php print($_SESSION[constant("cAppKey")]["credential"]["idx"]) ?>">
                                                                                <i class="far fa-thumbs-up wpforo-like-ico"></i>
                                                                            </span>
                                                                            <span class="like-count likes_count_response">
                                                                                <?php
                                                                                if (isset($response["likes_attach"])) {
                                                                                    //print_pre(count( $response["likes_attach"] ), true);
                                                                                    $somaLike = 0;
                                                                                    foreach ($response["likes_attach"] as $like) {
                                                                                        if ($like["is_liked"] == "yes") {
                                                                                            $somaLike = $somaLike + 1;
                                                                                        } else {
                                                                                            $somaLike = $somaLike -= $somaLike;
                                                                                        }
                                                                                    }

                                                                                    print($somaLike);
                                                                                } else {
                                                                                    print("0");
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-1">

                                        </div>
                                        <div class="col-sm-11">
                                            <div class="row">
                                                <div class="col-sm-12 mt-5">
                                                    <div class="formulario">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <form action="<?php print($GLOBALS["send_response_url"]) ?>" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="forum_id" value="<?php print($data["idx"]) ?>">
                                                                    <div class="form-group">
                                                                        <label>Deixar uma resposta</label>
                                                                        <textarea class="form-control editor" name="response" rows="3"></textarea>
                                                                    </div>

                                                                    <div class="text-right">
                                                                        <button type="submit" name="btn_save" class="btn btn-success btn-sm btn_orange"><i class="bi bi-send-plus"></i> Adicionar Resposta</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn_orange {
        background-color: #F26724;
        border: #F26724;
    }

    .btn_orange:hover {
        background-color: #F26724;
        border: #F26724;
    }
</style>