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
    protected $landvehicle_number;

    /** @var int The number of wheels this vehicle has */
    public $wheel_count;

    /** @var array Holds the pressures of all the tires in the vehicle */
    public $tire_pressures = [];

    /** @var bool Determines if land vehicle is in park, all vehicles start in park */
    protected $parked = TRUE;

    /**
     * Construct this Land Vehicle by setting its Land Vehicle number,
     *   increasing Land Vehicle count and calling parent constructor
     *   to do generic Vehicle maintenance.
     *
     * @param int $weight       The weight of the vehicle, in lbs.
     * @param int $cap     The max number of people the vehicle can hold
     */
    function __construct($weight, $cap) {
        $this->landvehicle_number = LandVehicle::$land_count++;
        echo "Created new Land Vehicle" . PHP_EOL;
        parent::__construct($weight, $cap);
    }

    /**
     * All land vehicles have tires and tire pressure, this will simply print it.
     *
     * Child classes will further explain which wheel is which and then call the
     *   parent method.
     */
    function check_tire_pressure() {
        //if tire pressure is empty, read it
        if (empty($this->tire_pressures)) {
            $this->read_tire_pressure();
        }
        for ($i = 0; $i < count($this->tire_pressures); ++$i) {
            echo "Pressure in tire " . ($i + 1) . ": " . $this->tire_pressures[$i] . " psi" . PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * A function for land vehicles to read their tire pressure and populate
     *   the relevant property. Uses the number of wheels to size the $tire_pressure
     *   array.
     *
     * @see check_tire_pressure() to print the tire pressure
     */
    public function read_tire_pressure() {
        echo $this->name() . " reading tire pressure" . PHP_EOL;

        //since we know the number of tires each LandVehicle will have, this loop
        // handles cars, motorcycles, tricycles, etc.
        for ($i = 0; $i < $this->wheel_count ; $i++) {
            $this->tire_pressures[$i] = rand(65, 115);
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
        echo "stub accel";
    }

    public function decelerate($rate, $duration) {
        echo "stub decel";
    }

    public function  decelerate_to($speed) {
        echo "sub decel_to\n";
    }

    /**
     * Start the car.
     *
     * Takes in a string that represents the key, hashes it with the salt and sees
     *   if there is a match, if so engine is turned on and we indicate so.
     *
     * Deal with vehicles that have no keys set.
     *
     * @param string $key   The 'key' to the car, which comes in the form of a password.
     */
    public function start($key) {
        echo "Trying to start LandVehicle: " . $this->name() . " with key $key" . PHP_EOL;
        if (!isset($this->hashed_password)) {
            echo "This vehicle does not have a key!!
Please make one by using the set_password command!" . PHP_EOL;
            return;
        }
        if (hash('sha256', $key . $this->vehicle_salt) === $this->hashed_password ) {
            echo "VROOM!!!! VROOM!!" . PHP_EOL;
            $this->engine_on = TRUE;
            echo "LandVehicle started." . PHP_EOL;
        }
        else {
            echo "FAILURE! Password mismatch in starting car number: {$this->landvehicle_number}" . PHP_EOL;
        }
    }

    public function stop() {
        echo "STUB STOP";
    }
}