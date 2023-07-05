<?php

/**
 * Fired during plugin activation
 *
 * @link       github.com/kingdanie
 * @since      0.1.0
 *
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.1.0
 * @package    Rank_Chart
 * @subpackage Rank_Chart/includes
 * @author     Danie D'mola
 */
class Rank_Chart_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {

	    global $wpdb;

	    if($wpdb->get_var("SHOW tables like '".$this->wp_rank_chart_tbl()."'") != $this->wp_rank_chart_tbl()){

            //Dynamic table generating Code

            $table_query = "CREATE TABLE `".$this->wp_rank_chart_tbl()."` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `day` varchar(150) DEFAULT NULL,
                         `setScore` int(11) DEFAULT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                         PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4"; //Table creation query

            require_once (ABSPATH .'wp-admin/includes/upgrade.php');
            dbDelta($table_query);

        }

	}



    public function wp_rank_chart_tbl(){
        global $wpdb;

        return $wpdb->prefix ."rank_chart_tbl"; // $wpdb->prefix => wp_
    }

}