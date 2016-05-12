<?php
/**
 * Shows the form for a cafe message
 *
 * @package theme_ffd
 */

$cafe = elgg_extract("cafe", $vars);
$comment = elgg_extract("comment", $vars);

if ($cafe) {
    echo elgg_view("input/hidden", array("name" => "entity_guid", "value" => $cafe->guid));
}

?>

<div>
    <?php echo elgg_view('input/longtext', array(
        'name' => 'generic_comment',
        'value' => elgg_get_sticky_value('comment', 'generic_comment', $comment->description)
    ));
    ?>
</div>
        
<?php
    echo elgg_view("input/submit", array(
        'value' => elgg_echo('theme_ffd:cafe:publish')
    ));
?>