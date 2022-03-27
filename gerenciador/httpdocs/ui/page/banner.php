<!-- Container Begin -->
<div class="row">
    <p class="mb-0 col-lg-12"><a href="<?php print( $GLOBALS["home_url"] ) ?>">Home</a> / <a href="<?php print( $GLOBALS["banners_url"] ) ?>">Banners</a> / <?php print( $form["title"] ) ?></p>
    <div class="container-fluid box solaris-head">
        <div class="box-body">
            <form action="<?php print( $form["url"] ) ?>" method="post" enctype="multipart/form-data" >
                <?php
                if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){
                ?>
                <input type="hidden" id="done" name="done" value="<?php print( $info["get"]["done"] ) ?>">
                <?php
                }
                ?>
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Dados</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input id="name" type="text" class="form-control" placeholder="Nome do Banner"  name="name" value="<?php print( isset( $data["name"] ) ? $data["name"] : "" ) ?>">
                                    </div>                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="link"> Link </label>
                                        <input id="link" type="text" class="form-control" placeholder="https://" name="link" value="<?php print( isset( $data["link"] ) ? $data["link"] : "" ) ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="target">Abrir o Link em </label>
                                        <select name="target" id="target" class="form-control">
                                            <?php 
                                            foreach( array( "_blank" => "Nova Pagina" , "_self" => "Mesma Pagina" ) as $k => $v ){
                                                printf('<option %s value="%s">%s</option>' , isset( $data["target"] ) && $k == $data["target"] ? ' selected' : '' , $k , $v ) ;
                                            }
                                            ?>                                        
                                        </select>     
                                    </div>                             
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Imagem  (1248px x 143px)</label>
                                        <input type="file" id="image" name="image" class="form-control">  
                                    </div>                             
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="status_published">Publicado </label>
                                        <select name="status_published" id="status_published" class="form-control">
                                            <?php 
                                            foreach( $GLOBALS["yes_no_lists"] as $k => $v ){
                                                printf('<option %s value="%s">%s</option>' , isset( $data["status_published"] ) && $k == $data["status_published"] ? ' selected' : '' , $k , $v ) ;
                                            }
                                            ?>                                        
                                        </select>     
                                    </div>                             
                                </div>    
                                <?php if( !empty( $data["img"] ) && file_exists( constant("cRootServer") . $data["img"] ) ){
                                ?><img class="img-fluid" src="/<?php print( $data["img"] ) ?>"/>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-content">
                    <div class="modal-header label">
                        <h5 class="modal-title ">Disponivel para os Perfis</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row col-lg-12">
                                    <input type="hidden" name="profiles_id[1]" id="profiles_id[1]" value="1">
                                    <input type="hidden" name="profiles_id[2]" id="profiles_id[2]" value="2">

                                    <?php foreach( profiles_controller::data4select("idx",array( " slug in ('adm-premier','gestor-hsol') " ) ) as $k => $v ){ ?>
                                    <input style="display: none;" name="profiles_id[<?php print( $k ) ?>]" id="profiles_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" checked>
                                    <label class="w-50">
                                        <input type="checkbox" value="<?php print( $k ) ?>" checked disabled>
                                        <?php print( $v ) ?>
                                    </label>
                                    <?php } ?>
                                    <?php foreach( profiles_controller::data4select("idx",array( " idx > 2 ", " not slug in ('adm-premier','gestor-hsol') " ) ) as $k => $v ){ ?>
                                    <label class="w-50">
                                        <input name="profiles_id[<?php print( $k ) ?>]" id="profiles_id[<?php print( $k ) ?>]" type="checkbox" value="<?php print( $k ) ?>" <?php print( isset( $data["profiles_attach"][0] ) && in_array( $k , array_column( $data["profiles_attach"] , "idx" ) ) ? "checked" : "" ) ?>>
                                        <?php print( $v ) ?>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php if( isset( $info["get"]["done"] ) && !empty( $info["get"]["done"] ) ){ ?>
                    <a href="<?php print($info["get"]["done"]); ?>" class="btn btn-outline-secondary btn-sm" >Voltar</a>
                    <?php } ?>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="submit" name="btn_save" class="btn btn-outline-primary btn-sm"><?php print( isset( $data["idx"] ) ? "Editar" : "Salvar" ) ?></button>
                </div>
            </form>
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
    .bxs_user{
        border:1px solid #0A4C80; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;padding:0px
    }
    .bxs_user .header{ background-color:#0A4C80;color:#FFFFFF;padding: 5px 5px;font-size: 1.52rem; }
    .modal-lg {
        max-width: 80%;
    }
</style>