<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <blockquote class="blockquote">
                <p class="mb-0">Curadoria de Lançamento de Atividades</p>
            </blockquote>
            <hr>
        </div>
    <?php print_pre($GLOBALS["curatorship_url"]); ?>
        <div class="col-sm-12 mt-2">
            <div class="col-sm-12 text-left" style="padding: 0px; ">
                <span type="button" class="bt btn-primar btn-sm" data-toggle="modal" data-target="#modal_add_store">Atividades</span>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="atividades" role="tabpanel" aria-labelledby="atividades-tab">
                    <table class="table table-striped table-inverse mt-2">
                    <div class="col-sm-12">
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Atividade</th>
                                    <th>Modalidade</th>
                                    <th>Data da Entrada</th>
                                    <th>Data da Aprovação</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="5">
                                        <form  id="frm_filter" method="GET" action="<?php print( $GLOBALS["curatorships_url"] ) ?>" style="display: none">
                                            <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                                            <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                                        </form>
                                        <div class="row col-lg-12">
                                            <div class="col-lg-3 form-group">
                                                <select class="form-control" id="select_paginage" class="col-lg-3 ">
                                                    <option <?php print( $paginate == 20 ? 'selected="selected"' : '' ) ?> value="20">20</option>
                                                    <option <?php print( $paginate == 50 ? 'selected="selected"' : '' ) ?> value="50">50</option>
                                                    <option <?php print( $paginate == 100 ? 'selected="selected"' : '' ) ?> value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 d-flex justify-content-center form-group text-center">
                                                <button type="button" id="btn_sr_first" class=" btn ">|<</button>
                                                <button type="button" id="btn_sr_previus" class=" btn "><</button>
                                                <button type="button" id="btn_sr_next" class=" btn ">></button>
                                                <button type="button" id="btn_sr_last" class=" btn ">>|</button>
                                            </div>
                                            <p class="col-lg-3 text-right"><?php print( ( $info["sr"] + 1 ) . " de " . $total )?></p>
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>                                
                                <?php foreach($data as $activie): ?>
                                    <tr>
                                        <td><?php echo isset($activie["post"]["ActivityDetails"]["activityName"]) ? is_empty_or_null($activie["post"]["ActivityDetails"]["activityName"]) ? "-" : $activie["post"]["ActivityDetails"]["activityName"] : "-" ?></td>
                                        <td><?php echo isset($activie["modality"]) ? is_empty_or_null($activie["modality"]) ? "-" : $activie["modality"] : "-" ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($activie["created_at"])) ?></td>
                                        <td></td>
                                        <?php 
                                            if(isset($activie["status"])){
                                                switch($activie["status"]){
                                                    case 'Em Analise':
                                                        printf( '<td class="text-warning"><a href="' . $GLOBALS["registrodeatividade_url"] . '"><i class="fa fa-clock"></i> Em Analise</a></td>', $activie['idx'] ) ;
                                                        break;
                                                    case 'Revisar':
                                                        echo '<td class="text-secondary"><i class="fa fa-exclamation-circle"></i> Em Revisão</td>' ;
                                                        break;
                                                    case 'Aprovado':
                                                        echo '<td class="text-success"><i class="fa fa-check-circle text-success"></i> Aprovado</td>';
                                                        break;
                                                    case 'Negado':
                                                        echo '<td class="text-secondary"><i class="fa fa-times"></i> Reprovado</td>';
                                                        break;
                                                    default: 
                                                        echo '<td>-</td>';
                                                        break;
                                                }   
                                            }
                                            ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .blockquote p {
        color: rgb(85, 85, 85);
        font-size: 25px;
        font-weight: 600;
        font-family: Montserrat;
    }

    #atividades-tab {
        color: #FFFFFF;
        padding: 8px 16px;
        font-size: 16px;
        background: #077111;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 5px 5px 0px 0px;
    }

    #myTabContent {
        box-shadow: rgb(85 85 85) 0px 0px 3px;
        border-top: 10px solid rgb(7, 113, 17);
    }
    .bt.btn-primar.btn-sm{
    color: #FFFFFF;
    border: none;
    cursor: pointer;
    padding: 5px 30px;
    font-size: 16px;
    background: #077111;
    transition: all 400ms ease-in-out;
    font-weight: 600;
    border-radius: 5px 5px 0px 0px;
    }

    a, a:active, a:hover { 
        color: inherit; 
        } 
</style>