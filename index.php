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

//other than that, just run the tests

error_reporting(E_ALL);
ini_set('display_errors', '1');

$cycle = new Motorcycle(1000, 125);
$cycle->test();

$car = new Car(2000, 5, 150, 4);
$car->test();

$tru = new PickupTruck(4000, 2, 100);
$tru->test();

//race car
$car2 = new Car(1000, 2, 350);
$car2->test();


echo PHP_EOL . 'END';

