<div class="container-fluid xs-padding-top-40 login-inverno-bio">

    <div class="container">
    <?php html_notification_print() ?>
    </div>


<form action="<?php print( $GLOBALS["password_url"] )?>" method="POST" class="auth-page">
<div class="tela-login screen">
          
            <div class="overlap-group border-11px-white">
            <img class="marcacamp" src="<?php printf("%s%s",constant("cFurniture"),"images/logotipo.png")?>">     
            <div class="flex-row xs-padding-top-25">        
    
            <div class="form-body">
                <div class="d-flex justify-content-between align-items-center mb-4 form-options">
                    <h5>Informe seu CPF</h5>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="login-input">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <circle fill="none" cx="12" cy="7" r="3"></circle>
                            <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z"></path>
                        </svg>
                    </label>
                    <input type="text" id="cpf-input" name="cpf" class="form-control" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Reenviar</button>
            </div>


            
        </div>
    </div>
</div>
</form>

</div>

<style>
    .marcacamp{
        margin:0px auto !important;
    }
    .form-body{
        margin: auto;
        text-align: center;
    }
    h5{
        margin: auto;
        color: #fff;
    }

    button.btn-primary{
        color: var(--white);
        font-family: var(--font-family-noto_sans);
        font-size: 20px;
        font-weight: 300;
        letter-spacing: 0;
        line-height: 15px;
        min-height: 22px;
        min-width: 44px;
        white-space: nowrap;
        background-color: #c4a133;
        border:none;
        padding: 10px 20px;
}
    
</style>