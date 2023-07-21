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
                    <?php
                    // Display the site logo or site title and description
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
                        echo '<p class="site-description">' . get_bloginfo('description') . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="cell small-6">
                <nav class="site-navigation">
                    <!-- Display the site menu -->
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'primary-menu',
                    ));
                    ?>
                </nav>
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


<div id="content" class="site-content"> <!-- Opening div for the main content area -->
