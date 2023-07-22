<?php
// Prevent direct access to this file
defined('ABSPATH') || exit;

get_header(); // Include the site header

// Main content
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell small-12">
                    <article <?php post_class(); ?>>
                        <h2><?php the_title(); ?></h2>

                        <?php
                        if (has_post_thumbnail()) {
                            // Display the post thumbnail (featured image) with custom image size and attributes
                            the_post_thumbnail('medium', array('class' => 'custom-thumbnail-class', 'alt' => 'Custom Alt Text'));
                        } ?>

                        <?php
                        // Display the car brand
                        $car_brands = get_the_terms(get_the_ID(), 'brand');
                        if (!empty($car_brands) && !is_wp_error($car_brands)) {
                            echo '<p>Brand: ';
                            foreach ($car_brands as $brand) {
                                echo esc_html($brand->name);
                            }
                            echo '</p>';
                        } ?>

                        <?php
                        // Display the car country
                        $car_countries = get_the_terms(get_the_ID(), 'country');
                        if (!empty($car_countries) && !is_wp_error($car_countries)) {
                            echo '<p>Country: ';
                            foreach ($car_countries as $country) {
                                echo esc_html($country->name);
                            }
                            echo '</p>';
                        } ?>

                        <?php
                        // Display the car color
                        $car_color = get_post_meta(get_the_ID(), 'car_color', true);
                        if (!empty($car_color)) { ?>
                            <span style="background-color: <?php echo esc_html($car_color); ?>">
                                123
                            </span>
                        <?php } ?>

                        <?php
                        // Display the car fuel
                        $car_fuel = get_post_meta(get_the_ID(), 'car_fuel', true);
                        if (!empty($car_fuel)) {
                            echo '<p>Fuel: ' . esc_html($car_fuel) . '</p>';
                        } ?>

                        <?php
                        // Display the car power
                        $car_power = get_post_meta(get_the_ID(), 'car_power', true);
                        if (!empty($car_power)) {
                            echo '<p>Power: ' . esc_html($car_power) . '</p>';
                        } ?>

                        <?php
                        // Display the car price
                        $car_price = get_post_meta(get_the_ID(), 'car_price', true);
                        if (!empty($car_price)) {
                            echo '<p>Price: ' . esc_html($car_price) . '</p>';
                        } ?>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                    </article>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    // Display an error message if there are no posts
    echo '<p>No posts found.</p>';
}

get_footer(); // Include the site footer
