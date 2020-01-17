<?php
/**
 * Created by PhpStorm.
 * User: Philipp
 * Date: 15.01.2020
 * Time: 20:27
 */


add_action('customize_register', 'extended_blog_infos');
/**
 * Register Our Customizer Stuff Here
 * https://codex.wordpress.org/Theme_Customization_API
 */
function extended_blog_infos($wp_customize)
{
    // The Panel Menu
    $wp_customize->add_panel('text_blocks', array(
        'priority' => 500,
        'theme_supports' => '',
        'title' => __('Additional Infos', 'loremipsum'),
        'description' => __('Set editable text for certain content.', 'loremipsum'),
    ));

    // The Section.
    $wp_customize->add_section('custom_footer_text', array(
        'title' => __('Change Footer Text', 'loremipsum'),
        'panel' => 'text_blocks',
        'priority' => 10
    ));

    // The Setting
    $wp_customize->add_setting('footer_text_block', array(
        'default' => __('default text', 'loremipsum'),
        'sanitize_callback' => 'sanitize_text'
    ));


    /**
     * The Setting Type and appearance
     *
     *
     * ### example
     *
     * Showing the footer text block in page
     *<?php if( get_theme_mod( 'footer_text_block') != "" ): ?>
     *   <p class="footer-text">
     *     <?php echo get_theme_mod( 'footer_text_block'); ?>
     *  </p>
     *
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     */
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'custom_footer_text',
        array(
            'label' => __('Footer Text', 'loremipsum'),
            'section' => 'custom_footer_text',
            'settings' => 'footer_text_block', // the ID of the type
            'type' => 'textarea'
        )
    ));

    // Sanitize text
    function sanitize_text($text)
    {
        return sanitize_text_field($text);
    }
}