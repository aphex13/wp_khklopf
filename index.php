<?php
/**
 * The main template file
 *
 * @package KH_Klopf_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="site-content">
        <div class="content-area">
            <?php
            if (have_posts()) :
                
                // Display breadcrumbs
                khklopf_breadcrumbs();

                // Check if this is an archive page
                if (is_home() && !is_front_page()) :
                    ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                // Start the Loop
                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', get_post_type());

                endwhile;

                // Pagination
                khklopf_pagination();

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
