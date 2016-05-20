<?php
/**
 * Shows the overview page of the FFD Cafe
 *
 * @package theme_ffd
 */

elgg_push_context("cafe");

if (elgg_is_logged_in() && can_write_to_container()) {
    $add = elgg_view_form('theme_ffd/cafe', array(
        'name' => 'cafe',
        'action' => 'action/cafe/save'
        ), array('collapsable' => true)
    );
} else {
    $add = "";
}

$options = array(
    'type' => 'object',
    'subtype' => 'cafe',
    'order_by' => 'last_action DESC',
    'full_view' => false
);

$owner = get_input('owner');
if ($owner) {
    $owner = get_user_by_username($owner);
}

if ($owner) {
    $options['owner_guid'] = $owner->guid;
    $filter_context = 'mine';
} else {
    $filter_context = 'all';
}

$purpose = get_input('purpose');
if (in_array($purpose, array('search', 'share', 'experience'))) {
    $options['metadata_name_value_pairs'] = array(
        array(
            'name' => 'purpose',
            'value' => $purpose
        )
    );
    $getter = 'elgg_get_entities_from_metadata';
} else {
    $getter = 'elgg_get_entities';
}

$output .= elgg_list_entities($options, $getter);

$body = elgg_view_layout('content', array(
    'header' => $add,
    'content' => $output,
    'filter_context' => $filter_context
));

echo elgg_view_page(elgg_echo('pinboard'), $body);
