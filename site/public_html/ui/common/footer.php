<section class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <div class="lista">
                    <ul>
                        <li>
                            <a href="<?php print($GLOBALS["politica_privacidade_url"]) ?>">Política de Privacidade</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["politica_cookies_url"]) ?>">Política de Cookies</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["biblioteca_url"]) ?>">Biblioteca</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["meu_cadastro_url"]) ?>">Meu Cadastro</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="lista">
                    <ul>
                        <li>
                            <a href="<?php print($GLOBALS["home_url"]) ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["treinamentos_url"]) ?>">Treinamentos</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["meus_certificados_url"]) ?>">Meus Certificados</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["orientacoes_uso_url"]) ?>">Orientações gerais de uso</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="lista">
                    <ul>
                        <li>
                            <a href="<?php print($GLOBALS["minhas_notas_url"]) ?>">Minhas Notas</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["aviso_legal_url"]) ?>">Aviso Legal</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["contato_url"]) ?>">Contato</a>
                        </li>
                        <li>
                            <a href="<?php print($GLOBALS["notificacoes_url"]) ?>">Notificações</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="logo-footer">
                    <img class="img-footer" src="<?php printf("%s%s", constant("cFurniture"), "images/tab_images/logotipo_footer.png") ?>" alt="">
                </div>

                <?php 
                if( file_exists( constant("cRootServer") . "ui/includes/sabichao.php") ){
                    include( constant("cRootServer") . "ui/includes/sabichao.php");
                }
                ?>
            </div>
        </div>
    </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="footer-copy">
                            <h4>&copy; <?php print date('Y'); ?> |Todos os direitos reservados</h4>
                        </div>
                    </div>
                </div>
            </div>


</section>





</body>

</html>