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


echo "hi";

$a = new Motorcycle(115, 125);
echo LandVehicle::$land_count;

$a->set_password('abc');
$a->start('cde');
$a->start('abc');

//echo $a->motorcycle_number, $a->vehicle_number;

echo '<br>';
$a->check_tire_pressure();
$a->wipers_on();
$a->wipers_off();
