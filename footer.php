<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package loremipsum
 */

?>

</div><!-- #content -->

<footer class="site-footer">
    <?php dynamic_sidebar('footer'); ?>

    <?php
    wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'menu_id' => 'footer-menu'
    ));
    ?>
    <div class="footer-text">
        <?php echo get_theme_mod('footer_text_block'); ?>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
