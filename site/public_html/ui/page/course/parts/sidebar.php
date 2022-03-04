
                <h1>Progresso</h1>
                <?php $progress = course_controller::verifyAllprogress($data["sections_attach"][0]["courses_attach"][0]["idx"]); ?>
                <?php include( constant("cRootServer") . "ui/page/course/parts/progress.php"); ?>
                <div class="my-5">
                    <h1>Conteúdo</h1>
                    <?php foreach($sidebar as $sidebarcontent){ ?>
                    <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2">
                        <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-12">
                            <p class="MuiTypography-root MuiTypography-body1" style="font-size: 15px; font-weight: 600; color: rgb(245, 245, 245); margin-bottom: 6px; background: rgb(83, 41, 15); padding: 3px 4px;"><?php print($sidebarcontent["title"]) ?></p>
                            <ul class="list-unstyled" style="line-height: 35px;">
                                
                            <?php 
                                foreach($sidebarcontent["content"] as $content){ 
                                 $complete = course_controller::verifyprogress($content["type"],$content["idx"]);
                            ?>
                                <li>
                                    <p class="MuiTypography-root MuiTypography-body1 <?php print($complete?'completo':'') ?>" style="font-size: 14px; font-weight: 600; color: rgb(83, 41, 15); padding: 3px 4px; 
                                    <?php print($content["type"] == $info["slug2"] && $content["idx"] == $info["idx"] ? "background: rgba(83, 41, 15, 0.145);" : "" ) ?>
                                    ">
                                        <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true" style="fill: <?php print( $complete ? "#028101;" : "rgb(204, 204, 204);" ) ?> margin-right: 4px;">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                                        </svg>
                                        <?php print($content["title"]) ?>
                                    </p>
                                </li>
                            <?php 
                                } 
                            ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>