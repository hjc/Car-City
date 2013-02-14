<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 11:44 PM
 * To change this template use File | Settings | File Templates.
 */
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
    /** @var int Count the total number of cars we have */
    public static $car_count = 0;

    /** @var int The number of this car */
    public $car_number;

    /**
     * Construct this car by setting its car number, increasing car count and
     *   calling parent constructor to do generic Vehicle maintenance.
     */
    function __construct() {
        $this->car_number = Car::$car_count++;
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

    /**
     * Start the car.
     *
     * Takes in a string that represents the key, hashes it with the salt and sees
     *   if there is a match, if so engine is turned on and we indicate so.
     *
     * @param string $key   The 'key' to the car, which comes in the form of a password.
     */
    public function start($key) {
        if (hash('sha256', $key . $this->vehicle_salt) === $this->hashed_password ) {
            echo "VROOM!!!! VROOM!!\n";
            $this->engine_on = TRUE;
            echo "Car started. \n";
        }
        else {
            echo "FAILURE! Password mismatch in starting car number: {$this->car_number}";
        }
    }

    public function stop() {

    }

    public function headlights_on() {

    }

    public function headlights_off() {

    }
}