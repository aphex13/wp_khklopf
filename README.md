# KH Klopf Theme

A custom, responsive WordPress theme for [khklopf.at](https://khklopf.at) with full Gutenberg support, ACF integration, SEO optimization, and accessibility features.

## Features

- ✅ **Responsive Design**: Mobile-first approach with fluid layouts
- ✅ **Gutenberg Support**: Full block editor compatibility with theme.json
- ✅ **ACF Integration**: Advanced Custom Fields support with example blocks
- ✅ **SEO Optimized**: Semantic HTML5, Schema.org markup, Open Graph tags
- ✅ **Accessible**: WCAG 2.1 compliant with ARIA labels and keyboard navigation
- ✅ **Sticky Header**: Smooth sticky navigation with performance optimization
- ✅ **Site Branding**: Custom logo and site identity support
- ✅ **Template System**: Complete template hierarchy for all page types
- ✅ **Performance**: Clean, optimized code with minimal dependencies
- ✅ **Customizable**: Well-documented and easy to extend

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- MySQL 5.7 or higher / MariaDB 10.3 or higher

## Installation

1. **Download the theme:**
   ```bash
   git clone https://github.com/aphex13/wp_khklopf.git
   ```

2. **Upload to WordPress:**
   - Copy the theme folder to `/wp-content/themes/`
   - Or upload as a ZIP file via WordPress Admin: Appearance → Themes → Add New

3. **Activate the theme:**
   - Go to Appearance → Themes
   - Click "Activate" on the KH Klopf Theme

4. **Configure theme settings:**
   - Set up your logo: Appearance → Customize → Site Identity
   - Configure menus: Appearance → Menus
   - Set up homepage: Settings → Reading

## Theme Structure

```
wp_khklopf/
├── style.css                 # Main stylesheet with theme information
├── functions.php             # Theme functions and features
├── theme.json               # Gutenberg theme configuration
├── index.php                # Main template file
├── header.php               # Header template
├── footer.php               # Footer template
├── front-page.php           # Homepage template
├── single.php               # Single post template
├── page.php                 # Page template
├── archive.php              # Archive template
├── search.php               # Search results template
├── 404.php                  # 404 error page template
├── comments.php             # Comments template
├── searchform.php           # Search form template
├── js/
│   └── navigation.js        # Navigation and interactive features
├── template-parts/
│   ├── content.php          # Default content template
│   ├── content-single.php   # Single post content
│   ├── content-page.php     # Page content
│   ├── content-archive.php  # Archive listing
│   ├── content-search.php   # Search results
│   ├── content-none.php     # No results found
│   └── blocks/
│       └── hero.php         # ACF Hero block example
└── README.md                # This file
```

## Customization

### Colors

Edit CSS variables in `style.css`:

```css
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --text-color: #333;
    --text-light: #666;
    --bg-color: #ffffff;
    --bg-light: #f8f9fa;
}
```

Or use the theme.json color palette for Gutenberg blocks.

### Typography

Modify font settings in `theme.json` or override in `style.css`:

```css
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, ...;
}
```

### Navigation Menus

1. Go to **Appearance → Menus**
2. Create a new menu or edit existing
3. Assign to **Primary Menu** or **Footer Menu** location
4. Add pages, posts, custom links, or categories

### Custom Logo

1. Go to **Appearance → Customize → Site Identity**
2. Click "Select Logo"
3. Upload your logo image (recommended: 200x80px or similar)
4. Adjust logo size if needed

### Homepage Setup

**Static Homepage:**
1. Create a new page (e.g., "Home")
2. Go to **Settings → Reading**
3. Select "A static page" under "Your homepage displays"
4. Choose your homepage and blog page

**Dynamic Homepage:**
- The theme automatically displays latest posts if no static page is set

## ACF (Advanced Custom Fields) Integration

The theme includes built-in support for ACF. Install the ACF plugin to use custom fields.

### Example: Homepage Hero Section

1. Install [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/)
2. Create a field group for the homepage:
   - `hero_title` (Text)
   - `hero_text` (Textarea)
   - `hero_image` (Image)
3. The `front-page.php` template will automatically display these fields

### Custom Gutenberg Blocks

The theme includes an example Hero block (`template-parts/blocks/hero.php`).

To create ACF fields for this block:
1. Create a field group
2. Set location rule: "Block is equal to Hero Section"
3. Add fields:
   - `hero_title` (Text)
   - `hero_subtitle` (Text)
   - `hero_button_text` (Text)
   - `hero_button_link` (URL)
   - `hero_background_image` (Image)

## SEO Features

### Built-in SEO

The theme includes:
- Semantic HTML5 markup
- Schema.org structured data (Article, Breadcrumbs)
- Open Graph meta tags
- Optimized heading hierarchy
- Breadcrumb navigation

### Recommended Plugins

For advanced SEO, install:
- [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/)
- [Rank Math](https://wordpress.org/plugins/seo-by-rank-math/)

The theme is compatible with all major SEO plugins.

## Accessibility

The theme follows WCAG 2.1 Level AA guidelines:

- **Keyboard Navigation**: Full keyboard support for all interactive elements
- **Screen Reader Support**: ARIA labels and semantic HTML
- **Skip Links**: Jump to main content
- **Color Contrast**: WCAG AA compliant color combinations
- **Focus Indicators**: Visible focus states for all interactive elements

## Performance Optimization

- **Minimal Dependencies**: No jQuery or heavy frameworks
- **Optimized JavaScript**: Deferred loading with async/defer attributes
- **Efficient CSS**: Mobile-first approach with critical CSS inline
- **Lazy Loading**: Native browser lazy loading for images
- **HTTP/2 Ready**: Optimized for modern hosting environments

### Recommended Performance Plugins

- [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/)
- [Autoptimize](https://wordpress.org/plugins/autoptimize/)
- [Smush](https://wordpress.org/plugins/wp-smushit/) for image optimization

## Browser Support

- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Development

### Local Development

1. Set up a local WordPress environment (XAMPP, Local, Docker, etc.)
2. Clone the repository to `/wp-content/themes/`
3. Make your changes
4. Test thoroughly before deploying

### Coding Standards

The theme follows [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/):

- PHP: WordPress PHP Coding Standards
- JavaScript: WordPress JavaScript Coding Standards
- CSS: WordPress CSS Coding Standards

### Child Theme

To customize without modifying core files, create a child theme:

1. Create a new folder: `/wp-content/themes/khklopf-child/`
2. Create `style.css`:
   ```css
   /*
   Theme Name: KH Klopf Child
   Template: wp_khklopf
   */
   ```
3. Create `functions.php`:
   ```php
   <?php
   add_action('wp_enqueue_scripts', 'khklopf_child_enqueue_styles');
   function khklopf_child_enqueue_styles() {
       wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   }
   ```

## Support & Documentation

### Common Issues

**Navigation menu not showing:**
- Go to Appearance → Menus and assign a menu to "Primary Menu"

**Logo not displaying:**
- Go to Appearance → Customize → Site Identity and upload a logo

**Sticky header not working:**
- Check that JavaScript is not blocked by cache or security plugins
- Clear browser cache and reload

### Getting Help

- Check the [WordPress Codex](https://codex.wordpress.org/)
- Review [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- Search [WordPress Support Forums](https://wordpress.org/support/)

## Changelog

### Version 1.0.0
- Initial release
- Responsive design with mobile-first approach
- Full Gutenberg block editor support
- ACF integration with example blocks
- SEO-optimized markup and meta tags
- Accessible navigation with ARIA labels
- Sticky header functionality
- Custom logo and site branding
- Complete template hierarchy
- Performance optimizations

## Credits

- Theme by KH Klopf
- Built with WordPress best practices
- Icons: Unicode emoji for simplicity
- Fonts: System font stack for optimal performance

## License

This theme is licensed under the GNU General Public License v2 or later.

Copyright (C) 2024 KH Klopf

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
