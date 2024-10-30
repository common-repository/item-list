<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       zworthkey.com/about-us
 * @since      1.0.0
 *
 * @package    Zwk_Item_List
 * @subpackage Zwk_Item_List/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zwk_Item_List
 * @subpackage Zwk_Item_List/admin
 * @author     Zworthkey <sales@zworthkey.com>
 */
class Zwk_Item_List_Admin {

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
		add_filter( 'manage_shop_order_posts_columns', array($this, 'zwk_add_item_column'),99,1);
		add_action( 'manage_shop_order_posts_custom_column' , array($this, 'zwk_fill_item'), 99, 2);
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
		 * defined in Zwk_Item_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zwk_Item_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zwk-item-list-admin.css', array(), $this->version, 'all' );

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
		 * defined in Zwk_Item_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zwk_Item_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zwk-item-list-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function zwk_add_item_column($columns){
		foreach ( $columns as $column_name => $column_info ) {

			$new_columns[ $column_name ] = $column_info;
	
			if ( 'order_date' === $column_name ) {
				$new_columns['zwk_item'] = __( 'Items', '' );
			}
		}
		return $new_columns;
	}

	public function zwk_fill_item($column, $post_id){
		$order = wc_get_order($post_id);
		$no_item = count($order->get_items());
		$num = 1 ;
		switch($column){
			case "zwk_item":
				foreach ($order->get_items() as $item_id => $item ) {
					$product_name   = $item->get_name(); // Get the item name (product name)

					$item_quantity  = $item->get_quantity(); // Get the item quantity
					echo esc_html('<p>');
					echo esc_html($product_name.' x '.$item_quantity);
					echo esc_html('</p>');
					if($no_item != $num){
						echo esc_html('<br/>');
						$num++;
					}
					
				}
			break;
		}
	}

}
