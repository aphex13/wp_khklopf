<?php
/**
 * The template for displaying pages
 *
 * @package KH_Klopf_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="site-content">
        <div class="content-area">
            <?php
            while (have_posts()) :
                the_post();

                // Display breadcrumbs
                khklopf_breadcrumbs();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
