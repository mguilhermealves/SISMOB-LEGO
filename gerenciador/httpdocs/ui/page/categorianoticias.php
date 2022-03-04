<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Listagem de Categorias</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <?php
                    include( constant("cRootServer") . "ui/common/resume.php");
                ?>
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $GLOBALS["categorianoticias_url"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                        <label>
                            Titulo
                            <input type="text"  name="filter_title" value="<?php print( isset( $info["get"]["filter_title"] ) ? $info["get"]["filter_title"] : "" ) ?>">
                        </label>
                        <div>
                            <button type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
                            <a class="btn button bg-gray round" title="Incluir" href="<?php print( $form["pattern"]["new"] ) ?>"><i class="fontello-plus"></i> Nova Categoria</a>
                        </div>
                    </div>
                </form>
                <div id="solaris-head-data"></div>
            </div>
        </div>
    </div>
</div>
<style>
    .row_js{ justify-content: space-around;flex-direction: row; display: flex; margin: 5px auto;width:95%; border:1px solid #707070; border-radius:7px; padding:0px 5px }
    .row_js .cell{ text-align:left; padding:5px; border-right: 1px solid #c0c0c0; width:100% }
    .row_js .cell_last{ border-right: none; }
    .row_js_header{ padding:10px 5px; font-weight: bold }

    .row_js .table_data_footer{ display: flex; flex-direction: row; align-items: baseline; }
    #per_page{ max-width: 100px; align-items: baseline; }
    #paginate_control{ justify-content: space-around; font-size: 2rem; }
    #paginate_display{ justify-content: flex-end; }
    .row_js_header button i{ float: right; font-weight: bold }
    #paginate_control button{ width: 100%; background-color: #ffffff; color: #707070; text-align: center; font-weight: bold; }
    #paginate_control button:disabled{ background-color: #f0f0f0; color: #ffffff; border:none ; opacity: 0.5; }
</style>