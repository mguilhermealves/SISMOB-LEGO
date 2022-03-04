<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <blockquote class="blockquote">
            <p class="mb-0">Analytics</p>
         </blockquote>
         <hr>
         <div class="row">
            <div class="col-sm-12 ">
               <form class="MuiInputBase-root jss37"id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>">
                  <div class="row">
                     <div class="col-sm-4" >
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input class="form-control select-custom-full-width" type="date" name="period_start" value=''style="font-size: revert; !important;">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input  class="form-control select-custom-full-width" type="date" name="period_end" value=''style="font-size: revert; !important;">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">                           
                           <input type="text" class="form-control" placeholder="Escreva o nome do Aluno">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Grupos de Acesso:</label>
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Grupos de Acesso</option>
                              <?php 
                                 foreach( profiles_controller::data4select("idx",array( " idx > 2 " ) ) as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="paginate" id="paginate" value="<?php print( $paginate ) ?>">
                  <input type="hidden" name="ordenation" id="ordenation" value="<?php print( $ordenation ) ?>">
                  <input type="hidden" name="sr" id="sr" value="<?php print( $info["sr"] ) ?>">
                  <div class="row">
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Gerente de Contas:</label>
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Gerente de Contas</option>
                              <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Estados:</label>
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Estados</option>
                              <?php 
                                 foreach( $GLOBALS["ufbr_lists"] as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Concluidos:</label>    
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Concluidos:</option>
                              <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Aprovados:</label>    
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Aprovados</option>
                              <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="search" class="sr-only">Usuarios Ativos:</label>    
                           <select class="form-control" name="filter_authenticate">
                              <option value="0"<?php print( !isset( $info["get"]["filter_authenticate"] ) || $info["get"]["filter_authenticate"] == "" ? " selected" : "" ) ?>>Usuarios Ativos</option>
                              <?php 
                                 foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                       printf('<option value="%s"%s>%s</option>'."\n" , $k , isset( $info["get"]["filter_authenticate"] ) && $info["get"]["filter_authenticate"] == $k ? ' selected="selected"' : ''  , $v);
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <button type="submit" class="jss38 btn-block">Filtrar</button> 
                     </div>
                  </div>
               </form>
               <div class="col-sm-4"></div>
            </div>
            <div class="col-sm-12" style="overflow: auto;">
               <table class="table">
                  <thead >
                     <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Grupo</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        foreach ($data as $key => $value) {
                        ?>
                     <tr>
                        <td><?php print( $value["name"] ) ?></td>
                        <td><?php print(  $value["login"])  ?></td>
                        <td><?php print(isset( $value["profiles_attach"][0] ) ? $value["profiles_attach"][0]["name"] : "-") ?></td>
                        <td><?php print(  $value["mail"])  ?></td>
                        <td><?php print(  $value["cpf"])  ?></td>
                        <td>
                           <a class="btn btn-primary mx-2" href="<?php printf( $form["pattern"]["action"] , $value["idx"] ) ?>" class="button tiny bg-blue round" title="Editar">Editar<i class="fontello-edit"></i></a>
                        </td>
                     </tr>
                     <?php
                        }
                        ?>
                  </tbody>
                  <tfoot>
                     <tr>
                        <th colspan="5">
                           <form class="" id="frm_filter" method="GET" action="<?php print( $form["pattern"]["search"] ) ?>" style="display: none;flex-direction: row;justify-content: space-around;align-items: flex-end;">
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
               </table>
            </div>         
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
   background: #f26724;
   margin-top: 10px;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
   #myTabContent {
   box-shadow: rgb(85 85 85) 0px 0px 3px;
   border-top: 10px solid rgb(242, 103, 36);
   }
   #helpId ul {
   position: relative;
   right: 35px;
   }
   #helpId li {
   list-style: none;
   }
   .bt.btn-primar.btn-sm{
   color: #FFFFFF;
   border: none;
   cursor: pointer;
   padding: 5px 30px;
   font-size: 16px;
   background: #f26724;
   transition: all 400ms ease-in-out;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
   table, thead {
   background: rgb(210, 210, 210);
   color: #707070;
   cursor: pointer;
   padding: 14px 0px 14px 0px;
   font-size: 14px;
   font-weight: bold;
   border-top: 10px solid rgb(242, 103, 36);
   }
   .table td {
   color: #707070;
   width: 15%;
   padding: 12px 20px 12px 0px;
   font-size: 14px;
   background: transparent;
   font-weight: 500;
   border-width: 3px;
   border-spacing: 3px;
   }
   table tbody tr:hover {
   background: #70707041;
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
   background: #f26724;
   margin-top: 10px;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
   #myTabContent {
   box-shadow: rgb(85 85 85) 0px 0px 3px;
   border-top: 10px solid rgb(242, 103, 36);
   }
   #helpId ul {
   position: relative;
   right: 35px;
   }
   #helpId li {
   list-style: none;
   }
   .bt.btn-primar.btn-sm{
   color: #FFFFFF;
   border: none;
   cursor: pointer;
   padding: 5px 30px;
   font-size: 16px;
   background: #f26724;
   transition: all 400ms ease-in-out;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
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
   background: #f26724;
   margin-top: 10px;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
   #myTabContent {
   box-shadow: rgb(85 85 85) 0px 0px 3px;
   border-top: 10px solid rgb(242, 103, 36);
   }
   .border {
   color: #FFFFFF;
   padding: 12px;
   font-size: 16px;
   background: #f26724;
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
   background-color:#f26724;
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
   color:#f26724;
   border: 1px solid#f26724;
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
   background: #f26724;
   transition: all 400ms ease-in-out;
   font-weight: 600;
   border-radius: 5px 5px 0px 0px;
   }
   .select-custom-full-width{
   width: 100% !important;
   }
   .custom-margim-bottom {
   margin-bottom: 10px;
   }
</style>

