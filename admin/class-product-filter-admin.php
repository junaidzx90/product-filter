<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Product_Filter
 * @subpackage Product_Filter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Product_Filter
 * @subpackage Product_Filter/admin
 * @author     Developer Junayed <admin@easeare.com>
 */
class Product_Filter_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Product_Filter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Product_Filter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-filter-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Product_Filter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Product_Filter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-filter-admin.js', array( 'jquery' ), $this->version, false );

	}

	function admin_menu_callback(){
		add_options_page( "Product Filter", "Product Filter", "manage_options", "filter-product", [$this, "filter_product_menupage"], null );
		add_settings_section( 'product_filter_opt_section', '', '', 'product_filter_opt_page' );
		// Shortcode
		add_settings_field( 'pf_shortcode_view', 'Shortcode', [$this, 'pf_shortcode_view_cb'], 'product_filter_opt_page','product_filter_opt_section' );
		// Category One
		add_settings_field( 'product_filter_category1', 'Category One', [$this, 'product_filter_category1_cb'], 'product_filter_opt_page','product_filter_opt_section' );
		register_setting( 'product_filter_opt_section', 'product_filter_category1' );
		// Category Two
		add_settings_field( 'product_filter_category2', 'Category Two', [$this, 'product_filter_category2_cb'], 'product_filter_opt_page','product_filter_opt_section' );
		register_setting( 'product_filter_opt_section', 'product_filter_category2' );
	}

	function pf_shortcode_view_cb(){
		echo '<input type="text" readonly value="[filter_product]">';
	}

	function product_filter_category1_cb(){
		wc_product_dropdown_categories(array(
			'show_option_none'  => 'Select a category',
			'hide_empty'        => 0,
			'selected'          => get_option( 'product_filter_category1' ),
			'value_field'       => 'term_id',
			'show_count'        => 0,
			'name'              => 'product_filter_category1',
		));
	}
	function product_filter_category2_cb(){
		wc_product_dropdown_categories(array(
			'show_option_none'  => 'Select a category',
			'hide_empty'        => 0,
			'selected'          => get_option( 'product_filter_category2' ),
			'value_field'       => 'term_id',
			'show_count'        => 0,
			'name'              => 'product_filter_category2',
		));
	}

	function filter_product_menupage(){
		require_once plugin_dir_path( __FILE__ )."partials/product-filter-admin-display.php";
	}

}
