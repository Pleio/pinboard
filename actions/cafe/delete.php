<?php

$guid = (int) get_input("guid");
$cafe = new ElggCafe($guid);

if (!$cafe instanceof ElggCafe) {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
    forward(REFERER);
}

if (!$cafe->canEdit()) {
    register_error(elgg_echo("theme_ffd:cafe:nopermissions"));
    forward(REFERER);
}

$result = $cafe->delete();
if ($result) {
    system_message(elgg_echo("theme_ffd:cafe:deleted"));
} else {
    register_error(elgg_echo("theme_ffd:cafe:notdeleted"));
}

forward('cafe');
