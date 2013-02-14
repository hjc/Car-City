<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 11:44 PM
 * To change this template use File | Settings | File Templates.
 */
/**
 * PHP Magic function that gets called every time an undefined class is referenced,
 *  it will include the class if it can.
 *
 * @param string $class_name       The name of the class we want to include.
 */
function __autoload($class_name) {
    include dirname(__FILE__) . $class_name . '.php';
}

/**
 * A class that represents the concept of a car.
 *
 * The class inherits from the generic class, Vehicle
 *
 * @package     Vehicles
 * @subpackage  Car
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
class Car extends Vehicle
{
    public static $car_count = 0;

    //increment number of cars and call parent constructor to handle the rest
    function __construct() {
        ++Car::$car_count;
        parent::__construct();
    }

    //raise the car's speed
    public function accelerate($rate, $duration) {
        $this->current_speed = $rate * $duration;
    }

    public function accelerate_to($speed) {

    }

    public function decelerate($rate, $duration) {

    }

    public function start($key) {

    }

    public function stop() {

    }
}
