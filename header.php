<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package loremipsum
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="site">
    <a class="skip-link screen-reader-text" href="#content">
        <?php esc_html_e('Skip to content', 'loremipsum'); ?>
    </a>

    <header class="site-header">
        <div class="site-branding">
            <?php
            the_custom_logo();
            if (is_front_page() && is_home()) :
                ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </p>
            <?php
            endif;
            $loremipsum_description = get_bloginfo('description', 'display');
            if ($loremipsum_description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo $loremipsum_description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->
        <!-- the id is used for the toggle navigation -->
        <nav id="site-navigation" class="main-navigation">
            <div class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'menu_id' => 'primary-menu',
            ));
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div class="site-content">
