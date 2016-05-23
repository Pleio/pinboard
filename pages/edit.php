<?php
/**
 * Shows the edit page of a specific cafe message
 *
 * @package theme_ffd
 */

$guid = get_input('guid');
$entity = get_entity($guid);

if (!$entity | !$entity instanceof ElggCafe) {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
    forward(REFERER);
}

$options = array(
        'name' => 'pinboard',
        'action' => 'action/pinboard/save'
);

$output = elgg_view_form('pinboard/save', $options, array('entity' => $entity));

$content = elgg_view_layout('one_column', array('content' => $output));
echo elgg_view_page(elgg_echo('pinboard'), $content);