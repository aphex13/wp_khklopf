<?php
/**
 * The footer template file
 *
 * @package KH_Klopf_Theme
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-container">
        <div class="site-info">
            <?php
            /* translators: 1: Theme name, 2: Theme author */
            printf(
                esc_html__('&copy; %1$s %2$s. All rights reserved.', 'khklopf'),
                date('Y'),
                '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>'
            );
            ?>
            <span class="sep"> | </span>
            <?php
            /* translators: %s: WordPress */
            printf(
                esc_html__('Powered by %s', 'khklopf'),
                '<a href="https://wordpress.org/">WordPress</a>'
            );
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
