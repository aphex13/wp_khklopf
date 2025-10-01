<?php
/**
 * The template for displaying single posts
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

                get_template_part('template-parts/content', 'single');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

                // Previous/next post navigation.
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'khklopf') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'khklopf') . '</span> <span class="nav-title">%title</span>',
                ));

            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
