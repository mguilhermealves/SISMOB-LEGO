<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Curadoria de Atividades</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["action"] ) ?>">
                    <div class="large-2 columns">
                        <label>
                            Instituição PJ
                            <select name="filter_pj">
                                <option value=""<?php print( !isset( $info["get"]["filter_pj"] ) || $info["get"]["filter_pj"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( pjs_controller::data4select("idx",array( " active = 'yes' " ) , "name") as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_pj"] ) && $info["get"]["filter_pj"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Status
                            <select name="filter_status">
                                <option value=""<?php print( !isset( $info["get"]["filter_status"] ) || $info["get"]["filter_status"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( $GLOBALS["activities_status_list"] as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_status"] ) && $info["get"]["filter_status"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Modalidade
                            <select name="filter_modality">
                                <option value=""<?php print( !isset( $info["get"]["filter_modality"] ) || $info["get"]["filter_modality"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( activities_controller::data4select("modality",array( " active = 'yes' " ) , "modality") as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_modality"] ) && $info["get"]["filter_modality"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Tipo
                            <select name="filter_type">
                                <option value=""<?php print( !isset( $info["get"]["filter_type"] ) || $info["get"]["filter_type"] == "" ? " selected" : "" ) ?>></option>
                                <?php 
                                foreach( activities_controller::data4select("type",array( " active = 'yes' " ) , "type") as $k => $v ){
                                    printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_type"] ) && $info["get"]["filter_type"] == $k ? ' selected="selected"' : ''  , $v);
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="large-2 columns" style="display:flex">
                        <button class="button bg-gray round" type="submit">Filtrar</button>
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