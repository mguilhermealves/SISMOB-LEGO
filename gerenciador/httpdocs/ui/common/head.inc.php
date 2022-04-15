</head>

<body>
  <?php
  if (isset($_SESSION[constant("cAppKey")]["credential"])) {
  ?>

    <nav class="navbar fixed-top navbar-expand-sm navbar-light menu">
      <a class="navbar-brand" href="/"><img style="max-width: 150px;" src="<?php printf("%simg/logo.jpeg", constant("cFurniture")) ?>"></a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">

        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item" style="border-right: 1px solid #fff">
            <a class="nav-link">Bem vindo(a), <?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"]) ?></a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="/">Home </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="<?php print($GLOBALS["clients_url"]) ?>">Clientes <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php print($GLOBALS["properties_url"]) ?>">Imoveis</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php print($GLOBALS["locations_url"]) ?>">Alugueis / Vendas</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="financerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Financeiro</a>
            <div class="dropdown-menu" aria-labelledby="financerId">
              <a class="dropdown-item" href="<?php print($GLOBALS["account_pay_categories_url"]) ?>">Categorias</a>
              <a class="dropdown-item" href="<?php print($GLOBALS["account_pay_cost_centers_url"]) ?>">Centro de Custo</a>
              <a class="dropdown-item" href="<?php print($GLOBALS["companies_url"]) ?>">Empresas</a>
              <a class="dropdown-item" href="<?php print($GLOBALS["bills_payableds_url"]) ?>">Contas a Pagar</a>
              <a class="dropdown-item" href="<?php print($GLOBALS["accounts_receivables_url"]) ?>">Contas a Receber</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportsId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Relatórios</a>
            <div class="dropdown-menu" aria-labelledby="reportsId">
              <a class="dropdown-item" href="<?php print($GLOBALS["clients_reports_url"]) ?>">Clientes</a>
              <a class="dropdown-item" href="<?php print($GLOBALS["properties_reports_url"]) ?>">Imoveis</a>
            </div>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php print($GLOBALS["logout_url"]) ?>">Sair</a>
          </li>
        </ul>
      </div>
    </nav>
    <style>
      .menu {
        background-color: #006699 !important;
      }

      .nav-link {
        color: #fff !important;
      }
    </style>
    <hr class="mt-0" style="width: 100%; height: 3px; background: rgb(230 230 230);" />
    <div class="container_context">
      <div class="container-fluid">
        <?php
        if ($info["server_uri"] != "") {
        ?>
          <div class="d-flex">

            <div class="d-flex col-lg-12 col-lg-9 row-margin">
              <div class="col-lg-12 p-3 d-flex flex-column whiteContainer">
              <?php
            } else {
              ?>
                <div class="container bg-white" style="border-radius:15px;margin-bottom:2rem;background: 0% 0% no-repeat padding-box padding-box rgb(255, 255, 255); padding: 0.75rem 1.5rem; border-radius: 15px; box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;">
              <?php
            }
          }
              ?>