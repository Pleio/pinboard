<?php
/**
 * Shows the view page of a specific cafe message
 *
 * @package theme_ffd
 */

$guid = get_input('guid');
$cafe = get_entity($guid);

if (!$cafe | !$cafe instanceof ElggCafe) {
    register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
    forward(REFERER);
}

elgg_push_breadcrumb($cafe->title);

$output = elgg_view_entity($cafe, array('full_view' => true));

$options = array(
    'type' => 'object',
    'subtype' => 'comment',
    'container_guid' => $cafe->guid,
    'order_by' => 'time_created ASC',
    'limit' => false,
    'pagination' => false
);

$count = elgg_get_entities(array_merge($options, array(
    'count' => true
)));

$comments_title = elgg_view_icon("comment-o", "mrs") . $count . " " . elgg_echo('answers');
$comments = elgg_list_entities($options);
$output .= elgg_view_module('info', $comments_title, $comments, array("class" => "mtm ffd-answers"));

if (elgg_is_logged_in()) {
    $cafe_comment = elgg_view_form('theme_ffd/cafe/comment', array(
        'name' => 'cafe_comment',
        'action' => 'action/comment/save'
    ), array(
        'cafe' => $cafe
    ));

    $output .= elgg_view_module('info', elgg_echo('theme_ffd:cafe:comment'), $cafe_comment);
}

$content = elgg_view_layout('one_column', array('content' => $output));
echo elgg_view_page(elgg_echo('theme_ffd:cafe'), $content);