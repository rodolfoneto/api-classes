<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://rodolfoneto.com.br
 * @since             1.0.0
 * @package           Api_Classes
 *
 * @wordpress-plugin
 * Plugin Name:       Api Classes
 * Plugin URI:        https://rodolfoneto.com.br/cursos/api-classes
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rodolfo Neto
 * Author URI:        http://rodolfoneto.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       api-classes
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
define( 'API_CLASSES_VERSION', '1.0.0' );

require_once plugin_dir_path( __FILE__ ) . './vendor/autoload.php';
require_once plugin_dir_path( __FILE__ ) . './autoload.php';
require_once plugin_dir_path( __FILE__ ) . './includes/ApiClasses.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-api-classes-activator.php
 */
function activate_api_classes() {
//	require_once plugin_dir_path( __FILE__ ) . 'includes/class-api-classes-activator.php';
    ApiClasses\Includes\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-api-classes-deactivator.php
 */
function deactivate_api_classes() {
//	require_once plugin_dir_path( __FILE__ ) . 'includes/class-api-classes-deactivator.php';
	ApiClasses\Includes\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_api_classes' );
register_deactivation_hook( __FILE__, 'deactivate_api_classes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
//require plugin_dir_path( __FILE__ ) . 'includes/ApiClasses.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_api_classes() {

	$plugin = new ApiClasses\Includes\ApiClasses();
	$plugin->run();

}
run_api_classes();


add_action('rest_api_init', function(){
    $endUrls = [
        '',
        '/me',
        '/(?P<id>[\d]+)',
    ];
    (new ApiClasses\Includes\DisableRestAPI())->disableRESTAPI('wp/v2', 'users', $endUrls);
    (new ApiClasses\Includes\DisableRestAPI())->disableRESTAPI('wp/v2', 'posts', $endUrls);
});

//add_action('init', function()
//{
//    $userRouter = new ApiClasses\Includes\UserRouter();
//    add_action('rest_api_init', [$userRouter, 'register_routes'], 2);
//    var_dump($a);die;
//    apply_filters('rest_authentication_errors', function($a){
//        echo '<pre>';var_dump($a);die;
//    });
//    $wp_rest_server = rest_get_server();
////    var_dump($wp_rest_server);die();
//    $all_namespaces     = $wp_rest_server->get_namespaces();
//    $all_routes         = array_keys( $wp_rest_server->get_routes() );
//        echo '<pre>';var_dump($wp_rest_server);die;
//    foreach ( $all_namespaces as $route ) {
//        echo '<pre>';var_dump($all_namespaces);die;
//        echo '<pre>';var_dump($all_namespaces);die;
//    }
//	remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
//	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
//	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
//        
//            add_filter( 'json_enabled', '__return_false' );
//    add_filter( 'json_jsonp_enabled', '__return_false' );
//
//    // Filters for WP-API version 2.x
//    add_filter( 'rest_enabled', '__return_false' );
//    add_filter( 'rest_jsonp_enabled', '__return_false' );
//});