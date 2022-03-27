<div class="row">
    <div class="col-sm-12">
        <div class="MuiPaper-root jss33 MuiPaper-elevation1 MuiPaper-rounded">
            <div class="col-sm-12">
                <blockquote class="blockquote">
                    <p class="MuiTypography-root jss34 MuiTypography-body1">Relação de Associados</p>
                </blockquote>
                <hr>
            </div>
            <p class="MuiTypography-root jss39 MuiTypography-body1"> Relação de associados ativos da sua instituição</P>
    
            <div class="MuiPaper-root jss35 MuiPaper-elevation1 MuiPaper-rounded">
                
                    <form id="frm_filter" action="<?php print( $GLOBALS["memberships_url"] ) ?>" method="GET" class="MuiInputBase-root jss37">
                        <input type="hidden" name="paginate" value="<?php print( $paginate ) ?>">
                        <input type="hidden" name="sr" value="<?php print( $info["sr"] ) ?>">
                            <div class="jss36" >
                                <i class="fas fa-search border"></i>
                            </div>
                            <div class="MuiInputBase-root jss47">
                                <label for="search" class="sr-only">Digite o nome do Associado</label>
                                <input name="filter_name" value="<?php print( isset( $info["get"]["filter_name"] ) ? $info["get"]["filter_name"] : "" ) ?>" type="text" class="MuiInputBase-input" placeholder="Digite o nome do Associado">
                            </div>
                            <button type="submit" class="jss38">Buscar</button>
                    </form>
                
            </div>
    
            <div class="col-sm-12 mt-2">
                <div class="col-sm-12 text-left" style="padding: 15px 0px 0px; ">
                    <span type="text" class="bt btn-primar btn-sm" data-toggle="modal" data-target="#modal_add_store">Relação de Associados</span>
                </div>
    
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="atividades" role="tabpanel" aria-labelledby="atividades-tab">
                        <table class="table table-striped table-inverse mt-2">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Nome do Associado CFP</th>  
                                </tr>
                            </thead>
                            <tfoot>
                                <tr><th>
                                    <div class="row col-lg-12">
                                        <?php
                                        if( $total > 0 ){
                                        ?>
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
                                        <?php
                                        }
                                        else{
                                            print("<center>Nenhum Registro encontrado</center>");
                                        }
                                        ?>
                                    </div></th></tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach( $data as $v ){
                                ?>
                                <tr>
                                    <td scope="row"><?php print( $v["first_name"] . " " . $v["last_name"] ) ?></td> 
                                </tr>
                                <?php
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .jss34 {
    color: #555555;
    font-size: 25px;
    font-family: Montserrat;
    font-weight: 600;
    }
    .jss39 {
    color: #555555;
    }
    .MuiTypography-body1 {
    font-size: 1rem;
    font-family: Montserrat;
    font-weight: 400;
    line-height: 1.5;
    }

    .jss35 {
    gap: 10px;
    height: 40px;
    display: flex;
    padding: 15px;
    align-items: center;
    }
    .jss36 {
        display: inline-block;
        align-items: center;
    }

    .MuiSvgIcon-root {
    fill: currentColor;
    width: 1em;
    height: 1em;
    display: inline-block;
    font-size: 1.5rem;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    flex-shrink: 0;
    user-select: none;
    }

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

    .border {
        color: #FFFFFF;
        padding: 12px;
        font-size: 16px;
        background: #077111;
        margin-top: 10px;
        font-weight: 600;
        border-radius: 10px;
    }
    
    .MuiPaper-rounded {
        
    border-radius: 4px;
    }
    .MuiPaper-root {
        
        color: rgba(0, 0, 0, 0.87);
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        background-color: #fff;
    }
    .fas .fa-search .border {
        color: #FFFFFF;
        display: flex;
        padding: 8px;
        align-items: center;
        border-radius: 10px;
        justify-content: center;
        background-color: #999;
    }
    .jss47 {
        display: inline-block;
        width:450px;
        padding: 0px 5px;
        border-radius: 5px;
        background-color: #DDDDDD;
        align-items: center;
    }
    .MuiInputBase-input{
        font: inherit;
        color: currentColor;
        width: 100%;
        border: 0;
        height: 1.1876em;
        margin: 0;
        display: inline-block;
        padding: 6px 0 7px;
        min-width: 0;
        background: none;
        box-sizing: content-box;
        animation-name: mui-auto-fill-cancel;
        letter-spacing: inherit;
        animation-duration: 10ms;
        -webkit-tap-highlight-color: transparent;
        align-items: center;
    }
    .jss38 {
        display: inline-block;
        color: #999;
        border: 1px solid #999;
        padding: 3px 30px;
        text-align: center;
        border-radius: 5px;
        background-color: #FFFFFF;
        align-items: center;
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
</style>