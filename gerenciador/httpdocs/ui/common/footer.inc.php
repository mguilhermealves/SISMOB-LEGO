    <?php
    if (isset($_SESSION[constant("cAppKey")]["credential"])) {
      if ($info["server_uri"] != "") {
    ?> </div>
        </div>
        </div>
        </div>
      <?php
      } else {
      ?>
        </div>
      <?php
      }
      ?>
      </div>
      <hr class="mb-0" style="width: 100%; height: 3px;" />
      <div class="footer" style="background-color:#FFFFFF">
        <div class="container text-center pt-4 footer-desc">
          © COPYRIGHT 2021-<?php print(date("Y")); ?> | SISMOB | TODOS OS DIREITOS RESERVADOS.
        </div>
      </div>
    <?php
    }
    ?>
    <script type='text/javascript' src="<?php printf("%s%s", constant("cFurniture"), "js/jquery.js") ?>"></script>
    <script type='text/javascript' src='<?php printf("%s%s", constant("cFurniture"), "js/jquery-ui.js") ?>'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script type='text/javascript' src='<?php printf("%s%s", constant("cFurniture"), "js/jquery.inputmask.bundle.js") ?>'></script>
    <script type='text/javascript' src='<?php printf("%s%s", constant("cFurniture"), "js/jquery-autocomplete.js") ?>'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  

    <script src="<?php printf("%s%s", constant("cFurniture"), "js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js") ?>"></script>
    <link rel="stylesheet" href="<?php printf("%s%s", constant("cFurniture"), "js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css") ?>" />
    <script type='text/javascript' src='<?php printf("%s%s", constant("cFurniture"), "js/jquery-autocomplete.js") ?>'></script>
    <script type="text/javascript">
      $('.editor').jqte();
      $('.datepicker').datepicker({
        dateFormat: 'yy-mm-d',
        closeText: "Fechar",
        prevText: "&#x3C;Anterior",
        nextText: "Próximo&#x3E;",
        currentText: "Hoje",
        monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        dayNames: ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"],
        dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        weekHeader: "Sm",
        firstDay: 1
      });

      $('.check-select input[type="checkbox"]').click(function() {
        var label = $('label[for="' + $(this).attr('id') + '"]');
        $(label).animate({
          'margin': '0'
        }, 100);
        $(label).animate({
          'margin': '5px'
        }, 100);
      });
      $('[data-search]').on('keyup', function() {
        var searchVal = $(this).val();
        var filterItems = $('[data-filter-item]');

        if (searchVal != '') {
          filterItems.addClass('hidden');
          $('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');
        } else {
          filterItems.removeClass('hidden');
        }
      });
    </script>