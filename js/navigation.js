/**
 * Navigation and Sticky Header JavaScript
 *
 * @package KH_Klopf_Theme
 */

(function() {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');

        if (!menuToggle || !navigation) {
            return;
        }

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            navigation.classList.toggle('toggled');
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navigation.classList.contains('toggled')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('toggled');
                menuToggle.focus();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navigation.contains(e.target) && !menuToggle.contains(e.target)) {
                if (navigation.classList.contains('toggled')) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    navigation.classList.remove('toggled');
                }
            }
        });
    }

    /**
     * Sticky Header
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');
        
        if (!header) {
            return;
        }

        let lastScrollTop = 0;
        const headerHeight = header.offsetHeight;
        let ticking = false;

        function updateHeader() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > headerHeight) {
                header.classList.add('sticky');
                // Add padding to body to prevent content jump
                document.body.style.paddingTop = headerHeight + 'px';
            } else {
                header.classList.remove('sticky');
                document.body.style.paddingTop = '0';
            }

            lastScrollTop = scrollTop;
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                window.requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });
        
        // Initial check
        updateHeader();
    }

    /**
     * Dropdown Menu Accessibility
     */
    function initDropdownAccessibility() {
        const menuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');

        menuItems.forEach(function(menuItem) {
            const link = menuItem.querySelector('a');
            const submenu = menuItem.querySelector('ul');

            if (!link || !submenu) {
                return;
            }

            // Add aria attributes
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');
            submenu.setAttribute('aria-hidden', 'true');

            // Toggle on click for touch devices
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const expanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !expanded);
                    submenu.setAttribute('aria-hidden', expanded);
                    submenu.style.display = expanded ? 'none' : 'flex';
                }
            });

            // Handle mouse events for desktop
            menuItem.addEventListener('mouseenter', function() {
                if (window.innerWidth > 768) {
                    link.setAttribute('aria-expanded', 'true');
                    submenu.setAttribute('aria-hidden', 'false');
                }
            });

            menuItem.addEventListener('mouseleave', function() {
                if (window.innerWidth > 768) {
                    link.setAttribute('aria-expanded', 'false');
                    submenu.setAttribute('aria-hidden', 'true');
                }
            });

            // Handle keyboard navigation
            link.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        const expanded = this.getAttribute('aria-expanded') === 'true';
                        this.setAttribute('aria-expanded', !expanded);
                        submenu.setAttribute('aria-hidden', expanded);
                        submenu.style.display = expanded ? 'none' : 'flex';
                    }
                }
            });
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId === '#' || targetId === '#0') {
                    return;
                }

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update focus for accessibility
                    targetElement.focus({ preventScroll: true });
                }
            });
        });
    }

    /**
     * Initialize all functions when DOM is ready
     */
    function init() {
        initMobileMenu();
        initStickyHeader();
        initDropdownAccessibility();
        initSmoothScroll();
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
