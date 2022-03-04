<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span><?php print( $form["title"] ) ?></span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $form["search"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                    <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                    <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                    <label>
                        Título da Aula
                        <input type="text"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                    </label>
                    <div>
                        <button type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
                        <a class="btn button bg-gray round" title="Incluir" href="<?php print( $form["new"] ) ?>"><i class="fontello-plus"></i> <?php print( $form["titlenew"] ) ?></a>
                    </div>
                </form>
                <div id="solaris-head-data">

                    <table class="table large-12 columns">
                        <thead>
                            <tr>
                                <th>Título da Aula</th>
                               
                                <th width="20%">Ação</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3">
                                    <select id="select_paginage" class="large-3 columns">
                                        <option <?php print( $paginate == 20 ? 'selected="selected"' : '' ) ?> value="20">20</option>
                                        <option <?php print( $paginate == 50 ? 'selected="selected"' : '' ) ?> value="50">50</option>
                                        <option <?php print( $paginate == 100 ? 'selected="selected"' : '' ) ?> value="100">100</option>
                                    </select>
                                    <div class="large-6 columns text-center">
                                        <button type="button" id="btn_sr_first" class="button btn secondary">|<</button>
                                        <button type="button" id="btn_sr_previus" class="button btn secondary"><</button>
                                        <button type="button" id="btn_sr_next" class="button btn secondary">></button>
                                        <button type="button" id="btn_sr_last" class="button btn secondary">>|</button>
                                    </div>
                                    <p class="large-3 columns text-right"><?php print( ( $info["sr"] + 1 ) . " de " . $recordset )?></p>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach( $data as $v){ ?>
                            <tr>
                                <td><?php print( $v["lessons_title"] ) ?></td>                               
                                <td><a class="btn button btn-info" href="<?php printf( $form["action"] , $v["idx"] ) ?>">[ editar ]</a> 
                                <a id="btn_remove_<?php print( $v["idx"] ) ?>" class="btn button btn-danger" href="<?php printf( $form["action"] , $v["idx"] ) ?>">[ excluir ]</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    <table>

                </div>
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