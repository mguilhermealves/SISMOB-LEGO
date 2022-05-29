</head>

<body>
  <?php
  if (isset($_SESSION[constant("cAppKey")]["credential"])) { ?>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light menu">
      <a class="navbar-brand" href="/"><img style="max-width: 150px;" src="<?php printf("%simg/logo.jpeg", constant("cFurniture")) ?>"></a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <?php
          $b = new menus_model();
          $fs = array("active = 'yes'", " idx in ( select menus_profiles.menus_id from menus_profiles where menus_profiles.active = 'yes' and menus_profiles.profiles_id in ( '" . implode("','", isset($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]) ? array_column($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"], "idx") : array(0)) . "' ) ) ");
          $b->set_order(array("position"));
          $b->load_data();
          $b->attach(array("urls"));
          $b->join("menus", "menus", array("parent" => "idx"), " and active = 'yes' and idx in ( select menus_profiles.menus_id from menus_profiles where menus_profiles.active = 'yes' and menus_profiles.profiles_id in ('" . implode("','", isset($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]) ? array_column($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"], "idx") : array(0))  . "') ) order by position ");
          $b->attach_son("menus", array("urls"));

          foreach ($b->data as $k => $v) {
            if (isset($v["menus_attach"][0])) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php print($v["name"]) ?>" id="<?php print("menu_" . $k) ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php print($v["name"]) ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="<?php print("menu_" . $k) ?>">
                  <?php foreach ($v["menus_attach"] as $r) { ?>

                    <a class="dropdown-item" href="<?php print($GLOBALS[$r["urls_attach"][0]["slug"] . "_url"]) ?>">
                      <?php print($r["name"]) ?>
                    </a>

                  <?php } ?>
                </div>
              </li>
            <?php } else if ($v["parent"] == '-1') { ?>
              <li class="nav-item">
                <a class="nav-link <?php print(isset($page) && in_array($page, array($v["name"]), true) ? 'active' : '') ?>" href="<?php print($GLOBALS[$v["urls_attach"][0]["slug"] . "_url"]) ?>"><?php print($v["name"]) ?></a>
              </li>
          <?php }
          } ?>
        </ul>

        <ul class="navbar-nav ml-5 mr-2 mt-5 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="editUserId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php print("Bem vindo(a), " . $_SESSION[constant("cAppKey")]["credential"]["first_name"]) ?></a>
            <div class="dropdown-menu" aria-labelledby="editUserId">
              <a class="dropdown-item" href="<?php printf($GLOBALS["user_url"], $_SESSION[constant("cAppKey")]["credential"]["idx"]) ?>">Meus Dados</a>
            </div>
          </li>

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

            <div class="d-flex col-lg-12 col-lg-9 row-margin">
              <div class="col-lg-12 p-3 d-flex flex-column whiteContainer">
              <?php
            } else {
              ?>
                <div class="container bg-white" style="border-radius:15px;margin-bottom:2rem;background: 0% 0% no-repeat padding-box padding-box rgb(255, 255, 255); padding: 0.75rem 1.5rem; border-radius: 15px; box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;">
              <?php
            }
          } ?>