</main> <!-- Closing div for the main content area -->

<!-- Site footer -->
<footer>
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell small-12">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <?php wp_footer(); // Hook for WordPress plugins and additional scripts ?>
            </div>
        </div>
    </div>
</footer>
<!-- End site footer -->

</body>
</html>
