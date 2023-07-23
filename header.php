<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); // Hook for WordPress plugins and additional head content ?>
</head>
<body <?php body_class(); ?>>

<!-- Site header -->
<header>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell medium-2 small-6 small-order-1 medium-order-1">
                <div class="site-branding">
                    <a href="<?php echo home_url(); ?>">
                        <?php
                        $logo_url = get_custom_logo_url();
                        if (!empty($logo_url)) {
                            echo '<img src="' . esc_url($logo_url) . '" alt="Custom Logo">';
                        } else {
                            echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
                            echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
                        } ?>
                    </a>
                </div>
            </div>
            <div class="cell medium-6 small-12 small-order-2 medium-order-1">
                <div class="title-bar" data-responsive-toggle="example-animated-menu" data-hide-for="medium">
                    <button class="menu-icon" type="button" data-toggle></button>
                    <div class="title-bar-title">Menu</div>
                </div>

                <?php
                // Insert wp_nav_menu function with your menu inside top-bar
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => 'div',
                    'container_class' => 'top-bar',
                    'menu_class' => 'dropdown menu',
                    'menu_id' => 'example-animated-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
                    'fallback_cb' => false,
                ));
                ?>

            </div>
            <div class="cell medium-4 small-6 small-order-1 medium-order-2">
                <div class="site-phone">
                    <a href="tel:<?php echo get_custom_cleaned_phone_number(); ?>">
                        <?php echo get_custom_phone_number(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End site header -->


<!-- Opening div for the main content area -->
<main id="content" class="site-content">