<?php
/**
 * Created by PhpStorm.
 * User: Philipp
 * Date: 13.12.2019
 * Time: 15:38
 */


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function loremipsum_widgets_init()
{
    // sidebar widget
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'loremipsum'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'loremipsum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    // footer widget
    register_sidebar(array(
        'name' => esc_html__('Footer', 'loremipsum'),
        'id' => 'footer',
        'description' => esc_html__('Add widgets here.', 'loremipsum'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'loremipsum_widgets_init');