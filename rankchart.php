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

}

ChartRankPlugin::get_instance();