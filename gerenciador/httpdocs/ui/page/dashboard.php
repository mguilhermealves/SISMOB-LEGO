<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 py-3">
    <div style="display: flex; align-items: center; justify-content: flex-start;">
        <h1 class="display-5"><i class="bi bi-speedometer"></i> Dashboard SISMOB - Sistema Imobiliario</h1>
    </div>

    <?php
    $boiler = new menus_model();
    $boiler->set_filter(array("active = 'yes'", " idx in ( select menus_profiles.menus_id from menus_profiles where menus_profiles.active = 'yes' and menus_profiles.profiles_id in ( '" . implode("','", isset($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"][0]) ? array_column($_SESSION[constant("cAppKey")]["credential"]["profiles_attach"], "idx") : array(0)) . "' ) ) "));
    $boiler->set_order(array("position"));
    $boiler->load_data();
    $boiler->attach(array("urls"));

    foreach ($boiler->data as $k => $v) {
        if ($k == 0) {
            $color = $v["color"];
            print('<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="display:flex;justify-content: flex-start;align-items: flex-start;flex-direction: revert;flex-wrap: wrap;">');
        }
        if ($v["color"] != $color) {
            $color = $v["color"];
            print('</div><div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="display:flex;justify-content: flex-start;align-items: flex-start;flex-direction: revert;flex-wrap: wrap;">');
        }
        printf(
            '<a id="linkside%s" class="p-3 my-3 mr-4 link-menu-sidebar" style="border-color:%s" href="%s"><p>%s</p></a>',
            $k,
            $v["color"],
            isset($v["urls_attach"][0]) && isset($GLOBALS[$v["urls_attach"][0]["slug"] . "_url"]) ? $GLOBALS[$v["urls_attach"][0]["slug"] . "_url"] : "#",
            $v["name"]
        );
        print('<style>a#linkside' . $k . ':hover{ background-image: linear-gradient(180deg, ' . $v["color"] . ' 0%, rgba(255, 255, 255, 1) 57%) !important; color:rgb(85, 85, 85); text-decoration:none }</style>');
    }
    ?>
</div>

<style>
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