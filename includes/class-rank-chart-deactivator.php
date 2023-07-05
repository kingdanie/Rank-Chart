<?php

/**
 * Fired during plugin deactivation
 *
 * @link       github.com/kingdanie
 * @since      0.1.0
 *
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.1.0
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 * @author     Danie D'mola
 */
class Rank_Chart_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.1.0
	 */

	private $table_activator;


	public function __construct( $activator )
    {
        $this->table_activator = $activator;
    }

	
    public function deactivate() {

	    global $wpdb;
		$table_name = $this->table_activator->wp_rank_chart_tbl();
		$sql = "DROP TABLE IF EXISTS $table_name";
	        //drop tables when plugin uninstalls

        $wpdb->query( $sql );

	}

}