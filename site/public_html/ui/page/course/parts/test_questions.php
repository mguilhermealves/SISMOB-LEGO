<?php
print('<script>var questions_id = []; var question_type = [];</script><form method="POST" action="" id="llms_start_quiz_2" enctype="multipart/form-data">');
print('<input id="tests_id" name="tests_id" type="hidden" value="' . $data["idx"] . '"/>');
print('<input type="hidden" name="started_at" value="' . date("Y-m-d H:i:s") . '" />');
print('<input type="hidden" name="course_slug" value="' . $course_data["slug"] . '" />');
print('<input type="hidden" name="duration" id="duration" value="" />');

foreach( $data["questions_attach"] as $k =>  $question ){
	print('<div class="llms-question-solaris">');
    printf('<div class="llms-question-description">%d) %s</div>' , $k + 1 , $question["title"] );
    //print_pre($question["alternatives_attach"]);

    // if( $current_meta["_llms_description_enabled"] == "yes" ){
    //     printf('<div class="llms-question-description"%s</div>' , $question->post_content );
    // }

    switch( $question["type"] ){
        case "choice":
        case "verdeiro_falso":        
	        $text_Option[] = "question_" . $question["idx"] ;	
            $keys = array_filter( array_keys( $current_meta ) , function($key) { return strpos($key, '_llms_choice_') === 0; });
            $input_type = 'yes' === $current_meta["_llms_multi_choices"] ? 'checkbox' : 'radio';
            print( '<script>question_type["question_' . $question["idx"] . '[]"]="choise";questions_id["question_' . $question["idx"] . '[]"] = "question_' . $question["idx"] . '[]";</script><ol class="llms-question-choices">');
            // $option = array();
            // foreach( $keys as $value ){
            //         $unserialize = unserialize( $current_meta[ $value ] ) ;
            //     $option[ $unserialize["marker"] ] = array(
            //         "id" => $unserialize["id"]
            //         , "question_id" => $unserialize["question_id"]
            //         , "marker" => $unserialize["marker"]
            //         , "choice" => $unserialize["choice"]
            //     ) ;
            // }
            ksort($question["alternatives_attach"]);
            foreach( $question["alternatives_attach"] as $value ){
                $li = '<li class="llms-choice type--text" id="choice-wrapper-#choice_ID#">';
                $li .= '    <label for="choice-#choice_ID#">';
                $li .= '        <input id="choice-#choice_ID#" name="question_#question_ID#[]" type="#input_type#" value="#choice_ID#">';
                $li .= '        <span style="min-width:27px;min-height:27px" class="llms-marker type--#input_type#">';
                $li .= '            <span class="iterator">#choice_marker#</span>';
                $li .= '            <i class="fa fa-check"></i>';
                $li .= '        </span>';
                $li .= '        <p class="llms-choice-text">#choice_choice#</p>';
                $li .= '    </label>';
                $li .= '</li>';
                print( 
                    strtr( 
                        $li 
                        , array(
                            "#choice_ID#" => $value["idx"]
                            , "#question_ID#" => $question["idx"]
                            , "#input_type#" => $input_type
                            , "#choice_marker#" => $value["marker"]
                            , "#choice_choice#" => $value["choice"]
                        ) 
                    ) 
                );
            }
            print( '</ol>');
        break;
        case "dicotomia":   
        case "alternativa":        
            $text_Option[] = "question_" . $question["idx"] ;
            $marker = array("A","B","C","D","E","F","G","H","I","J");	
            //$keys = array_filter( array_keys( $current_meta ) , function($key) { return strpos($key, '_llms_choice_') === 0; });
            //$input_type = 'yes' === $current_meta["_llms_multi_choices"] ? 'checkbox' : 'radio';
            $input_type = 'radio';
            print( '<script>question_type["question_' . $question["idx"] . '[]"]="alternativa";questions_id["question_' . $question["idx"] . '[]"] = "question_' . $question["idx"] . '[]";</script><ol class="llms-question-choices">');
            // $option = array();
            // foreach( $keys as $value ){
            //         $unserialize = unserialize( $current_meta[ $value ] ) ;
            //     $option[ $unserialize["marker"] ] = array(
            //         "id" => $unserialize["id"]
            //         , "question_id" => $unserialize["question_id"]
            //         , "marker" => $unserialize["marker"]
            //         , "choice" => $unserialize["choice"]
            //     ) ;
            // }
            ksort($question["alternatives_attach"]);
                foreach( $question["alternatives_attach"] as $k => $value ){
                    $li = '<li class="llms-choice type--text" id="choice-wrapper-#alternativa_ID#">';
                    $li .= '    <label for="alternativa-#alternativa_ID#">';
                    $li .= '        <input id="alternativa-#alternativa_ID#" name="questions[#question_ID#]" type="#input_type#" value="#alternativa_ID#,#alternativa_alternativa#">';
                    $li .= '        <span style="min-width:27px;min-height:27px" class="llms-marker type--#input_type#">';
                    $li .= '            <span class="iterator">#alternativa_marker#</span>';
                    $li .= '            <i class="fa fa-check"></i>';
                    $li .= '        </span>';
                    $li .= '        <p class="llms-alternativa-text">#alternativa_alternativa#</p>';
                    $li .= '    </label>';
                    $li .= '</li>';
                    print( 
                        strtr( 
                            $li 
                            , array(
                                "#alternativa_ID#" => $value["idx"]
                                , "#question_ID#" => $question["idx"]
                                , "#input_type#" => $input_type
                                , "#alternativa_marker#" => $marker[$k]
                                , "#alternativa_alternativa#" => $value["title"]
                            ) 
                        ) 
                    );
                }
            print( '</ol>');
        break;
        case "code":
			print( strtr( '<script>question_type["question_' . $question["idx"] . '"]="textarea";questions_id["question_' . $question["idx"] . '"] = "question_' . $question["idx"] . '";</script><textarea required="required" name="question_#ID#" id="question_#ID#"></textarea>' , array( "#ID#" => $question["idx"] ) ) );
        break;	
        case "short_answer":
			print( strtr( '<script>question_type["question_' . $question["idx"] . '"]="text";questions_id["question_' . $question["idx"] . '"] = "question_' . $question["idx"] . '";</script><input required="required" class="llms-aq-short-answer-field" id="question_#ID#" type="text" name="question_#ID#">' , array( "#ID#" => $question["idx"] ) ) );
		break;	
        case "long_answer":
        case "dissertativa":
			$text_Edito[] = "question_" . $question["idx"] ;
			print( strtr( '<script>question_type["question_' . $question["idx"] . '"]="textarea";questions_id["question_' . $question["idx"] . '"] = "question_' . $question["idx"] . '";</script><textarea required="required" name="questions[#ID#]" id="question_#ID#" style="height: 137px;border:1px solid #000; width:100%"></textarea>' , array( "#ID#" => $question["idx"] ) ) );
		break;	
    }
	print('</div>');
}

