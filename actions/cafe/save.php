<?php

elgg_make_sticky_form("cafe");

$guid = (int) get_input("guid");

$cafe = new ElggCafe($guid);

$adding = !$cafe->guid;
$editing = !$adding;

if (!$cafe instanceof ElggCafe) {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
    forward(REFERER);
}

if ($editing && !$cafe->canEdit()) {
    register_error(elgg_echo("theme_ffd:cafe:nopermissions"));
    forward(REFERER);
}

$container_guid = (int) get_input("container_guid");
if (empty($container_guid)) {
    $container_guid = (int) $cafe->owner_guid;
}

if ($editing && ($container_guid != $cafe->getContainerGUID())) {
    $moving = true;
}

if ($adding && !can_write_to_container(0, $container_guid, "object", "cafe")) {
    register_error(elgg_echo("theme_ffd:cafe:nopermissions"));
    forward(REFERER);
}

$title = get_input("title");
$description = get_input("description");
$purpose = get_input("purpose");

$tags = string_to_tag_array(get_input("tags", ""));

if (strlen($title) > 60) {
    $title = substr($title,0,60);
}

if (empty($container_guid) || empty($title) || empty($description) || empty($purpose)) {
    register_error(elgg_echo("theme_ffd:cafe:fieldsmissing"));
    forward(REFERER);
}

$cafe->title = $title;
$cafe->description = $description;
$cafe->purpose = $purpose;

$cafe->tags = $tags;
$cafe->access_id = get_default_access();
$cafe->container_guid = $container_guid;

$result = $cafe->save();

if ($result) {
    system_message(elgg_echo("theme_ffd:cafe:saved"));
    elgg_clear_sticky_form("cafe");
} else {
    register_error(elgg_echo("theme_ffd:cafe:notsaved"));
}

forward('/cafe');
