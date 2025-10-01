<?php
/**
 * Template part for displaying posts
 *
 * @package KH_Klopf_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/BlogPosting">
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title" itemprop="headline">', '</h1>');
        else :
            the_title('<h2 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>

        <div class="entry-meta">
            <span class="posted-on">
                <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
                <?php if (get_the_time('U') !== get_the_modified_time('U')) : ?>
                    <time class="updated" datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>" itemprop="dateModified">
                        <?php echo esc_html(get_the_modified_date()); ?>
                    </time>
                <?php endif; ?>
            </span>
            <span class="byline">
                <?php esc_html_e('by', 'khklopf'); ?> 
                <span class="author vcard" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" itemprop="url">
                        <span itemprop="name"><?php echo esc_html(get_the_author()); ?></span>
                    </a>
                </span>
            </span>
            <?php if (has_category()) : ?>
                <span class="cat-links">
                    <?php esc_html_e('in', 'khklopf'); ?> 
                    <?php the_category(', '); ?>
                </span>
            <?php endif; ?>
        </div>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('khklopf-featured', array('itemprop' => 'image')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content" itemprop="articleBody">
        <?php
        if (is_singular()) :
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'khklopf'),
                'after'  => '</div>',
            ));
        else :
            the_excerpt();
        endif;
        ?>
    </div>

    <footer class="entry-footer">
        <?php if (has_tag()) : ?>
            <span class="tags-links">
                <?php the_tags('', ', ', ''); ?>
            </span>
        <?php endif; ?>
    </footer>
</article>
