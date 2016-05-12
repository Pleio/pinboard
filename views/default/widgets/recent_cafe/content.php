<?php

$options = array(
    "type" => "object",
    "subtype" => "cafe",
    "limit" => 10
);

$cafe = elgg_get_entities($options);

if ($cafe) {
    foreach ($cafe as $object) {
        echo "<div class=\"cafe\">";
            echo "<div class=\"cafe-title\">";
                echo elgg_view_icon("round-plus");
                echo elgg_view("output/url", array(
                    "text" => $object->title,
                    "href" => $object->getURL()
                ));
            echo "</div>";

            echo "<div class=\"cafe-date\">";
                echo  " ";
                echo "<i>" . strftime("%e %b", $object->time_created) . "</i>";
            echo "</div>";
        echo "</div>";
    }
}

$more_link = elgg_view("output/url", array(
    "text" => elgg_echo("ffd_theme:widgets:recent_cafe:more"),
    "href" => "cafe"
));

echo "<div class='elgg-widget-more'>" . $more_link . "</div>";