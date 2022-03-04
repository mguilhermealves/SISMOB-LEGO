<div class="container-fluid iniciar-curso">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <h1>Avaliação</h1> 
                <div class="d-flex flex-column"><a href="/curso/<?php printf($course_data["slug"]) ?>">Voltar para: <?php printf($course_data["course_title"]) ?></a></div>
                <div class="row my-5">
                    <div class="col-md-12 justify-content-center mb-5">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-3">
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <p class="MuiTypography-root MuiTypography-body1 text-center" style="font-size: 2rem; font-weight: 600; color: rgb(83, 41, 15);"><?php printf($data["title"]) ?></p>
                            </div>
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <input type="hidden" value="<?php print($_SESSION[ constant("cAppKey") ]["credential"]["idx"]); ?>" class="user_id" />
                                <input type="hidden" value="<?php print($data["idx"]) ?>" class="object_id" />
                                <input type="hidden" value="test" class="type" /> 
                                <input type="hidden" value="<?php print($objeto_completo) ?>" class="complete" /> 
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <div class="llms-quiz-results single-llms_quiz">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <h2 class="llms-quiz-results-title text-center pb-4">Resultado</h2>
                                        <aside class="llms-quiz-results-aside">
                                                
                                                <div id="donutchart">
                                                    <div id="labelOverlay">
                                                                   
                                                    </div>
                                                    <div id="chart"></div>       
                                                </div>                
                                                <?php  setlocale(LC_ALL, 'pt_BR'); ?>
                                                <ul class="llms-quiz-meta-info mt-4 text-center">
                                                    <li class="llms-quiz-meta-item" id="response_corrects"></li>
                                                    <li class="llms-quiz-meta-item"><?php print(ucfirst( utf8_encode( strftime("%d de %B de %Y", strtotime($attempt_current[0]["created_at"]) ) ) )); ?> completo</li>
                                                    <li class="llms-quiz-meta-item">Tempo total: <?php print($attempt_current[0]["duration"]) ?></li>
                                                </ul>
                                            </aside>
                                    </div>
                                    <div class="col-lg-8">

                                        <section class="llms-quiz-results-main">
                                            <style>
                                                .llms-status-icon-tip .fa-times{ color: red;padding:0;font-size: 20px; }
                                                .llms-status-icon-tip .fa-check{ color: green;padding:0;font-size: 20px; }
                                                .corect .llms-quiz-attempt-answers .llms-quiz-attempt-answer { color: green; }
                                                .incorect .llms-quiz-attempt-answers .llms-quiz-attempt-answer { color: red; }
                                                .llms-quiz-attempt-answer-section .llms-quiz-attempt-answers { margin-left: 0px; }
                                                .llms-quiz-attempt-answer-section .llms-quiz-attempt-answers .llms-quiz-attempt-answer { list-style: none; }
                                                .llms-quiz-attempt-answer-section+.llms-remarks{ border: 2px solid #ffd8bf; margin-top: 15px; border-radius: 15px; padding: 15px; display:flex; flex-direction:row; align-items: center; }
                                                .fa-exclamation{ color:#ff6600;border: 1px solid #ff6600;border-radius: 25px;padding: 4px 12px;font-size: 1.5rem; }
                                                .llms-remarks .remarks{ font-size: 1.2rem; margin-bottom: 0px; font-weight: bold; }
                                            </style>
                                            <ol class="llms-quiz-attempt-results">
                                            <?php 
                                                $somapontoscorretos = 0;
                                                $countcorretas = 0;
                                                $displaycalc = count(array_filter( $attempt_current, function($x){ return $x["execute_corrections"] == 'no'; }) ) == 0 ;
                                                foreach( $data["questions_attach"] as $k => $question ){ 
                                                ?>
                                                <li class="llms-quiz-attempt-question type--choice status--graded incorrect" data-question-id="17017" data-grading-manual="no" data-points="1" data-points-curr="0" style="padding: 15px; border: 1px solid #c0c0c0; border-radius: 15px;list-style: none;margin-bottom:15px">
                                                    <h3 class="llms-question-title" style="margin-bottom: 0px;font-size:1.0rem">
                                                        <strong><?php print($question["title"]) ?></strong>
                                                    </h3>
                                                        <?php
                                                            switch( $question["type"] ){
                                                                case "dicotomia":
                                                                    $correta =  array_column(array_filter( $question["alternatives_attach"], function($x){ return $x["is_correct"] == 'yes'; }), "title", "idx");
                                                                    $selecionada = array_column( $question["alternatives_attach"], "title", "idx");
            
                                                                    $somapontoscorretos += key($correta) == $attempt_current[$k]["alternatives_id"] ? $question["points"] : 0;
                                                                    $countcorretas += key($correta) == $attempt_current[$k]["alternatives_id"] ? 1 : 0;
                                                        ?>
                                                            <span class="llms-points">
                                                                <span 
                                                                    <?php print( $displaycalc ? ( key($correta) == $attempt_current[$k]["alternatives_id"] ? 'style="color:green"' : 'style="color:red"' ) : '' ) ?> 
                                                                >
                                                                    <?php print( $displaycalc ? (key($correta) == $attempt_current[$k]["alternatives_id"] ? $question["points"] : '0.00') : '-' ) ?>    
                                                                </span> 
                                                                / <?php print($question["points"]) ?> pontos
                                                            </span>
                                                            <span class="llms-status-icon-tip tip--top-left" data-tip="Resposta <?php print($displaycalc ? ( key($correta) == $attempt_current[$k]["alternatives_id"] ? "corect" : "incorect") : "" ) ?>">
                                                                <i class="<?php print( $displaycalc ? ( key($correta) == $attempt_current[$k]["alternatives_id"] ? "llms-status-icon fa fa-check" : "llms-status-icon fa fa-times") : "" ) ?>"></i>
                                                            <span>
                                                            <div class="llms-quiz-attempt-answer-section llms-student-answer corrent <?php print(  $displaycalc ? ( key($correta) == $attempt_current[$k]["alternatives_id"] ? "corect" : "incorect") : "" ) ?>">
                                                                <p class="llms-quiz-results-label student-answer" style="font-size: 1.2rem;margin-top: 15px;margin-bottom: 0px;">Resposta selecionada:</p>
                                                                <ul class="llms-quiz-attempt-answers">
                                                                    <li class="llms-quiz-attempt-answer">
                                                                        <?php print($selecionada[$attempt_current[$k]["alternatives_id"]]) ?>&nbsp;
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <?php if(key($correta) != $attempt_current[$k]["alternatives_id"]){ ?>
                                                                <div class="llms-quiz-attempt-answer-section llms-correct-answer">
                                                                    <p class="llms-quiz-results-label correct-answer" style="font-size: 1.2rem;margin-top: 15px;margin-bottom: 0px;">Resposta correta: </p>
                                                                    <ul class="llms-quiz-attempt-answers">
                                                                        <li class="llms-quiz-attempt-answer">
                                                                            <?php print(current($correta)) ?>&nbsp;
                                                                        </li>
                                                                    </ul>
                                                            	</div>
                                                                <?php if( !empty($question["justification"]) ){?>
                                                                <div class="llms-quiz-attempt-answer-section llms-correct-answer">
                                                                    <p class="llms-quiz-results-label correct-answer" style="font-size: 1.2rem;margin-top: 15px;margin-bottom: 0px;">Justificativa: </p>
                                                                    <ul class="llms-quiz-attempt-answers">
                                                                        <li class="llms-quiz-attempt-answer">
                                                                            <?php print($question["justification"]) ?>&nbsp;
                                                                        </li>
                                                                    </ul>
                                                            	</div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php
                                                                break;
                                                                case "dissertativa":
                                                        ?>
                                                            <span class="llms-points">
                                                                <span 
                                                                    <?php print( $displaycalc ? ( $question["points"] == $attempt_current[$k]["execute_points"] ? 'style="color:green"' : 'style="color:red"') : "" ) ?> 
                                                                >
                                                                    <?php print( $displaycalc ? $attempt_current[$k]["execute_points"] : '-') ?>    
                                                                </span> 
                                                                / <?php print($question["points"]) ?> pontos
                                                            </span>
                                                            <div class="llms-quiz-attempt-answer-section llms-student-answer corrent <?php print( $displaycalc ? ( $question["points"] == $attempt_current[$k]["execute_points"] ? "corect" : "incorect" ) : "" ) ?>">
                                                                <p class="llms-quiz-results-label student-answer" style="font-size: 1.2rem;margin-top: 15px;margin-bottom: 0px;">Resposta selecionada:</p>
                                                                <ul class="llms-quiz-attempt-answers">
                                                                    <li class="llms-quiz-attempt-answer">
                                                                        <?php print($attempt_current[$k]["alternatives_text"]) ?>&nbsp;
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        <?php
                                                                break;
                                                            }
                                                        ?>
                                                </li>
                                            <?php } ?>                                               
                                            </ol>
                                        </section>

                                        <?php $allAttempts = course_controller::allAttempts($data["idx"]); ?>

                                        <section class="llms-quiz-results-history-no-remove pt-2">
                                        <h2 class="llms-quiz-results-title">Ver a avaliação respondida</h2>
                                            <select class="form-control mt-2" id="llms-quiz-attempt-select" name="attempt_number" data-url="<?php print($_SERVER["REQUEST_URI"]); ?>" >
                                                <option value="">-- Escolha uma tentativa --</option>
                                                <?php foreach($allAttempts as $k=>$value){ ?>
                                                    <option value="<?php echo $value["attempt_number"] ?>">
                                                            Tentativa #<?php echo $value["attempt_number"] ?>
                                                    </option>
                                                <?php } ?>                                            
                                            </select>
                                        </section>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <?php include( constant("cRootServer") . "ui/page/course/parts/nav.php"); ?>
            </div>
        </div>
    </div>
</div>


<?php 

    $totalquestions = count($data["questions_attach"]);
    $valor = $countcorretas;
    if( $displaycalc ){
        $resultado = ($valor / $totalquestions) * 100;
        $erradas = 100 - $resultado;
    }
    else{
        $resultado = 0;
        $erradas = 100;
    }

?>

<script>
                                        
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Respostas', 'Percentual'],
            ['Corretas',     <?php print($resultado) ?>],
            ['Erradas',      <?php print($erradas) ?>],		
        ]);

        var options = {
            title: "",
            pieHole: 0.80,
            pieSliceBorderColor: "none",
            colors: ['#289917', '#f1f1f1', '#eaeaea' ],
            chartArea:{left:0,top:0,width:'100%',height:'100%'},
            legend: {
                position: "none"	
            },
            pieSliceText: "none",
            tooltip: {
                trigger: "none"
            }

          

        };

        var chart = new google.visualization
                .PieChart(document.getElementById('chart'));
            
        chart.draw(data, options);
       

        document.getElementById("labelOverlay").innerHTML = <?php print( $displaycalc ? '\'<p class="used-size">'.$somapontoscorretos.'</p>\'' : '\'<p class="used-size" style="font-size:14px">Aguardando Correção</p>\'') ?>;
        document.getElementById("response_corrects").innerHTML = 'Respostas corretas: <?php print( $displaycalc ? $countcorretas . "/" . $totalquestions : "Aguardando Correção" ) ?>';
        
    }
</script>

<style>
    .llms-quiz-results-aside{width:100%;float: left;}
    .llms-quiz-results-main{width: 100%;float: left;}
    .single-llms_quiz .llms-donut.incomplete { color: red!important;}
    .single-llms_quiz .llms-quiz-results .llms-donut.incomplete svg path {
        stroke: red!important;
    }
    .llms-donut{
        background-color: #f1f1f1;
        background-image: none;
        border-radius: 50%;
        color: #ef476f;
        height: 200px;
        overflow: hidden;
        position: relative;
        width: 200px;
    }
    .llms-donut,
    .single-llms_quiz .llms-donut.passing {
        color: #289917!important;
        font-weight: 700;
    }
    .llms-donut svg path,
    .single-llms_quiz .llms-quiz-results .llms-donut.passing svg path {
        stroke: #289917!important;
    }
    .llms-donut svg path{fill: none;stroke-width: 35px;}
    .llms-donut::before, .llms-donut::after {

    content: " ";
    display: table;

    }
    .llms-donut .inside{
        -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: #fff;
    border-radius: 50%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    height: 80%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    left: 50%;
    position: absolute;
    text-align: center;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    width: 80%;
    top: 50%;
    z-index: 3;
    }
    .llms-donut .percentage{
        line-height: 1.2;
        font-size: 34px;
    }
    #donutchart,
    #chart {
    width: 100%;
    height:auto;
    font-family: Arial;
    }

    #donutchart {
        position: relative;
    }

    #labelOverlay {
        width: 100%;
        height: 100%;
        display: flex;
        top: 0;
        left: auto;
        text-align: center;
        cursor: default;
        z-index: 9;
        right: auto;
        align-items: center;
        justify-content: center;
        position: absolute;
    }

    #labelOverlay p {
    line-height: 0.3;
    padding:0;
    margin: 8px;
    }

    #labelOverlay p.used-size {
    line-height: 0.5;
    font-size: 28pt;
    color: #289917;
    }

    #labelOverlay p.total-size {
    line-height: 0.5;
    font-size: 12pt;
    color: #cdcdcd;
    }
</style>