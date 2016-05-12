<?php
/**
 * Shows the edit page of a specific cafe message
 *
 * @package theme_ffd
 */

$guid = get_input('guid');
$cafe = get_entity($guid);

if (!$cafe | !$cafe instanceof ElggCafe) {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
    forward(REFERER);
}

$options = array(
        'name' => 'cafe',
        'action' => 'action/cafe/save'
);

$output = elgg_view_form('theme_ffd/cafe', $options, array('entity' => $cafe));

$content = elgg_view_layout('one_column', array('content' => $output));
echo elgg_view_page(elgg_echo('theme_ffd:cafe'), $content);