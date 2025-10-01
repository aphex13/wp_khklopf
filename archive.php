<?php
/**
 * The template for displaying archive pages
 *
 * @package KH_Klopf_Theme
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
    <div class="site-content">
        <div class="content-area">
            <?php if (have_posts()) : ?>

                <header class="archive-header">
                    <?php
                    the_archive_title('<h1 class="archive-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                </header>

                <?php
                // Start the Loop
                while (have_posts()) :
                    the_post();

                    get_template_part('template-parts/content', 'archive');

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
