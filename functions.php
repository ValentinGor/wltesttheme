<?php
// Enqueue styles and scripts
function wl_test_theme_enqueue_scripts()
{
    // Foundation CSS
    wp_enqueue_style('foundation', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.5/css/foundation.min.css', array(), '6.7.5');

    // Your custom styles
    wp_enqueue_style('wl-test-theme-style', get_stylesheet_uri(), array('foundation'), '1.0');
    wp_enqueue_style('wl-test-theme-main-style', get_template_directory_uri() . '/assets/css/main-style.css', array('foundation'), '1.0');

    // Foundation JS (include jQuery as a dependency)
    wp_enqueue_script('foundation', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.7.5/js/foundation.min.js', array('jquery'), '6.7.5', true);

    // Your custom scripts
    wp_enqueue_script('wl-test-theme-script', get_template_directory_uri() . '/assets/js/custom-script.js', array('jquery', 'foundation'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'wl_test_theme_enqueue_scripts');

// Add support for featured images
add_theme_support('post-thumbnails');

// Custom function to modify excerpt length
function wl_test_theme_excerpt_length($length)
{
    return 30; // Change the number to adjust the excerpt length
}

add_filter('excerpt_length', 'wl_test_theme_excerpt_length', 999);

// Support title tag
add_theme_support('title-tag');

// Remove type script style
add_theme_support('html5', array('script', 'style'));

// Register the menu location
function theme_register_menus()
{
    register_nav_menus(array(
        'primary-menu' => 'Primary Menu', // Replace 'primary-menu' with your desired menu location name
        // You can add more menu locations here if needed
        //'secondary-menu' => 'Secondary Menu',
        //'footer-menu' => 'Footer Menu',
    ));
}

add_action('after_setup_theme', 'theme_register_menus');

// Registering a custom record type "Car"
function custom_post_type_car()
{
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car',
        'menu_name' => 'Cars',
        'name_admin_bar' => 'Car',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Car',
        'new_item' => 'New Car',
        'edit_item' => 'Edit Car',
        'view_item' => 'View Car',
        'all_items' => 'All Cars',
        'search_items' => 'Search Cars',
        'parent_item_colon' => 'Parent Car:',
        'not_found' => 'No cars found.',
        'not_found_in_trash' => 'No cars found in Trash.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'car'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_nav_menus' => true, // Set to true to enable menu support
    );

    register_post_type('car', $args);
}

add_action('init', 'custom_post_type_car');

// Registration of taxonomy "Brand"
function custom_taxonomy_brand()
{
    $labels = array(
        'name' => 'Brands',
        'singular_name' => 'Brand',
        'menu_name' => 'Brands',
        'all_items' => 'All Brands',
        'edit_item' => 'Edit Brand',
        'view_item' => 'View Brand',
        'update_item' => 'Update Brand',
        'add_new_item' => 'Add New Brand',
        'new_item_name' => 'New Brand Name',
        'parent_item' => 'Parent Brand',
        'parent_item_colon' => 'Parent Brand:',
        'search_items' => 'Search Brands',
        'popular_items' => 'Popular Brands',
        'separate_items_with_commas' => 'Separate brands with commas',
        'add_or_remove_items' => 'Add or remove brands',
        'choose_from_most_used' => 'Choose from the most used brands',
        'not_found' => 'No brands found.',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'brand'),
    );

    register_taxonomy('brand', 'car', $args);
}

add_action('init', 'custom_taxonomy_brand');

// Registration of taxonomy "Country"
function custom_taxonomy_country()
{
    $labels = array(
        'name' => 'Countries',
        'singular_name' => 'Country',
        'menu_name' => 'Countries',
        'all_items' => 'All Countries',
        'edit_item' => 'Edit Country',
        'view_item' => 'View Country',
        'update_item' => 'Update Country',
        'add_new_item' => 'Add New Country',
        'new_item_name' => 'New Country Name',
        'parent_item' => 'Parent Country',
        'parent_item_colon' => 'Parent Country:',
        'search_items' => 'Search Countries',
        'popular_items' => 'Popular Countries',
        'separate_items_with_commas' => 'Separate countries with commas',
        'add_or_remove_items' => 'Add or remove countries',
        'choose_from_most_used' => 'Choose from the most used countries',
        'not_found' => 'No countries found.',
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'country'),
    );

    register_taxonomy('country', 'car', $args);
}

add_action('init', 'custom_taxonomy_country');

// Adding meta fields to the "Car" post type
function car_meta_fields()
{
    add_meta_box('car_color', 'Color', 'car_color_callback', 'car', 'normal', 'default');
    add_meta_box('car_fuel', 'Fuel', 'car_fuel_callback', 'car', 'normal', 'default');
    add_meta_box('car_power', 'Power', 'car_power_callback', 'car', 'normal', 'default');
    add_meta_box('car_price', 'Price', 'car_price_callback', 'car', 'normal', 'default');
}

add_action('add_meta_boxes', 'car_meta_fields');

// Creating fields for each meta field
function car_color_callback($post)
{
    $color = get_post_meta($post->ID, 'car_color', true);
    ?>
    <input type="color" name="car_color" value="<?php echo esc_attr($color); ?>">
    <?php
}

function car_fuel_callback($post)
{
    $fuel = get_post_meta($post->ID, 'car_fuel', true);
    ?>
    <select name="car_fuel">
        <option value="petrol" <?php selected($fuel, 'petrol'); ?>>Petrol</option>
        <option value="diesel" <?php selected($fuel, 'diesel'); ?>>Diesel</option>
        <option value="electric" <?php selected($fuel, 'electric'); ?>>Electric</option>
    </select>
    <?php
}

function car_power_callback($post)
{
    $power = get_post_meta($post->ID, 'car_power', true);
    ?>
    <input type="number" name="car_power" value="<?php echo esc_attr($power); ?>">
    <?php
}

function car_price_callback($post)
{
    $price = get_post_meta($post->ID, 'car_price', true);
    ?>
    <input type="number" name="car_price" value="<?php echo esc_attr($price); ?>">
    <?php
}

// Saving meta field values when saving a record
function save_car_meta($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (isset($_POST['car_color'])) {
        update_post_meta($post_id, 'car_color', sanitize_hex_color($_POST['car_color']));
    }

    if (isset($_POST['car_fuel'])) {
        update_post_meta($post_id, 'car_fuel', sanitize_text_field($_POST['car_fuel']));
    }

    if (isset($_POST['car_power'])) {
        update_post_meta($post_id, 'car_power', intval($_POST['car_power']));
    }

    if (isset($_POST['car_price'])) {
        update_post_meta($post_id, 'car_price', floatval($_POST['car_price']));
    }
}

add_action('save_post_car', 'save_car_meta');


// Adding custom field "Phone Number" to the WordPress Customizer
function custom_phone($wp_customize)
{
    // Creating a new section
    $wp_customize->add_section('custom_contact_section', array(
        'title' => 'Contact Information', // Section title
        'description' => 'Customize contact information.', // Section description (optional)
        'priority' => 160, // Display priority of the section in the Customizer
    ));

    // Adding the new "Phone Number" field
    $wp_customize->add_setting('phone_number', array(
        'default' => '', // Default value (if not specified)
        'sanitize_callback' => 'sanitize_text_field', // Sanitization function for the entered data
    ));

    $wp_customize->add_control('phone_number', array(
        'label' => 'Phone Number', // Field label
        'section' => 'custom_contact_section', // Section where the field should be displayed
        'type' => 'text', // Control type (text field)
        'priority' => 10, // Display priority of the control
    ));
}

add_action('customize_register', 'custom_phone');


// Getting a phone number from the customizer settings
function get_custom_phone_number()
{
    $phone_number = get_theme_mod('phone_number', '');
    // Cleaning the phone number from extra characters, leaving only numbers
    return $phone_number;
}

// Getting a cleaned phone number from the customizer settings
function get_custom_cleaned_phone_number()
{
    $cl_phone_number = get_theme_mod('phone_number', '');
    // Cleaning the phone number from extra characters, leaving only numbers
    $cleaned_phone_number = preg_replace('/[^0-9]/', '', $cl_phone_number);
    return $cleaned_phone_number;
}

// Custom Logo
function custom_logo($wp_customize)
{
    $wp_customize->add_section('custom_logo_section', array(
        'title' => 'Custom Logo', // Section title
        'description' => 'Upload a custom logo for your website.', // Section description (optional)
        'priority' => 160, // Display priority of the section in the Customizer
    ));

    $wp_customize->add_setting('custom_logo', array(
        'default' => '', // Default value if logo is not selected
        'sanitize_callback' => 'esc_url_raw', // Sanitization function for the logo URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo', array(
        'label' => 'Select Custom Logo', // Control label
        'section' => 'custom_logo_section', // Section where the control should be displayed
        'settings' => 'custom_logo', // Settings associated with the control
    )));
}

add_action('customize_register', 'custom_logo');

function get_custom_logo_url()
{
    return get_theme_mod('custom_logo', '');
}

// Cars shortcode
function recent_cars_shortcode()
{
    $args = array(
        'post_type' => 'car', // Replace 'car' with the name of your custom post type
        'posts_per_page' => 10,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $output = '<ul>'; // Start the list
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li>' . get_the_title() . '</li>'; // Output the car title as a list item
        }
        $output .= '</ul>'; // Close the list
    } else {
        $output = 'No cars found.';
    }

    wp_reset_postdata();

    return $output;
}

add_shortcode('recent_cars', 'recent_cars_shortcode');