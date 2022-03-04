quiz_results_json.template = '<div class="row_js#CLASS#"#ADD#>';
quiz_results_json.template += '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_DATA#>#DATA#</div>';
quiz_results_json.template += '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_TITLE#>#TITLE#</div>';
quiz_results_json.template += '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_PARTICIPANTE#>#PARTICIPANTE#</div>';
quiz_results_json.template += '  <div class="cell" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_ACERTOS#>#ACERTOS#</div>';
quiz_results_json.template += '  <div class="cell cell_last" style="height: 45px;min-width: 70px !important;overflow:hidden;"#ADD_POINTS#>#POINTS#</div>';
quiz_results_json.template += '</div>';

quiz_results_json.footer = '<div class="row_js table_data_footer">';
quiz_results_json.footer += ' <div class="cell cell_last table_data_footer">';
quiz_results_json.footer += '     Linha por Página ';
quiz_results_json.footer += '     <select id="per_page">';
quiz_results_json.footer += '         <option value="20" selected>20</option>';
quiz_results_json.footer += '         <option value="50">50</option>';
quiz_results_json.footer += '         <option value="100">100</option>';
quiz_results_json.footer += '     </select>';
quiz_results_json.footer += ' </div>';
quiz_results_json.footer += ' <div class="cell cell_last table_data_footer" style="justify-content: space-around;" id="paginate_control"></div>';
quiz_results_json.footer += ' <div class="cell cell_last table_data_footer" id="paginate_display">#DATA_TOTAL#</div>';
quiz_results_json.footer += '</div>';

$.ajax({
    type: "GET",
    url: quiz_results_json.url
    , data: quiz_results_json.data
    ,success: function( data ){
        $.each( data.total , function(i,o){
            $( "#" + i + "SpanUser").html( o )
        })
        quiz_results_json.out_data = data ;
        fn_common.render_data( 
            quiz_results_json.template + '<div class="row_data"></div>'
            , {
                "#CLASS#" : " row_js_header"
                , "#ADD#": ""
                , "#DATA#" : '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_data" type="button">Data<i class="fa fa-border-none"></i></button>'
                , "#ADD_DATA#" : ''
                , "#TITLE#" : '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_title" type="button">Titulo do Quiz<i class="fa fa-border-none"></i></button>'
                , "#ADD_TITLE#" : ''
                , "#PARTICIPANTE#" : '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_participante" type="button">Participante<i class="fa fa-border-none"></i></button>'
                , "#ADD_PARTICIPANTE#" : ''
                , "#POINTS#" : '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_points" type="button">Pontos<i class="fa fa-border-none"></i></button>'
                , "#ADD_POINTS#" : ''
                , "#ACERTOS#" : '<button style="width: 100%; background-color: #ffffff; color: #707070; text-align: left; font-weight: bold; padding: 0px;" id="btn_ordenation_acertos" type="button">Acertos<i class="fa fa-border-none"></i></button>'
                , "#ADD_ACERTOS#" : ''
            }
            , "#solaris-head-data" 
        ) ;
        $.each( data.row , function(i,o){
            fn_common.render_data( 
                quiz_results_json.template
                , {
                    "#CLASS#" : " table_data_data"
                    , "#ADD#": ' data-data="' + o.created_at + '" data-title="' + o.title + '" data-participante="' + o.participante + '" data-points="' + o.points + '"'
                    , "#ADD_DATA#" : ' title="#DATA#"'
                    , "#ADD_TITLE#" : ' title="#TITLE#"'
                    , "#ADD_PARTICIPANTE#" : ' title="#PARTICIPANTE#"'
                    , "#ADD_POINTS#" :' title="#POINTS#"'
                    , "#ADD_ACERTOS#" : ' title="#ACERTOS#"'
                    , "#DATA#" :  String( o.created_at ).replace(/^(....).(..).(..).(.....).+/,"$3/$2/$1 $4")
                    , "#TITLE#" :  o.quizes_attach[0].name
                    , "#PARTICIPANTE#" :  o.users_attach[0] != undefined ? o.users_attach[0]["first_name"] + " " + o.users_attach[0]["last_name"] : ""
                    , "#POINTS#" : parseFloat( o.pontos ).toFixed(2)
                    , "#ACERTOS#" :  parseFloat( o.acertos ).toFixed(0)
                }
                , "#solaris-head-data .row_data" 
            ) ;
        })
        $.each(['data','title','participante','points','acertos'], function(i,o){
            $("#btn_ordenation_" + o ).bind("click",function(){
                fn_common.ordenation( o )
            })
        });
        fn_common.render_data( 
            quiz_results_json.footer
            , {
                "#DATA_TOTAL#" : ""
            }
            , "#solaris-head-data" 
        ) ;
        fn_common.paginate(1);
        $("#per_page").bind("change", function(){
            fn_common.paginate(1);
        })
    }
})


