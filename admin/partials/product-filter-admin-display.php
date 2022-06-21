<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Product_Filter
 * @subpackage Product_Filter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h3>Product filter</h3>
<hr>
<form style="width: 75%;" method="post" action="options.php">
    <?php
    settings_fields( 'product_filter_opt_section' );
    do_settings_sections('product_filter_opt_page');
    echo get_submit_button( 'Save Changes', 'secondary', 'save-filter-setting' );
    ?>
</form>