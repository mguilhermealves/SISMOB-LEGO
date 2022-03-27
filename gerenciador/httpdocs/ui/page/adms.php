<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Instituições PJs</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["action"] ) ?>">
                    <div class="large-2 columns">
                        <label>
                            Nome
                            <input type="text"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Habilitado
                            <select name="filter_enabled">
                                <option value=""<?php print( !isset( $info["get"]["filter_enabled"] ) || $info["get"]["filter_enabled"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_enabled"] ) && $info["get"]["filter_enabled"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Categoria
                            <select name="filter_category">
                                <option value=""<?php print( !isset( $info["get"]["filter_category"] ) || $info["get"]["filter_category"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( $GLOBALS["categories_lists"] as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_category"] ) && $info["get"]["filter_category"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns" style="display:flex">
                        <button class="button bg-gray round" type="submit">Filtrar</button>
                    </div>
                    <div class="large-2 columns" style="display:flex">
                <a class="button success round right" title="Incluir" href="<?php print( $form["pattern"]["new"] ) ?>"><i class="fontello-plus"></i> Adicionar</a>
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

    .row_js .table_data_footer{ display: flex; flex-direction: row; align-items: center; }
    #per_page{ max-width: 100px; align-items: baseline; }
    #paginate_control{ justify-content: space-around; font-size: 2rem; }
    #paginate_display{ justify-content: flex-end; }
    .row_js_header button i{ float: right; font-weight: bold }
    #paginate_control button{ width: 100%; background-color: #ffffff; color: #707070; text-align: center; font-weight: bold; }
    #paginate_control button:disabled{ background-color: #f0f0f0; color: #ffffff; border:none ; opacity: 0.5; }
</style>