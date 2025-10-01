<?php
/**
 * Template part for displaying single posts
 *
 * @package KH_Klopf_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Article">
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('khklopf-featured', array('itemprop' => 'image')); ?>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>

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

    <div class="entry-content" itemprop="articleBody">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'khklopf'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <footer class="entry-footer">
        <?php if (has_tag()) : ?>
            <span class="tags-links">
                <?php esc_html_e('Tags:', 'khklopf'); ?> 
                <?php the_tags('', ', ', ''); ?>
            </span>
        <?php endif; ?>
    </footer>
</article>
