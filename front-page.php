<?php
/**
 * The template for displaying the front page
 *
 * This is the template that displays the homepage by default.
 * It can be customized using ACF fields.
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

                // Check if there's a custom hero section (ACF field example)
                $hero_title = khklopf_get_field('hero_title');
                $hero_text = khklopf_get_field('hero_text');
                $hero_image = khklopf_get_field('hero_image');

                if ($hero_title || $hero_text || $hero_image) :
                    ?>
                    <section class="hero-section">
                        <?php if ($hero_image) : ?>
                            <div class="hero-image">
                                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                        <div class="hero-content">
                            <?php if ($hero_title) : ?>
                                <h1><?php echo esc_html($hero_title); ?></h1>
                            <?php endif; ?>
                            <?php if ($hero_text) : ?>
                                <p><?php echo esc_html($hero_text); ?></p>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php
                endif;

                // Display the page content
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
