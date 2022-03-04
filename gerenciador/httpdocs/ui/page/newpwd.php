
    <div class="inner-wrap">
        <div class="wrap-fluid">
            <br>
            <br>
            <!-- Container Begin -->
            <div class="large-offset-4 large-4 columns">
                <div class="box bg-white">
                    <!-- Profile -->
                    <div class="profile">
                        <img src="<?php printf("%s%s",constant("cFurniture"),"img/logo_adm.png") ?>">
                        <h3>Definir Senha</h3>
                    </div>
                    <!-- End of Profile -->
                    <!-- /.box-header -->
                    <div class="box-body " style="display: block;">
                        <div class="row">
                            <div class="large-12 columns">
                                <div class="row">
                                    <div class="edumix-signup-panel">
                                        <form id="frm_pwd" action="<?php printf( $GLOBALS["tkpwd_url"] , $info["key"] ) ?>" method="post">
                                            <div class="row collapse">
                                                <div class="small-2  columns">
                                                    <span class="prefix bg-gray"><i class="text-white icon-lock"></i></span>
                                                </div>
                                                <div class="small-10  columns">
                                                    <input type="password" name="password" placeholder="Senha">
                                                </div>
                                            </div>
                                            <div class="row collapse">
                                                <div class="small-2 columns ">
                                                    <span class="prefix bg-gray"><i class="text-white icon-lock"></i></span>
                                                </div>
                                                <div class="small-10 columns ">
                                                    <input type="password" name="confirm-password" placeholder="Confirmar a Senha">
                                                </div>
                                            </div>
                                            <div class="row collapse">
                                                <button type="submit" name="btn_save" class="button radius small expand bg-gray">Definir a Senha</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .timeline -->
                </div>
                <!-- box -->
            </div>
        </div>
        <!-- End of Container Begin -->
    </div>
    <!-- end paper bg -->
    <!-- end of inner-wrap -->