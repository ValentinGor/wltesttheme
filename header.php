<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); // Hook for WordPress plugins and additional head content ?>
</head>
<body <?php body_class(); ?>>

<!-- Site header -->
<header>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell small-2">
                <div class="site-branding">
                    <a href="<?php echo home_url(); ?>">
                        <?php
                        $logo_url = get_custom_logo_url();
                        if (!empty($logo_url)) {
                            echo '<img src="' . esc_url($logo_url) . '" alt="Custom Logo">';
                        } else {
                            echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
                            echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
                        }
                        ?>
                    </a>
                </div>
            </div>
            <div class="cell small-6">
                <?php
                // Display the menu assigned to the 'primary-menu' location
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => 'nav',
                    'container_class' => 'primary-menu', // You can add a CSS class to the menu container
                ));
                ?>
            </div>
            <div class="cell small-4">
                <a href="tel:<?php echo get_custom_cleaned_phone_number(); ?>">
                    <?php echo get_custom_phone_number(); ?>
                </a>
            </div>
        </div>
    </div>
</header>
<!-- End site header -->


<main id="content" class="site-content"> <!-- Opening div for the main content area -->