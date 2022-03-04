<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Respostas de Quiz</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $GLOBALS["quizresponse_url"] ) ?>" style="display: flex;flex-direction: row;justify-content: space-around;align-items: flex-end;">
                        <label>
                            Quiz
                            <select name="filter_quiz_id">
                                <option <?php print( ( isset( $info["get"]["filter_quiz_id"] ) && $info["get"]["filter_quiz_id"] == "" ? ' selected ' : '' ) ) ?>value=""></option>
                                <?php foreach( quizes_controller::data4select() as $k => $v ){ printf('<option %svalue="%d">%s</option>', ( isset( $info["get"]["filter_quiz_id"] ) && $info["get"]["filter_quiz_id"] == $k ? ' selected ' : '' ) , $k , $v ); } ?>
                            </select>
                        </label>
                        <label>
                            Participante
                            <select name="filter_user_id">
                                <option <?php print( ( isset( $info["get"]["filter_user_id"] ) && $info["get"]["filter_user_id"] == "" ? ' selected ' : '' ) ) ?>value=""></option>
                                <?php foreach( users_controller::data4select("idx" , array( " active = 'yes' " , " idx in ( select distinct( created_by ) from quizes_respostas where active = 'yes' )") ) as $k => $v ){ printf('<option %svalue="%d">%s</option>', ( isset( $info["get"]["filter_user_id"] ) && $info["get"]["filter_user_id"] == $k ? ' selected ' : '' ) , $k , $v ); } ?>
                            </select>
                        </label>
                        <div>
                            <button type="submit" class="btn button info round"><i class="fontello-search"></i> Filtrar</button>
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