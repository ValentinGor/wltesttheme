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
    // Display an error message if there are no pages
    echo '<p>No pages found.</p>';
}

get_footer(); // Include the site footer
