<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hayden
 * Date: 2/13/13
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * A class that represents the very basic concept of a Vehicle.
 *
 * Is an abstract class defining generic functions that all vehicles share:
 * - Start
 * - Stop
 * - Accelerate
 * - Decelerate
 *
 * Also implements a few persistent elements, namely a password and salt that,
 *  in theory, would replace the physical key.
 *
 * @package     Vehicles
 * @subpackage  VehicleGeneric
 * @author      Hayden Chudy <hjc1710@gmail.com>
 */
abstract class Vehicle
{
    //helps us make the salt and has other useful methods
    use Text_Helper;
    /** @var int contains total count of vehicles */
    public static $vehicle_count = 0;

    public $vehicle_number = 0;

    /** @var int holds vehicle's current speed */
    public $current_speed = 0;

    /** @var int holds vehicle's top speed */
    public $top_speed;

    /** @var bool is the engine on? alternatively, is the car started? */
    public $engine_on = FALSE;

    /** @var string a salt we will append to our vehicle's password for safety */
    protected  $vehicle_salt;

    /** @var string the hashed password that starts the vehicle, we will see if the
     *              key matches this after it has been hashed. */
    protected $hashed_password;

    /** @var bool are the headlights on? */
    protected $headlights_on = FALSE;

    /**
     * Construct the object, increasing vehicle count, making a future salt, and
     *  setting the vehicle number.
     */
    function __construct() {
        //make a salt for this vehicle's password
        $this->vehicle_salt = $this->create_salt();

        //set vehicle number and then increment vehicle count
        $this->vehicle_number = Vehicle::$vehicle_count++;
    }


    function set_password($string) {
        $this->hashed_password = hash('sha256', $string . $this->vehicle_salt);
    }

    /**
     * Increase the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s).
     *
     * @param float $rate          Acceleration rate, in m^2
     * @param float $duration      Acceleration time, in s
     */
    abstract public function accelerate($rate, $duration);

    /**
     * Decrease the vehicle's speed by providing an acceleration rate (m/s^2) and
     *  a duration (s).
     *
     * @param float $rate          Acceleration rate, in m^2
     * @param float $duration      Acceleration time, in s
     */
    abstract public function decelerate($rate, $duration);

    /**
     * Start the vehicle.
     *
     * @param string $key       A password the user provides to start their vehicle (high-tech, huh?)
     */
    abstract public function start($key);

    /**
     * Stop the vehicle.
     */
    abstract public function stop();

    /**
     * Turn the vehicle's headlights on
     */
    abstract public function headlights_on();

    /**
     * Turn the vehicle's headlights off
     */
    abstract public function headlights_off();
}