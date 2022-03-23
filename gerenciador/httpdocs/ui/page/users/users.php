<!-- Container Begin -->
<div class="row">
   <div class="col-sm-12">
      <p class="mb-0"><a href="<?php print($GLOBALS["home_url"]) ?>">Home</a> / Usuarios</p>
      <hr />
      <!-- Button trigger modal -->
      <form class="col-sm-12" id="frm_filter" method="GET" action="<?php print($form["pattern"]["search"]) ?>">
         <input type="hidden" name="paginate" id="paginate" value="<?php print($paginate) ?>">
         <input type="hidden" name="ordenation" id="ordenation" value="<?php print($ordenation) ?>">
         <input type="hidden" name="sr" id="sr" value="<?php print($info["sr"]) ?>">
         <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="filter_first_name" class="sr-only">Primeiro Nome:</label>
                  <input type="text" class="form-control" name="filter_first_name" value="<?php print(isset($info["get"]["filter_first_name"]) ? $info["get"]["filter_first_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Primeiro Nome">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="filter_last_name" class="sr-only">Ultimo Nome:</label>
                  <input type="text" class="form-control" name="filter_last_name" value="<?php print(isset($info["get"]["filter_last_name"]) ? $info["get"]["filter_last_name"] : "") ?>" class="MuiInputBase-input form-control" placeholder="Digite o Ultimo Nome">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="filter_cpf" class="sr-only">CPF:</label>
                  <input type="text" class="form-control" name="filter_cpf" class="MuiInputBase-input form-control" placeholder="Digite o CPF" value="<?php print(isset($info["get"]["filter_cpf"]) ? $info["get"]["filter_cpf"] : "") ?>">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="filter_profile" class="sr-only ">Grupo de Acesso:</label>
                  <select class="form-control " name="filter_profile">
                     <option value="0" <?php print(!isset($info["get"]["filter_profile"]) || $info["get"]["filter_profile"] == "" ? " selected" : "") ?> placeholder="Digite o Email">Selecione</option>
                     <?php
                     foreach (profiles_controller::data4select("idx", array(" active = 'yes' ", " idx > 2 "), "name") as $k => $v) {
                        printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($info["get"]["filter_profile"]) && $info["get"]["filter_profile"] == $k ? ' selected="selected"' : '', $v);
                     }
                     ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
               
            </div>

            <div class="col-sm-2">
               <button type="submit" class="btn btn-info btn-block btn-sm"><i class="bi bi-search"></i> Filtrar</button>
            </div>

            <div class="col-sm-2">
               <a id="btn_add" class="btn btn-primary btn-block btn-sm" title="Adicionar" href="<?php print($form["new"]) ?>"><i class="bi bi-plus-circle"></i> Novo Usuário</a>
            </div>

            <div class="col-sm-2">
               <button id="btn_export" type="button" class="btn btn-info btn-block btn-sm"><i class="bi bi-file-spreadsheet"></i> Exportar</button>
            </div>
         </div>
      </form>

      <hr />
      <!-- Container Begin -->
      <div class="row text-center">
         <div class="col-sm-12" style="overflow: auto;">
            <table class="table">
               <thead>
                  <tr>
                     <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_name))) ?>">Nome <i class="<?php print($ordenation_name_ordenation) ?>"></i></a>
                     </th>
                     <th>
                        Grupo
                     </th>
                     <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_mail))) ?>">Email <i class="<?php print($ordenation_mail_ordenation) ?>"></i></a>
                     </th>
                     <th>
                        <a style="color:#707070;text-decoration:none" href="<?php print(set_url($form["pattern"]["search"], array("ordenation" => $ordenation_cpf))) ?>">CPF <i class="<?php print($ordenation_cpf_ordenation) ?>"></i></a>
                     </th>
                     <th>
                        Ações
                     </th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th colspan="6">
                        <div class="row col-lg-12">
                           <div class="col-lg-3 form-group">
                              <select class="form-control" id="select_paginage" class="col-lg-3 ">
                                 <option <?php print($paginate == 20 ? 'selected="selected"' : '') ?> value="20">20</option>
                                 <option <?php print($paginate == 50 ? 'selected="selected"' : '') ?> value="50">50</option>
                                 <option <?php print($paginate == 100 ? 'selected="selected"' : '') ?> value="100">100</option>
                              </select>
                           </div>
                           <div class="col-lg-6 d-flex justify-content-center form-group text-center">
                              <button type="button" id="btn_sr_first" class=" btn ">|<< /button>
                                    <button type="button" id="btn_sr_previus" class=" btn ">
                                       << /button>
                                          <button type="button" id="btn_sr_next" class=" btn ">></button>
                                          <button type="button" id="btn_sr_last" class=" btn ">>|</button>
                           </div>
                           <p class="col-lg-3 text-right"><?php print(($info["sr"] + 1) . " de " . $total) ?></p>
                        </div>
                     </th>
                  </tr>
               </tfoot>
               <tbody>
                  <?php
                  foreach ($data as $key => $value) {
                  ?>
                     <tr>
                        <td><?php print($value["first_name"] . " " . $value["last_name"]) ?></td>
                        <td><?php print(isset($value["profiles_attach"][0]) ? $value["profiles_attach"][0]["name"] : "-") ?></td>
                        <td><?php print($value["mail"])  ?></td>
                        <td><?php print($value["cpf"])  ?></td>
                        <td>
                           <a class="btn btn-primary btn-sm" href="<?php printf($form["pattern"]["action"], $value["idx"]) ?>" class="button tiny bg-blue round" title="Detalhe"><i class="bi bi-search"></i> Detalhe</a>
                        </td>
                     </tr>
                  <?php
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <script>
         window.setTimeout(function() {
            jQuery("#btn_export").bind("click", function() {
               jQuery("#frm_filter").prop({
                  "action": "<?php print(set_url($GLOBALS["users_url"] . ".xls", $info["get"])) ?>"
               }).submit();
            })
         }, 1000);
      </script>
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

         #helpId ul {
            position: relative;
            right: 35px;
         }

         #helpId li {
            list-style: none;
         }

         .bt.btn-primar.btn-sm {
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
            width: 450px;
            padding: 0px 5px;
            border-radius: 5px;
            background-color: #DDDDDD;
            align-items: center;
         }

         .MuiInputBase-input {
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
            cursor: pointer;
            border: 1px solid #999;
            padding: 5px 30px;
            text-align: center;
            background-color: #FFFFFF;
            align-items: center;
            font-weight: 600;
            border-radius: 5px 5px 5px 5px;
            margin: 0;
         }

         .bt.btn-primar.btn-sm {
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

         .labels-dados {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            color: #077111;
            padding: 15px;
            font-size: 16px;
            border-radius: 15px;
            border: 1px solid #c0c0c0;
            border-left-color: rgb(192, 192, 192);
            border-left-style: solid;
            border-left-width: 1px;
            box-shadow: 2px 2px 2px #c0c0c0;
            width: 200px;
            height: 124px;
            border-left: 30px solid #077111;
            font-size: 25px;

         }

         .labels-dados-down {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            color: #077111;
            margin: 10px;
            border-radius: 15px;
            border: 1px solid #c0c0c0;
            border-left-color: rgb(192, 192, 192);
            border-left-style: solid;
            border-left-width: 1px;
            box-shadow: 2px 2px 2px #c0c0c0;
            width: 200px;
            height: 124px;
            border-left: 30px solid #077111;
            font-size: 20px;
         }

         table,
         thead {
            background: rgb(210, 210, 210);
            color: #707070;
            cursor: pointer;
            padding: 14px 0px 14px 0px;
            font-size: 14px;
            font-weight: bold;
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
      </style>
   </div>
</div>