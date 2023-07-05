<?php
/**
 * Plugin Name:     Rankchart
 * Plugin URI:      https://github.com/kingdanie
 * Description:     Plugin that displays daily SEO charts on the Wordpress dashboard
 * Author:          Danie D'mola
 * Author URI:       https://github.com/kingdanie
 * Text Domain:     rankchart
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Rankchart
 */

//if this file is accessed directly, abort!!
defined('ABSPATH') or die('Unauthorized Access');

//define constants
define('CR_PLUGIN-VERSION', '0.1.0');
define('CR_PLUGIN_TABLE_NAME', 'rank_chart_data');
define('CR_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
define('CR_PLUGIN_BUILD_DIR', CR_PLUGIN_DIR . 'build/' );



// Include the activator and deactivator classes
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-activator.php';
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-plugin.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-deactivator.php';



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rank-chart-activator.php
 */
function activate_rank_chart_plugin() {
	$activator = new Rank_Chart_Activator();
	$activator->activate();
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rank-chart-deactivator.php
 */
function deactivate_rank_chart_plugin() {
    $activator = new Rank_Chart_Activator();
    $deactivator = new Rank_Chart_Deactivator($activator);
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_rank_chart_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_rank_chart_plugin' );



Rank_Chart_Plugin::get_instance();