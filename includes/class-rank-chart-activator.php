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

            $this->create_table();
            $this->insert_data();

        }

	}


       /**
     * Create the table.
     */
    private function create_table() {
        global $wpdb;

        $table_name = $this->wp_rank_chart_tbl();
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            day VARCHAR(150) DEFAULT NULL,
            setScore INT(11) DEFAULT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }


    /**
     * Insert the data into the table.
     */
    private function insert_data() {
        global $wpdb;

        $table_name = $this->wp_rank_chart_tbl();
        $data = array(
            [
                'day' => '1',
                'setScore' => 4000,
            ],
            [
                'day' => '2',
                'setScore' => 3000,
            ],
            [
                'day' => '3',
                'setScore' => 2000,
            ],
            [
                'day' => '4',
                'setScore' => 2780,
            ],
            [
                'day' => '5',
                'setScore' => 1890,
            ],
            [
                'day' => '6',
                'setScore' => 2390,
            ],
            [
                'day' => '7',
                'setScore' => 3490,
            ],
            [
                'day' => '8',
                'setScore' => 2780,
            ],
            [
                'day' => '9',
                'setScore' => 1890,
            ],
            [
                'day' => '10',
                'setScore' => 2390,
            ],
            [
                'day' => '11',
                'setScore' => 3490,
            ],
            [
                'day' => '12',
                'setScore' => 2180,
            ],
            [
                'day' => '13',
                'setScore' => 5890,
            ],
            [
                'day' => '14',
                'setScore' => 390,
            ],
            [
                'day' => '15',
                'setScore' => 3490,
            ],
            [
                'day' => '16',
                'setScore' => 4000,
            ],
            [
                'day' => '17',
                'setScore' => 3000,
            ],
            [
                'day' => '18',
                'setScore' => 2000,
            ],
            [
                'day' => '19',
                'setScore' => 2780,
            ],
            [
                'day' => '20',
                'setScore' => 1890,
            ],
            [
                'day' => '21',
                'setScore' => 2390,
            ],
            [
                'day' => '22',
                'setScore' => 3490,
            ],
            [
                'day' => '23',
                'setScore' => 2780,
            ],
            [
                'day' => '24',
                'setScore' => 1890,
            ],
            [
                'day' => '25',
                'setScore' => 2390,
            ],
            [
                'day' => '26',
                'setScore' => 3490,
            ],
            [
                'day' => '27',
                'setScore' => 2180,
            ],
            [
                'day' => '28',
                'setScore' => 5890,
            ],
            [
                'day' => '29',
                'setScore' => 390,
            ],
            [
                'day' => '30',
                'setScore' => 3490,
            ],
            [
                'day' => '31',
                'setScore' => 4000,
            ]
        );

        foreach ( $data as $row ) {
            $wpdb->insert( $table_name, $row );
        }
    }




    public function wp_rank_chart_tbl(){
        global $wpdb;

        return $wpdb->prefix . CR_PLUGIN_TABLE_NAME; // $wpdb->prefix => wp_
    }

}