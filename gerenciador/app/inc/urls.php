<?php
$home_url = constant("cFrontend") ;
$tkpwd_url = sprintf("%s%s/%s" ,  constant("cFrontend_USER") , "tkpwd" , "%s" ) ;
$logout_url = sprintf("%s%s" , constant("cFrontend") , "sair") ;

foreach( (array)urls_controller::data4select("slug",array(" idx > 0 ") , "pattern") as $k => $v ){
    $GLOBALS[ $k . "_url"] = constant("cFrontend") . $v;
}
?>
