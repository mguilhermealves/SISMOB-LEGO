<div class="container-fluid iniciar-curso">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-9">
                <h1><?php print($data["lessons_title"]) ?></h1> 
                <div class="d-flex flex-column"><a href="/curso/<?php printf($course_data["slug"]) ?>">Voltar para: <?php printf($course_data["course_title"]) ?></a></div>
                <div class="row my-5">
                    <div class="col-md-12 justify-content-center text-center mb-5">
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-3">
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                <p class="MuiTypography-root MuiTypography-body1" style="font-size: 2rem; font-weight: 600; color: rgb(83, 41, 15);">Vitta Natural</p>
                            </div>
                            <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                                
                                <iframe data-saveprogress="<?php print($GLOBALS["salvar-progresso_url"]) ?>" data-idcurso="<?php print($data["idx"]) ?>" id="videoSingle" style="height: 480px; width: 100%;" src="<?php print($data["lessons_content_url"]) ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" data-ready="true"></iframe>                                                           
                                <input type="hidden" value="<?php print($_SESSION[ constant("cAppKey") ]["credential"]["idx"]); ?>" class="user_id" />
                                <input type="hidden" value="<?php print($data["idx"]) ?>" class="object_id" />
                                <input type="hidden" value="lesson" class="type" />
                                
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column"><a href="/curso/<?php printf($course_data["slug"]) ?>"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14 " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                                </svg>Voltar ao curso</a></div>
                        <div class="d-flex flex-column"><a href="/">Próxima aula<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-right" class="svg-inline--fa fa-long-arrow-alt-right fa-w-14 ml-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                                </svg></a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-3">
                <h1>Progresso</h1>
                <div class="" style="display: flex; height: 1.5rem; overflow: hidden; font-size: 0.75rem; background-color: rgb(233, 236, 239); border-radius: 0.25rem;">                
                    <div class="progress-bar bg-transparent" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%; color: rgb(51, 51, 51);">                       
                        <p id="progress" class="MuiTypography-root MuiTypography-body1" style="width: 0%; color: rgb(51, 51, 51); padding: 3px; font-weight: 600;padding-left: 0;padding-right: 0;  background: green;">0%</p>
                    </div>
                </div>
                <div class="my-5">
                    <h1>Conteúdo</h1>
                    <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2">
                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                            <p class="MuiTypography-root MuiTypography-body1" style="font-size: 15px; font-weight: 600; color: rgb(245, 245, 245); margin-bottom: 6px; background: rgb(83, 41, 15); padding: 3px 4px;"><?php print($section_title) ?></p>
                            <ul class="list-unstyled" style="line-height: 35px;">
                                
                            <?php foreach($content_section as $content){ ?>
                                <li>
                                    <p class="MuiTypography-root MuiTypography-body1" style="font-size: 14px; font-weight: 600; color: rgb(83, 41, 15); padding: 3px 4px; 
                                    <?php print($content["type"] == $type && $content["idx"] == $data["idx"] ? "background: rgba(83, 41, 15, 0.145);" : "" ) ?>
                                    "><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(204, 204, 204); margin-right: 4px;">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                        </svg><?php print($content["title"]) ?></p>
                                </li>
                            <?php } ?>
                            
                                <li>
                                    <p class="MuiTypography-root MuiTypography-body1" style="font-size: 14px; font-weight: 600; color: rgb(83, 41, 15); padding: 3px 4px;"><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(204, 204, 204); margin-right: 4px;">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                        </svg>Avaliação</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>