<?php
/**
 *
 * @link              https://shamir.co.il
 * @since             1.0.0
 * @package           Shamir
 *
 * @wordpress-plugin
 * Plugin Name:       shamir
 * Plugin URI:        https://shamir.co.il
 * Description:       Users Table
 * Version:           1.0.0
 * Author:            Oren S
 * Author URI:        https://shamir.co.il
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shamir
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SHAMIR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shamir-activator.php
 */
function activate_shamir() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shamir-activator.php';
	Shamir_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shamir-deactivator.php
 */
function deactivate_shamir() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shamir-deactivator.php';
	Shamir_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_shamir' );
register_deactivation_hook( __FILE__, 'deactivate_shamir' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shamir.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shamir() {

	$plugin = new Shamir();
	$plugin->run();

}
run_shamir();

/* custom post type */
function cptui_register_my_cpts_list() {

	/**
	 * Post Type: List.
	 */

	$labels = [
		"name" => __( "list", "shamir" ),
		"singular_name" => __( "list", "shamir" ),
		"menu_name" => __( "List", "shamir" ),
		"all_items" => __( "All Lists", "shamir" ),
		"add_new" => __( "Add New", "shamir" ),
		"add_new_item" => __( "List", "shamir" ),
		"edit_item" => __( "Edit List", "shamir" ),
		"new_item" => __( "Add New List", "shamir" ),
		"view_item" => __( "View List", "shamir" ),
		"view_items" => __( "View Lists", "shamir" ),
		"search_items" => __( "Lists", "shamir" ),
	];

	$args = [
		"label" => __( "List", "shamir" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "list", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "list", $args );
}

add_action( 'init', 'cptui_register_my_cpts_list' );


class IveReadThis {

    /*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {

        // Include the Ajax library on the front end

        add_action( 'wp_head', array( &$this, 'add_ajax_library' ) );

        add_action( 'wp_ajax_summ_update', array( &$this, 'summ_update' ) );
        add_action( 'wp_ajax_nopriv_summ_update', array( &$this, 'summ_update' ) );

				add_action( 'wp_ajax_get_rec', array( &$this, 'get_rec' ) );
        add_action( 'wp_ajax_nopriv_get_rec', array( &$this, 'get_rec' ) );

    } // end constructor

    /**
     * Registers and enqueues plugin-specific styles.
     */

     public function add_ajax_library() {

         $html = '<script type="text/javascript">';
            $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
         $html .= '</script>';

        echo $html;

    } // end add_ajax_library


		public function summ_update() {

		     if( isset( $_POST['post_id'] ) && is_numeric( $_POST['post_id'] ) ) {
		    // First, we need to make sure the post ID parameter has been set and that it's a numeric value
		    // if( isset( $post_id ) && is_numeric( $post_id ) ) //{

		        $post_id = $_POST['post_id'];
		        $users_json = $_POST['users_json'];
		        // save a basic text value
		        $field_key_4 = "users_json";
		        echo false == update_field( $field_key_4, $users_json, $post_id ) ? "-1" : "1";

		    } // end if

		    die();

		} // end action

		public function get_rec() {

		     if( isset( $_POST['post_id'] ) && is_numeric( $_POST['post_id'] ) ) {
		    // First, we need to make sure the post ID parameter has been set and that it's a numeric value
		    // if( isset( $post_id ) && is_numeric( $post_id ) ) //{

		        $post_id = $_POST['post_id'];
		        // save a basic text value

		          echo get_field("users_json", $post_id);

		    }

		    die();

		} // end action




} // end class

new IveReadThis();
