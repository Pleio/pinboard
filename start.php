<?php

elgg_register_event_handler("init", "system", "pinboard_init");

function pinboard_init() {
    // pagehandlers
    elgg_register_page_handler("pinboard", "pinboard_page_handler");

    // actions
    $actions_base = dirname(__FILE__) . "/actions";
    elgg_register_action("pinboard/save", "$actions_base/save.php");
    elgg_register_action("pinboard/delete", "$actions_base/delete.php");

    // register objects
    elgg_register_menu_item("site", array(
        "name" => 'pinboard',
        "text" => elgg_echo('pinboard'),
        "href" => 'pinboard',
    ));

    elgg_extend_view("css/elgg", "css/pinboard/site");
    elgg_extend_view('js/elgg', 'js/pinboard/site');

    elgg_register_entity_type("object", "cafe");
    elgg_register_entity_url_handler("object", "cafe", "pinboard_url");
    elgg_register_plugin_hook_handler("register", 'menu:filter', 'theme_ffd_cafe_filter_menu_handler');
}

/**
 * Pinboard page handler
 *
 * @param array $page Array of URL segments passed by the page handling mechanism
 * @return bool
 */
 function pinboard_page_handler($segments) {

    switch($segments[0]) {
        case "detail":
            set_input('guid', $segments[1]);
            elgg_push_breadcrumb(elgg_echo('pinboard'), 'cafe');
            include(dirname(__FILE__) . "/pages/detail.php");
            break;
        case "edit":
            set_input('guid', $segments[1]);
            elgg_push_breadcrumb(elgg_echo('pinboard'), 'cafe');
            include(dirname(__FILE__) . "/pages/edit.php");
            break;
        case "owner":
            set_input('owner', $segments[1]);
        case "purpose":
            set_input('purpose', $segments[1]);
        case "all":
        default:
            elgg_push_breadcrumb(elgg_echo('pinboard'));
            include(dirname(__FILE__) . "/pages/overview.php");
            break;
    }

    return true;
 }


 function pinboard_url($cafe) {
    return "pinboard/detail/" . $cafe->guid . "/" . elgg_get_friendly_title($cafe->title);
 }