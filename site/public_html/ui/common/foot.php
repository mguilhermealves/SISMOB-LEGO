        <script src="<?php printf("%s%s", constant("cFurniture"), "jquery-3.5.1.slim.min.js") ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        

        <script src="<?php printf("%s%s", constant("cFurniture"), "bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js") ?>"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "bootstrap-4.5.3-dist/js/bootstrap.min.js") ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "jquery-ui.js") ?>"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "jquery.inputmask.bundle.js") ?>"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/slick/slick.js") ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <link rel="stylesheet" href="<?php printf("%s%s", constant("cFurniture"), "js/calendar/main.css") ?>">
        <link rel="stylesheet" href="<?php printf("%s%s", constant("cFurniture"), "css/custom-calendar.css") ?>">
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/calendar/main.js") ?>"></script>
        <script src='<?php printf("%s%s", constant("cFurniture"), "js/calendar/locales/pt-br.js") ?>'></script>
        <script src='<?php printf("%s%s", constant("cFurniture"), "js/jQuery-Form-Validator/form-validator/jquery.form-validator.min.js") ?>'></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/jquery.mask.js") ?>"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js") ?>"></script>
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/jquery.redirect.js") ?>"></script>
        <link rel="stylesheet" href="<?php printf("%s%s", constant("cFurniture"), "js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css") ?>" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
                $(function() {
                        $(".card-treinamentos").slick({
                                infinite: false,
                                slidesToShow: 5,
                                slidesToScroll: 1,
                        });

                        $('.sabichao > img').click(function() {
                        $(this).parent().toggleClass('active');
                        });

                        $('.sabichao > .sabichao-help-box > .title').click(function() {
                        $(this).closest('.sabichao').removeClass('active');
                        });

                        $("#formFooter").submit(function(){                               
                                     
                                return enviarFormularioFooter();                                                        
                        });                        
                });

                $('.editor').jqte({
                        'source': false
                });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.0.0-rc.1/cropper.min.js"></script> 
        <script src="<?php printf("%s%s", constant("cFurniture"), "js/site.js") ?>"></script>