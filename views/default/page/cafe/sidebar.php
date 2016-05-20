<?php
/**
 * Shows the sidebar of the FFD cafe overview
 *
 * @package theme_ffd
 */


if (function_exists('theme_ffd_fivestar_get_top_users')):
?>

<div class="theme-ffd-cafe-profile-owner-block">
    <?php if (elgg_is_logged_in()): ?>
        <div class="theme-ffd-profile-icon">
            <?php echo elgg_view('profile/icon'); ?>
        </div>

        <ul>
            <li>
                <?php
                    $user = elgg_get_logged_in_user_entity();
                    echo elgg_view("output/url", array(
                        "text" => elgg_echo("profile:edit"),
                        "href" => "profile/" . $user->username . "/edit",
                    ));
                ?>
            </li>
        </ul>

        <div class="theme-ffd-profile-owner-short-description">
            <b><?php echo elgg_echo("profile:briefdescription"); ?>:</b><br />
            <?php if ($user->briefdescription): ?>
                <?php echo $user->briefdescription; ?>
            <?php else: ?>
                <?php echo elgg_echo("pinboard:no_short_description"); ?>
            <?php endif ?><br />
        </div>
    <?php endif ?>

    <div class="theme-ffd-search-users">
        <?php
        $text = elgg_view("output/img", array(
                "src" => THEME_GRAPHICS . "users.png"
        ));
        $text .= "<span>" . elgg_echo("pinboard:searchmembers") . "</span>";

        echo elgg_view("output/url", array(
            "text" => $text,
            "href" => "members/all"
        ));
        ?>
    </div>

    <div class="theme-ffd-top10">
        <b><?php echo elgg_echo("theme_ffd:top10"); ?></b>
        <?php
            foreach (theme_ffd_fivestar_get_top_users() as $user) {
                    echo elgg_view("theme_ffd/profile/item_cafe", array('entity' => $user));
            }
        ?>
    </div>

</div>

<?php
endif;