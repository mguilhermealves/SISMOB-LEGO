                <div class="row row_box">
                    <?php if( isset( $page ) && in_array( $page , array("dashboard","users","user") , true ) ) { ?>
                    <div id="TotalUser" class="box-dash box-dash_blue">
                        <small>Total de usuários:</small>
                        <span id="totalSpanUser"></span>
                    </div>
                    <div class="box-dash box-dash_blue">
                        <small>Total de usuários ativos:</small>
                        <span id="yesSpanUser"></span>
                    </div>
                    <div class="box-dash box-dash_blue">
                        <small>Total de usuários inativos:</small>
                        <span id="noSpanUser"></span>
                    </div>
                    <?php } ?>
                </div>
