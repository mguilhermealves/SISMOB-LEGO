
$("#btn_export").bind("click",function(){
    $("#frm_filter").prop({"action": $("#frm_filter").prop("action") + '.xls' });
    $("#frm_filter").submit();
    $("#frm_filter").prop({"action": String( $("#frm_filter").prop("action") ).replace(/.xls/,'') });
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
        per_page = $("#per_page").length > 0 ?  $("option:selected", "#per_page").val() : 20 ;
        paginate = sr * Number( per_page ) ;

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
                $("#paginate").val( $("option:selected","select[id='per_page']").val() );
                $("#sr").val( 1 );
                $("#frm_filter").submit();
                //fn_common.paginate( 1 ) ; 
            })
            $('#btn_previous').prop( "disabled", false ).unbind("click").bind("click", function(){
                $("#paginate").val( $("option:selected","select[id='per_page']").val() );
                $("#sr").val( sr - 1 );
                $("#frm_filter").submit();
                //fn_common.paginate( ( sr - 1 ) ) ; 
            });
        }

        paginate_text = ( paginate - per_page + 1 ) ;

        if( paginate < data_preregisters_json.out_data.total.total ){
            last_paginate = data_preregisters_json.out_data.total.total % per_page == 0 ? data_preregisters_json.out_data.total.total / per_page : ( Math.floor( data_preregisters_json.out_data.total.total / per_page ) + 1 ) ;
            paginate_text += ' - ' + paginate;
            $('#btn_next').prop( "disabled", false ).unbind("click").bind("click", function(){ 
                $("#paginate").val( $("option:selected","select[id='per_page']").val() );
                $("#sr").val( sr + 1 );
                $("#frm_filter").submit();
                //fn_common.paginate( ( sr + 1 ) ) ; 
            });
            $('#btn_last').prop( "disabled", false ).unbind("click").bind("click", function(){
                $("#paginate").val( $("option:selected","select[id='per_page']").val() );
                $("#sr").val( last_paginate );
                $("#frm_filter").submit();
                //fn_common.paginate( last_paginate ) ; 
            });
        }
        else{
            $('#btn_next').prop( "disabled", true ).unbind("click");
            $('#btn_last').prop( "disabled", true ).unbind("click");
        }
        paginate_text += ' de ' + data_preregisters_json.out_data.total.total;

        //$(".row_data .table_data_data").hide();
        //$(".row_data .table_data_data").slice( paginate - per_page , paginate).css({"display":"flex"})
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
$(document).ready( function(){
    /*$.each(['name','preregister','grupo','mail','cpf','status'], function(i,o){
        $("#btn_ordenation_" + o ).bind("click",function(){
            fn_common.ordenation( o )
        })
    });*/
    fn_common.paginate( data_preregisters_json.page );
    $("select[id='per_page']").bind("change",function(){
        $("#paginate").val( $("option:selected","select[id='per_page']").val() );
        $("#sr").val( 1 );
        $("#frm_filter").submit();
    })
    $("button[id^='btn_ordenation']").bind("click",function(){
        $("#ordenation").val( String( $(this).attr("id") ).replace(/btn_ordenation_/,'') ); 
        $("#frm_filter").submit();
    })
})