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

function test (Vehicle $c) {
    //echo LandVehicle::$land_count;
    $c->wheel_count();
    $c->start('abc');
    $key = '1234ac';
    $c->set_password($key);
    $c->start("abc");
    $c->start($key);
    $c->get_direction();
    $c->check_headlights();
    $c->headlights_on();
    $c->wipers_on();
    $c->check_tire_pressure();
    $c->check_wipers();
    $c->accelerate(25, 4);
    $c->get_speed();
    $c->change_speed(1000);
    $c->get_speed();
    $c->turn_left(180);
    $c->get_direction();
    $c->turn_right(360);
    $c->get_direction();
    $c->turn_left(90.4);
    $c->get_direction();
    $c->turn_right(270.4);
    $c->get_direction();
    $c->decelerate(25, 4);
    $c->get_speed();
    $c->change_speed(0);
    $c->get_speed();

    $c->decelerate(25, 4);
    $c->get_speed();


    $c->is_parked();
    $c->park();
    $c->is_parked();
    $c->accelerate(100, 15);
    $c->park();
    $c->is_parked();
    $c->accelerate(50, 2);
    $c->stop();




    $c->check_headlights();
    $c->headlights_off();
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

$c = [['Motorcycle', 115, 125]];

$cycle = new Motorcycle(1000, 125);
test($cycle);

/**
 * MOTORCYCLE TEST SUITE!!
 *
 * Create some motorcycles and run them through their paces.
 */




//echo $a->motorcycle_number, $a->vehicle_number;

echo PHP_EOL . 'END';

