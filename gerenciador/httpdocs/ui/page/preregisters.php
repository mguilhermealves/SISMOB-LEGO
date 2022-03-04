<!-- Container Begin -->
<div class="row">
    <div class="large-12 columns" >
        <div class="box solaris-header">
            <div class="box-header bg-transparent">
                <h3 class="box-title">
                    <span>Pre-Cadastros</span>
                </h3>
            </div>
        </div>
        <div class="box solaris-head">
            <div class="box-body">
                <form class="large-12 columns" id="frm_filter" method="GET" action="<?php print( $GLOBALS["preregisters_url"] ) ?>">
                    <input type="hidden" name="paginate" id="paginate" value="<?php print( $paginate ) ?>">
                    <input type="hidden" name="ordenation" id="ordenation" value="<?php print( $ordenation ) ?>">
                    <input type="hidden" name="sr" id="sr" value="<?php print( $info["sr"] ) ?>">
                    <div class="large-2 columns">
                        <label>
                            Cadatro Maior que
                            <input type="date"  name="filter_created_start" value="<?php print( isset( $info["get"]["filter_created_start"] ) ? $info["get"]["filter_created_start"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Cadatro Menor que
                            <input type="date"  name="filter_created_end" value="<?php print( isset( $info["get"]["filter_created_end"] ) ? $info["get"]["filter_created_end"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            Nome
                            <input type="text"  name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            CPF
                            <input type="text" name="filter_cpf" value="<?php print( isset( $info["get"]["filter_cpf"] ) ? $info["get"]["filter_cpf"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns">
                        <label>
                            E-mail
                            <input type="text"  name="filter_mail" value="<?php print( isset( $info["get"]["filter_mail"] ) ? $info["get"]["filter_mail"] : "" ) ?>">
                        </label>
                    </div>
                    <div class="large-2 columns" style="display:flex">
                        <button class="button bg-gray round" type="submit">Filtrar</button>
                    </div>
                    <div class="large-2 columns" style="display:flex">
                        <button id="btn_export" class="button bg-gray round" type="button">Exportar</button>
                    </div>
                </form>
                <div id="solaris-head-data">

                <?php
$template = '<div class="row_js#CLASS#"#ADD#>';
$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_CREATED#>#CREATED#</div>';
$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_NAME#>#NAME#</div>';
$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_MAIL#>#MAIL#</div>';
$template .= '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_CPF#>#CPF#</div>';
$template .= '  <div class="cell cell_last" style="min-width: 70px !important;overflow:hidden;">#ACAO#</div>';
$template .= '</div>';

$footer = '<div class="row_js table_data_footer">';
$footer = ' <div class="cell cell_last table_data_footer">';
$footer = '     Linha por Página ';
$footer = '     <select id="per_page">';
$footer = '         <option value="20" selected>20</option>';
$footer = '         <option value="50">50</option>';
$footer = '         <option value="100">100</option>';
$footer = '     </select>';
$footer = ' </div>';
$footer = ' <div class="cell cell_last table_data_footer" style="justify-content: space-around;" id="paginate_control"></div>';
$footer = ' <div class="cell cell_last table_data_footer" id="paginate_display">#DATA_TOTAL#</div>';
$footer = '</div>';

print( strtr( $template , [
    "#CLASS#" => " row_js_header"
    , "#ADD#" => ""
    , "#NAME#" => '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_' . $ordenation_name . '" type="button">Nome / Sobrenome <i class="fa fa-'. $ordenation_name_ordenation .'"></i></button>'
    , "#MAIL#" => '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_' . $ordenation_mail . '" type="button">Email <i class="fa fa-'. $ordenation_mail_ordenation .'"></i></button>'
    , "#CREATED#" => '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_' . $ordenation_created_at . '" type="button">Data de Cadastro <i class="fa fa-'. $ordenation_created_at_ordenation .'"></i></button>'
    , "#CPF#" => '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_' . $ordenation_cpf . '" type="button">CPF <i class="fa fa-'. $ordenation_cpf_ordenation .'"></i></button>'
    , "#ACAO#" => 'AÇÃO'
    , "#ADD_NAME#" => ''
    , "#ADD_MAIL#" => ''
    , "#ADD_CPF#" => ''
    , "#ADD_CREATED#" => ''
]));
print('<div class="row_data">');
foreach( $data as $k => $v ){
    print( strtr( $template , [
        "#CLASS#" => " table_data_data"
        , "#ADD#" => ' id="data_register_' . $v["idx"] . '" data-name="' . trim( $v["first_name"] . " " . $v["last_name"] ) . '" data-mail="' . $v["mail"]  . '" data-cpf="' . $v["cpf"]  . '" data-created_at="' . $v["created_at"] . '"'
        , "#ADD_NAME#" => $v["first_name"] . " " . $v["last_name"]
        , "#ADD_MAIL#" => ' title="#MAIL#"'
        , "#ADD_CPF#" => ' title="#CPF#"'
        , "#ADD_CREATED#" => ' title="#CREATED#"'
        , "#NAME#" => $v["first_name"] . " " . $v["last_name"]
        , "#MAIL#" => $v["mail"] 
        , "#CREATED#" => preg_replace("/^(....).(..).(..).(.....).+$/","$3/$2/$1 $4",$v["created_at"]) 
        , "#CPF#" => preg_replace("/(.+)(...)(...)(..)$/","$1.$2.$3-$4",$v["cpf"]) 
        , "#ACAO#" => '<a href="' . set_url( sprintf( $form["pattern"]["action"] , $v["idx"] ) , array( "done" => urlencode( $form["pattern"]["search"] ) ) ) . '" style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_status" type="button">Detalhe <i class="fa fa-eye"></i></a>'

    ]));
}
print('</div>');

print( '<div class="row_js table_data_footer">') ;
print( ' <div class="cell cell_last table_data_footer">') ;
print( '     Linha por Página ') ;
print( '     <select id="per_page">') ;
print( '         <option value="20"' . ( $paginate == 20 ? ' selected' : '' ) . '>20</option>') ;
print( '         <option value="50"' . ( $paginate == 50 ? ' selected' : '' ) . '>50</option>') ;
print( '         <option value="100"' . ( $paginate == 100 ? ' selected' : '' ) . '>100</option>') ;
print( '     </select>') ;
print( ' </div>') ;
print( ' <div class="cell cell_last table_data_footer" style="justify-content: space-around;" id="paginate_control"></div>') ;
print( ' <div class="cell cell_last table_data_footer" id="paginate_display"></div>') ;
print( '</div>') ;
?>
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

    .row_js .table_data_footer{ display: flex; flex-direction: row; align-items: center; }
    #per_page{ max-width: 100px; align-items: baseline; }
    #paginate_control{ justify-content: space-around; font-size: 2rem; }
    #paginate_display{ justify-content: flex-end; }
    .row_js_header button i{ float: right; font-weight: bold }
    #paginate_control button{ width: 100%; background-color: #ffffff; color: #707070; text-align: center; font-weight: bold; }
    #paginate_control button:disabled{ background-color: #f0f0f0; color: #ffffff; border:none ; opacity: 0.5; }
</style>