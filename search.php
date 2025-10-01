<?php
/**
 * The template for displaying search results
 *
 * @package KH_Klopf_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="site-content">
        <div class="content-area">
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query */
                        printf(esc_html__('Search Results for: %s', 'khklopf'), '<span>' . get_search_query() . '</span>');
                        ?>
                    </h1>
                </header>

                <?php
                // Start the Loop
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', 'search');

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
