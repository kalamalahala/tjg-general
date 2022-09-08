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

/**
 * Shortcode callback hooks split into their individual files.
 * 
 * @since 0.0.10
 * @package Tjg_General
 * @subpackage Tjg_General/public
 * @author Tyler Karle <tyler.karle@icloud.com>
 */
 
 try {
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'shortcodes/recruiting-overview.php';

 } catch (Exception $e) {
	 error_log($e->getMessage());
 }

class Tjg_General_Public
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style('tjg-general-css', plugin_dir_url(__FILE__) . 'css/tjg-general-public.css', array(), null, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script('tjg-general-js', plugin_dir_url(__FILE__) . 'js/tjg-general-public.js', array('jquery'), $this->version, true);
		wp_localize_script('tjg-general-js', 'tjg_ajax_object', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('tjg_general_nonce'),
		));
	}

	function confirm_hire_button_shortcode($attributes)
	{
		$atts = shortcode_atts(array(
			'unique_id' => '',
			'form_id' => '',
			'field_id' => ''
		), $attributes);
		$unique_id = $atts['unique_id'];
		$form_id = $atts['form_id'];
		$field_id = $atts['field_id'];

		if (!$unique_id) {
			return '<p>No unique ID provided.</p>';
		}
		if (!$atts['form_id']) {
			return '<p>No form ID provided.</p>';
		}
		if (!$atts['field_id']) {
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

		$hire_entry = GFAPI::get_entries($form_id, $hire_entry_query);
		if (!$hire_entry) {
			return '<p>No hire entry found.</p>';
		}
		$candidate_entry = $hire_entry[0];

		$candidate_uid = $candidate_entry[$field_id];
		$candidate_first_name = $candidate_entry['3.3'];
		$candidate_last_name = $candidate_entry['3.6'];
		$candidate_status = $candidate_entry['33'];

		$candidate_full_name = $candidate_first_name . ' ' . $candidate_last_name;

		$output = '<div class="tjg-hire-container"><p class="tjg-hire-status">Status: <span id="' . $candidate_uid . '-status" class="tjg-hire-status-text">' . $candidate_status . '</span></p><p>
		<a class="tjg-confirm-hire-button" data-uid="' . $candidate_uid . '" data-form-id="' . $form_id . '" data-field-id="' . $field_id . '">Confirm ' . $candidate_full_name . '</a>
		</p></div>';

		return $output;
	}

	function tjg_confirm_hire()
	{
		$nonce = $_REQUEST['nonce'];
		if (!wp_verify_nonce($nonce, 'tjg_general_nonce')) {
			die('Invalid nonce.');
		}
		$ajax_uid = $_REQUEST['uid'];
		$ajax_form_id = $_REQUEST['form_id'];
		$ajax_field_id = $_REQUEST['field_id'];

		$hire_entry_query = array(
			'status' => 'active',
			'field_filters' => array(
				array(
					'key' => $ajax_field_id,
					'value' => $ajax_uid,
				),
			)
		);

		$hire_entry = GFAPI::get_entries($ajax_form_id, $hire_entry_query);
		if (!$hire_entry) {
			die('No hire entry found.');
		}

		$candidate_entry = $hire_entry[0];
		$candidate_uid = $candidate_entry[$ajax_field_id];
		$candidate_first_name = $candidate_entry['3.3'];
		$candidate_last_name = $candidate_entry['3.6'];
		$candidate_full_name = $candidate_first_name . ' ' . $candidate_last_name;
		$enroll_date = $candidate_entry['38'];

		// Set status to Accepted - Pending XCEL, set enrollment date to today YYYY-MM-DD in string format
		$candidate_entry['33'] = 'Accepted - Pending XCEL';
		$candidate_entry['38'] = date('Y-m-d');
		$candidate_status = $candidate_entry['33'];

		// Update entry using GFAPI
		try {
			$updated_entry = GFAPI::update_entry($candidate_entry);
		} catch (Exception $e) {
			die('Error updating entry: ' . $e->getMessage());
		}

		if ($updated_entry) {
			$output = json_encode(array(
				'uid' => $candidate_uid,
				'first_name' => $candidate_first_name,
				'last_name' => $candidate_last_name,
				'full_name' => $candidate_full_name,
				'status' => $candidate_status,
				'enroll_date' => $enroll_date,
				'new_enroll_date' => $candidate_entry['38'],
				// 'entry' => $candidate_entry,
			));

			echo $output;
		} else {
			die('Error updating entry.');
		}
		die();
	}

	function tjg_confirm_hire_nopriv()
	{
		die('You must be logged in to do that.');
	}
}
