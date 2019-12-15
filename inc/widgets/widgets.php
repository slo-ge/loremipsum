<?php

require WIDGETS_DIR . '/insta-grid.php';

add_action('widgets_init', 'widgets_init');

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function widgets_init()
{
    register_widget('instagram_grid_widget');
}
