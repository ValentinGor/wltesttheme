<?php
// Prevent direct access to this file
defined('ABSPATH') || exit;

get_header(); // Include the site header

// Main content
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <article <?php post_class(); ?>>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="cell">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="cell large-4 medium-6 small-12">
                            <div class="car-thumbnail">
                                <?php
                                // Display the post thumbnail (featured image) with custom image size and attributes
                                the_post_thumbnail('medium', array('class' => 'custom-thumbnail-class', 'alt' => 'Custom Alt Text'));
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $car_brands = get_the_terms(get_the_ID(), 'brand');
                    if (!empty($car_brands) && !is_wp_error($car_brands)) { ?>
                        <div class="cell large-8 medium-6 small-12">
                            <div class="car-details">
                                <?php
                                // Display the car brand
                                $car_brands = get_the_terms(get_the_ID(), 'brand');
                                if (!empty($car_brands) && !is_wp_error($car_brands)) {
                                    echo '<p><span>Brand: </span>';
                                    foreach ($car_brands as $brand) {
                                        echo esc_html($brand->name);
                                    }
                                    echo '</p>';
                                } ?>

                                <?php
                                // Display the car country
                                $car_countries = get_the_terms(get_the_ID(), 'country');
                                if (!empty($car_countries) && !is_wp_error($car_countries)) {
                                    echo '<p><span>Country: </span>';
                                    foreach ($car_countries as $country) {
                                        echo esc_html($country->name);
                                    }
                                    echo '</p>';
                                } ?>

                                <?php
                                // Display the car color
                                $car_color = get_post_meta(get_the_ID(), 'car_color', true);
                                if (!empty($car_color)) { ?>
                                    <p class="color"><span >Color:</span>
                                        <span class="color" style="background-color: <?php echo esc_html($car_color); ?>">
                                        Color
                                    </span>
                                    </p>
                                <?php } ?>

                                <?php
                                // Display the car fuel
                                $car_fuel = get_post_meta(get_the_ID(), 'car_fuel', true);
                                if (!empty($car_fuel)) {
                                    echo '<p><span>Fuel: </span>' . esc_html($car_fuel) . '</p>';
                                } ?>

                                <?php
                                // Display the car power
                                $car_power = get_post_meta(get_the_ID(), 'car_power', true);
                                if (!empty($car_power)) {
                                    echo '<p><span>Power: </span>' . esc_html($car_power) . ' hp'.'</p>';
                                } ?>

                                <?php
                                // Display the car price
                                $car_price = get_post_meta(get_the_ID(), 'car_price', true);
                                if (!empty($car_price)) {
                                    echo '<p><span>Price: </span>' . esc_html($car_price) .' $'. '</p>';
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </article>
        <?php
    }
} else {
    // Display an error message if there are no posts
    echo '<p>No posts found.</p>';
}

get_footer(); // Include the site footer
