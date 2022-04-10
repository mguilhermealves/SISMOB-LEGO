<div class="body_login">
    <div class="login_container col-lg-6 col-xl-6 col-md-12 col-sm-12 col-xs-12 mx-auto">
        <div class="container_custom">
            <div class="login_header">
                <div class="login_header">
                    <img class="img-fluid" src="<?php printf("%simg/logo.jpeg", constant("cFurniture")) ?>">
                </div>
            </div>

            <div class="login_body">
                <?php
                if (isset($_SESSION[constant("cAppKey")]["messages"])) {
                    foreach ($_SESSION[constant("cAppKey")]["messages"] as $k => $v) {
                        printf('<div class="alert alert-%s" >%s</div>', $k, implode("<br>", $v));
                    }
                    unset($_SESSION[constant("cAppKey")]["messages"]);
                }
                ?>
                <form action="<?php print($GLOBALS["home_url"]) ?>" method="POST" class="container">
                    <div class="form-group py-3">
                        <div class="d-flex flex-column input-group-prepend">
                            <label>E-mail:</label>
                            <input name="login" type="email" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="email" required>
                        </div>

                        <br>

                        <div class="d-flex flex-column input-group-prepend">
                            <label>Senha:</label>
                            <input name="password" type="password" class="form-control" placeholder="Senha" aria-label="Senha" aria-describedby="senha" required>
                        </div>
                    </div>
                    <button name="btn_save" class="btn btn-block form-control " style="color: #fff;background-color: #006699;">Acessar o Sistema</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #fff !important;
    }

    .container_custom {
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem !important;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        /*margin: 10px;*/
    }

    .login_footer {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .body_login {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(0, 0, 0, 0.87);
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }

    .login_header {
        color: #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;

    }

    .login_body {
        gap: 30px;
        display: flex;
        flex-direction: column;
        padding: 1rem;
        background-color: #fff;

    }

    .login_body form .input-group-text {
        padding: 0px;
        background: #ffffff;

        padding-right: 1rem;
        padding-left: 0.5rem;

    }

    .login_body form input {
        background: #ffffff;

        border: 1px solid #ced4da;

    }

    .login_body form svg {
        color: rgba(158, 158, 158, 0.87);
        width: 18px;
        height: 18px;
    }
</style>