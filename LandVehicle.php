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
abstract class LandVehicle extends Vehicle implements TransportMethod\iWheels
{
    /** @var int Count the total number of land vehicles we have */
    public static $land_count = 0;

    /** @var int The number of wheels this vehicle has */
    protected $num_wheels;

    /** @var array Holds the pressures of all the tires in the vehicle */
    protected $tire_pressures = [];

    /** @var int The number of this land vehicle */
    protected $landvehicle_number;

    /** @var bool Determines if land vehicle is in park, all vehicles start in park */
    protected $parked = TRUE;

    protected $engine_on = FALSE;

    /**
     * Construct this Land Vehicle by setting its Land Vehicle number,
     *   increasing Land Vehicle count and calling parent constructor
     *   to do generic Vehicle maintenance.
     *
     * @param int $weight       The weight of the vehicle, in lbs.
     * @param int $cap     The max number of people the vehicle can hold
     */
    public function __construct($weight, $cap) {
        $this->landvehicle_number = LandVehicle::$land_count++;
        echo "Created new Land Vehicle, NUMBER:" . LandVehicle::$land_count . PHP_EOL;
        parent::__construct($weight, $cap);
    }

    /**
     * All land vehicles have tires and tire pressure, this will simply print it.
     *
     * Child classes will further explain which tire is which and then call the
     *   parent method.
     */
    public function check_tire_pressure() {
        //if tire pressure is empty, read it
        if (empty($this->tire_pressures)) {
            $this->read_tire_pressure();
        }

        //handle any number of tires
        for ($i = 0; $i < count($this->tire_pressures); ++$i) {
            echo "Pressure in tire " . ($i + 1) . ": " . $this->tire_pressures[$i] . " psi" . PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * Tell us how many wheels you have.
     */
    public function wheel_count() {
        echo PHP_EOL;
        $this->action("has {$this->num_wheels} wheels");
    }

    /**
     * Tell us the state of the engine, ie is it on or not (note vehicle turns it off
     *   automatically).
     */
    public function engine_state() {
        echo PHP_EOL;
        $this->action("checking engine");
        if ($this->engine_on) {
            $this->action("engine is on! Don't forget to turn it off");
        }
        else {
            $this->action("engine is off");
        }
    }

    /**
     * A function for land vehicles to read their tire pressure and populate
     *   the relevant property. Uses the number of wheels to size the $tire_pressure
     *   array.
     *
     * @see check_tire_pressure() to print the tire pressure
     */
    public function read_tire_pressure() {
        $this->action("reading tire pressure");

        //since we know the number of tires each LandVehicle will have, this loop
        // handles cars, motorcycles, tricycles, etc.
        for ($i = 0; $i < $this->num_wheels ; $i++) {
            $this->tire_pressures[$i] = rand(65, 115);
        }
    }


    /**
     * This is a wrapper to: $this->change_speed(0). this is included in the
     *   LandVehicles section because other vehicle types (i.e. Sea) do not
     *   have brakes. This makes a common term for stopping a car available
     *   to the class.
     *
     * Required for iWheels
     */
    public function brake() {
        echo PHP_EOL;
        $this->action("braking");
        $this->change_speed(0);
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

    /**
     * Indicate if LandVehicle is parked.
     *
     * Required for iWheels
     * @return mixed|void
     */
    public function is_parked() {
        echo PHP_EOL;
        $this->action("checking parking");
        $this->action("is" .( $this->parked ? " " : " not ") . "parked");
    }

    /**
     * Simple function to park the vehicle, will slow it down to 0 beforehand
     *   if it needs to. Then changes the parked flag
     */
    public function park() {
        echo PHP_EOL;
        $this->action("is parking");
        //we should really slow down and stop before we park
        if ($this->current_speed > 0) {
            $this->change_speed(0);
        }

        //get into park and tell everyone
        $this->parked = TRUE;
        $this->action("has parked");
    }

    /**
     * Have to unpark after we've parked! This does just that
     *
     * @return mixed|void
     */
    public function unpark() {
        echo PHP_EOL;
        $this->action("is getting out of park");
        $this->parked = FALSE;
        $this->action("is no longer parked");
    }

    /**
     * Increase the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s). Also going to pretend there is no friction.
     *
     * This is a slightly overridden version of the one in Vehicle. First it sees
     *   if the LandVehicle is parked, if so, it unparks it. Then it calls the
     *   parent method.
     *
     * @param float $rate       Acceleration rate, in m^2
     * @param float $duration   Acceleration time, in s
     */
    public function accelerate($rate, $duration) {
        //can't move if we're parked!
        if($this->parked) {
            $this->unpark();
        }

        //back to parent
        parent::accelerate($rate, $duration);
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
        echo PHP_EOL;
        $this->action("trying to start with key: \"$key\"");

        //see if we have a password, if not end
        if (!isset($this->hashed_password)) {
            echo "This vehicle does not have a key!!
Please make one by using the set_password command!" . PHP_EOL;
            return;
        }

        //had a password, see if it is right
        if (hash('sha256', $key . $this->vehicle_salt) === $this->hashed_password ) {

            //was right, let everyone know
            $this->engine_on = TRUE;
            echo "VROOM!!!! VROOM!!" . PHP_EOL;
            $this->action("started");

            //indicate it was a LandVehicle.
            echo "LandVehicle started." . PHP_EOL;
        }
        else {
            $this->action("FAILURE! Password mismatch!");
        }
    }

    /**
     * Stop the vehicle from moving. If the vehicle is not parked, then we will not
     *   turn the engine off before we park the vehicle. If the vehicle is parked we
     *   can ensure that $current_speed is 0 and we can safely park
     */
    public function stop() {
        //if we aren't parked before we turn the engine off, we're in trouble.
        // So ensure that. This will ensure that park is enabled and current_speed
        // is 0 (all parked vehicles have a current_speed of 0).
        if (!$this->is_parked()) {
            $this->park();
        }

        echo PHP_EOL;
        $this->action("turning engine off");
        $this->engine_on = FALSE;
        $this->action("vehicle off");
    }
}