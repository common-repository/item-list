<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       zworthkey.com/about-us
 * @since      1.0.0
 *
 * @package    Zwk_Item_List
 * @subpackage Zwk_Item_List/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Zwk_Item_List
 * @subpackage Zwk_Item_List/includes
 * @author     Zworthkey <sales@zworthkey.com>
 */
class Zwk_Item_List_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'zwk-item-list',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
