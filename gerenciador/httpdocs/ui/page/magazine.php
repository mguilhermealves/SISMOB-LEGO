<!-- Container Begin -->
<div class="row">
   <div class="form-group" >
      <div class="box solaris-header">
         <div class="box-header bg-transparent">
            <h3 class="box-title " style="margin-left:20px">
               <span><?php print( isset( $info["idx"] ) && (int)$info["idx"] > 0 ? "Editar Magazine " : "Cadastrar Magazine" ) ?></span>
            </h3>
         </div>
      </div>
      <div class="box solaris-head">
         <div class="box-body">
         </div>
      </div>
   </div>
</div>
<form id="form_opportunity_board" action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data">
   <?php
      if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
      ?>
   <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
   <?php
      }
      ?>
   <div class="modal-content">
      <div class="modal-header label">
         <h5 class="modal-title ">Informações</h5>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="form-group">
                     <label>Nome do Newsletter</label>
                     <input type="text" class="form-control" name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                     
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group">
                     <label>Chamada </label>
                     <textarea class="form-control" name="headline"><?php print( isset( $data["headline"] ) ? $data["headline"] : "" ) ?></textarea>                    
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label for="adm_urls_id">Tipo</label>
                     <select class="form-control"  id="type" name="type">
                        <option <?php print( !isset( $data["type"] ) || $data["type"] == "text" ? 'selected' : '' ) ?> value="text">Texto</option>
                        <option <?php print( isset( $data["type"] ) && $data["type"] == "link" ? 'selected' : '' ) ?> value="link">Link</option>
                        <option <?php print( isset( $data["type"] ) && $data["type"] == "zip" ? 'selected' : '' ) ?> value="zip"> Zip</option>
                     </select>
                  </div>
               </div>
               <div class="col-sm-12 text hidden-input input-change" id="text-container">
                  <div class="form-group"> 
                     <textarea cols="80" id="editor1" class="editor" name="text" rows="10" style="margin: 0px 0px 16px; height: 359px;"><?php print( isset( $data["text"] ) ? $data["text"] : "&nbsp;" ) ?></textarea>                            
                  </div>
               </div>
               <div class="col-sm-12 link hidden-input input-change" id="text-container" >
                  <div class="form-group">                        
                     <label>Link:</label>
                     <input class="form-control" type="text" name="link" placeholder="https://">                     
                     <?php if( !empty( $data["link"] ) && file_exists( constant("cRootServer") . $data["link"] ) ){
                        ?><img src="/<?php print( $data["link"] ) ?>"/>
                     <?php
                        } ?>                         
                  </div>
               </div>
               <div class="col-sm-12 zip hidden-input input-change" id="text-container">
                  <div class="form-group">                        
                     <label>Zip:</label>
                     <input class="form-control" type="file" name="zip_file">                     
                     <?php if( !empty( $data["link"] ) && file_exists( constant("cRootServer") . $data["link"] ) ){
                        ?><img src="/<?php print( $data["link"] ) ?>"/>
                     <?php
                        } ?>                         
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal-content">
      <div class="modal-header label">
         <h5 class="modal-title">Configuração</h5>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-2">
                  <div class="form-group">
                     <label> Perfis Disponiveis:</label>                       
                     <input type="hidden" name="profiles_id[1]" id="profiles_id[1]" value="1">
                     <input type="hidden" name="profiles_id[2]" id="profiles_id[2]" value="2">
                     <?php foreach( profiles_controller::data4select("idx",array( " idx > 2 " ) ) as $k => $v ){ ?>
                     <label>
                     <input name="profiles_id[<?php print( $k ) ?>]" id="profiles_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" <?php print( isset( $data["profiles_attach"][0] ) && in_array( $k , array_column( $data["profiles_attach"] , "idx" ) ) ? "checked" : "" ) ?>>
                     <?php print( $v ) ?>
                     </label>
                     <?php } ?>                                           
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group">                        
                     <label>Imagem:</label>
                     <input type="file" name="thumbnail">                     
                     <?php if( !empty( $data["image"] ) && file_exists( constant("cRootServer") . $data["image"] ) ){
                        ?><img src="/<?php print( $data["image"] ) ?>"/>
                     <?php
                        } ?>                         
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php 
      if( in_array( $_SESSION[ constant("cAppKey") ]["credential"]["profiles_attach"][0]["slug"] , array( "master" , "adm" ) ) ){ 
      ?>   
   <?php 
      }
      else{
      ?>
   <input type="hidden" class="form-control" name="tokens_id" value="<?php print( $data["tokens_id"] ) ?>">
   <input type="hidden" class="form-control" name="tokens_name" value="<?php print( $data["tokens_name"] ) ?>">
   <?php
      }
      ?>
   <button type="submit" name="btn_save" class="bottom-green">Salvar</button>  
    <a href="<?php print( $GLOBALS["magazines_url"] ) ?>" class="bottom-green-reverse return" >Voltar</a>
</form>
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
   .label {
   padding: 4px 20px;
   position: relative;
   background: #f26724;
   box-shadow: #3d3d3f 0px -4px 3px -2px;
   transition: all 200ms ease-in-out;
   border-radius: 10px 10px 0px 0px;
   margin-bottom: 8px;
   color: #e8e8e8;
   font-size: 18px;
   font-weight: 600;
   }
   .modal-content {
   margin-bottom: 12px;
   }
   .bottom-green {
       color: #FFFFFF;
       border: none;
       cursor: pointer;
       padding: 5px 30px;
       font-size: 16px;
       background: #f26724;
       transition: all 400ms ease-in-out;
       font-weight: 600;
       border-radius: 5px 5px 5px 5px;
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
   a:visited, .return {
    color: #999;
    }
    a:link {
        text-decoration: none;
    } 
   .hidden-input{
      display:none;
   }

   .show-input{
      display:block;
   }

</style>