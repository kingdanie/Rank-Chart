<?php
/**
 * Main Plugin File 
 *
 * @link       github.com/kingdanie
 * @since      0.1.0
 *
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 */

/**
 * Main Plugin File 
 *
 * This class defines all code necessary to running  the plugin's main logic.
 *
 * @since      0.1.0
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 * @author     Danie D'mola
 */

class Rank_Chart_Plugin {

    private static $instance;

    public static function get_instance() {
        if ( self::$instance === null ) {
            self:$instance = new self();
        }

        return self::$instance;
    }

    
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'rankchart_admin_enqueue_scripts' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'rank_chart_add_dashboard_widget' ) );
        add_action( 'rest_api_init', array( $this, 'rank_chart_custom_endpoint' ) );
    }


    public function rankchart_admin_enqueue_scripts() {
        wp_enqueue_style( 'cr-plugin-style', CR_PLUGIN_BUILD_DIR . 'index.css' );
        wp_enqueue_script( 'cr-plugin-script', CR_PLUGIN_BUILD_DIR . 'index.js', array('wp-element'), '0.1.0', true );

    }


    public function rank_chart_add_dashboard_widget() {
        wp_add_dashboard_widget( 'rankchart_dashboard_widget', 'Rank Chart Scores', array( $this, 'rankchart_admin_widget' ) );

        // Globalize the metaboxes array, this holds all the widgets for wp-admin
        global $wp_meta_boxes;

        // Get the regular dashboard widgets array with our new widget appearing at the very end
        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

        // Backup and delete our new dashboard widget from the end of the array
        $rank_chart_widget_backup = array( 'rank_chart_dashboard_widget' => $normal_dashboard['rank_chart_dashboard_widget'] );
        unset( $normal_dashboard['rank_chart_dashboard_widget'] );

        // Merge the two arrays together so our widget is at the beginning
        $sorted_dashboard = array_merge( $rank_chart_widget_backup, $normal_dashboard );

        // Save the sorted array back into the original metaboxes
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
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

         global $wpdb;
        $duration = $request->get_param( 'days' );
        $table_name = $wpdb->prefix . CR_PLUGIN_TABLE_NAME;

         // Query the database to fetch the data
        $query = $wpdb->prepare( "SELECT * FROM $table_name ORDER BY day ASC" );
        $results = $wpdb->get_results( $query, ARRAY_A );


        if( is_wp_error( $results ) ) {
            return rest_ensure_response( array() );
        }


        //Filter the data based on the selected duration
        $filtered_data = array_slice( $results, 0, $duration );

        return rest_ensure_response( $filtered_data );
    }
    

}