<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://jaxgo.club/
 * @since      1.0.0
 *
 * @package    Tjg_General
 * @subpackage Tjg_General/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tjg_General
 * @subpackage Tjg_General/public
 * @author     Tyler Karle <tyler.karle@icloud.com>
 */
class Tjg_General_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tjg_General_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tjg_General_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tjg-general-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tjg_General_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tjg_General_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tjg-general-public.js', array( 'jquery' ), $this->version, false );

	}

	function confirm_hire_button_shortcode( $attributes ) {
		$atts = shortcode_atts( array(
			'unique_id' => '',
			'form_id' => '',
			'field_id' => ''
		), $attributes );
		$unique_id = $atts['unique_id'];
		$form_id = $atts['form_id'];
		$field_id = $atts['field_id'];

		if ( ! $unique_id ) {
			return '<p>No unique ID provided.</p>';
		}
		if ( ! $atts['form_id'] ) {
			return '<p>No form ID provided.</p>';
		}
		if ( ! $atts['field_id'] ) {
			return '<p>No field ID provided.</p>';
		}

		$hire_entry_query = array(
			'status' => 'active',
			'field_filters' => array(
				array(
					'key' => $field_id,
					'value' => $unique_id,
				),
			)
		);

		$hire_entry = GFAPI::get_entries( $form_id, $hire_entry_query );
		if ( ! $hire_entry ) {
			return '<p>No hire entry found.</p>';
		}
		$hire_entry = $hire_entry[0];

		$output = '';

		foreach ( $hire_entry as $key => $value ) {
			$output .= '<p>' . $key . ': ' . $value . '</p>';
		}


		return $output . '<br><button class="confirm-hire-button">Confirm Hire!</button>';
	}

}
