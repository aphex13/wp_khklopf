<?php
/**
 * KH Klopf Theme functions and definitions
 *
 * @package KH_Klopf_Theme
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme setup
 */
function khklopf_setup() {
    // Make theme available for translation
    load_theme_textdomain('khklopf', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    // Add custom image sizes
    add_image_size('khklopf-featured', 1200, 675, true);
    add_image_size('khklopf-thumbnail', 400, 300, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'khklopf'),
        'footer'  => esc_html__('Footer Menu', 'khklopf'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');

    // Gutenberg wide align support
    add_theme_support('align-wide');

    // Gutenberg block editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary', 'khklopf'),
            'slug'  => 'primary',
            'color' => '#2c3e50',
        ),
        array(
            'name'  => esc_html__('Secondary', 'khklopf'),
            'slug'  => 'secondary',
            'color' => '#3498db',
        ),
        array(
            'name'  => esc_html__('Dark Text', 'khklopf'),
            'slug'  => 'dark-text',
            'color' => '#333333',
        ),
        array(
            'name'  => esc_html__('Light Text', 'khklopf'),
            'slug'  => 'light-text',
            'color' => '#666666',
        ),
    ));

    // Gutenberg block editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'khklopf'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Normal', 'khklopf'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => esc_html__('Medium', 'khklopf'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => esc_html__('Large', 'khklopf'),
            'size' => 28,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Huge', 'khklopf'),
            'size' => 36,
            'slug' => 'huge'
        )
    ));

    // Responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'khklopf_setup');

/**
 * Set the content width in pixels
 */
function khklopf_content_width() {
    $GLOBALS['content_width'] = apply_filters('khklopf_content_width', 1200);
}
add_action('after_setup_theme', 'khklopf_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function khklopf_scripts() {
    // Theme stylesheet
    wp_enqueue_style('khklopf-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Theme JavaScript
    wp_enqueue_script('khklopf-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get('Version'), true);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'khklopf_scripts');

/**
 * Add custom body classes
 */
function khklopf_body_classes($classes) {
    // Add class if sidebar is active
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add class for sticky header
    $classes[] = 'has-sticky-header';

    return $classes;
}
add_filter('body_class', 'khklopf_body_classes');

/**
 * Add meta tags for SEO
 */
function khklopf_seo_meta_tags() {
    if (is_singular()) {
        global $post;
        
        // Open Graph meta tags
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '" />' . "\n";
        }
        
        if ($post->post_excerpt) {
            echo '<meta property="og:description" content="' . esc_attr($post->post_excerpt) . '" />' . "\n";
            echo '<meta name="description" content="' . esc_attr($post->post_excerpt) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'khklopf_seo_meta_tags');

/**
 * Add Schema.org markup for articles
 */
function khklopf_article_schema() {
    if (is_single()) {
        global $post;
        
        $schema = array(
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'author'        => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
            ),
        );
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $schema['image'] = $image[0];
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'khklopf_article_schema');

/**
 * Customize excerpt length
 */
function khklopf_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'khklopf_excerpt_length', 999);

/**
 * Customize excerpt more string
 */
function khklopf_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '&hellip; <a class="read-more" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read more', 'khklopf') . '</a>';
}
add_filter('excerpt_more', 'khklopf_excerpt_more');

/**
 * Custom pagination
 */
function khklopf_pagination() {
    if ($GLOBALS['wp_query']->max_num_pages <= 1) {
        return;
    }
    
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($GLOBALS['wp_query']->max_num_pages);

    // Add current page to the array
    if ($paged >= 1) {
        $links[] = $paged;
    }

    // Add the pages around the current page to the array
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination" role="navigation" aria-label="' . esc_attr__('Posts navigation', 'khklopf') . '">';

    // Previous Post Link
    if (get_previous_posts_link()) {
        printf('<a href="%s" aria-label="%s">%s</a>', esc_url(get_previous_posts_page_link()), esc_attr__('Previous page', 'khklopf'), esc_html__('&laquo; Previous', 'khklopf'));
    }

    // Link to first page
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="current"' : '';
        printf('<a href="%s"%s aria-label="%s">%s</a>', esc_url(get_pagenum_link(1)), $class, esc_attr__('Page 1', 'khklopf'), '1');

        if (!in_array(2, $links)) {
            echo '<span>...</span>';
        }
    }

    // Link to current page and pages around it
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="current"' : '';
        printf('<a href="%s"%s aria-label="%s">%s</a>', esc_url(get_pagenum_link($link)), $class, esc_attr(sprintf(__('Page %s', 'khklopf'), $link)), $link);
    }

    // Link to last page
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo '<span>...</span>';
        }

        $class = $paged == $max ? ' class="current"' : '';
        printf('<a href="%s"%s aria-label="%s">%s</a>', esc_url(get_pagenum_link($max)), $class, esc_attr(sprintf(__('Page %s', 'khklopf'), $max)), $max);
    }

    // Next Post Link
    if (get_next_posts_link()) {
        printf('<a href="%s" aria-label="%s">%s</a>', esc_url(get_next_posts_page_link()), esc_attr__('Next page', 'khklopf'), esc_html__('Next &raquo;', 'khklopf'));
    }

    echo '</nav>';
}

