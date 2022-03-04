<div class="modal-header">
    <h5 class="modal-title" id="novoCadastroLabel">Escolha a Seção</h5>
    <div class="search">
		<input type="text" placeholder="Buscar Seção" data-search />
	</div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>



<div class="modal-body">                            
    <div class="row">  
 
                    <div class="col-lg-12 columns" >                            
                        <?php if(isset($data["sections_attach"])){
                            $sections = isset($data["sections_attach"]) ? $data["sections_attach"] : []; ?>
                                    <div class="row">
                                        <div class="col-lg-9">
                                            Título da Seção
                                        </div>  
                                        <div class="col-lg-3">

                                        </div>
                                    </div>
                                    <?php foreach( $sections as $v){ ?>
                                        <div class="row padding-bottom-25">
                                            <div class="col-lg-9">
                                                <i class="bi bi-caret-right-square-fill"></i> <?php print( $v["section_title"] ) ?>

                                                <i class="bi bi-plus-square" title="Adicionar" data-toggle="collapse" href="#collapseContents_<?php print( $v["idx"] ) ?>" role="button" aria-expanded="false"></i>
                                                

                                                <div class="row padding-left-5 collapse" id="collapseContents_<?php print( $v["idx"] ) ?>">                                                   
                                                    <div class="col-lg-9">
                                                        <div class="row">           
                                                            <div class="col-lg-1 text-right">
                                                                <i class="bi bi-arrow-return-right"></i>
                                                            </div>             
                                                             <div class="col-lg-2 text-center">  
                                                                <a href="#" class="add-toogle" data-target="#lessonModal">
                                                                    <i class="bi bi-play-circle-fill"></i>
                                                                    Aula
                                                                </a>                                                           
                                                             </div>
                                                             <div class="col-lg-2 text-center">
                                                                <a href="">
                                                                    <i class="bi bi-clipboard2-check-fill"></i>
                                                                    Avaliação
                                                                </a>
                                                             </div>
                                                             <div class="col-lg-2 text-center">
                                                                <a href="">
                                                                    <i class="bi bi-clipboard-data-fill"></i>
                                                                    Pesquisa
                                                                </a>
                                                             </div>
                                                             <div class="col-lg-2 text-center">
                                                                <a href="">
                                                                    <i class="bi bi-chat-left-dots-fill"></i>
                                                                    Fórum
                                                                </a>
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-lg-3">

                                            </div>
                                        </div>
                                    <?php } ?>
                    <?php } ?>

                    </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit"  name="btn_save" class="btn btn-primary">Save changes</button>
</div>




<!-- NOVA AULA -->

<div class="row form-inside-modal" id="lessonModal">
 <div class="col-lg-12">
    <?php include(constant("cFrontComponents") . "sections-tab/modal-lesson.php");  ?>
 </div>
</div>




<style>
    .bi-plus-square{
        cursor:pointer;
    }
</style>