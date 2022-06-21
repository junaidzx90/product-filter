<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Product_Filter
 * @subpackage Product_Filter/public/partials
 */

function get_product_category_by_id( $category_id ) {
    if(!$category_id) return;
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return $term['name'];
}
?>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="product_filter">
    <div class="__product_filter">
        <?php 
        if(get_option('product_filter_category1')){
            ?>
            <a href="#" class="filter_item active" data-product-filter=".<?php echo get_option('product_filter_category1') ?>"><?php echo get_product_category_by_id( get_option('product_filter_category1') ) ?></a>
            <?php
        }
        if(get_option('product_filter_category2')){
            ?>
            <a href="#" class="filter_item" data-product-filter=".<?php echo get_option('product_filter_category2') ?>"><?php echo get_product_category_by_id( get_option('product_filter_category2') ) ?></a>
            <?php
        }
        ?>
    </div>

    <div id="__product_slider" class="owl-carousel">
        <?php 
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array (
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => [get_option('product_filter_category1'), get_option('product_filter_category2')],
                    'operator' => 'IN'
                )
            )
        );
        $products = get_posts( $args );

        if($products){
            foreach($products as $product){
                $productObj = wc_get_product($product->ID);
                $terms = get_the_terms( $product->ID, 'product_cat' );
                ?>
                <div class="product_item <?php echo implode(" ", wp_list_pluck( $terms, 'term_id' )) ?>">
                    <div class="product_image">
                        <img src="<?php echo wp_get_attachment_url( $productObj->get_image_id() ) ?>" alt="<?php echo $productObj->get_slug(); ?>">
                    </div>
                    <h4 class="product_title"><?php echo $productObj->get_name(); ?></h4>
                    <div class="_price">
                        <?php echo $productObj->get_price_html(); ?>
                    </div>
                    <div class="buton-wrapper">
                        <a target="_blank" class="view_button" href="<?php echo get_the_permalink( $product->ID ) ?>">View Product</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>