<?php
/**
 * Hero Block Template
 *
 * Example ACF Block Template
 *
 * @package KH_Klopf_Theme
 */

// Get ACF fields
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_button_text = get_field('hero_button_text');
$hero_button_link = get_field('hero_button_link');
$hero_background_image = get_field('hero_background_image');

// Support for block preview in the admin
$is_preview = isset($is_preview) && $is_preview;

// Create id attribute allowing for custom "anchor" value
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values
$className = 'hero-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$style = '';
if ($hero_background_image) {
    $style = 'background-image: url(' . esc_url($hero_background_image['url']) . ');';
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php echo esc_attr($style); ?>">
    <div class="hero-content-wrapper">
        <?php if ($hero_title) : ?>
            <h2 class="hero-title"><?php echo esc_html($hero_title); ?></h2>
        <?php endif; ?>

        <?php if ($hero_subtitle) : ?>
            <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
        <?php endif; ?>

        <?php if ($hero_button_text && $hero_button_link) : ?>
            <a href="<?php echo esc_url($hero_button_link); ?>" class="hero-button">
                <?php echo esc_html($hero_button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<style>
.hero-block {
    position: relative;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 4rem 1.5rem;
    color: #fff;
    text-align: center;
}

.hero-block::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-content-wrapper {
    position: relative;
    z-index: 1;
    max-width: 800px;
}

.hero-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.hero-button {
    display: inline-block;
    padding: 1rem 2rem;
    background: var(--wp--preset--color--secondary, #3498db);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.hero-button:hover {
    background: var(--wp--preset--color--primary, #2c3e50);
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.125rem;
    }
}
</style>
