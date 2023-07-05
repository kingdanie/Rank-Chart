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
define('CR_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
define('CR_PLUGIN_BUILD_DIR', CR_PLUGIN_DIR . 'build/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rank-chart-activator.php
 */
function activate_rank_chart_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-activator.php';
	$activator = new Rank_Chart_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rank-chart-deactivator.php
 */
function deactivate_rank_chart_plugin() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-activator.php';
    $activator = new Rank_Chart_Activator();


	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rank-chart-deactivator.php';
    $deactivator = new Rank_Chart_Deactivator($activator);
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_rank_chart_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_rank_chart_plugin' );


class ChartRankPlugin {

    private static $instance;

    public static function get_instance() {
        if ( self::$instance === null ) {
            self:$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'rankchart_admin_enqueue_scripts'));
        add_action('wp_dashboard_setup', array($this, 'rank_chart_add_dashboard_widget'));
        add_action( 'rest_api_init', array($this, 'rank_chart_custom_endpoint' ));
    }


    public function rankchart_admin_enqueue_scripts() {
        wp_enqueue_style( 'cr-plugin-style', CR_PLUGIN_BUILD_DIR . 'index.css');
        wp_enqueue_script( 'cr-plugin-script', CR_PLUGIN_BUILD_DIR . 'index.js', array('wp-element'), '0.1.0', true);

    }


    public function rank_chart_add_dashboard_widget() {
        wp_add_dashboard_widget('rankchart_dashboard_widget', 'Rank Chart Scores', array($this, 'rankchart_admin_widget'));
    }


    public function rankchart_admin_widget() {
        require_once CR_PLUGIN_DIR . '/templates/app.php';
    }

    public function rank_chart_custom_endpoint() {
        register_rest_route( 'cr-plugin/v1', '/data', array(
            'methods' => 'GET',
            'callback' => array( $this, 'rank_chart_get_data' ),
  ) );
    }

    public function rank_chart_get_data( $request ) {
        $duration = $request->get_param('days');
        $data_url = CR_PLUGIN_DIR . 'data.php';

        //fetch the data from the data file
        $response = wp_remote_get($data_url);

        if( is_wp_error( $response ) ) {
            return rest_ensure_response(array());
        }

        $data = json_decode( wp_remote_retrieve_body($response), true);

        //Filter the data based on the selected duration
        $filtered_data = array_slice( $data, 0, $duration );

        return rest_ensure_response( $filtered_data );
    }
    

}

ChartRankPlugin::get_instance();