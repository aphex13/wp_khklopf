<?php
/**
 * Template part for displaying posts in archives
 *
 * @package KH_Klopf_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('khklopf-thumbnail'); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

        <div class="entry-meta">
            <span class="posted-on">
                <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </span>
            <span class="byline">
                <?php esc_html_e('by', 'khklopf'); ?> 
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php echo esc_html(get_the_author()); ?>
                </a>
            </span>
        </div>
    </header>

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>
</article>