print('<div class="row">');
print('<div class="col-lg-12 wiki-content text-center">');
print('<button class="btn lms-button-danger" id="llms_start_quiz1" name="llms_start_quiz1" type="submit">Responder Avaliação</button>');
print('</div>');
print('</div>');

print("</form>");


?>


<style>
.llms-question-solaris{ border: 1px solid #c0c0c0; padding: 1rem; margin-bottom: 1rem; }
.llms-question-choices{ list-style-type: none; margin: 0; padding: 0; }
.llms-question-choices li.llms-choice { border-bottom: 1px solid #e8e8e8; margin: 0; padding: 0; position: relative; }
.llms-question-choices li.llms-choice label { display: flex; margin: 0; padding: 10px 20px; position: relative; }
.llms-question-choices li.llms-choice input { display: none; left: 0; pointer-events: none; position: absolute; top: 0; visibility: hidden; }
input[type=checkbox], input[type=radio] { box-sizing: border-box; padding: 0; }
input[type="radio"]:checked, input[type=reset], input[type="checkbox"]:checked, input[type="checkbox"]:hover:checked, input[type="checkbox"]:focus:checked, input[type=range]::-webkit-slider-thumb { border-color: #0274be; background-color: #0274be; box-shadow: none; }
.llms-question-choices li.llms-choice .llms-marker.type--radio { border-radius: 50%; }
.llms-question-choices li.llms-choice .llms-marker { font-size: 1em; width: 1.75em; height: 1.75em; line-height: 1.75em; background: #f0f0f0; display: inline-block; margin-right: 10px; text-align: center; -webkit-transition: all 0.2s ease; transition: all 0.2s ease; vertical-align: middle; }
.llms-question-choices li.llms-choice .llms-marker .fa { display: none; line-height: 1.7rem; margin-left: 0 !important;padding: 0 !important;font-size: 18px}
.llms-question-choices li.llms-choice .llms-marker .fa::before{margin-left: -10px;}
.llms-question-choices li.llms-choice .llms-marker i { color: #289917; }
.llms-question-choices li.llms-choice .llms-choice-text{ display: inline-block; }
.llms-question-choices li.llms-choice label{ cursor: pointer;}
.llms-question-choices li.llms-choice label .llms-marker .iterator { display: block; }
.llms-question-choices li.llms-choice label .llms-marker .iterator .fa{}
.llms-question-choices li.llms-choice label .llms-marker .fa { display: none; }
.llms-question-choices li.llms-choice label:hover .llms-marker .iterator { display: none; }
.llms-question-choices li.llms-choice label:hover .llms-marker .fa { display: block; }
.llms-question-choices li.llms-choice input:checked+.llms-marker { background: #289917; }
.llms-question-choices li.llms-choice input:checked+.llms-marker .iterator { display: none; }
.llms-question-choices li.llms-choice input:checked+.llms-marker .fa { display: block; color:#FFF }
</style>

<script>

var time = 0
    setInterval(function(){
        time++
        var sec = time % 60
        var min = (time-sec)/60 % 60
        var hour = (time-sec-min*60)/3600
        var str= hour+':'+("0"+min).slice(-2)+':'+("0"+sec).slice(-2)
        document.getElementById("duration").value = str
    },1000);
</script>