<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 11:44 PM
 * To change this template use File | Settings | File Templates.
 */
/**
 * A class that represents the concept of a general land vehicle, like a car or
 *   motorcycle.
 *
 * The class inherits from the generic class, Vehicle
 *
 * @package     Vehicles
 * @subpackage  LandVehicle
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
abstract class LandVehicle extends Vehicle
{
    /** @var int Count the total number of land vehicles we have */
    public static $land_count = 0;

    /** @var int The number of this land vehicle */
    public $land_number;

    /** @var int The number of wheels this vehicle has */
    public $wheel_count;

    /** @var array holds the pressures of all the tires in the vehicle */
    public $tire_pressures = [];

    /**
     * Construct this car by setting its car number, increasing car count and
     *   calling parent constructor to do generic Vehicle maintenance.
     *
     * @param int $weight       The weight of the vehicle, in lbs.
     * @param int $cap     The max number of people the vehicle can hold
     */
    function __construct($weight, $cap) {
        $this->land_number = LandVehicle::$land_count++;
        echo "Created new Land Vehicle";
        parent::__construct($weight, $cap);
    }

    /**
     * All land vehicles have tires and tire pressure, this will simply print it.
     *
     * Child classes will further explain which wheel is which and then call the
     *   parent method.
     */
    function check_tire_pressure() {
        for ($i = 0; $i < count($this->tire_pressures); $i++) {
            echo "Pressure in tire " . $i + 1 . ": " . $this->tire_pressures[$i] . " psi\n";
        }
    }

    /**
     * Raise the land vehicle's speed by a constant acceleration rate for a
     *   duration.
     *
     * @param float $rate       How fast we are accelerating, m/s^2
     * @param float $duration   How long we will accelerate for
     */
    public function accelerate($rate, $duration) {
        $this->current_speed = $rate * $duration;
    }

    /**
     * Also provide a method where we can just pass in a speed and
     *
     * @param int $speed
     */
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
            echo "LandVehicle started. \n";
        }
        else {
            echo "FAILURE! Password mismatch in starting car number: {$this->land_number}";
        }
    }

    public function stop() {

    }

    public function headlights_on() {

    }

    public function headlights_off() {

    }
}