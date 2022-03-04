<nav>
    <ul>
        <li class="<?php print( isset( $page ) && in_array( $page , array("homepage") , true ) ? 'active"' : '' ) ?>"><a href="/">Home</a></li>
        <li class="<?php print( isset( $page ) && in_array( $page , array("regulamento") , true ) ? 'active"' : '' ) ?>"><a href="/regulamento">Regulamento</a></li>
        <!-- <li><a href="">CADASTRO</a></li> -->
        <li class="<?php print( isset( $page ) && in_array( $page , array("noticias","noticia") , true ) ? 'active"' : '' ) ?>"><a href="/noticias">Mural de Notícias</a></li>
        <li class="<?php print( isset( $page ) && in_array( $page , array("extrato") , true ) ? 'active"' : '' ) ?>"><a href="/extrato">Extrato</a></li>
        <!-- <li><a href="/construcao">QUIZZES</a></li> -->
        <li class="<?php print( isset( $page ) && in_array( $page , array("premios") , true ) ? 'active"' : '' ) ?>"><a href="/premios">Premiação</a></li>
        <li class="<?php print( isset( $page ) && in_array( $page , array("categorias") , true ) ? 'active"' : '' ) ?>"><a href="/categorias">Categorias</a></li>               
        <li class="<?php print( isset( $page ) && in_array( $page , array("duvidas") , true ) ? 'active"' : '' ) ?>"><a href="/duvidas">Dúvidas Frequentes (FAQ)</a></li>
        <li class="<?php print( isset( $page ) && in_array( $page , array("agenda") , true ) ? 'active"' : '' ) ?>"><a href="/agenda">Agenda</a></li>
        <li class="<?php print( isset( $page ) && in_array( $page , array("contatos") , true ) ? 'active"' : '' ) ?>" ><a href="/contatos">Fale Conosco</a></li>
    </ul>
</nav>

