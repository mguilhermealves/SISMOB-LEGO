</head>

<body>
  <?php
  if (isset($_SESSION[constant("cAppKey")]["credential"])) {
  ?>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <a class="navbar-brand" href="/">SYSMOB</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
      
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="editUserId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php print($_SESSION[constant("cAppKey")]["credential"]["first_name"]) ?></a>
            <div class="dropdown-menu" aria-labelledby="editUserId">
              <a class="dropdown-item disabled" href="#">Editar Dados</a>
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
    <hr class="mt-0" style="width: 100%; height: 3px; background: rgb(230 230 230);" />
    <div class="container_context">
      <div class="container-fluid">
        <?php
        if ($info["server_uri"] != "") {
        ?>
          <div class="d-flex">
            <div class="d-flex col-lg-2 col-sm-2" style="justify-content: flex-start;flex-direction:column">
              <?php include(constant("cRootServer") . "ui/common/sidebar.inc.php"); ?>
            </div>
            <div class="d-flex col-lg-10 col-lg-9 row-margin">
              <div class="col-lg-12 p-3 d-flex flex-column whiteContainer">
              <?php
            } else {
              ?>
                <div class="container bg-white" style="border-radius:15px;margin-bottom:2rem;background: 0% 0% no-repeat padding-box padding-box rgb(255, 255, 255); padding: 0.75rem 1.5rem; border-radius: 15px; box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;">
              <?php
            }
          }
              ?>