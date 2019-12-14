<article <?php post_class(); ?>>
    <header class="entry-header">
        <?php

        loremipsum_post_thumbnail();
        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

        ?>
</article>