/**
 * ACF Integration - Register example custom fields
 * Note: Requires Advanced Custom Fields plugin to be installed
 */
function khklopf_register_acf_blocks() {
    if (function_exists('acf_register_block_type')) {
        // Example: Register a custom hero block
        acf_register_block_type(array(
            'name'            => 'hero',
            'title'           => __('Hero Section', 'khklopf'),
            'description'     => __('A custom hero section block.', 'khklopf'),
            'render_template' => 'template-parts/blocks/hero.php',
            'category'        => 'formatting',
            'icon'            => 'cover-image',
            'keywords'        => array('hero', 'banner', 'header'),
            'supports'        => array(
                'align' => array('wide', 'full'),
            ),
        ));
    }
}
add_action('acf/init', 'khklopf_register_acf_blocks');

/**
 * Get ACF field with fallback
 */
function khklopf_get_field($field_name, $post_id = false, $fallback = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        return $value ? $value : $fallback;
    }
    return $fallback;
}

/**
 * Display breadcrumbs for better navigation and SEO
 */
function khklopf_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    $separator = ' &raquo; ';
    $home_title = esc_html__('Home', 'khklopf');

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'khklopf') . '" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a itemprop="item" href="' . esc_url(home_url('/')) . '"><span itemprop="name">' . $home_title . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</span>';

    if (is_category() || is_single()) {
        echo $separator;
        
        if (is_single()) {
            $categories = get_the_category();
            if ($categories) {
                $category = $categories[0];
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a itemprop="item" href="' . esc_url(get_category_link($category->term_id)) . '"><span itemprop="name">' . esc_html($category->name) . '</span></a>';
                echo '<meta itemprop="position" content="2" />';
                echo '</span>';
                echo $separator;
            }
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="3" />';
            echo '</span>';
        } else {
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . single_cat_title('', false) . '</span>';
            echo '<meta itemprop="position" content="2" />';
            echo '</span>';
        }
    } elseif (is_page()) {
        echo $separator;
        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</span>';
    } elseif (is_search()) {
        echo $separator;
        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html__('Search results for', 'khklopf') . ' "' . get_search_query() . '"</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</span>';
    } elseif (is_404()) {
        echo $separator;
        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html__('Error 404', 'khklopf') . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</span>';
    }

    echo '</nav>';
}

/**
 * Add async/defer attributes to enqueued scripts
 */
function khklopf_script_loader_tag($tag, $handle) {
    if ('khklopf-navigation' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'khklopf_script_loader_tag', 10, 2);
