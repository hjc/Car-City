#!/usr/bin/php
<?php

/**
 * PHP Magic function that gets called every time an undefined class is referenced,
 *  it will include the class if it can. This function will handle any classes
 *  that are qualified by a namespace.
 *
 * @param string $class_name       The name of the class we want to include.
 */
function __autoload($class_name) {
    if (strpos($class_name, '\\') !== FALSE) {
        $pieces = explode('\\', $class_name);
        $class_name = $pieces[count($pieces) - 1];
    }
    include dirname(__FILE__) . '/' . $class_name . '.php';
}

error_reporting(E_ALL);
ini_set('display_errors', '1');



/**
 * MOTORCYCLE TEST SUITE!!
 *
 * Create some motorcycles and run them through their paces.
 */
$cycle = new Motorcycle(115, 125);
//echo LandVehicle::$land_count;
$cycle->wheel_count();
$cycle->start('abc');
$key = '1234ac';
$cycle->set_password($key);
$cycle->start("abc");
$cycle->start($key);
$cycle->check_headlights();
$cycle->headlights_on();
$cycle->wipers_on();
$cycle->check_tire_pressure();
$cycle->check_wipers();
$cycle->accelerate(25, 4);
$cycle->read_speed();
$cycle->change_speed(1000);
$cycle->read_speed();
$cycle->turn_left(180);
$cycle->read_direction();
$cycle->turn_right(360);
$cycle->read_direction();
$cycle->turn_left(90.4);
$cycle->read_direction();
$cycle->turn_right(270.4);
$cycle->read_direction();
$cycle->decelerate(25, 4);
$cycle->read_speed();
$cycle->change_speed(0);
$cycle->read_speed();

$cycle->is_parked();
$cycle->park();
$cycle->is_parked();
$cycle->accelerate(100, 15);
$cycle->park();
$cycle->is_parked();
$cycle->accelerate(50, 2);
$cycle->stop();




$cycle->check_headlights();
$cycle->headlights_off();



//echo $a->motorcycle_number, $a->vehicle_number;

echo PHP_EOL . 'END';

