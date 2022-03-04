
                <?php
                    $nav = array(
                        array( "text" => "Voltar ao Curso" , "link" => sprintf($GLOBALS["curso_url"] , $info["slug"] ) )
                    ) ;
                    $next = false ;
                    foreach( $sidebar as $k => $v ){
                        foreach( $v["content"] as $kin => $vin ){
                            if( !isset( $nav[1] ) ){
                                if( $vin["type"] == $info["slug2"] && $vin["idx"] == $info["idx"] ){
                                    $nav[1] = array();    
                                }
                                else{
                                    $nav[0] = array( "text" => $vin["type"] == "lesson" ? "Voltar a Aula" : "Voltar a Avaliação" , "link" => sprintf( $GLOBALS["cursoconteudo_url"] , $info["slug"] , $vin["type"] , $vin["idx"] ) ) ;   
                                }
                            }
                            elseif( $next == false ){
                                $next = true ;
                                $nav[1] = array( "text" =>  $vin["type"] == "lesson" ? "Próxima Aula" : "Próxima Avaliação" , "link" => sprintf( $GLOBALS["cursoconteudo_url"] , $info["slug"] , $vin["type"] , $vin["idx"] ) ) ;
                            }
                        }
                    }
                ?>
                <div class="d-flex justify-content-between">                        
                    <div class="d-flex flex-column">
                        <a href="<?php print($nav[0]["link"]) ?>">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 mr-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                            </svg>
                            <?php print( $nav[0]["text"] ) ?>
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <?php
                        if( isset( $nav[1]["text"] ) ){
                        ?>
                        <a href="<?php print($nav[1]["link"]) ?>">
                            <?php print( $nav[1]["text"] ) ?>
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-right" class="svg-inline--fa fa-long-arrow-alt-right fa-w-14 ml-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                            </svg>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>