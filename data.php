<?php
/**
 * Fired during plugin activation
 *
 * @link       github.com/kingdanie
 * @since      0.1.0
 *
 * @package    Rank_Chart
 */

header( 'Content-Type => application/json' );

$data = array(
        array(
              'day' => '1',
              'setScore' => 4000,
        ),
        array(
              'day' => '2',
              'setScore' => 3000,
        ),
        array(
              'day' => '3',
              'setScore' => 2000,
        ),
        array(
              'day' => '4',
              'setScore' => 2780,
        ),
        array(
              'day' => '5',
              'setScore' => 1890,
        ),
        array(
              'day' => '6',
              'setScore' => 2390,
        ),
        array(
              'day' => '7',
              'setScore' => 3490,
        ),
        array(
              'day' => '8',
              'setScore' => 2780,
        ),
        array(
              'day' => '9',
              'setScore' => 1890,
        ),
        array(
              'day' => '10',
              'setScore' => 2390,
        ),
        array(
              'day' => '11',
              'setScore' => 3490,
        ),
        array(
              'day' => '12',
              'setScore' => 2180,
        ),
        array(
              'day' => '13',
              'setScore' => 5890,
        ),
        array(
              'day' => '14',
              'setScore' => 390,
        ),
        array(
              'day' => '15',
              'setScore' => 3490,
        ),
        array(
              'day' => '16',
              'setScore' => 4000,
        ),
        array(
              'day' => '17',
              'setScore' => 3000,
        ),
        array(
              'day' => '18',
              'setScore' => 2000,
        ),
        array(
              'day' => '19',
              'setScore' => 2780,
        ),
        array(
              'day' => '20',
              'setScore' => 1890,
        ),
        array(
              'day' => '21',
              'setScore' => 2390,
        ),
        array(
              'day' => '22',
              'setScore' => 3490,
        ),
        array(
              'day' => '23',
              'setScore' => 2780,
        ),
        array(
              'day' => '24',
              'setScore' => 1890,
        ),
        array(
              'day' => '25',
              'setScore' => 2390,
        ),
        array(
              'day' => '26',
              'setScore' => 3490,
        ),
        array(
              'day' => '27',
              'setScore' => 2180,
        ),
        array(
              'day' => '28',
              'setScore' => 5890,
        ),
        array(
              'day' => '29',
              'setScore' => 390,
        ),
        array(
              'day' => '30',
              'setScore' => 3490,
        ),
        array(
              'day' => '31',
              'setScore' => 4000,
        )
    );

echo json_encode($data);
