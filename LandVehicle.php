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
     * Child classes will further explain which tire is which and then call the
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



    //this will essentially be a wrapper to: $this->change_speed(0)
    // this is included in the LandVehicles section because other vehicle types
    // (i.e. Sea, Air) do not have brakes. This makes a common term for stopping
    // a car available to the class
    public function brake() {
        //wrapper for decel_to 0
    }

    /*
     * for cars,
     * need doors, count and array[count] of TF to indicate open or closed
     * door status, list number of doors, location (driver, passenger, back driver), locked, open
     * need to lock and unlock doors
     * need to open doors, check if they are locked first
     *
     * for trucks,
     * need to lower beds
     */

    //like above, only LandVehicles and AirVehicles can park, do not add to Vehicle
    public function is_parked() {

    }

    /**
     * Simple function to park the vehicle, will slow it down to 0 beforehand
     *   if it needs to. Then changes the parked flag
     */
    public function park() {
        echo PHP_EOL;
        echo $this->name() . ": is parking!" . PHP_EOL;
        //we should really slow down and stop before we park
        if ($this->current_speed > 0) {
            $this->decelerate_to(0);
        }

        $this->parked = TRUE;
        echo $this->name() . ": has parked!" . PHP_EOL;
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