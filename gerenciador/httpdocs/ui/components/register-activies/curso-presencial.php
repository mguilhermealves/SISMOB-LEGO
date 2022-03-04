<div class="tab-pane fade show active" id="curso-presencial" role="tabpanel" aria-labelledby="curso-presencial-tab">
    <!-- Descritivo de Atividade -->
    <?php include(constant("cFrontComponents") . "modelo/card_course_descript.php");  ?>

    <!-- Endereço do Curso -->
    <?php include(constant("cFrontComponents") . "modelo/card_course_address.php");  ?>

    <!-- Informações da Atividade -->
    <?php include(constant("cFrontComponents") . "modelo/card_information_activie.php");  ?>

    <!-- Dados do professor/palestrante -->
    <?php include(constant("cFrontComponents") . "modelo/card_information_panelist.php");  ?>

    <!-- Aceite dos Termos -->
    <?php include(constant("cFrontComponents") . "modelo/card_accept_terms.php");  ?>

</div>

<style>
    span.in-company-switch,
    span.open-public-switch,
    span.recurring-course-switch,
    span.single-course-switch {
        float: left;
        font-size: 18px;
        color: #666666;
        margin-top: 2px;
    }

    .switch-gender {
        position: relative;
        float: left;
        height: 20px;
        width: 50px;
        margin: 5px 10px;
        background: #b3b3b3;
        border-radius: 100px;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;
    }

    .switch-label {
        position: relative;
        z-index: 2;
        float: left;
        width: 25px;
        height: 25px;
        border-radius: 100px;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;
        cursor: pointer;
    }

    .switch-label:active {
        font-weight: bold;
    }

    .switch-label-off {
        padding-left: 2px;
    }

    .switch-label-on {
        padding-right: 2px;
    }

    .switch-input {
        display: none;
    }

    .switch-input:checked+.switch-label {
        text-shadow: 0 1px rgba(255, 255, 255, 0.25);
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
    }

    .switch-input:checked+.switch-label-on~.switch-selection {
        /* Note: left: 50% doesn't transition in WebKit */
        left: 31px;
    }

    .switch-selection {
        display: block;
        position: absolute;
        z-index: 1;
        top: -4px;
        left: 0;
        width: 28px;
        height: 28px;
        background: #077111;
        border-radius: 100px;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;
        -webkit-transition: left 0.15s ease-out;
        -moz-transition: left 0.15s ease-out;
        -o-transition: left 0.15s ease-out;
        transition: left 0.15s ease-out;
    }


    label {
        color: #707070;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .label_div {
        padding: 4px 20px;
        position: relative;
        background: #077111;
        box-shadow: #3d3d3f 0px -4px 3px -2px;
        transition: all 200ms ease-in-out;
        border-radius: 10px 10px 0px 0px;
        margin-bottom: 8px;

        color: #e8e8e8;
        font-size: 18px;
        font-weight: 600;
    }

    .nav-tabs {
        border-bottom: none;
        margin: 0 10px;
    }

    .nav-tabs .nav-item .nav-link{
        color: #077111;
        border: 1px solid #077111;
        cursor: pointer;
        padding: 5px 30px;
        font-size: 16px;
        background: #FFFFFF;
        transition: all 400ms ease-in-out;
        font-weight: 600;
        border-radius: 5px;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #e8e8e8;
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        background-color: #077111;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .btn-primary {
        color: #007bff;
        border: 2px solid #007bff;
        cursor: pointer;
        margin: 10px 0px;
        padding: 5px 30px;
        font-size: 15px;
        background: #FFFFFF;
        transition: .4s ease-in-out;
        font-weight: 600;
        border-radius: 5px;
    }

    .btn-success {
        color: #007111;
        border: 2px solid #007111;
        cursor: pointer;
        margin: 10px 0px;
        padding: 5px 30px;
        font-size: 15px;
        background: #FFFFFF;
        transition: .4s ease-in-out;
        font-weight: 600;
        border-radius: 5px;
    }

    #msn_error p {
        font-size: 15px;
        font-weight: 500;
        color: rgb(215, 25, 25);
        padding-bottom: 10px;
    }

    #msn_error_link p {
        font-size: 15px;
        font-weight: 500;
        color: rgb(215, 25, 25);
        padding-bottom: 10px;
    }

    ol {
        padding-left: 20px;
    }

    ol li {
        padding: 5px;
        color: #000;
    }

    ol li:nth-child(even) {
        background: #dfdfdf;
    }

    .strike {
        text-decoration: line-through;
    }

    li:hover {
        cursor: pointer;
    }


    /* input {
        font: inherit;
        color: currentColor;
        width: 100%;
        border: 0;
        height: 1.1876em;
        margin: 0;
        display: block;
        padding: 6px 0 7px;
        min-width: 0;
        background: none;
        box-sizing: content-box;
        animation-name: mui-auto-fill-cancel;
        letter-spacing: inherit;
        animation-duration: 10ms;
        -webkit-tap-highlight-color: transparent;
        background: #DDD;
    } */
</style>