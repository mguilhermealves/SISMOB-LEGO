<div class="row">
   <p class="mb-0 col-lg-12">
      <a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["users_url"] ) ?>">Usuarios</a> / <?php print(isset($data["first_name"]) ? "Usuario " . $data["first_name"] : "Cadastrar Usuario") ?>
   </p>
   <div class="container-fluid box solaris-head">
      
      <form id="form_opportunity_board" action="<?php print($form["url"]) ?>" method="post" enctype="multipart/form-data">
         <?php
         if (isset($info["get"]["done"]) && !empty($info["get"]["done"])) {
         ?>
            <input type="hidden" id="done" name="done" value="<?php print($info["get"]["done"]) ?>">
         <?php
         }
         ?>
         <div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title ">Informações Pessoais</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="first_name">
                              Primeiro Nome:
                           </label>
                           <input id="first_name" type="text" class="form-control" name="first_name" value="<?php print(isset($data["first_name"]) ? $data["first_name"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="last_name">
                              Último Nome:
                           </label>
                           <input id="last_name" type="text" class="form-control" name="last_name" value="<?php print(isset($data["last_name"]) ? $data["last_name"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="cpf">
                              CPF:
                           </label>
                           <input id="cpf" <?php print(isset($data["idx"]) ? 'disabled' : '') ?> type="text" class="form-control" name="cpf" value="<?php print(preg_replace("/(.+)(...)(...)(..)$/", "$1.$2.$3-$4", preg_replace("/\D+?/", "", $data["cpf"]))) ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="gestor">
                              Gestor:
                           </label>
                           <input id="gestor" <?php print(isset($data["idx"]) ? 'disabled' : '') ?> type="text" class="form-control" name="gestor" value="<?php print(isset($data["gestor"]) ? $data["gestor"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="mail">
                              E-mail:
                           </label>
                           <input id="mail" <?php print(isset($data["idx"]) ? 'disabled' : '') ?> type="text" class="form-control" name="mail" value="<?php print(isset($data["mail"]) ? $data["mail"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label>
                              Telefone:
                           </label>
                           <input id="celphone" type="text" class="form-control" name="celphone" value="<?php print(isset($data["celphone"]) ? $data["celphone"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="birthdate">
                              Nascimento:
                           </label>
                           <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php print(isset($data["birthdate"]) ? $data["birthdate"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="genre">
                              Sexo:
                           </label>
                           <select class="form-control" id="genre" name="genre">
                              <option value="" <?php print(!isset($data["genre"]) || $data["genre"] == "" ? ' selected="selected"' : '') ?>></option>
                              <?php
                              foreach ($GLOBALS["genre_lists"] as $k => $v) {
                                 printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["genre"]) && $data["genre"] == $k ? ' selected="selected"' : '', $v);
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title">Endereço</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="address">
                              Endereço:
                           </label>
                           <input type="text" id="address" class="form-control" name="address[address]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["address"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="address_number">
                              Numero:
                           </label>
                           <input id="address_number" type="text" class="form-control" name="address[number]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["number"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="address_complement">
                              Complemento:
                           </label>
                           <input id="address_complement" type="text" class="form-control" name="address[complement]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["complement"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="address_neighborhood">
                              Bairro:
                           </label>
                           <input id="address_neighborhood" type="text" class="form-control" name="address[neighborhood]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["neighborhood"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="address_city">
                              Cidade:
                           </label>
                           <input id="address_city" type="text" class="form-control" name="address[city]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["city"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="address_zip_code">
                              CEP:
                           </label>
                           <input id="address_zip_code" type="text" class="form-control" name="address[postal_code]" value="<?php print(isset($data["address_attach"][0]) ? $data["address_attach"][0]["postal_code"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="form-group">
                           <label for="address_uf">
                              *Estado:
                           </label>
                           <select class="form-control" id="address_uf" name="address[uf]">
                              <option <?php print(!isset($data["address_attach"][0]) || $data["address_attach"][0]["uf"] == "" ? ' selected="selected"' : '') ?>>- Selecione -</option>
                              <?php
                              foreach ($GLOBALS["ufbr_lists"] as $k => $v) {
                                 printf('<option value="%s"%s>%s</option>' . "\n", $k, isset($data["address_attach"][0]) && $data["address_attach"][0]["uf"] == $k ? ' selected="selected"' : '', $v);
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-content">
            <div class="modal-header label">
               <h5 class="modal-title ">Informações adicionais</h5>
            </div>
            <div class="modal-body">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="created_at">
                              Data Cadastro
                           </label>
                           <input id="created_at" disabled type="text" class="form-control" value="<?php print(isset($data["created_at"]) ? preg_replace("/^(....).(..).(..).(.....).+$/", "$3/$2/$1", $data["created_at"]) : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="last_login">
                              Ultimo Acesso
                           </label>
                           <input id="last_login" disabled type="text" class="form-control" value="<?php print(isset($data["last_login"]) ? $data["last_login"] : "") ?>">
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="profiles_id">
                              Perfil
                           </label>
                           <?php
                           if (in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["slug"], array("master"))) {
                           ?>
                              <select disabled class="form-control" name="profiles_id" name="profiles_id">
                                 <option value="" <?php print(!isset($data["profiles_attach"][0]) ? ' selected' : '') ?>>-- Selecione --</option>
                                 <?php
                                 foreach ($profiles_lists as $k => $v) {
                                    printf('<option value="%s"%s>%s</option>', $k, isset($data["profiles_attach"][0]) && $data["profiles_attach"][0]["idx"] == $k ? ' selected' : '', $v);
                                 }
                                 ?>
                              </select>
                           <?php
                           } else {
                              print('<input type="hidden" name="profiles_id" value="' . (isset($data["profiles_attach"][0]) ? $data["profiles_attach"][0]["idx"] : 4) . '"><input type="text" class="form-control" disabled value="' . (isset($data["profiles_attach"][0]) ? $data["profiles_attach"][0]["name"] : 'Não Associado') . '">' . "\n");
                           }
                           ?>
                        </div>
                     </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="enabled">Acesso Ativo</label>
                           <select class="form-control" id="enabled" name="enabled">
                              <option value="" <?php print(!isset($data["enabled"]) || $data["enabled"] == "" ? ' selected="selected"' : '') ?>></option>
                              <?php
                              foreach ($GLOBALS["yes_no_lists"] as $k => $v) {
                                 printf('<option value="%s"%s>%s</option>', $k, !empty($data["enabled"]) && $data["enabled"] == $k  ? ' selected="selected"' : '', $v);
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <?php
                     if (in_array($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]["slug"], array("master", "adm"))) {
                     ?>
                        <div class="col-sm-12">
                           <div class="form-group">
                              <input type="hidden" name="tokens_id" value="<?php print($data["tokens_id"]) ?>">
                              <input type="hidden" name="tokens_name" value="<?php print($data["tokens_name"]) ?>">
                              <label for="tk_pwd"> Link para definir a senha </label>
                              <div class="input-group mb-3">
                                 <input class="form-control" disabled id="tk_pwd" name="tk_pwd" type="text" value="<?php print($data["tk_pwd"]) ?>">
                                 <div class="input-group-append">
                                    <button id="btntk_pwd" type="button" style="background: #FFF;color: #707070;"><i style="font-size: 1.7rem;" class="fa fa-copy"></i></button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php
                     } else {
                     ?>
                        <input type="hidden" class="form-control" name="tokens_id" value="<?php print($data["tokens_id"]) ?>">
                        <input type="hidden" class="form-control" name="tokens_name" value="<?php print($data["tokens_name"]) ?>">
                     <?php
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>

         <a href="<?php print($GLOBALS["users_url"]) ?>" class="bottom-green-reverse return">Voltar</a>
         <button type="submit" name="btn_save" class="btn btn-primary btn-sm " style="color: #FFFFFF;border: none;cursor: pointer;padding: 5px 30px;font-size: 16px;background: #999;transition: all 400ms ease-in-out;font-weight: 600;border-radius: 5px 5px 0px 0px; float:right">Salvar</button>
      </form>
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

   .label {
      padding: 4px 20px;
      position: relative;
      background: #999;
      box-shadow: #3d3d3f 0px -4px 3px -2px;
      transition: all 200ms ease-in-out;
      border-radius: 10px 10px 0px 0px;
      margin-bottom: 0px;
      color: #e8e8e8;
      font-size: 18px;
      font-weight: 600;
   }

   .modal-content {
      margin-bottom: 12px;
   }
   .modal-body {
    border: 1px solid #999;
    margin-bottom: 16px;
   }

   .bottom-green-reverse {
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
   }

   a:link {
      text-decoration: none;
   }
</style>