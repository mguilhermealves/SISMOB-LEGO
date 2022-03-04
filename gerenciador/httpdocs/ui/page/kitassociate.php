<!-- Container Begin -->
<div class="row">
   <div class="col-sm-12">
      <div class="col-sm-12 mb-3">
         <div id="modal_add_store" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div role="document">
               <form id="form_opportunity_board" action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data">
                  <?php
                     if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                     ?>
                  <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                  <?php
                     }
                     ?>
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Adicionar Kit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="container-fluid">
                           <div class="row">
                              <div class="col-sm-9">
                                 <div class="form-group">
                                    <label>Título:</label>
                                    <input class="form-control" type="text" name="title" value="<?php print( isset( $data["title"] ) ? $data["title"] : "" ) ?>">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Arquivo</label>
                                    <input type="file" class="form-control" name="link" id="link" value="<?php print( isset( $data["link"] ) ? $data["link"] : "" ) ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                </div>          
            
                <button type="submit" name="btn_save" class="bottom-green">Salvar</button>
                <a href="<?php print( $GLOBALS["kitassociates_url"] ) ?>" class="bottom-green-reverse return" >Voltar</a>
            </form>
         </div>        
      </div>
   </div>
</div>
<script>
   window.setTimeout( function(){
       jQuery("a[id^='btn_remove']").on("click",function(){
           var target = jQuery(this);
           if( confirm('Confirma a exclusão do item ?') ){
               jQuery.ajax({
                   type: "POST",
                   url:jQuery(target).attr("href")
                   , data: { 'btn_remove': 'yes' } 
                   ,success: function(){
                       jQuery(jQuery(target).closest("tr")).remove()
                   }
               })
           }
           return false;
       })
   },1000);
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
   border-radius: 5px 5px 5px 5px;
   }
   .jss38 {
   display: inline-block;
   color: #999;
   border: 1px solid #999;
   padding: 3px 30px;
   text-align: center;
   background-color: #FFFFFF;
   align-items: center;
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
