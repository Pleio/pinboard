<?php ?>
//<script>
elgg.provide('elgg.pinboard');

elgg.pinboard.init = function() {
    $('.theme-ffd-collapse-control').live('click', function(event) {
        event.preventDefault();

        $('.theme-ffd-collapse-control').toggle();
        $('.theme-ffd-collapsable').toggle(400);
    });
};

elgg.register_hook_handler('init', 'system', elgg.pinboard.init);