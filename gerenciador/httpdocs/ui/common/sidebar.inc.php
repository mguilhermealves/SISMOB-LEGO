<div class="whiteContainer p-3 mb-2 text-center"><a style="text-align: center; font: normal normal normal 20px/14px Montserrat; letter-spacing: 0px; color: #555555; opacity: 1;" href="/">&lt; VOLTAR</a></div>



<div class="d-flex flex-column sidebar whiteContainer sidebarContainerPadding px-3 py-4">

    <?php
    $boiler = new menus_model();
    $fs = array("active = 'yes'", " idx in ( select menus_profiles.menus_id from menus_profiles where menus_profiles.active = 'yes' and menus_profiles.profiles_id in ( '" . implode("','", isset($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]) ? array_column($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"], "idx") : array(0)) . "' ) ) ");
    if (!isset($sidebar_color)) {
        $sidebar_color = "#000";
    }
    if ($info["server_uri"] != "") {
        $fs[] = " color = '" . $sidebar_color . "' ";
    }
    $boiler->set_filter($fs);
    $boiler->set_order(array("position"));
    $boiler->load_data();
    $boiler->attach(array("urls"));
    foreach ($boiler->data as $k => $v) {
        print(strtr(
            '<a id="link_sidebar_#ID#" class="p-3 my-1 mx-auto link-menu-sidebar" href="#URL#"><p>#NAME#</p></a><style>#link_sidebar_#ID#{ border-color:#COLOR# } #link_sidebar_#ID#:hover{ background-image: linear-gradient(180deg, #COLOR# 0%, rgba(255, 255, 255, 1) 57%) !important }</style>',
            array(
                "#COLOR#" => $v["color"], "#ID#" => $v["idx"], "#URL#" => isset($v["urls_attach"][0]) && isset($GLOBALS[$v["urls_attach"][0]["slug"] . "_url"]) ? $GLOBALS[$v["urls_attach"][0]["slug"] . "_url"] : "#", "#NAME#" => $v["name"]
            )
        ));
    }
    ?>
</div>
<style>
    .sidebar a:hover {
        background-image: linear-gradient(180deg, <?php print($sidebar_color) ?> 0%, rgba(255, 255, 255, 1) 57%) !important;
    }

    .slick-list {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .link-menu-sidebar {
        width: 142px !important;
        height: 142px;
        border: 3px solid rgb(0, 117, 18);
        font-size: 1rem;
        line-height: 1rem;
        font-weight: 600;
        color: rgb(85, 85, 85);
        display: flex;
        flex-direction: column;
        box-shadow: none;
        text-align: center;
        transition: all 800ms ease-in-out;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        gap: 15px;
    }
</style>