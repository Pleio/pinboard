<?php

elgg_register_event_handler("init", "system", "pinboard_init");

function pinboard_init() {

    // pagehandlers
    elgg_register_page_handler("cafe", "pinboard_cafe_page_handler");

    // actions
    $actions_base = dirname(__FILE__) . "/actions/cafe";
    elgg_register_action("cafe/save", "$actions_base/save.php");
    elgg_register_action("cafe/delete", "$actions_base/delete.php");

    // register objects
    elgg_register_menu_item("site", array(
        "name" => 'cafe',
        "text" => elgg_echo('cafe'),
        "href" => 'cafe',
    ));

    elgg_extend_view("css/elgg", "css/pinboard/site");
    elgg_extend_view('js/elgg', 'js/pinboard/site');

    elgg_register_entity_type("object", "cafe");
    elgg_register_entity_url_handler("object", "cafe", "pinboard_cafe_url");
    elgg_register_plugin_hook_handler("register", 'menu:filter', 'theme_ffd_cafe_filter_menu_handler');

    //add a widget
    elgg_register_widget_type("recent_cafe", elgg_echo("ffd_theme:widgets:recent_cafe:title"), elgg_echo("ffd_theme:widgets:recent_cafe:description"), "index");
}

/**
 * Pinboard page handler
 *
 * @param array $page Array of URL segments passed by the page handling mechanism
 * @return bool
 */
 function pinboard_cafe_page_handler($segments) {
    elgg_extend_view("page/elements/sidebar", "page/cafe/sidebar");

    switch($segments[0]) {
        case "detail":
            set_input('guid', $segments[1]);
            elgg_push_breadcrumb(elgg_echo('theme_ffd:cafe'), 'cafe');
            include(dirname(__FILE__) . "/pages/cafe/detail.php");
            break;
        case "edit":
            set_input('guid', $segments[1]);
            elgg_push_breadcrumb(elgg_echo('theme_ffd:cafe'), 'cafe');
            include(dirname(__FILE__) . "/pages/cafe/edit.php");
            break;
        case "owner":
            set_input('owner', $segments[1]);
        case "purpose":
            set_input('purpose', $segments[1]);
        case "all":
        default:
            elgg_push_breadcrumb(elgg_echo('theme_ffd:cafe'));
            include(dirname(__FILE__) . "/pages/cafe/overview.php");
            break;
    }

    return true;
 }


 function pinboard_cafe_url($cafe) {
    return "cafe/detail/" . $cafe->guid . "/" . elgg_get_friendly_title($cafe->title);
 }