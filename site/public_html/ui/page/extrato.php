<section class="banner-page margin-top-50" style="background-image:url(../../furniture/images/banner_aproveiteV10.jpg)">
      
      </section>
      
      <section class="margin-bottom-140 xs-margin-bottom-40">
          <div class="container-fluid">
              <div class="container limit-1500">
      
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="row">
                              <div class="col-lg-12 title-vertical medium">
                                  <h3>Extrato</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 menu-principal">
                               <?php include( constant("cRootServer") . "ui/includes/menu-lateral.php"); ?>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-8 coluna-formulario">

                            <div class="row">
                                <div class="col-lg-12 padding-top-25 padding-bottom-5 padding-left-30 padding-right-30"> 
                                    <table class="table table-striped col-lg-12">
                                        <thead>
                                            <tr>
                                                <th colspa="5">
                                                    <label>Periodo</label>
                                                    <select>
                                                        <?php 
                                                        foreach( $data["moviment"] as $k => $v ){ 
                                                            printf('<option value="%s"%s>%s</option>' , $k , $k == $info["get"]["moviment"] , $v );
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="text-align:center">Data</th>
                                                <th style="text-align:center">Doc Fiscal</th>
                                                <th style="text-align:center">Filial</th>
                                                <th style="text-align:center">Data Liberação</th>
                                                <th style="text-align:center">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach( $data["records"] as $v ){
                                            ?>
                                            <tr>
                                                <td style="text-align:center"><?php print( preg_replace("/^(....).(..).(..)/","$3/$2/$1",$v["dat_movimento"]) ) ?></td>
                                                <td style="text-align:center"><?php print( $v["doc_fiscal"] ) ?></td>
                                                <td style="text-align:center"><?php print( $v["name"] ) ?></td>
                                                <td style="text-align:center"><?php print( preg_replace("/^(....).(..).(..).+/","$3/$2/$1",$v["libered_at"]) ) ?></td>
                                                <td style="text-align:right"><?php print( number_format($v["valor"],0,",",".") ) ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>         
                                                                                    
                                </div>  
                            </div>

                           
                                                        
                            <div class="row margin-top-10">
                                <div class="col-lg-12 padding-top-20 padding-bottom-20 barra-baixo">                                 
                                </div>                             
                            </div>
                      </div>
                      <div class="col-lg-2">
                            <?php include( constant("cRootServer") . "ui/includes/lateral-agenda.php"); ?>
                      </div>
                  </div>
                     
      
      
              </div>
          </div>
      </section>