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
define('ASBPATH') or die('Unauthorized Access');

//define constants
define('CR_PLUGIN-VERSION', '0.1.0');
define('CR_PLUGIN_DIR', plugin_dir_url( _FILE__ ));


class ChartRankPlugin {

    private static $instance;

    public static function get_instance() {
        if ( self::$instance === null ) {
            self:$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
        
    }


    
}