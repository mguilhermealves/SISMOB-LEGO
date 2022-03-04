<?php 
$contents = sections_controller::contents_section($info); 
?>

<div class="modal-content">
    <div class="modal-header label">
        <h5 class="modal-title ">Posições</h5>
    </div>
    <div class="modal-body" style="padding-left: 0px;">
        <form action="<?php printf($GLOBALS["order_positions_url"]) ?>" method="post" style="text-align:center" enctype="multipart/form-data" >
            <input type="hidden" id="done" name="done" value="<?php printf( $GLOBALS["section_url"],$info["idx"]) ?>">
            <ul id="piclist" style="padding-left: 1rem;text-align: left;">                       
                <?php   
                    if(isset($contents)){                                   
                        foreach( $contents as $content){  
                ?>
                        <li class="no-swipe group " style="list-style-type: none;"  >
                            <input type="hidden" name="order[]" value="<?php print($content["type"]) ?>_<?php print($content["idx"]) ?>" />
                            <?php print( $content["title"] ) ?>
                            <div class="handle instant icone-drag" style="cursor: grabbing;"></div>
                        </li>
                <?php   }  
                    } 
                ?>                                            
            </ul>
            <button type="submit"  name="btn_save" class="btn btn-outline-primary btn-sm mx-auto">Salvar Posições</button>
        </form>
    </div>
</div>


<style>
.modal-lg {
    max-width: 80%;
}
.button{
    margin:0 5px;
}
td.no-border{
    border:0 !important;
}


li.group{
    line-height: 1rem;
    border-bottom: 1px solid #999;
    margin-bottom: 0.5rem;
}
.group:after {
  content: "";
  display: table;
  clear: both;
}



.handle {
  float: right;
  cursor: -webkit-grab;
}

.handle:after {
    content: "\2261";
    font-size: 35px;  
    color: gray;
  }

.slip-reordering {
  -webkit-box-shadow: 0 0 5px 5px rgba(0,0,0,0.02);
  box-shadow: 0 0 5px 5px rgba(0,0,0,0.03);
}

</style>