<div class="pilulas-de-conteudo">
    <div class="container-fluid">
        <?php 
        if( file_exists( constant("cRootServer") . "ui/includes/pilula_header.php") ){
            include( constant("cRootServer") . "ui/includes/pilula_header.php");
        }
        ?>
        <?php 
        if( file_exists( constant("cRootServer") . "ui/includes/pilula_placar.php") ){
            include( constant("cRootServer") . "ui/includes/pilula_placar.php");
        }
        ?>
        <?php 
        if( file_exists( constant("cRootServer") . "ui/includes/pilulas_tabela.php") ){
            include( constant("cRootServer") . "ui/includes/pilulas_tabela.php");
        }
        ?>
    </div>
</div>

