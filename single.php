<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package loremipsum
 */

get_header();
?>
    <div class="content-area">
        <main class="site-main">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
                the_post_navigation(); // @me: this is different from pages.php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            endwhile;
            ?>
        </main>
    </div>
<?php
get_sidebar();
get_footer();