var fn_common = {
    render_data: function (template, data, destine) {
        $.each(data, function (r, p) {
            var t = new RegExp(r, "g")
            template = String(template).replace(t, p);
        })
        $(destine).append(template);
    }, 
    paginate: function( sr ){
        paginate_control_button = '<button type="button" id="btn_#ID#" class="btn">#CONTEXT#</button>';
        per_page = $("option:selected", "#per_page").val() ;
        paginate = sr * per_page  ;
        $("#paginate_control").html('') ;
        $.each({
            'first':'<i class="fa fa-angle-double-left"></i>'
            , 'previous':'<i class="fa fa-angle-left"></i>'
            , 'next':'<i class="fa fa-angle-right"></i>'
            , 'last':'<i class="fa fa-angle-double-right"></i>'
        }, function(i,o){
            fn_common.render_data( 
                paginate_control_button
                , {
                    "#CONTEXT#" : o
                    , "#ID#": i
                }
                , "#paginate_control" 
            ) ;
        });

        if( sr == 1 ){
            $('#btn_first').prop( "disabled", true ).unbind("click");
            $('#btn_previous').prop( "disabled", true ).unbind("click");
        }
        else{
            $('#btn_first').prop( "disabled", false ).unbind("click").bind("click", function(){ 
                fn_common.paginate( 1 ) ; 
            })
            $('#btn_previous').prop( "disabled", false ).unbind("click").bind("click", function(){
                fn_common.paginate( ( sr - 1 ) ) ; 
            });
        }

        paginate_text = ( paginate - per_page + 1 ) ;

        if( paginate < quiz_results_json.out_data.total.total ){
            last_paginate = quiz_results_json.out_data.total.total % per_page == 0 ? quiz_results_json.out_data.total.total / per_page : ( Math.floor( quiz_results_json.out_data.total.total / per_page ) + 1 ) ;
            paginate_text += ' - ' + paginate;
            $('#btn_next').prop( "disabled", false ).unbind("click").bind("click", function(){ 
                fn_common.paginate( ( sr + 1 ) ) ; 
            });
            $('#btn_last').prop( "disabled", false ).unbind("click").bind("click", function(){
                fn_common.paginate( last_paginate ) ; 
            });
        }
        else{
            $('#btn_next').prop( "disabled", true ).unbind("click");
            $('#btn_last').prop( "disabled", true ).unbind("click");
        }
        paginate_text += ' de ' + quiz_results_json.out_data.total.total;
        

        $(".row_data .table_data_data").hide();
        $(".row_data .table_data_data").slice( paginate - per_page , paginate).css({"display":"flex"})
        $("#paginate_display").html( paginate_text );
    }
    , ordenation: function( obj ){
        var ordernation = $("#btn_ordenation_" + obj + " i").hasClass( "fa-angle-up" );
        $.each( $(".row_js_header button i") , function(i,o){
            $(o).removeClass("fa-border-none").removeClass("fa-angle-up").removeClass("fa-angle-down").addClass("fa-border-none")
        })
        $("#btn_ordenation_" + obj + " i").removeClass("fa-border-none").addClass( ordernation ? "fa-angle-down" : "fa-angle-up");
        $(".row_data .table_data_data").sort(function(a,b){ return ( ordernation ? ( $(b).data( obj ) ) > ( $(a).data( obj ) ) : ( $(b).data( obj ) ) < ( $(a).data( obj ) ) ) ? 1 : -1; }).appendTo(".row_data");
    }
}