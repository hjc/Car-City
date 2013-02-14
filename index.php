<?php

/**
 * PHP Magic function that gets called every time an undefined class is referenced,
 *  it will include the class if it can.
 *
 * @param string $class_name       The name of the class we want to include.
 */
function __autoload($class_name) {
    include dirname(__FILE__) . '/' . $class_name . '.php';
}

error_reporting(E_ALL);
ini_set('display_errors', '1');


echo "hi";

//$a = new LandVehicle();
//echo LandVehicle::$car_count;

$a->set_password('abc');
$a->start('cde');
$a->start('abc');

echo $a->car_number, $a->vehicle_number;
